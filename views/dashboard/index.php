<?php
session_start();
require_once('../../controllers/AuthController.php');
require_once('../../HijriDateLib/hijri.class.php');
require_once('../../controllers/DataHandlingController.php');
require_once('../../controllers/DataValidationController.php');
require_once('../../controllers/DBController.php');
require_once("../../includes/fun.php");

AuthController::gustAuth('../../index.php');

$userEmail=$_SESSION['userEmail'];
//connecting to database
$connectDb= new ConnectDb($servername,$username,$password,$dbname);

$conn=$connectDb->connectdb();
//get data user
$sql = "SELECT * FROM `users` WHERE userEmail ='$userEmail'";
$result=$connectDb->select($conn,$sql);

// die(print_r($result));

require_once('../../includes/header.php');
require_once('../../includes/nav.php');


if ($result->num_rows > 0) {
  // output data of each row
  
  $userData= $result->fetch_assoc();

  


}
else{
  session_destroy();
  header('location: ../../');
}
?>
<div class="text-center mt-5"><h1 class="text-primary">Welcome <?php echo ($userData['userName']) ?> in Dashboard</h1></div>


<div class=" dflex justify-content-center row  mt-5">
        <a href="./home.php" class="btn btn-success col-md-6 col-lg-3 mx-2 py-3">click here</a>

</div>

<?php

require_once('../../includes/footer.php');


?>

