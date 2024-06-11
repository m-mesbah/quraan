<?php 


require_once("../vendor/autoload.php");
require_once("../includes/fun.php");
require_once '../controllers/DataHandlingController.php';
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "company_name_herbs";

// $x=['userEmail','userName','phone'];
// $y=['a@a.a','Mesbah','12345678'];
// $connect = new ConnectDb($servername, $username, $password, $dbname);
// $conn = $connect->connectdb();
// // $result = $connect->update(" users ",$x,$y, " userEmail = 'a@a.a' ");
// // $result = $connect->insert(" users ",$x,$y);
// $result = $connect->delete_row(" users "," userEmail "," 'a@a.a' ");

//set mail reciver and sender
$url = "http://herbsland.org";
$from_mail_header='herbs Land';
$from_mail = 'mesbah@herbsland.org';
$userEmailheader = 'Clint';
$mail_body="<html><h1 >reset your Password</h1>To reset your password click: </br> <a href="."$url?access_token=".">Reset your password</a></html>";
$alt_body="Hi there, we are happy to confirm your booking. Please check the document in the attachment.";
$subject = 'Reset your password';
$userEmail = 'm.mesbah@4tel.sa';


$msg='';
//sendeng email
$mail = send_mail($mail_host, $mail_user, $mail_password, $port , $from_mail_header, $from_mail, $userEmailheader, $userEmail ,$mail_body, $alt_body, $subject);
after_send_email($mail, $msg);

print_r($mail->ErrorInfo);