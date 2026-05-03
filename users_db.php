<?php

$users = [
    [
        'id' => 1,
        'login' => 'admin',
        'name' => 'Администратор',
        'email' => 'admin@example.com',
        // Пароль: admin123
        'password_hash' => '$2y$10$ZfvU56UC0p3JKhz8/Yz9EObz4h0GzLsmRUWHyJfictlnySeh4OHEa'
    ],
    [
        'id' => 2,
        'login' => 'user',
        'name' => 'Иван Петров',
        'email' => 'user@example.com',
        // Пароль: user123
        'password_hash' => '$2y$10$brUb5jrI3fV7UG0oDDPyyOb/0tIMtCFZT6P2Tm/QPamBLWxpIbRdy'
    ],
    [
        'id' => 3,
        'login' => 'seller',
        'name' => 'Мария Сидорова',
        'email' => 'seller@example.com',
        // Пароль: seller456
        'password_hash' => '$2y$10$wQHq1.Cng37dFuXitb25K.3l/JIiVguwiicPDogg8FCa/OGhvClNu'
    ]
];

function generatePasswordHash($password) {
    return password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);
}

function verifyPassword($password, $hash) {
    return password_verify($password, $hash);
}

function getUserByLogin($login) {
    global $users;
    foreach ($users as $user) {
        if ($user['login'] === $login) {
            return $user;
        }
    }
    return null;
}

function getUserById($id) {
    global $users;
    foreach ($users as $user) {
        if ($user['id'] === $id) {
            return $user;
        }
    }
    return null;
}
?>
