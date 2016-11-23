<?php
require("config.php");

session_start();

$action = $_POST['action'];

$param1 = $_POST['param1'];


function insertClock($username, $time,  $stmp){
    $sql = "INSERT INTO clock (userid, time_in) VALUES (?, ?)";
    $q = $stmp->prepare($sql);
    $q->execute(array($username, $time));
}
function getAllClocks($username, $stmp){
    $sql = "SELECT * FROM clock WHERE userid = '" . $username . "' ORDER BY id DESC";
    $q = $stmp->query($sql);

    echo json_encode($q->fetchAll(PDO::FETCH_ASSOC));
}
function endClock($username, $time, $stmp){
    $sql = "UPDATE clock SET time_out='" . $time ."' WHERE id = (SELECT * FROM (SELECT MAX(id) FROM clock WHERE userid='" . $username ."') AS x)";
    $q = $stmp->prepare($sql);
    $q->execute();
}

switch ($action){
    case "insertClock":
        insertClock($_SESSION['username'], $param1, $conn);
        break;
    case "getAllClocks":
        getAllClocks($_SESSION['username'], $conn);
        break;
    case "endClock":
        endClock($_SESSION['username'], $param1, $conn);
        break;
    default:
        echo "Action not available";
        break;
}
