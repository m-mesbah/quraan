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
$sql = "UPDATE `users` SET `group_id` = '".$_GET['group_id']."' WHERE `id` = '".$_GET['user_id']."'";
$result = $connectDb->select($conn, $sql);
$success['success'] = true;
$success['successMsg'] = 'DONE';
echo (json_encode($success));

die();
?>
