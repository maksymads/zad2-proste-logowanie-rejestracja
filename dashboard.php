<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel użytkownika</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Witaj, <?= $_SESSION['username'] ?></h1>
        <p>To jest Twój panel użytkownika.</p>
        <p><a href="logout.php" class="btn">Wyloguj się</a></p>
    </div>
</body>
</html>