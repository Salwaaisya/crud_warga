<?php
include 'config.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Dummy login sederhana
    if ($username == 'admin' && $password == 'admin') {
        $_SESSION['login'] = true;
        header('Location: index.php');
        exit;
    } else {
        $error = "Username atau Password salah!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
<h2>Login</h2>
<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
<form method="POST">
    Username: <input type="text" name="username" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button type="submit" name="login">Login</button>
</form>
</body>
</html>
