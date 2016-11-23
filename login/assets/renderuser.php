<?php
/**
 * Created by PhpStorm.
 * User: Aron
 * Date: 12/11/2016
 * Time: 22:29
 */
session_start();
$userid = $_SESSION["username"];

try {
    require("../assets/config.php");
} catch(Exception $e) {
    exit('Unable to connect to database.');
}

try {
    $conn = new PDO("mysql:host=localhost;dbname=calendar", "test", "test");
    $sql = "SELECT id, fromuser, touser FROM friends WHERE touser='" . $userid . "' AND friends = 0";
    $result = $conn->query($sql);
} catch(PDOException $e) {
    echo "Error with query!";
}

$data = array();
while ($row = $result->fetch(PDO::FETCH_ASSOC))
{
    $data[] = array('id' => $row['id'], 'from' => $row['fromuser'], 'to' => $row['touser']);
}

if (empty($data)){
    echo "No friendrequests";
}else {
    echo '<table class="striped" id="printtt">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Username</th>';
    echo '<th></th>';
    echo '<th></th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    echo '<button id="acceptt">asdasd</button>';

    foreach ($data as $ROW) {
        echo '<tr>';
        echo '<td>' . $ROW['from'] . "</td>";
        echo '<td><button id="' . $ROW["id"] . '" class="btn red accept">Accept</button></td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
}