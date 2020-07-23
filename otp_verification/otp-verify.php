<?php 
require_once 'config.php';
session_start();

$otp_enter = $_POST['otp-enter'];
$get_verify_url = $URL.'/'.$API_KEY.'/SMS'.'/'.'VERIFY'.'/'.$_SESSION['session_id'].'/'.$otp_enter;
    //verify otp enter by the user
    // Initializes a new cURL session
$curl = curl_init($get_verify_url);

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
//$obj = json_decode($response);
$obj = json_decode($response);

if($obj->{"Status"} == "Success" && $obj->{"Details"} == "OTP Matched"){
    echo "otp verify successfuly";
    session_destroy();
    header("refresh:5;url=index.php");
}else if($obj->{"Status"} == "Error" && $obj->{"Details"} == "OTP Mismatch"){
    echo "otp failed";
}else if($obj->{"Status"} == "Success" && $obj->{"Details"} == "OTP Expired"){
    echo "your otp will expired";
}else{
    echo "Internal server Error!!";
}
?>