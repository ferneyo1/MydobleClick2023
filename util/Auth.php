<?php
class Auth
{
    
    public static function handleLogin()
    {
        @session_start();
        //echo $_SESSION['loggedIn'];
        $logged = $_SESSION['loggedIn'];
        if ($logged == false) {
            session_destroy();
            header('location:'.URL.'login');
            exit;
        }
    }
    
}
?>