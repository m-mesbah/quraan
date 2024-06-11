

<?php

session_start();
$location = true;
require_once('./controllers/AuthController.php');
require_once('./includes/header.php');
require_once('./controllers/DBController.php');
require_once("./vendor/autoload.php");
require_once("./includes/fun.php");
require_once("./includes/header.php");
require_once("./includes/nav.php");


?>


    
     

    <main >

        <div class="container">
            <div class="row  justify-content-between align-items-around my-5" dir='rtl'>
                
            
                <a href="<?php echo  $_SESSION['domain'] ?>/views/quraan/read.php" class="col-md-5  bg-success  text-center  align-content-center text-decoration-none mx-md-3 my-3" style='height: 200px; border-color: transparent; border-width: 10px; ' >
                    <h2 class="text-white">القرآن الكريم</h2>
                </a>
                <a href="<?php echo  $_SESSION['domain'] ?>/views/quraan/listen.php" class="col-md-5  bg-success  text-center  align-content-center text-decoration-none mx-md-3 my-3" style='height: 200px; border-color: transparent; border-width: 10px; ' >
                    <h2 class="text-white">القرآن الكريم صوت</h2>
                </a>
                <a  href="<?php echo  $_SESSION['domain'] ?>/views/quraan/azkaar.php" class="col-md-5  bg-success  text-center  align-content-center text-decoration-none mx-md-3 my-3" style='height: 200px; border-color: transparent; border-width: 10px; ' >
                    <h2 class="text-white">اذكار</h2>
                </a>
                <a  href="<?php echo  $_SESSION['domain'] ?>/views/quraan/ahadeeth.php" class="col-md-5  bg-success  text-center  align-content-center text-decoration-none mx-md-3 my-3" style='height: 200px; border-color: transparent; border-width: 10px; ' >
                    <h2 class="text-white">احاديث</h2>
                </a>
                <a href="<?php echo  $_SESSION['domain'] ?>/views/quraan/eza3a.php" class="col-md-5  bg-success  text-center  align-content-center text-decoration-none mx-md-3 my-3" style='height: 200px; border-color: transparent; border-width: 10px; ' >
                    <h2 class="text-white">الاذاعات</h2>
                </a>
                
            </div>
           
        </div>

    </main>

<?php 

require_once('./includes/footer.php');



?>