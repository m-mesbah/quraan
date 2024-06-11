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

// die($_SESSION['group_id']);
if( @$_SESSION['group_id'] != '7' && @$_SESSION['group_id'] != '100' )
{
    header("location:  ".$_SESSION['domain']."/index.php");

}

$connectDb = new ConnectDb($servername, $username, $password, $dbname);
$conn = $connectDb->connectdb();
if( @$_SESSION['group_id'] == '7')$sql = "SELECT * FROM `users` where group_id != '100' and group_id != '7'";
if( @$_SESSION['group_id'] == '100')$sql = "SELECT * FROM `users` where group_id != '100' ";
$result = $connectDb->select($conn, $sql);

?>


<div class="container">
    <div class="text-center mt-4">
        <div class=" position-fixed text-text-center " style='z-index:99999999999999;right: 0px; left:0px; top:0px; ' >
            <div class="bg-success text-center text-white successMsg"></div>
            <div class="bg-danger text-center text-white Err"></div>
        </div>
        
        <h4 class="text-success">Users</h4>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Currunt possition</th>
                <th scope="col">Set possition</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $result->fetch_assoc()) {
            ?>
                <tr>
                    <td scope="col"><?php echo $row['userName'] ?></td>
                    <td scope="col"><?php echo $row['userEmail'] ?></td>
                    <td scope="col">
                       <?php
                            switch ($row['group_id']) {
                                case '0':
                                  echo 'User';
                                  break;
                                case '1':
                                    echo 'CEO';
                                  break;
                                case '3':
                                    echo 'Accountant';
                                  break;
                                case '7':
                                    echo 'IT';
                                  break;
                                case '5':
                                    echo 'HR';
                                  break;
                               
                                }
                       ?>
                    
                    </td>
                    <td scope="col">
                        <form id='updateGroupIdForm' action="<?php echo  $_SESSION['domain'] ?>/handlers/setGroupId.php" class="text-center" method="get">
                           <select name="group_id" id="" class="">
                              <option <?php if($row['group_id'] == '0') echo 'selected'; ?> value="0">User</option>
                              <option <?php if($row['group_id'] == '1') echo 'selected'; ?> value="1">CEO</option>
                              <option <?php if($row['group_id'] == '3') echo 'selected'; ?> value="3">Accountant</option>
                              <option <?php if($row['group_id'] == '5') echo 'selected'; ?> value="5">HR</option>
                              <option <?php if($row['group_id'] == '7') echo 'selected'; ?> value="7">IT</option>
                           </select>
                           <input type="text" name="user_id" value="<?php echo $row['id'] ?>" hidden >
                            <button type="submit" id='updateGroupId' class="btn btn-success mt-1 submit_btn">Set</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php require_once('../../includes/footer.php'); ?>