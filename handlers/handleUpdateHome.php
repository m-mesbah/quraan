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

// die(print_r($_POST));
if($_POST['type'] == 'logo'){
    if(empty($_FILES["logo"]["name"]) || $_FILES["logo"]["name"] == '' || !@$_FILES["logo"])
    { 
        // die('4643');
        array_push(DataHandlingController::$errs,"please choose an image for logo");
        echo (json_encode(DataHandlingController::$errs)); 
        die();
    }
    $img = $_FILES["logo"];
    $imgName = 'logo.png' ;
    $tmpName = $img["tmp_name"];
    move_uploaded_file($tmpName, "../assets/img/$imgName");
    $success['success']=true;
    $success['successMsg']='The logo has been Updated';
    
    echo (json_encode($success));
    die();
}
if($_POST['type']== 'slider'){
    if(empty($_FILES["img"]["name"]) || $_FILES["img"]["name"] == '' || !@$_FILES["img"])
    { 
        // die('4643');
        array_push(DataHandlingController::$errs,"please choose an image for about section");
        echo (json_encode(DataHandlingController::$errs)); 
        die();
    }

    if(!@$_POST["p"] || !@$_POST["h"] || !@$_POST["button_text"] || !@$_POST["button_url"] )
    { 
        // die('4643');
        array_push(DataHandlingController::$errs,"please make sure you filled all data");
        echo (json_encode(DataHandlingController::$errs)); 
        die();
    }

    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "company_name_herbs";

    $id = $_POST['id'];
    $new_silder_fields = [];
    $new_silder = [];

    foreach($_POST as $key=>$value){
        if($key == 'type' || $key == 'old_img'){
            continue;
        }
        array_push($new_silder_fields,$key);
        array_push($new_silder,$value);
    }
    $img = $_FILES["img"];
    $imgName = uniqid().'.'. explode('/',$img['type'])[1];  
    $tmpName = $img["tmp_name"];
    $old_img = $_POST['old_img'];
    array_push($new_silder_fields,'img');
    array_push($new_silder,$imgName);
   
    $connect = new ConnectDb($servername, $username, $password, $dbname);
    $conn = $connect->connectdb();
    
    $result = $connect->update_row("sliders", $new_silder_fields  ,$new_silder , "where id = '$id' " );
    // die(print_r($new_silder_fields).'<br>'.  print_r($new_silder));
    move_uploaded_file($tmpName, "../assets/img/home/sliders/$imgName");
    unlink("../assets/img/home/sliders/$old_img");
    if($result)
    {
        $success['success']=true;
        $success['successMsg']='The certificate logo has been added, wait 2 secends';

        echo (json_encode($success));
        die();
    }

    $success['success']=true;
    $success['successMsg']='The data has been Updated';
    
    echo (json_encode($success));
    die();
}
