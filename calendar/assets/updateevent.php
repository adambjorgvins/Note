<?php
/**
 * Created by PhpStorm.
 * User: Aron
 * Date: 15/10/2016
 * Time: 01:40
 */

/* Values received via ajax */
$id = $_POST['id'];
$title = $_POST['title'];
$start = $_POST['start'];
$end = $_POST['end'];

// connection to the database
try {
    require("config.php");
} catch(Exception $e) {
    exit('Unable to connect to database.');
}
// update the records
$sql = "UPDATE events SET title='$title', start = '$start', end = '$end' where id='$id'";
$q = $bdd->prepare($sql);
$q->execute(array($title,$start,$end,$id));