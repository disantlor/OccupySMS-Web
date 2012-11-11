<?php
include '../../bootstrap.php';

$requestData = $_POST;

/*
 * Do some basic validation 
 */
// validate phone
if (! isset($requestData['phone']) || strlen($requestData['phone']) < 10) {
	errorAndExit('Please provide a valid phone number.');
}

// validate address
if (! isset($requestData['address'])) {
	errorAndExit('You did not provide a valid address.');
}

// validate neighborhood
if (! isset($requestData['neighborhood'])) {
	errorAndExit('You did not provide a neighborhood.');
}
	
// validate needs
if (! isset($requestData['needs']) || ! is_array($requestData['needs']) || ! count($requestData['needs'])) {
	errorAndExit('You did not specify any needs.');
}

foreach ($requestData['needs'] as $need) {
	if (! in_array($need, OS_Needs::listValidNeeds())) {
		errorAndExit('You supplied an invalid need. Please choose one of the following: ' . implode(', ', OS_Needs::listValidNeeds()));
	}
} 

function errorAndExit($message = '')
{
	// for some reason headers cause server error on 1and1??
	// header('HTTP 1.0 Bad Request', true, 400);
	echo $message;
	exit;
}

/*
 * Submit AIDEE request 
 */
$results = array();
// validation successful, now create a new Aidee request, one per need supplied (Aidees are represented once per need in db)
foreach ($requestData['needs'] as $need) {
	
	$resultMessage = "[Results for \"{$need}\" request]: ";
	
	try {

		$response = OS_Aidee::create(array(
			'phone' => $requestData['phone'],
			'address' => $requestData['address'],
			'neighborhood' => $requestData['neighborhood'],
			'type' => $need,
			'args' => isset($requestData['details']) ? $requestData['details'] : NULL
		));
		
		$resultMessage .= $response->getBody();
		
	} catch (Exception $e) {
	
		$resultMessage .= 'Sorry, something went wrong and your request was NOT recorded. Try submitting again';
	
	}
	
	$results[] = $resultMessage;
}

/*
 * Success Output
 */
echo json_encode($results);

exit;