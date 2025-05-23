<?php
$host = 'mysql-377a294d-rizahanafi98-2428.g.aivencloud.com';
$username = 'hanafikoe';
$password = 'AVNS_JMloJCiSAlAf2I5qav8';
$database = 'laundry_db';
$port = 18991;

$conn = new mysqli($host, $username, $password, $database, port: $port);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>