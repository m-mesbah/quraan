<?php 
session_start();
require_once('../controllers/DataHandlingController.php');
require_once('../controllers/DataValidationController.php');
require_once('../controllers/DBController.php');

//data to reset password

//handling access token and new password
$access_token=DataHandlingController::handleData('access_token','Error to change password please reset the password again ');
$access_token=DataValidationController::testInput($access_token);

$newPassword=DataHandlingController::handleData('password','password is requiered');
$newPassword=DataValidationController::testInput($newPassword);
$newPassword=DataValidationController::hashPass($newPassword);


  if(!empty(DataHandlingController::$errs))
  {
      echo (json_encode(DataHandlingController::$errs)); 
      die();
  }
  

  //see if the access token is correct and the user did not change it from browser


  $connectDb= new ConnectDb($servername,$username,$password,$dbname);

  $conn=$connectDb->connectdb();
  
  $sql = "SELECT * FROM `users` WHERE access_token ='$access_token'";
  $result=$connectDb->select($conn,$sql);
  if($result->num_rows == 0){
      $conn->close();
      array_push(DataHandlingController::$errs,"Error to change password please reset the password again");
      echo (json_encode(DataHandlingController::$errs)); 
      die();
  }
  else{

    //set new password and null the access token
    $sql = "UPDATE `users` SET `access_token` = null ,  `password`='$newPassword' WHERE access_token ='$access_token'";
    $result=$connectDb->select($conn,$sql);
    $success['success']=true;
    $success['successMsg']='The Password is changed we will redirect you to log in after 5 secends ';
    echo (json_encode($success));
    die();
    }

?>