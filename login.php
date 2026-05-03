<?php
session_start();
header('Content-Type: text/html; charset=UTF-8');

if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit();
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($login === '' || $password === '') {
        $error = 'Ошибка, заполните все поля.';
    } else {
        require_once 'users_db.php';
        $user = getUserByLogin($login);

        if ($user === null || !password_verify($password, $user['password_hash'])) {
            $error = 'Неверный логин или пароль.';
            $timestamp = date('Y-m-d H:i:s');
            $status = 'FAILED';
            file_put_contents('auth.log', "[$timestamp] $status | Пользователь: $login", FILE_APPEND);
        } else {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['login'] = $user['login'];
            $_SESSION['name'] = $user['name'];
            $timestamp = date('Y-m-d H:i:s');
            file_put_contents('auth.log', "[$timestamp] SUCCESS | Пользователь: $login", FILE_APPEND);
            header('Location: dashboard.php');
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav>
        <a href="index.html">Главная</a>
        <a href="catalog.html">Каталог</a>
    </nav>

    <div>
        <h1>Вход</h1>
        <?php if ($error): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="POST">
            <label for="login">Логин</label>
            <input type="text" id="login" name="login" required>

            <label for="password">Пароль</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Войти</button>
        </form>

        <p>Тестовые учетные данные: admin / admin123, user / user123</p>
    </div>

    <footer>
        <p>&copy; 2026</p>
    </footer>
</body>
</html>
