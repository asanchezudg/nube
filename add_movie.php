<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $host = 'mysql-techwork-udgvirtual-techwork.e.aivencloud.com';
    $db   = 'movies';
    $user = 'avnadmin';
    $pass = 'AVNS_1Dye_sfp1FZnU6d4yOr';
    $port = '18118';

    try {
        $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db;charset=utf8", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("INSERT INTO movies (title, year, synopsis, cover) VALUES (?, ?, ?, ?)");
        
        $stmt->execute([
            $_POST['title'],
            $_POST['year'],
            $_POST['synopsis'],
            $_POST['cover']
        ]);

        // Redireccionar a la página principal con un mensaje de éxito
        header('Location: index.php?success=1');
        exit;

    } catch(PDOException $e) {
        // Redireccionar con mensaje de error
        header('Location: index.php?error=' . urlencode($e->getMessage()));
        exit;
    }
}
?>