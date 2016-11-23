<?php
/**
 * Created by PhpStorm.
 * User: Aron
 * Date: 07/11/2016
 * Time: 09:53
 */
session_start();
$userid = $_SESSION["username"];
$id = $_POST['id'];
$user = $_POST['user'];

// connection to the database
try {
    require("config.php");
} catch(Exception $e) {
    exit('Unable to connect to database.');
}
/**
 * Update event to add colabrator on event
 */
try{
    // update the records
    $sql = "UPDATE events SET colabrator='$user' where id='$id'";
    $q = $bdd->prepare($sql);
    $q->execute(array($user,$id));
}catch (Exception $e){
    echo "NO";
}