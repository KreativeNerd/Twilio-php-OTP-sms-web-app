<?php
session_start();
require_once './vendor/autoload.php';
include ('db_conn.php');

use Twilio\Rest\Client;


$sid = $configVariables['sid'];
$token = $configVariables['token'];
$from = $configVariables['from'];

$countryCode = mysqli_real_escape_string($connection, $_POST['country_code']);

$phoneNumber = mysqli_real_escape_string($connection, $_POST['phone_number']) ;


processData($countryCode, $phoneNumber, $connection); //invoked function

function processData($countryCode, $phoneNumber, $connection) {
    $sql = "SELECT * FROM `users` WHERE `phone_number` = '$phoneNumber' LIMIT 1"; //Note that limit 1 selects only 1 record
    
    $isPhoneNumberPresent = mysqli_query($connection, $sql) or die(mysqli_error($connection));
    $num_row = mysqli_num_rows($isPhoneNumberPresent);
    $row = mysqli_fetch_assoc($isPhoneNumberPresent);
    if($num_row > 0) {
        if($row['is_verified'] == '1') {
            echo "Number Already Verified";die;
        } else {
            sendOTP($countryCode, $phoneNumber, $connection);
            header("location:verify.php");
        }
    } else {
        $sql = "INSERT INTO users VALUES(DEFAULT, '$phoneNumber', '0', '0')";
        $isPhoneNumberPresent = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        sendOTP($countryCode, $phoneNumber, $connection); 
        header("location:verify.php");
    }
}


function sendOTP($countryCode, $phoneNumber, $connection) {
    try {
        global $sid;
        global $token;
        global $from;
        
        $client = new Client($sid , $token);
        
        $otp = generateOTP();

        $message = $client->messages
                  ->create($countryCode . $phoneNumber, // to
                           array("from" => $from, "body" => "Your One Time Password is " . $otp)
                  );   
              
        $sql = "UPDATE `users` SET `otp`= $otp WHERE `phone_number` = '$phoneNumber'";
        $verified = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        $_SESSION['phoneNumber'] = $phoneNumber;                  
    } catch(\Exception $ex) {
        print_r($ex);die;
    }
    
}


function generateOTP() {
    return rand(1000, 9999);
}