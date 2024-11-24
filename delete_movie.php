<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $host = 'mysql-techwork-udgvirtual-techwork.e.aivencloud.com';
    $db   = 'movies';
    $user = 'avnadmin';
    $pass = 'AVNS_1Dye_sfp1FZnU6d4yOr';
    $port = '18118';

    try {
        $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db;charset=utf8", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("DELETE FROM movies WHERE id = ?");
        $stmt->execute([$_POST['id']]);

        header('Location: index.php?success=1');
        exit;

    } catch(PDOException $e) {
        header('Location: index.php?error=' . urlencode($e->getMessage()));
        exit;
    }
}
?>