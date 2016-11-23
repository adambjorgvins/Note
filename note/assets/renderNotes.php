<?php
/**
 * Created by PhpStorm.
 * User: Aron
 * Date: 23/11/2016
 * Time: 09:31
 */

session_start();
$userid = $_SESSION["username"];

// List of events
$json = array();

// Query that retrieves events
$requete = "SELECT * FROM notes WHERE userid = '" . $userid . "' ORDER BY id DESC";

// connection to the database
try {
    require("config.php");
} catch(Exception $e) {
    echo('Unable to connect to database.');
}

// Execute the query
$resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));

echo "{
  \"notes\":";
// sending the encoded result to success page
echo json_encode($resultat->fetchAll(PDO::FETCH_ASSOC));
echo "}";