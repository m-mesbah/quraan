<?php 
if($_SERVER['SERVER_NAME']=='localhost')$_SESSION['domain'] = " http://".$_SERVER['SERVER_NAME'].'/hr/github/quraan';
if($_SERVER['SERVER_NAME']!='localhost')$_SESSION['domain'] = " http://".$_SERVER['SERVER_NAME'].'/hr/github/quraan';
// Start with PHPMailer class 
use PHPMailer\PHPMailer\PHPMailer;

$servername = "localhost";
$username = "admin";
$password = "1234@Ali";
$dbname = "makaseb_req";

if($_SERVER['SERVER_NAME']=='localhost'){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "makaseb_hr";
}
//set mail craiterian
// $mail_host='sandbox.smtp.mailtrap.io';
// $mail_user = '9c133dd7610d47';
// $mail_password = '7073871097ffd8';
// $port = 2525;

// websmail craiterians
$mail_host='smtp.gmail.com';
$mail_user = 'ali.maher@soar.inc';
$mail_password = 'AaaMmm_00';
$port = 587;

function send_mail($mail_host, $mail_user, $mail_password,$port , $from_mail_header, $from_mail, $userEmailheader, $userEmail, $body , $alt_body, $subject){

    // create a new object
    $mail = new PHPMailer();
   
    //set mail craiterian
    $mail->isSMTP();
    $mail->Host = "$mail_host";
    $mail->SMTPAuth = true;
    $mail->Username = "$mail_user" ;
    $mail->Password = "$mail_password";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = $port;
    
    //set mail reciver and sender
    $mail->setFrom("$from_mail", "$from_mail_header");
    $mail->addAddress("$userEmail", "$userEmailheader");
    $mail->Subject = "$subject";
   
    // Set HTML 
    $mail->isHTML(TRUE);
    $mail->Body = "$body";
    $mail->AltBody = "$alt_body";
    return $mail;
    
    }
    
    function after_send_email($mail, $msg)
    {
      // send the message
      if (!$mail->send()) {
        array_push(DataHandlingController::$errs, "There is an error to send mail, please try again");
        echo (json_encode(DataHandlingController::$errs));
      } else {
        //success massage will show after send mail 
        $success['success'] = true;
        $success['successMsg'] = "$msg";
        echo (json_encode($success));
        die();
      }
    }
    function after_send_email_($mail, $msg)
    {

      // send the message
      if (!$mail->send()) {

        $_SESSION['req_err'] = '<p class="py-3 mt-3 text-whit">There is an error to sending mail but the request isupdated </p>';
        header('location: ../views/requests/view.php');
      } else {
        //success massage will show after send mail 
     $_SESSION['req_succ'] = '<p class="py-3 mt-3 text-whit">The request now handed to CEO wait until he accept it</p>';
    if(@$_GET['status'] == '2' )$_SESSION['req_succ'] = '<p class="py-3 mt-3 text-whit">The request Rejected</p>';
    if(@$_GET['status'] == '3' )$_SESSION['req_succ'] = '<p class="py-3 mt-3 text-whit">The request accepted</p>';
    if(@$_GET['status'] == '4' )$_SESSION['req_succ'] = '<p class="py-3 mt-3 text-whit">The date was set</p>';
    if(@$_GET['status'] == '5' )$_SESSION['req_succ'] = '<p class="py-3 mt-3 text-whit">The devices in buy state now</p>';
    if(@$_GET['status'] == '6' )$_SESSION['req_succ'] = '<p class="py-3 mt-3 text-whit">The request moved to completed state</p>';
    if(@$_POST['status'] == '7' )$_SESSION['req_succ'] = '<p class="py-3 mt-3 text-whit">The devices delivered</p>';
    header('location: ../views/requests/view.php');

      }
    }