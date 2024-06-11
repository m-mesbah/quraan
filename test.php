

<?php

session_start();
$location = true;
require_once('./controllers/AuthController.php');
require_once('./includes/header.php');
require_once('./controllers/DBController.php');
require_once("./vendor/autoload.php");
require_once("./includes/fun.php");

?>


    
     

    <main >

        <div class="container">
            <div class="text-center mt-5">
                <h2 class="text-dark">Welcom to <span class="text-primary ">Makaseb</span></h2>
            </div>
            <div id="successMsg" class="form-text bg-success text-white text-center"></div>

            <form class="my-2" id='quraan' action="https://api.alquran.cloud/v1/quran/ar" method="post" >
                <!-- <div id="loginErrs" class="form-text bg-danger text-white"></div>
                <div class="mb-3">
                    <label for="userEmail" class="form-label">Email address</label>
                    <input type="text" name="userEmailLogin" id="userEmailLogin"  class="form-control" aria-describedby="emailHelp">
                    <div id="emailErr" class="form-text text-danger"></div>
                </div>
                <div class="mb-3">
                    <label for="userPassword" class="form-label">Password</label>
                    <input type="password" name="userPasswordLogin" id="userPasswordLogin"  class="form-control" >
                    <div id="passwordErr" class="form-text text-danger"></div>

                </div> -->
                
                <button id="submit" id='' class="btn btn-primary d-inline mr-4 submit_btn">Login</button>
                <!-- <p class="text-primary text-decoration-none cursor-pointer mx-4 d-inline" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#showRegisterForm">forget your password?</p> -->

                
            </form>

            <!-- Button trigger Register modal -->
            <!-- <button class=" btn btn-success text-white text-decoration-none px-5 mt-3"  data-bs-toggle="modal" data-bs-target="#showLoginForm" id=''>Register</button> -->
            <!-- Button trigger Register modal -->

        </div>


<div class="text-center" id='fehras'></div>

        <!-- forget password modal -->
    </main>

<?php 

require_once('./includes/footer.php');



?>
