<?php
require_once 'auth_check.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav>
        <a href="index.html">Главная</a>
        <a href="catalog.html">Каталог</a>
        <a href="cart.html">Корзина</a>
        <a href="logout.php">Выход</a>
    </nav>

    <main>
        <h1>Личный кабинет</h1>
        <p>Добро пожаловать, <?php echo htmlspecialchars($_SESSION['name']); ?>.</p>
        <p>Логин: <?php echo htmlspecialchars($_SESSION['login']); ?></p>
        <p>Email: <?php echo htmlspecialchars($current_user['email']); ?></p>
    </main>

    <footer>
        <p>&copy; 2026</p>
    </footer>
</body>
</html>
