<?php
const DBHOST = "db";
const DBNAME = "onlinetraining";
const DBUSER = "test";
const DBPASS = "test";
$dsn = "mysql:host=" . DBHOST . ";dbname=" . DBNAME . ";charset=utf8";
try {
    // Ici, on test la connection.
    $db = new PDO($dsn, DBUSER, DBPASS);
    // echo "CONNECTION OK" . "<br>";
} catch (PDOException $error) {
    echo "ECHEC DE LA CONNECTION : " . $error->getMessage() . "<br>";
}
