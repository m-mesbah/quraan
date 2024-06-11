<?php 

session_start();
require_once('../controllers/AuthController.php');
require_once('../controllers/DataHandlingController.php');
require_once('../controllers/DataValidationController.php');
require_once('../controllers/DBController.php');
require_once("../vendor/autoload.php");

require_once("../includes/fun.php");
AuthController::gustAuth('../index.php');

if(@$_SESSION['page']=='home')
{
    if(empty($_GET['id']) || !@$_GET['id'])
    { 
        array_push(DataHandlingController::$errs,"there is on slider to edite");
        echo (json_encode(DataHandlingController::$errs)); 
        die();
    }

    
    $id = $_GET['id'];
    $connect = new ConnectDb($servername, $username, $password, $dbname);
    $conn = $connect->connectdb();
    
    $result = $connect->select_rows(" sliders ","sliders.*","where sliders.id=  $id");
    if($result->num_rows >0){
        echo (json_encode($result->fetch_assoc())); 
        die();
    }
   else{
        array_push(DataHandlingController::$errs,"there is no such slider with that title");
        echo (json_encode(DataHandlingController::$errs)); 
        die();
   }
}