<?php
/**
 * Created by PhpStorm.
 * User: Aron
 * Date: 14/10/2016
 * Time: 21:45
 */
session_start();
$userid = $_SESSION["username"];

// List of events
$json = array();

// Query that retrieves events
$requete = "SELECT * FROM events WHERE userid = '" . $userid . "' OR colabrator = '" . $userid . "' ORDER BY id";

// connection to the database
try {
    require("config.php");
} catch(Exception $e) {
    echo('Unable to connect to database.');
}

// Execute the query
$resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));

// sending the encoded result to success page
echo json_encode($resultat->fetchAll(PDO::FETCH_ASSOC));