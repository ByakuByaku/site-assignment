<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require_once 'users_db.php';
$current_user = getUserById($_SESSION['user_id']);

if ($current_user === null) {
    session_destroy();
    header('Location: login.php');
    exit();
}
?>
