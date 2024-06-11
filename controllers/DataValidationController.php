<?php 

class DataValidationController {

 

  //method to test input and secure database from sql injection
    static function testInput($inputToTest) {
        
        
        $inputData = trim($inputToTest);
        $inputData = stripslashes($inputData);
        $inputData = htmlspecialchars($inputData);
        return $inputData;
      }



      //method to hashing password
      static function hashPass($pass)
      {
        $pass=sha1($pass);
        return $pass;
      }






}