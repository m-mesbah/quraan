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
