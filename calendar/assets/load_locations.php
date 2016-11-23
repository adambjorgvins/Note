<?php
/**
 * Created by PhpStorm.
 * User: Aron
 * Date: 02/11/2016
 * Time: 08:26
 */
session_start();
$userid = $_SESSION["username"];


// Query that retrieves events
$requete = "SELECT lat,lng FROM events WHERE userid = '" . $userid . "' ORDER BY id";

// connection to the database
try {
    require("config.php");
} catch(Exception $e) {
    echo('Unable to connect to database.');
}
// Execute the query
$resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));

// sending the encoded result to success page
$res = $resultat->fetchAll(PDO::FETCH_ASSOC);
$data = json_encode($res, JSON_NUMERIC_CHECK);
echo($data);

