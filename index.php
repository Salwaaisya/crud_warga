<?php
session_start();
include "config.php";

if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $q = $conn->query("SELECT * FROM users WHERE username='$user'");
    if ($q->num_rows > 0) {
        $data = $q->fetch_assoc();
        if (password_verify($pass, $data['password'])) {
            $_SESSION['login'] = true;
            header("Location: dashboard.php");
            exit;
        }
    }
    $error = "Username atau password salah!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="bootstrap.min.css" rel="stylesheet">
</head>
<body class="container p-5">
    <h2>Login</h2>
    <?php if (!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
    <form method="post">
        <input type="text" name="username" placeholder="Username" class="form-control mb-2" required>
        <input type="password" name="password" placeholder="Password" class="form-control mb-2" required>
        <button class="btn btn-primary" name="login">Login</button>
    </form>
</body>
</html>