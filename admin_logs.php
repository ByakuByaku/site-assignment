<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['login'] !== 'admin') {
    http_response_code(403);
    die('<h1>403 - Доступ запрещён</h1><p>У вас недостаточно прав для доступа.</p>');
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Журнал доступа</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav>
        <a href="dashboard.php">Личный кабинет</a>
        <a href="logout.php">Выход</a>
    </nav>

    <div class="admin-panel">
        <div class="admin-header">
            <h1>Журнал доступа</h1>
            <p>Записи сохраняются в файле auth.log.</p>
        </div>

        <div class="log-controls">
            <form method="POST" style="display:inline; margin-right: 10px;">
                <button type="submit" name="clear_logs" class="danger" onclick="return confirm('Вы уверены? Это удалит все записи!');">Очистить журнал</button>
            </form>
            <form method="POST" style="display:inline;">
                <button type="submit" name="refresh">Обновить</button>
            </form>
        </div>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['clear_logs'])) {
            file_put_contents('auth.log', "# Журнал очищен в " . date('Y-m-d H:i:s') . "\n");
            echo '<p>Журнал успешно очищен!</p>';
        }

        $logFile = 'auth.log';

        if (!file_exists($logFile)) {
            echo '<p>Журнал пока пуст.</p>';
        } else {
            $logLines = array_filter(array_map('trim', explode("\n", file_get_contents($logFile))));
            $logLines = array_reverse($logLines);

            if (empty($logLines)) {
                echo '<p>Журнал пока пуст.</p>';
            } else {
                echo '<div class="log-viewer">';
                foreach ($logLines as $line) {
                    if (strpos($line, '# ') === 0) {
                        continue;
                    }
                    $class = 'log-entry';
                    if (stripos($line, 'SUCCESS') !== false) {
                        $class .= ' success';
                    } elseif (stripos($line, 'FAILED') !== false) {
                        $class .= ' failed';
                    } elseif (stripos($line, 'LOGOUT') !== false) {
                        $class .= ' logout';
                    }
                    echo '<div class="' . $class . '">' . htmlspecialchars($line) . '</div>';
                }
                echo '</div>';
            }
        }
        ?>
    </div>

    <footer>
        <p>&copy; 2026</p>
    </footer>
</body>
</html>
