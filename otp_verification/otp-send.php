<?php 

require_once 'config.php';
$MOBILE_NUMBER = $_POST['phone_number'];

$get_custom_data_url = $URL.'/'.$API_KEY.'/SMS'.'/'.$MOBILE_NUMBER.'/AUTOGEN';

if(isset($MOBILE_NUMBER)){
// Initializes a new cURL session
$curl = curl_init($get_custom_data_url);

// Set the CURLOPT_RETURNTRANSFER option to true
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// Set the CURLOPT_POST option to true for POST request
curl_setopt($curl, CURLOPT_POST, true);

// Set custom headers for RapidAPI Auth and Content-Type header
curl_setopt($curl, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json'
  ]);

// Execute cURL request with all previous settings
$response = curl_exec($curl);

// Close cURL session
curl_close($curl);
$obj = json_decode($response);
session_start();
$_SESSION['success'] = $obj->{"Status"};
$_SESSION['session_id'] = $obj->{"Details"};

//redirect to otp input page
header("Location: otp-input.php");
exit();
}else{
    echo "Please enter right number!!";
}

?>