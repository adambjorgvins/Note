<?php
/**
 * Created by PhpStorm.
 * User: Aron
 * Date: 14/10/2016
 * Time: 21:46
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