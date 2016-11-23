<?php
/**
 * Created by PhpStorm.
 * User: Aron
 * Date: 09/11/2016
 * Time: 21:19
 */
session_start();
$userid = $_SESSION["username"];

try {
    require("config.php");
} catch(Exception $e) {
    exit('Unable to connect to database.');
}

try {
    $conn = new PDO("mysql:host=$servername;dbname=calendar", $username, $password);
    $sql = "SELECT place FROM events WHERE userid = '" . $userid . "'";
    $result = $conn->query($sql);
} catch(PDOException $e) {
    echo "Error with query!";
}

echo "{";
while ($row = $result->fetch())
{
   echo("'" . $row['place'] . "' : null, ");
}
echo "'Home' : null";
echo "}";