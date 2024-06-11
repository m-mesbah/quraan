<?php 
session_start();
require_once('../controllers/DataHandlingController.php');
require_once('../controllers/DBController.php');

$userEmail = @$_GET['userEmail'] ? $_GET['userEmail'] :array_push(DataHandlingController::$errs,"Error please activate again") ;

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
      array_push(DataHandlingController::$errs,"Error to active this email");
      echo (json_encode(DataHandlingController::$errs)); 
      die();
  }
  else{

    //set new password and null the access token
    $sql = "UPDATE `users` SET `active` = '1'    WHERE userEmail ='$userEmail'";
    $result=$connectDb->select($conn,$sql);
    $success['success']=true;
    $success['successMsg']='The email is activated ';
    $_SESSION['userEmail']=$userEmail;
    $_SESSION['loggedin']=true;
    header("location: ../views/dashboard/index.php");
    
    die();
    }

?>