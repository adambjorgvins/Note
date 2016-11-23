<?php
/**
 * Created by PhpStorm.
 * User: Aron
 * Date: 10/11/2016
 * Time: 20:45
 */
session_start();
$userid = $_SESSION["username"];
$id = $_POST['id'];

// connection to the database
try {
    require("config.php");
} catch(Exception $e) {
    exit('Unable to connect to database.');
}
try{
    // update the records
    $sql = "UPDATE events SET colabrator= null where id='$id'";
    $q = $bdd->prepare($sql);
    $q->execute(array($id));
}catch (Exception $e){
    echo "NO";
}