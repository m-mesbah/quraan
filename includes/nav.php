
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" dir="rtl">
        
        <div class="container">
            <a class="navbar-brand text-white" href="<?php echo  $_SESSION['domain'] ?>"> قرآن كريم </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                   
                <li class="nav-item mx-1">
                    <a class="nav-link  " href="<?php echo  $_SESSION['domain'] ?>/views/dashboard/home.php">الصفحة الرئيسية</a>
                </li>
                <li class="nav-item mx-1">
                    <a class="nav-link  " href="<?php echo  $_SESSION['domain'] ?>/views/quraan/read.php">القرآن الكريم</a>
                </li>
                <li class="nav-item mx-1">
                    <a class="nav-link  " href="<?php echo  $_SESSION['domain'] ?>/views/quraan/listen.php">القرآن الكريم mb3</a>
                </li>
                <li class="nav-item mx-1">
                    <a class="nav-link  " href="<?php echo  $_SESSION['domain'] ?>/views/quraan/azkaar.php">اذكار</a>
                </li>
                <li class="nav-item mx-1">
                    <a class="nav-link  " href="<?php echo  $_SESSION['domain'] ?>/views/quraan/ahadeeth.php">احاديث</a>
                </li>
                <li class="nav-item mx-1">
                    <a class="nav-link  " href="<?php echo  $_SESSION['domain'] ?>/views/quraan/eza3a.php">الاذاعات</a>
                </li>
                <?php if( !isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != '1' ) {?>
                <li class="nav-item mx-1">
                    <a class=" btn btn-primary tex-white" href="<?php echo  $_SESSION['domain'] ?>/login.php">سجل دخول</a>
                </li>
                <?php }?>

                </ul>
                <?php if(@$_SESSION['loggedin'] AND $_SESSION['loggedin']) {?>
                <div class="mb-md-2">
                    <button id="dropdown-btn" class="text-white btn btn-success position-relative  "><?php echo @$_SESSION['userName'] ?? 'الاعدادات' ?></button>
                    <ul class="bg-white p-2 position-absolute mt-2" style="display: none; padding-left: 15px;" id="dropdown">
                    

                        <p class="text-dark text-decoration-none "><a class="text-dark text-decoration-none btn btn-danger" href="<?php echo  $_SESSION['domain'] ?>/handlers/handleLogout.php">تسجيل خروج</a></p>
                    </ul>
                </div>
                <?php }?>
            </div>
        </div>
           
        
</nav>