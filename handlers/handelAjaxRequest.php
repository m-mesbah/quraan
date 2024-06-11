<?php
session_start();
require_once('../controllers/AuthController.php');
require_once('../controllers/DataHandlingController.php');
require_once('../controllers/DataValidationController.php');
require_once('../controllers/AuthController.php');
require_once('../controllers/DBController.php');
require_once("../vendor/autoload.php");
require_once("../includes/fun.php");
AuthController::gustAuth('../index.php');



if (empty($_GET['id']) || !@$_GET['id']) {
    array_push(DataHandlingController::$errs, "Error ");
    echo (json_encode(DataHandlingController::$errs));
    die();
}

$connectDb = new ConnectDb($servername, $username, $password, $dbname);
$conn = $connectDb->connectdb();
$sql = "SELECT 
       requests.id as id, 
        requests.department as department,
        requests.emp_name as emp_name ,
        requests.emp_code as emp_code ,
        requests.com_name as com_name  ,
        requests.labtop as labtop ,
        requests.mouse_and_pad as mouse_and_pad ,
        requests.headset as headset ,
        requests.lap_stand as lap_stand  ,
        requests.others as others ,
        requests.status as req_status ,
        requests.st_comment as st_comment ,
        requests.re_date as re_date ,
        requests.set_spcs_dat as set_spcs_dat ,
        requests.ceo_app_date as ceo_app_date ,
        requests.acc_date as acc_date ,
        requests.buy_date as buy_date ,
        requests.del_date as del_date ,
        requests.contract as req_contract ,
        requests.spcs as spcs ,
        requests.serial_num as serial_num,
        status.title as title,
        status.description as st_description,
        status.color as color
    FROM `requests` join `status` where requests.status = status.status and requests.id = " . $_GET['id'] . " ";
$result = $connectDb->select($conn, $sql);

if ($result->num_rows > 0) {
    echo (json_encode($result->fetch_assoc()));
    die();
} else {
    array_push(DataHandlingController::$errs, "there is no such slider with that title");
    echo (json_encode(DataHandlingController::$errs));
    die();
}
