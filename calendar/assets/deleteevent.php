<?php
/**
 * Created by PhpStorm.
 * User: Aron
 * Date: 17/10/2016
 * Time: 17:04
 */

/* Values received via ajax */
session_start();
$userid = $_SESSION["username"];
$id = $_POST['id'];

// connection to the database
try {
    require("config.php");
} catch(Exception $e) {
    exit('Unable to connect to database.');
}
// delete the records
try{
    $sql = "DELETE FROM events WHERE userid = '" . $userid . "' AND id = $id";
    $q = $bdd->prepare($sql);
    $q->execute(array($id));
} catch (Exception $e){
    echo ("Error: " . $e);
}
