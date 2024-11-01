<?php
$host = "localhost";     
$user = "root";          
$password = "";          
$database = "taller9_db"; 


$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}
?>
