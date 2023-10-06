<?php 
/*Session Mechanism*/
class session{

    public static function checkSession(){
        session_start();
        if(!isset($_SESSION['user-id'])){
             self::destroy();
             echo "<script>window.location='signin.php';</script>";
        }
    }

    public static function checkLogin(){
            session_start();
            if(isset($_SESSION['user-id'])){
            echo "<script>window.location='index.php';</script>";
        }
    }

    public static function destroy(){
        session_destroy();
        echo "<script>window.location='signin.php';</script>";
    }

 }
?>