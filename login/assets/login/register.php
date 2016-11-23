<?php
/**
 * Created by PhpStorm.
 * User: Aron
 * Date: 17/10/2016
 * Time: 20:08
 */
require("Auth.php");
$user = new Auth();
$error = '';

$uname = strtolower(trim(strip_tags($_POST['username-reg'])));
$upass = trim(strip_tags($_POST['password-reg']));
$upass2 = trim(strip_tags($_POST['password2-reg']));
$uemail = strtolower(trim(strip_tags($_POST['email-reg'])));
$uphone = trim(strip_tags($_POST['phone-reg']));

// Check if everyting is ok with register form
if ($uname == "") {
    // if username field is blank
    $error = "provide username!";
} else if ($upass == "") {
    // if password is blank
    $error = "provide password!";
} else if ($uemail == "") {
    // if password is blank
    $error = "provide email!";
} else if ($upass != $upass2) {
    // if password is less than 6 chars
    $error = "Passwords does not match";
}else if ($uphone == ""){
    $error = "provide phone!";
} else {
    try {
        // Run query to check if user is already in the db
        $stmt = $user->runQuery("SELECT username FROM users WHERE username=:uname");
        $stmt->execute(array(':uname' => $uname));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row['username'] == $uname) {
            // if user exist an error is thrown
            $error = "sorry username already taken !";
        } else {
            // if username does not exist we put him to db
            if ($user->register($uname, $upass, $uemail, $uphone)) { // Sets input fields to register function in Auth class
                $_SESSION["username"] = $uname; // Setur session á userinn svo að þú getur unnið með hann þegar hann er búinn að logga sig inn

                // Whuub SMS API
                require 'sms/class-Clockwork.php';
                $API_KEY = "08e19db19ef3bf202b1cff2ef95d4f5b4a95ad3d";

                try
                {
                    // Create a Clockwork object using your API key
                    $clockwork = new Clockwork( $API_KEY );

                    // Setup and send a message
                    $message = array( 'to' => "354" . $uphone, 'message' => "Welcome! " . $uname);
                    $result = $clockwork->send( $message );

                    // Check if the send was successful
                    if($result['success']) {
                        //echo 'Message sent - ID: ' . $result['id'];
                    } else {
                        echo 'Message failed - Error: ' . $result['error_message'];
                    }
                }
                catch (ClockworkException $e)
                {
                    echo 'Exception sending SMS: ' . $e->getMessage();
                }
                $user->redirect('/'); // Þegar user er búinn að registera þá fer hann inná þessa síðu
            }
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}