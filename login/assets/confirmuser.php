<?php
/**
 * Created by PhpStorm.
 * User: Aron
 * Date: 12/11/2016
 * Time: 21:59
 */
$id = $_POST['id'];

// connection to the database
try {
    require("config.php");
} catch(Exception $e) {
    exit('Unable to connect to database.');
}
// UPDATE `calendar`.`friends` SET `friends` = '1' WHERE `friends`.`id` = 3;
// update the records
try {
    $conn = new PDO("mysql:host=localhost;dbname=calendar", "test", "test");
    $sql = "UPDATE friends SET friends = 1 WHERE id = " . $id .";";
    $result = $conn->query($sql);
    echo $sql;
    echo "Yebb";
} catch(PDOException $e) {
    echo "Error with query!";
}
