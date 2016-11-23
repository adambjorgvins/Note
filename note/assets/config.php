<?php
/**
 * Created by PhpStorm.
 * User: Aron
 * Date: 23/11/2016
 * Time: 09:33
 */

$servername = "localhost";
$username = "test";
$password = "test";

try {
    $bdd = new PDO("mysql:host=$servername;dbname=calendar", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}