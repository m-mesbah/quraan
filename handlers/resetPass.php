<?php 
session_start();
require_once('../controllers/DataHandlingController.php');
require_once('../controllers/DataValidationController.php');
require_once('../controllers/DBController.php');
require_once('../controllers/DBController.php');
require_once("../vendor/autoload.php");
require_once("../includes/fun.php");

// //data to reset password
$userEmail=DataHandlingController::handleData('email','Email is require');
$userEmail=DataValidationController::testInput($userEmail);

// $userEmail = $_GET['email'];
if (!filter_var($userEmail,FILTER_VALIDATE_EMAIL )) {
  array_push(DataHandlingController::$errs,"Invalid email format");
}
if(!empty(DataHandlingController::$errs))
{
    echo (json_encode(DataHandlingController::$errs)); 
    die();
}

$connectDb= new ConnectDb($servername,$username,$password,$dbname);

$conn=$connectDb->connectdb();

$sql = "SELECT * FROM `users` WHERE userEmail ='$userEmail'";
$result=$connectDb->select($conn,$sql);
if($result->num_rows == 0){
  $conn->close();
  array_push(DataHandlingController::$errs,"The email you just enterd is not exist");
  echo (json_encode(DataHandlingController::$errs)); 
  die();
}
else{
  $userData = $result->fetch_assoc();
  if($userData['active']=='0'){
    array_push(DataHandlingController::$errs,"This email is not activated  click here to active your email: <a href='http://localhost/task/views/email_active/index.php?userEmail=$userEmail' class='  text-dark p-1'>Activate</a>");
    echo (json_encode(DataHandlingController::$errs)); 
    die();
}

  //if email is exist set access_tocken to make sure no attacker change any email
  $access_token=uniqid();
  $sql = "UPDATE `users` SET `access_token` = '$access_token' WHERE `userEmail` ='$userEmail'";
  $result=$connectDb->select($conn,$sql);
  
  }




##################################
####### sending any email ########
##################################

//set mail reciver and sender
$url = "http://localhost/task/views/resetPass/index.php";
$from_mail_header='makaseb.com';
$from_mail = 'Makaseb';
$userEmailheader = 'mail.com';
$mail_body="<html><h1 >reset your Password</h1>To reset your password click: </br> <a href="."$url?access_token=$access_token".">Reset your password</a></html>";
$alt_body="Hi there, we are happy to confirm your booking. Please check the document in the attachment.";
$subject = 'Reset your password';

//set mail craiterian

// $mail_host='sandbox.smtp.mailtrap.io';
// $mail_user = '9c133dd7610d47';
// $mail_password = '7073871097ffd8';
// $port = 2525;

// $mail_host='p3plzcpnl499908.prod.phx3.secureserver.net';
// $mail_user = 'mesbah@king-of-herbs.com';
// $mail_password = 'Mahammad@101459012';
// $port = 465;
$msg = 'The email  had been send to your email, check your email';
//sendeng email
$mail = send_mail($mail_host, $mail_user, $mail_password, $port , $from_mail_header, $from_mail, $userEmailheader, $userEmail ,$mail_body, $alt_body, $subject);
after_send_email($mail,$msg);

##################################
####### sending any email ########
##################################

die();