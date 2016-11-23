<?php
/**
 * Created by PhpStorm.
 * User: Aron
 * Date: 23/11/2016
 * Time: 09:15
 */

// Values received via ajax
session_start();
$userid = $_SESSION["username"];
$title = $_POST['title'];
$body = $_POST['body'];
$pinned = $_POST['pinned'];

// connection to the database
try {
    require("config.php");
} catch(Exception $e) {
    exit('Unable to connect to database.');
}


/**
 * INSERT INTO `calendar`.`notes` (`id`, `title`, `body`, `userid`, `pinned`) VALUES (NULL, 'My first note', 'Lorem ipsum dolor ', 'aron', NULL);
 */
// insert the records
try{
    $sql = "INSERT INTO notes (title, body, userid, pinned) VALUES (:title, :body, :userid, :pinned)";
    $q = $bdd->prepare($sql);
    $q->execute(array(':title'=>$title, ':body'=>$body, ':userid'=>$userid, ':pinned'=>$pinned));
}catch (Exception $e){
    echo "Insert to db Error!";
}