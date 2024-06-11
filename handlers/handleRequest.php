<?php
session_start();
require_once('../controllers/DataHandlingController.php');
require_once('../controllers/DataValidationController.php');
require_once('../controllers/DBController.php');
require_once('../controllers/AuthController.php');
require_once("../vendor/autoload.php");
require_once("../includes/fun.php");
AuthController::gustAuth('../index.php');


$_REQUEST['id']= rand();
if (isset($_REQUEST['labtop'])) $_REQUEST['labtop'] = 'yes';
if (isset($_REQUEST['mouse_and_pad'])) $_REQUEST['mouse_and_pad'] = 'yes';
if (isset($_REQUEST['headset'])) $_REQUEST['headset'] = 'yes';
if (isset($_REQUEST['lap_stand'])) $_REQUEST['lap_stand'] = 'yes';

$department = DataHandlingController::handleData('department', 'Department is require');
$department = DataValidationController::testInput($department);


$com_name = DataHandlingController::handleData('com_name', 'Company name is require');
$com_name = DataValidationController::testInput($com_name);


$emp_code = DataHandlingController::handleData('emp_code', 'Employee code  is require');
$emp_code = DataValidationController::testInput($emp_code);

$emp_name = DataHandlingController::handleData('emp_name', 'Employee name  is require');
$emp_name = DataValidationController::testInput($emp_name);

if (!preg_match("/^[a-zA-Z-' ]*$/", $emp_name)) {
  array_push(DataHandlingController::$errs, "Invalid Employee name format");
}
//if there an error during handling inputs or validation  it will return errors to ajax 
if (!empty(DataHandlingController::$errs)) {
  echo (json_encode(DataHandlingController::$errs));
  die();
}

$fields = [];
$values = [];
foreach ($_REQUEST as $input => $value) {
  array_push($fields, $input);
  array_push($values, $value);
}
//connecting to database
$connectDb = new ConnectDb($servername, $username, $password, $dbname);

$conn = $connectDb->connectdb();
$connectDb->insert_row('requests', $fields, $values);
$request_number = $conn->insert_id;

##################################
####### sending any email ########
##################################

//set mail reciver and sender
$url = "http://localhost/task/handlers/handleActiveEmail.php";
$from_mail_header = 'ali.maher@makaseb.sa';
$from_mail = 'ali.maher@makaseb.sa';
$userEmailheader = 'makaseb.sa';
$mail_body = "
  <html>
  <body>
    <h1 style='background-color:green; color:white; text-align: center;'>There is a request sent with number: <b style='color:white;'> $request_number </b> </h1></br>
    <p  style='text-align: center;'> open the dashbord to accept it and request from a manager to check it</p>
    <div style='text-align: center;' ><a style='padding:10px; color:white; background-color:green; text-decoration: none;' href='".$_SESSION['domain']."/views/requests/view.php'> View request </a></div> </br> </br>
   </body>
    </html>
";
$alt_body = "Hi there, we are happy to sent you a request. Please check.";
$subject = 'Request number '.$request_number;

// //set mail craiterian
// $mail_host='sandbox.smtp.mailtrap.io';
// $mail_user = '9c133dd7610d47';
// $mail_password = '7073871097ffd8';

$userEmail = 'ali.maher@makaseb.sa';
$msg = 'The request was sent wait until it proved , your request number is: ' . $request_number . '';
//sendeng email
$mail = send_mail($mail_host, $mail_user, $mail_password, $port, $from_mail_header, $from_mail, $userEmailheader, $userEmail, $mail_body, $alt_body, $subject);
after_send_email($mail, $msg);


##################################
####### sending any email ########
##################################


die();
