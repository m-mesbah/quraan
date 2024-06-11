<?php
session_start();
require_once('../../controllers/AuthController.php');
require_once('../../HijriDateLib/hijri.class.php');
require_once('../../controllers/DataHandlingController.php');
require_once('../../controllers/DataValidationController.php');
require_once('../../controllers/DBController.php');
require_once '../../vendor/autoload.php';
require_once("../../includes/fun.php");
require_once('../../includes/header.php');
require_once('../../includes/nav.php');
AuthController::gustAuth('../../index.php');



?>


<div class="text-center mt-5 text-success">
    <h1>Welcome <?php echo @$_SESSION['userName'] ?> To makaseb Hr system</h1>
</div>

<div class=" dflex justify-content-center row  mt-5">
        <a href="../requests/view.php" class="btn btn-success col-md-6 col-lg-3 m-2 py-2"> Show requests</a>
        <?php if(@$_SESSION['group_id'] == '5' ||@$_SESSION['group_id'] == '100') {?>
        <a href="../requests/requests.php" class="btn btn-success col-md-6 col-lg-3 m-2 py-2"> Add requests</a>
        <?php } ?>
</div>

<?php require_once('../../includes/footer.php'); ?>