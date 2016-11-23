<?php
/**
 * Created by PhpStorm.
 * User: AdamB
 * Date: 23.11.2016
 * Time: 21:43
 */
?>
<?php
session_start();
if(!isset($_SESSION['username'])){
    $_SESSION['returnUrl'] = '/note';
    header("Location: ../login");
}
?>
<div>This is the note thingy!</div>
