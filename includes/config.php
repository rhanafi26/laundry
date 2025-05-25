<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'laundry_db';
$port = '3306';

$conn = new mysqli($host, $username, $password, $database, port: $port);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>