<?php
// Konfigurasi koneksi ke database
$host = "localhost";
$user = "root";
$password = "";
$database = "db_pariwisata";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
 die("Koneksi gagal: " . $conn->connect_error);
}

$conn->close();
?>