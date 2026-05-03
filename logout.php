<?php
session_start();

if (isset($_SESSION['user_id'])) {
    $login = $_SESSION['login'];
    
    $timestamp = date('Y-m-d H:i:s');
    $logLine = "[$timestamp] LOGOUT | Логин: $login | Статус: Пользователь вышел из системы" . PHP_EOL;
    file_put_contents('auth.log', $logLine, FILE_APPEND);
}


session_destroy();

header('Location: index.html');
exit();
?>
