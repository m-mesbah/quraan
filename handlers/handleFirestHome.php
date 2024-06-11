<?php

session_start();
require_once('../controllers/AuthController.php');
require_once('../HijriDateLib/hijri.class.php');
require_once('../controllers/DataHandlingController.php');
require_once('../controllers/DataValidationController.php');
require_once('../controllers/DBController.php');
require_once '../vendor/autoload.php';
require_once("../includes/fun.php");
AuthController::gustAuth('../index.php');
// die(print_r($_SESSION));


if(@$_POST['frist_logo']){
 
    if(!@$_FILES["logo"] || empty($_FILES["logo"]["name"])  )
    { 
        array_push(DataHandlingController::$errs,"please make sure you choose a logo image");
        $_SESSION['errs'] = DataHandlingController::$errs;
        header('location : ../views/dashboard/home.php');

    }

    $img = $_FILES["logo"];
    $imgName = 'logo.png' ;
    $tmpName = $img["tmp_name"];


    $connect = new ConnectDb($servername, $username, $password, $dbname);
    $conn = $connect->connectdb();
    $result = $connect->update_row("home","logo"  , $imgName,"where id = 1");
    if($result  )
    {
        move_uploaded_file($tmpName, "../assets/img/$imgName");
        unset($_SESSION['firest_home']);
        header('location: ../views/dashboard/home.php');
        die();
    }

}
$err = false;
if(@$_POST['frist_home_details']=='frist'){
    // die(print_r($_POST));
    if(!@$_FILES["about_img"] || empty($_FILES["about_img"]["name"])  )
    { 
        array_push(DataHandlingController::$errs,"please make sure you choose about image");
        $err = true;

    }
    if(!@$_POST["action_p"] || !@$_POST["action_h"] || !@$_POST["about_p"] || !@$_POST["about_h2"]|| !@$_POST["about_p1"]|| !@$_POST["about_p2"]|| !@$_POST["about_p3"]|| !@$_POST["products_h"]|| !@$_POST["products_p"] )
    { 
        
        if(empty($_POST["action_p"]) || empty($_POST["action_h"]) || empty($_POST["about_p"]) || empty($_POST["about_h2"])|| empty($_POST["about_p1"])|| empty($_POST["about_p2"])|| empty($_POST["about_p3"])|| empty($_POST["products_h"])|| empty($_POST["products_p"]) )
        { 
            
            array_push(DataHandlingController::$errs,"please make sure you filled all data");
            $err = true;
        }
        else{

            array_push(DataHandlingController::$errs,"please make sure you filled all data");
            $err = true;
        }
    }
    if($err) 
    {
        $_SESSION['errs'] = DataHandlingController::$errs;
        header('location: ../views/dashboard/home.php');
        die();
    }

    // die(print_r(DataHandlingController::$errs));
    $img = $_FILES["about_img"];
    $imgName = 'about.png' ;
    $tmpName = $img["tmp_name"];
    $new_silder_fields = [];
    $new_silder = [];
    array_push($new_silder_fields,'id');
    array_push($new_silder,1);
    foreach($_POST as $key=>$value){
        if($key == 'frist_home_details' ){
            continue;
        }
        array_push($new_silder_fields,$key);
        array_push($new_silder,$value);
    }
    array_push($new_silder_fields,'about_img');
    array_push($new_silder,$imgName);

    // die(print_r($new_silder_fields).'<br>'.  print_r($new_silder));

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "company_name_herbs";

    $connect = new ConnectDb($servername, $username, $password, $dbname);
    $conn = $connect->connectdb();
    $result = $connect->insert_row("home",$new_silder_fields  , $new_silder);
    move_uploaded_file($tmpName, "../assets/img/home/$imgName");
    if($result )
    {
        $success['success']=true;
        $success['successMsg']='The home information added, next add a logo ';
        $_SESSION['successMsg'] = $success['successMsg'];
        unset($_SESSION['firest_home'] );
        header('location: ../views/dashboard/home.php');
        die();
    }
 
    die();
   
}