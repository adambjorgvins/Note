<?php
/**
 * Created by PhpStorm.
 * User: Aron
 * Date: 17/10/2016
 * Time: 20:09
 */
require("Auth.php");
$user = new Auth();

$uname = strtolower(trim(strip_tags($_POST['username'])));
$upass = trim(strip_tags($_POST['password']));

// Do login from Auth class
    if($user->doLogin($uname,$upass))
    {
        // Sets session on user
        $_SESSION["username"] = $uname;
        // Redirect from Auth class
        if(isset($_SESSION['returnUrl'])){
            $retUrl = $_SESSION['returnUrl'];
            $user->redirect($retUrl);
        } else {
            $user->redirect('/');
        }
    }
    else
    {
        // if username or password is wrong an error will happen
        $error = "Wrong Details!";
    }
