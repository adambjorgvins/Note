<?php
$servername = "localhost";
$username = "test";
$password = "test";

try {
    $conn = new PDO("mysql:host=$servername;dbname=calendar", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}