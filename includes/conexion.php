<?php
$servername = "localhost:3306";
$username = "root";
$password = "qweQWE123";
$database = "VivaGym";

$conn = new mysqli ($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("La conexión ha fallado: " . $conn->connect_error);
}
?>