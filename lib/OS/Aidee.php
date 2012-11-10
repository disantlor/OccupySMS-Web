<?php
class OS_Aidee extends OS_Model
{
	private $_db;
	
	public function __construct($data = array())
	{
		$this->setDataArray($data);
	}
	
	/**
	 * Fetch geolocation from data.  If not available, perform geolocate and store data in db
	 * @return mixed array or bool
	 */
	public function getGeolocation()
	{
		if ($this->get('lat') && $this->get('lng')) {
			return array(
				'lat' => $this->get('lat'),
				'lng' => $this->get('lng')
			);
		}
		
		// consult google api helper
		$geolocation = OS_Location::geolocate(
			$this->get('address') . ', ' . $this->getNeighborhoodForDisplay() . ', New York' 
		);
		
		if (! $geolocation) {
			return false;
		}
		
		// cache $geolocation by saving to DB
		$this->_getDbConnection()->update(
			'requests',  
			array(
				'lat' => $geolocation['lat'],
				'lng' => $geolocation['lng']
			),
			'id = ' . $this->get('id')
		);	
		
		return $geolocation;
	}
	
	public function getNeighborhoodForDisplay()
	{
		$neighborhoods = array(
			'staten' => 'Staten Island',
			'coney' => 'Coney Island',
			'rockaway' => 'Rockaway'
		);
		
		return isset($neighborhoods[$this->get('neighborhood')]) ? $neighborhoods[$this->get('neighborhood')] : '';
	}
	
	/* STATIC SERVICE FUNCTIONS */
	/**
	 * fetch all Aidee requests
	 * @return array of OS_Aidee objects 
	 */
	public static function fetch($params = array())
	{
		$aidee = new OS_Aidee();
		$output = array();
		
		// debug query
		$requests = $aidee->_getDbConnection()->query('SELECT * FROM requests');

		foreach ($requests as $request) {
			$output[] = new OS_Aidee($request);
		}
		
		return $output;
	}
	
	/**
	 * fetch all unfulfilled Aidee requests
	 * @return array of OS_Aidee objects 
	 */
	public static function fetchOutstanding()
	{
		$aidee = new OS_Aidee();
		$output = array();
		
		// debug query
		$requests = $aidee->_getDbConnection()->query('SELECT * FROM requests WHERE helped IS NULL');

		foreach ($requests as $request) {
			$output[] = new OS_Aidee($request);
		}
		
		return $output;
	}
	
	/**
	 * Create a new Aidee request
	 * 
	 * For now, this function actually makes a request to the SMS listener script rather than writing to the db directly
	 * This way the validation code, error handling, etc, doesn't need to be duplicated here.
	 * 
	 * @param array of aidee request data
	 * @return Zend_Http_Response
	 */
	public static function create($requestData)
	{
		if (! is_array($requestData)) {
			return false;
		}
		
		// spoof a Mobile Commons GET request
		$requestData['api_key'] = SMS_LISTENER_API_KEY;
		$requestData['keyword'] = $requestData['type'];
		$requestData['profile_neighborhood'] = $requestData['neighborhood'];
		$requestData['profile_street_address'] = $requestData['address'];
		
		$client = new Zend_Http_Client();
		$client->setMethod(Zend_Http_Client::GET);
		$client->setUri(SMS_LISTENER_URL);
		$client->setParameterGet($requestData);
		
		return $client->request();
	}
	
	/* PRIVATE */
	private function _getDbConnection()
	{
		if (! is_null($this->_db)) {
			return $this->_db;
		}
	
		$this->_db = new Zend_Db_Adapter_Pdo_Mysql(array(
			'host'     	=> DB_HOST,
			'port'		=> DB_PORT,
			'username' 	=> DB_USER,
			'password' 	=> DB_PASS,
			'dbname'   	=> DB_NAME
		));
		
		return $this->_db;
	}
	
	
	
}