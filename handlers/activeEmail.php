<?php 
session_start();
require_once('../controllers/DataHandlingController.php');
require_once('../controllers/DataValidationController.php');
// require_once('../controllers/AuthController.php');
require_once('../controllers/DBController.php');
require_once("../vendor/autoload.php");
require_once("../includes/fun.php");


// //data to reset password
$userEmail=DataHandlingController::handleData('email','Email is require');
$userEmail=DataValidationController::testInput($userEmail);

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
  array_push(DataHandlingController::$errs,"The email  is not exist");
  echo (json_encode(DataHandlingController::$errs)); 
  die();
}

$userData = $result->fetch_assoc();
if($userData['active']=='0'){
    
  ##################################
  ####### sending any email ########
  ##################################

  //set mail reciver and sender
  $url = "http://localhost/task/handlers/handleActiveEmail.php";
  $from_mail_header='makaseb.com';
  $from_mail = 'mesbah@herbsland.org';
  $userEmailheader = 'mail.com';
  $mail_body="<html><h1 >Activate your email</h1>To Activate your email click: </br> <a href="."$url?userEmail=$userEmail".">Activate</a></html>";
  $alt_body="Hi there, we are happy to confirm your booking. Please check the document in the attachment.";
  $subject = 'Active your e-mail';

  // //set mail craiterian
  // $mail_host='sandbox.smtp.mailtrap.io';
  // $mail_user = '9c133dd7610d47';
  // $mail_password = '7073871097ffd8';

  $msg = '';
  //sendeng email
  $mail = send_mail($mail_host, $mail_user,  $mail_password, $port , $from_mail_header, $from_mail, $userEmailheader, $userEmail ,$mail_body, $alt_body, $subject);
  after_send_email($mail, $msg);

  ##################################
  ####### sending any email ########
  ##################################

  die();
}
else{

  array_push(DataHandlingController::$errs,"This email is already activated");
  echo (json_encode(DataHandlingController::$errs)); 
  die();
}