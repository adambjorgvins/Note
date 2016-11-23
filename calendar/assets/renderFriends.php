<?php
/**
 * Created by PhpStorm.
 * User: Aron
 * Date: 12/11/2016
 * Time: 23:04
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
    // SELECT * FROM `friends` WHERE fromuser = "aron" OR touser = "aron" AND friends = 1
    $sql = "SELECT * FROM friends WHERE fromuser = '" . $userid . "' AND friends = 1 OR touser = '" . $userid. "' AND friends = 1";
    $result = $conn->query($sql);
} catch(PDOException $e) {
    echo "Error with query!";
}

echo "{";
while ($row = $result->fetch())
{
    if ($row['fromuser'] == $userid){
        echo("'" . $row['touser'] . "' : null, ");
    }else if($row['touser'] == $userid){
        echo("'" . $row['fromuser'] . "' : null, ");
    }

}
echo "'Myself' : null";
echo "}";