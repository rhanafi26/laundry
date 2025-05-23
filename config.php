<?php
$host = getenv('mysql-377a294d-rizahanafi98-2428.g.aivencloud.com');
$username = getenv('hanafikoe');
$password = getenv('AVNS_JMloJCiSAlAf2I5qav8');
$database = getenv('laundry_db');
$port = getenv(18991);


$conn = new mysqli($host, $username, $password, $database, port: $port);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
