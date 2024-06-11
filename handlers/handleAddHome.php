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


if($_POST['type']=='logo'){
    if(empty($_FILES["certificates_logo"]["name"]) || $_FILES["certificates_logo"]["name"] == '' || !@$_FILES["certificates_logo"])
    { 
        array_push(DataHandlingController::$errs,"please choose an image for logo");
        echo (json_encode(DataHandlingController::$errs)); 
        die();
    }

    $img = $_FILES["certificates_logo"];
    $imgName = $img["name"];
    $img_ext = '.'.explode('/',$img["type"])[1];
    $imgName = uniqid() .$img_ext ;
    $tmpName = $img["tmp_name"];

    $connect = new ConnectDb($servername, $username, $password, $dbname);
    $conn = $connect->connectdb();
    $old_logos = @$_SESSION['home']['certificates_logo'];
    $new_logos = !empty($_SESSION['home']['certificates_logo'])? $old_logos . ','.$imgName : $imgName;
    // die($new_logos);
    $result = $connect->update_row("home", " certificates_logo ","$new_logos" , " where id = 1 " );
    move_uploaded_file($tmpName, "../assets/img/home/certificates_logo/$imgName");
    if($result)
    {
        $success['success']=true;
        $success['successMsg']='The certificate logo has been added, wait 2 secends';

        echo (json_encode($success));
        die();
    }
}
elseif($_POST['type']=='sliders'){
    if(empty($_FILES["slider"]["name"]) || $_FILES["slider"]["name"] == '' || !@$_FILES["slider"])
    { 
        array_push(DataHandlingController::$errs,"please choose an image for slider");
        echo (json_encode(DataHandlingController::$errs)); 
        die();
    }
    if(!@$_POST["p"] || !@$_POST["h"] || !@$_POST["button_text"] || !@$_POST["button_url"] )
    { 
        array_push(DataHandlingController::$errs,"please make sure you filled all data");
        echo (json_encode(DataHandlingController::$errs)); 
        die();
    }

    $img = $_FILES["slider"];
    $imgName = $img["name"];
    $img_ext = '.'.explode('/',$img["type"])[1];
    $imgName = uniqid() .$img_ext ;
    $tmpName = $img["tmp_name"];
    
    move_uploaded_file($tmpName, "../assets/img/home/sliders/$imgName");
    $new_silder_fields = [];
    $new_silder = [];

    foreach($_POST as $key=>$value){
        if($key == 'type' ){
            continue;
        }
        array_push($new_silder_fields,$key);
        array_push($new_silder,$value);
    }
    array_push($new_silder_fields,'img');
    array_push($new_silder,$imgName);
    // die(print_r($new_silder_fields).'<br>'.  print_r($new_silder));
    $img = count(explode(',',$_SESSION['home']['slider']));

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "company_name_herbs";

    $connect = new ConnectDb($servername, $username, $password, $dbname);
    $conn = $connect->connectdb();
    $old_logos = @$_SESSION['home']['slider'];
    $new_logos = !empty($_SESSION['home']['slider'])? $old_logos . ','.$imgName : $imgName;
    
    $result = $connect->insert_row("sliders",$new_silder_fields  , $new_silder);
    $last_id = mysqli_insert_id($conn);
    $home_slider = $_SESSION['home']['slider'] != null ? $_SESSION['home']['slider'].','. $last_id : $last_id;
    // die($home_slider);
    $result_slider_home_update = $connect->update_row("home","slider"  , $home_slider,"where id = 1");
  
    if($result && $result_slider_home_update )
    {
        $success['success']=true;
        $success['successMsg']='The slider image has been added, wait 2 secends';

        echo (json_encode($success));
        die();
    }
   
}