<?php
// Connection details
$host = "localhost";
$user = "mwezi";
$pass = "winner";
$database = "online_portrait_selling_management_system";

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>