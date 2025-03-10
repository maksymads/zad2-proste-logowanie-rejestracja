<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona Główna</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Witaj na naszej stronie!</h1>
        <p><a href="login.php" class="btn">Zaloguj się</a> lub <a href="register.php" class="btn">Zarejestruj</a>.</p>
    </div>
</body>
</html>