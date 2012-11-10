<?php
include '../../bootstrap.php';

$requestData = $_POST;

/*
 * Do some basic validation 
 */
// validate phone
if (! isset($requestData['phone'])) {
	header('You did not provide a phone number.', true, 400);
	exit;
}

// validate address
if (! isset($requestData['address'])) {
	header('You did not provide a valid address.', true, 400);
	exit;
}

// validate neighborhood
if (! isset($requestData['neighborhood'])) {
	header('You did not provide a neighborhood.', true, 400);
	exit;
}
	
// validate needs
if (! isset($requestData['needs']) || ! is_array($requestData['needs']) || ! count($requestData['needs'])) {
	header('You did not specify any needs.', true, 400);
	exit;
}

foreach ($requestData['needs'] as $need) {
	if (! in_array($need, OS_Needs::listValidNeeds())) {
		header('You supplied an invalid need. Please choose one of the following: ' . implode(', ', OS_Needs::listValidNeeds()), true, 400);
		exit;
	}
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