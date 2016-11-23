<?php
session_start();
$userid = $_SESSION["username"];
$from = strip_tags($_POST['from']);
$to = strip_tags($_POST['to']);
$category = strip_tags($_POST['category']);

// connection to the database

try {
require("config.php");
} catch(Exception $e) {
exit('Unable to connect to database.');
}

try{
$sql = "INSERT INTO `glossary` (`fromtext`, `totext`, `userid`, `category`) VALUES (:from, :to, :userid, :category)";
$q = $bdd->prepare($sql);
$q->execute(array(':from'=>$from, ':to'=>$to, ':category'=>$category, ':userid'=>$userid));
echo "Success!";
    echo ($from . " - " . $to . " - " .$category . " - " .$userid);
}catch (Exception $e){

echo "Error connectiong to db!";
}
