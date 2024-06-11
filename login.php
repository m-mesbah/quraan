

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
AuthController::userAuth('./views/quraan/read.php');


$connectDb= new ConnectDb($servername,$username,$password,$dbname);
$conn=$connectDb->connectdb();
//testing if the email is exist !! if exist return err
$sql = "SELECT * FROM `companies` ";
$result = $connectDb->select($conn,$sql);

?>


    
     

    <main dir='rtl' >

        <div class="container">
            <div class="text-center mt-5">
                <h2 class="text-dark"> سجل دخول لحفظ البيانات</span></h2>
            </div>
            <div id="successMsg" class="form-text bg-success text-white text-center"></div>

            <form class="my-2" id='loginForm' action="./handlers/handleLogin.php" method="post" >
                <div id="loginErrs" class="form-text bg-danger text-white"></div>
                <div class="mb-3">
                    <label for="userEmail" class="form-label"> الايميل</label>
                    <input type="text" name="userEmailLogin" id="userEmailLogin"  class="form-control" aria-describedby="emailHelp">
                    <div id="emailErr" class="form-text text-danger"></div>
                </div>
                <div class="mb-3">
                    <label for="userPassword" class="form-label">كلمة السر</label>
                    <input type="password" name="userPasswordLogin" id="userPasswordLogin"  class="form-control" >
                    <div id="passwordErr" class="form-text text-danger"></div>

                </div>
                
                <button id="submit" id='' class="btn btn-primary d-inline mr-4 submit_btn">دخول</button>
                
            </form>

            <!-- Button trigger Register modal -->
            <button class=" btn btn-success text-white text-decoration-none px-5 mt-3"  data-bs-toggle="modal" data-bs-target="#showLoginForm" id=''>ليس لديك حساب؟</button>
            <!-- Button trigger Register modal -->

        </div>


       <!-- Register Modal -->
       <div class="modal fade" id="showLoginForm" tabindex="-1" aria-labelledby="showLoginFormLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <button type="button" class="btn-close m-2" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-header">
                        <h5 class="modal-title" id="showLoginFormLabel">تسجيل حساب جديد</h5>
                    </div>
                    <div class="modal-body">
                        <form id="registerForm1" action="./handlers/handleRegister.php" method="POST" >
 
                        <div id="Errs" class="form-text bg-danger text-white"></div>
                        <div id="" class="form-text bg-success text-white text-center successMsg"></div>

                            <div class="mb-3">
                                <label for="userName" class="form-label"> الاسم كامل</label>
                                <input type="text" name="userName"  class="form-control"  aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="userEmail" class="form-label"> البريد الالكتروني</label>
                                <input type="text" name="userEmail"  class="form-control" aria-describedby="emailHelp">
                                <div id="emailErr" class="form-text text-danger"></div>
                            </div>
                            <div class="mb-3">
                                <label for="userPassword" class="form-label">كلمة السر</label>
                                <input type="password" name="userPassword"  class="form-control" >
                                <div id="passwordErr" class="form-text text-danger"></div>

                            </div>
                          
                            
                            <button type="submit" class="btn btn-primary submit_btn" id="regiser">تسجيل</button>
                        </form> 
                    </div>
                   
                </div>
            </div>
        </div>
        <!-- Register Modal -->


    </main>

<?php 

require_once('./includes/footer.php');



?>