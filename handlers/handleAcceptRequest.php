<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('../controllers/AuthController.php');
require_once('../controllers/DataHandlingController.php');
require_once('../controllers/AuthController.php');
require_once('../controllers/DataValidationController.php');
require_once('../controllers/DBController.php');
require_once("../vendor/autoload.php");
require_once("../includes/fun.php");
AuthController::gustAuth('../index.php');



$connectDb = new ConnectDb($servername, $username, $password, $dbname);
$conn = $connectDb->connectdb();
$date = date('Y-m-d H:i:s');
if(@$_GET['status'] == '1' )
{
    $sql = "UPDATE `requests` SET `set_spcs_dat` = '".$date."', `status` = '".$_GET['status']."', `spcs` = '".$_GET['spcs']."' WHERE `requests`.`id` = '".$_GET['id']."'";
    $result = $connectDb->select($conn, $sql);

##################################
####### sending any email ########
##################################

//set mail reciver and sender
$from_mail_header = 'ali.maher@makaseb.sa';
$from_mail = 'ali.maher@makaseb.sa';
$userEmailheader = 'makaseb.sa';
$mail_body = "
  <html>
  <body>
    <h1 style='background-color:green; color:white; text-align: center;'>There is a request sent with number: <b style='color:white;'> ".$_GET['id']." </b> </h1></br>
    <p  style='text-align: center;'> open the dashbord to accept it and request from a manager to check it</p>
    <div style='text-align: center;' ><a style='padding:10px; color:white; background-color:green; text-decoration: none;' href='".$_SESSION['domain']."/views/requests/view.php'> View request </a></div> </br> </br>
   </body>
    </html>
";
$alt_body = "Hi there, we are happy to sent you a request. Please check.";
$subject = 'Request number '.$_GET['id'];

// //set mail craiterian
// $mail_host='sandbox.smtp.mailtrap.io';
// $mail_user = '9c133dd7610d47';
// $mail_password = '7073871097ffd8';

$userEmail = 'ali.maher@makaseb.sa'; // ceo
$msg = 'The Spicifications sent to CEO for request : '.$_GET['id'].'';
//sendeng email
$mail = send_mail($mail_host, $mail_user, $mail_password, $port, $from_mail_header, $from_mail, $userEmailheader, $userEmail, $mail_body, $alt_body, $subject);
after_send_email_($mail, $msg);


##################################
####### sending any email ########
##################################

}

if(@$_GET['status'] == '2' )
{
    $sql = "UPDATE `requests` SET `st_comment` = '".$_GET['st_comment']."', `status` = '".$_GET['status']."' WHERE `requests`.`id` = '".$_GET['id']."'";
    $result = $connectDb->select($conn, $sql);

    
##################################
####### sending any email ########
##################################

//set mail reciver and sender
$from_mail_header = 'ali.maher@makaseb.sa';
$from_mail = 'ali.maher@makaseb.sa';
$userEmailheader = 'makaseb.sa';
$mail_body = "
  <html>
  <body>
    <h1 style='background-color:red; color:white; text-align: center;'>There is a request sent with number: <b style='color:white;'> ".$_GET['id']." </b> </h1></br>
    <p  style='text-align: center;'> open the dashbord to accept it and request from a manager to check it</p>
    <div style='text-align: center;' ><a style='padding:10px; color:white; background-color:green; text-decoration: none;' href='".$_SESSION['domain']."/views/requests/view.php'> View request </a></div> </br> </br>
   </body>
    </html>
";
$alt_body = "Hi there, we are happy to sent you a request. Please check.";
$subject = 'Request number '.$_GET['id'];

// //set mail craiterian
// $mail_host='sandbox.smtp.mailtrap.io';
// $mail_user = '9c133dd7610d47';
// $mail_password = '7073871097ffd8';

$userEmail = 'ali.maher@makaseb.sa'; // HR
$msg = 'The Spicifications sent to CEO for request : '.$_GET['id'].'';
//sendeng email
$mail = send_mail($mail_host, $mail_user, $mail_password, $port, $from_mail_header, $from_mail, $userEmailheader, $userEmail, $mail_body, $alt_body, $subject);
after_send_email_($mail, $msg);


##################################
####### sending any email ########
##################################


}
if(@$_GET['status'] == '3' )
{
    $sql = "UPDATE `requests` SET `ceo_app_date` = '".$date."', `status` = '".$_GET['status']."' WHERE `requests`.`id` = '".$_GET['id']."'";
    $result = $connectDb->select($conn, $sql);

    
##################################
####### sending any email ########
##################################

//set mail reciver and sender
$from_mail_header = 'ali.maher@makaseb.sa';
$from_mail = 'ali.maher@makaseb.sa';
$userEmailheader = 'makaseb.sa';
$mail_body = "
  <html>
  <body>
    <h1 style='background-color:green; color:white; text-align: center;'>There is a request sent with number: <b style='color:white;'> ".$_GET['id']." </b> </h1></br>
    <p  style='text-align: center;'> open the dashbord to accept it and request from a manager to check it</p>
    <div style='text-align: center;' ><a style='padding:10px; color:white; background-color:green; text-decoration: none;' href='".$_SESSION['domain']."/views/requests/view.php'> View request </a></div> </br> </br>
   </body>
    </html>
";
$alt_body = "Hi there, we are happy to sent you a request. Please check.";
$subject = 'Request number '.$_GET['id'];

// //set mail craiterian
// $mail_host='sandbox.smtp.mailtrap.io';
// $mail_user = '9c133dd7610d47';
// $mail_password = '7073871097ffd8';

$userEmail = 'ali.maher@makaseb.sa'; // ACC
$msg = 'The Spicifications sent to CEO for request : '.$_GET['id'].'';
//sendeng email
$mail = send_mail($mail_host, $mail_user, $mail_password, $port, $from_mail_header, $from_mail, $userEmailheader, $userEmail, $mail_body, $alt_body, $subject);
after_send_email_($mail, $msg);


##################################
####### sending any email ########
##################################

    
}
if(@$_GET['status'] == '4' )
{
    $sql = "UPDATE `requests` SET `acc_date` = '".$_GET['acc_date']."', `status` = '".$_GET['status']."' WHERE `requests`.`id` = '".$_GET['id']."'";
    $result = $connectDb->select($conn, $sql);
    
##################################
####### sending any email ########
##################################

//set mail reciver and sender
$from_mail_header = 'ali.maher@makaseb.sa';
$from_mail = 'ali.maher@makaseb.sa';
$userEmailheader = 'makaseb.sa';
$mail_body = "
  <html>
  <body>
    <h1 style='background-color:green; color:white; text-align: center;'>There is a request sent with number: <b style='color:white;'> ".$_GET['id']." </b> </h1></br>
    <p  style='text-align: center;'> open the dashbord to accept it and request from a manager to check it</p>
    <div style='text-align: center;' ><a style='padding:10px; color:white; background-color:green; text-decoration: none;' href='".$_SESSION['domain']."/views/requests/view.php'> View request </a></div> </br> </br>
   </body>
    </html>
";
$alt_body = "Hi there, we are happy to sent you a request. Please check.";
$subject = 'Request number '.$_GET['id'];

// //set mail craiterian
// $mail_host='sandbox.smtp.mailtrap.io';
// $mail_user = '9c133dd7610d47';
// $mail_password = '7073871097ffd8';

$userEmail = 'ali.maher@makaseb.sa'; // ceo
$msg = 'The Spicifications sent to CEO for request : '.$_GET['id'].'';
//sendeng email
$mail = send_mail($mail_host, $mail_user, $mail_password, $port, $from_mail_header, $from_mail, $userEmailheader, $userEmail, $mail_body, $alt_body, $subject);
after_send_email_($mail, $msg);


##################################
####### sending any email ########
##################################


}
if(@$_GET['status'] == '5' )
{
    $sql = "UPDATE `requests` SET `status` = '".$_GET['status']."' WHERE `requests`.`id` = '".$_GET['id']."'";
    $result = $connectDb->select($conn, $sql);
    
##################################
####### sending any email ########
##################################

//set mail reciver and sender
$from_mail_header = 'ali.maher@makaseb.sa';
$from_mail = 'ali.maher@makaseb.sa';
$userEmailheader = 'makaseb.sa';
$mail_body = "
  <html>
  <body>
    <h1 style='background-color:green; color:white; text-align: center;'>There is a request sent with number: <b style='color:white;'> ".$_GET['id']." </b> </h1></br>
    <p  style='text-align: center;'> open the dashbord to accept it and request from a manager to check it</p>
    <div style='text-align: center;' ><a style='padding:10px; color:white; background-color:green; text-decoration: none;' href='".$_SESSION['domain']."/views/requests/view.php'> View request </a></div> </br> </br>
   </body>
    </html>
";
$alt_body = "Hi there, we are happy to sent you a request. Please check.";
$subject = 'Request number '.$_GET['id'];

// //set mail craiterian
// $mail_host='sandbox.smtp.mailtrap.io';
// $mail_user = '9c133dd7610d47';
// $mail_password = '7073871097ffd8';

$userEmail = 'ali.maher@makaseb.sa'; // ceo
$msg = 'The Spicifications sent to CEO for request : '.$_GET['id'].'';
//sendeng email
$mail = send_mail($mail_host, $mail_user, $mail_password, $port, $from_mail_header, $from_mail, $userEmailheader, $userEmail, $mail_body, $alt_body, $subject);
after_send_email_($mail, $msg);


##################################
####### sending any email ########
##################################


}

if(@$_GET['status'] == '6' )
{
    $sql = "UPDATE `requests` SET `buy_date` = '".$date."', `status` = '".$_GET['status']."' WHERE `requests`.`id` = '".$_GET['id']."'";
    $result = $connectDb->select($conn, $sql);

    
##################################
####### sending any email ########
##################################

//set mail reciver and sender
$from_mail_header = 'ali.maher@makaseb.sa';
$from_mail = 'ali.maher@makaseb.sa';
$userEmailheader = 'makaseb.sa';
$mail_body = "
  <html>
  <body>
    <h1 style='background-color:green; color:white; text-align: center;'>There is a request sent with number: <b style='color:white;'> ".$_GET['id']." </b> </h1></br>
    <p  style='text-align: center;'> open the dashbord to accept it and request from a manager to check it</p>
    <div style='text-align: center;' ><a style='padding:10px; color:white; background-color:green; text-decoration: none;' href='".$_SESSION['domain']."/views/requests/view.php'> View request </a></div> </br> </br>
   </body>
    </html>
";
$alt_body = "Hi there, we are happy to sent you a request. Please check.";
$subject = 'Request number '.$_GET['id'];

// //set mail craiterian
// $mail_host='sandbox.smtp.mailtrap.io';
// $mail_user = '9c133dd7610d47';
// $mail_password = '7073871097ffd8';

$userEmail = 'ali.maher@makaseb.sa'; // ceo
$msg = 'The Spicifications sent to CEO for request : '.$_GET['id'].'';
//sendeng email
$mail = send_mail($mail_host, $mail_user, $mail_password, $port, $from_mail_header, $from_mail, $userEmailheader, $userEmail, $mail_body, $alt_body, $subject);
after_send_email_($mail, $msg);


##################################
####### sending any email ########
##################################


}
if(@$_POST['status'] == '7' ){
    $contract = $_FILES["contract"];
    $contractName = $contract["name"];
    $contractName = uniqid() . time() . $contract["name"];
    $tmpName = $contract["tmp_name"];
    move_uploaded_file($tmpName, "../assets/contracts/".$contractName."");
    $sql = "UPDATE `requests` SET `del_date` = '".$date."', `status` = '".$_POST['status']."', `serial_num` = '".$_POST['serial_num']."', `contract` = '".$contractName."' WHERE `requests`.`id` = '".$_POST['id']."'";
    $result = $connectDb->select($conn, $sql);
    
##################################
####### sending any email ########
##################################

//set mail reciver and sender
$from_mail_header = 'ali.maher@makaseb.sa';
$from_mail = 'ali.maher@makaseb.sa';
$userEmailheader = 'makaseb.sa';
$mail_body = "
  <html>
  <body>
    <h1 style='background-color:green; color:white; text-align: center;'>There is a request sent with number: <b style='color:white;'> ".$_GET['id']." </b> </h1></br>
    <p  style='text-align: center;'> open the dashbord to accept it and request from a manager to check it</p>
    <div style='text-align: center;' ><a style='padding:10px; color:white; background-color:green; text-decoration: none;' href='".$_SESSION['domain']."/views/requests/view.php'> View request </a></div> </br> </br>
   </body>
    </html>
";
$alt_body = "Hi there, we are happy to sent you a request. Please check.";
$subject = 'Request number '.$_GET['id'];

// //set mail craiterian
// $mail_host='sandbox.smtp.mailtrap.io';
// $mail_user = '9c133dd7610d47';
// $mail_password = '7073871097ffd8';

$userEmail = 'ali.maher@makaseb.sa'; // ceo
$msg = 'The Spicifications sent to CEO for request : '.$_GET['id'].'';
//sendeng email
$mail = send_mail($mail_host, $mail_user, $mail_password, $port, $from_mail_header, $from_mail, $userEmailheader, $userEmail, $mail_body, $alt_body, $subject);
after_send_email_($mail, $msg);


##################################
####### sending any email ########
##################################

}



?>
