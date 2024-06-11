<?php 


class AuthController{

    //method to put on users allow to visit by users only | if not it will redirect him to location that you choose (By programmar )
    static function userAuth($locationToRedirect){
        if(isset($_SESSION['loggedin']))
        {
            if($_SESSION['loggedin'])
            {
                header("location: $locationToRedirect");
            }
        }

        

    }

    //method to put on users allow to visit by gusts only| if not it will redirect him to location that you choose (By programmar )

    static function gustAuth($locationToRedirect){
        if(!isset($_SESSION['loggedin']))
        {
          

            header("location: $locationToRedirect");
            
        }
        elseif($_SESSION['loggedin']!=true)
        {
          

            header("location: $locationToRedirect");
        }
    }


    
}