<?php
session_start();
if (!isset($_SESSION['login'])) header("Location: index.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link href="bootstrap.min.css" rel="stylesheet">
</head>
<body class="container p-4">
    <h2>Dashboard</h2>
    <a href="warga.php" class="btn btn-info">Kelola Data Warga</a>
    <a href="logout.php" class="btn btn-danger">Logout</a>
</body>
</html>