<?php
/**
 * Created by PhpStorm.
 * User: Aron
 * Date: 17/10/2016
 * Time: 20:09
 */
session_start();

require_once ("assets/config.php");
$error = "";

if(isset($_SESSION['username'])){
    if(isset($_SESSION['returnUrl'])){
        $retUrl = $_SESSION['returnUrl'];
        header("Location: ". $retUrl);
    } else {
        header("Location: /");
    }
}

if (isset($_POST['submit'])){
    require("assets/login/login.php");
}

if ($error) {
    echo "<p>$error</p>";
}

?>
<div class="container">
    <div class="row">
        <form method="POST" action="">
            <p>
                <label for="username">Username:</label>
                <input type="text" name="username" id="username">
            </p>
            <p>
                <label for="pwd">Password:</label>
                <input type="password" name="password" id="pwd">
            </p>
            <p>
                <input name="submit" type="submit" class="btn" value="Log in">
            </p>
        </form>
    </div>
</div>
