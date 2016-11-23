<?php
/**
 * Created by PhpStorm.
 * User: Aron
 * Date: 14/10/2016
 * Time: 22:39
 */

// Values received via ajax
session_start();
$userid = $_SESSION["username"];
$title = $_POST['title'];
$start = $_POST['start'];
$end = $_POST['end'];
$place = $_POST['place'];
$color = $_POST['color'];
$lat = $_POST['lat'];
$lng = $_POST['lng'];

// connection to the database
try {
    require("config.php");
} catch(Exception $e) {
    exit('Unable to connect to database.');
}

// insert the records
try{
    $sql = "INSERT INTO events (title, start, end, place, color, userid, lat, lng) VALUES (:title, :start, :end, :place, :color, :userid, :lat, :lng)";
    $q = $bdd->prepare($sql);
    $q->execute(array(':title'=>$title, ':start'=>$start, ':end'=>$end, ':place'=>$place, ':color'=>$color, ':userid'=>$userid, ':lat'=>$lat, ':lng'=>$lng));
}catch (Exception $e){
    echo "Insert to db Error!";
}