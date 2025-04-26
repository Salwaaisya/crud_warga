<?php
$host = "localhost";
$user = "root";
$pass = "";
$db_name = "wargadb";

$conn = new mysqli($host, $user, $pass);
if ($conn->connect_error) die("Koneksi gagal!");

$conn->query("CREATE DATABASE IF NOT EXISTS $db_name");
$conn->select_db($db_name);

$conn->query("CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE,
    password VARCHAR(255)
)");

$conn->query("CREATE TABLE IF NOT EXISTS warga (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100),
    alamat TEXT,
    telepon VARCHAR(20)
)");

$res = $conn->query("SELECT COUNT(*) as total FROM users");
$data = $res->fetch_assoc();
if ($data['total'] == 0) {
    $password = password_hash("123", PASSWORD_DEFAULT);
    $conn->query("INSERT INTO users (username, password) VALUES ('admin', '$password')");
}
?>