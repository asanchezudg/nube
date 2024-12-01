<?php
$host = 'mysql-techwork-udgvirtual-techwork.e.aivencloud.com';
$db   = 'movies';
$user = 'avnadmin';
$pass = 'AVNS_1Dye_sfp1FZnU6d4yOr';
$port = '18118';

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Preparar la consulta SQL
    $stmt = $pdo->prepare("INSERT INTO movies (title, year, synopsis, cover, trailer) VALUES (:title, :year, :synopsis, :cover, :trailer)");
    
    // Vincular los parámetros
    $stmt->bindParam(':title', $_POST['title']);
    $stmt->bindParam(':year', $_POST['year']);
    $stmt->bindParam(':synopsis', $_POST['synopsis']);
    $stmt->bindParam(':cover', $_POST['cover']);
    $stmt->bindParam(':trailer', $_POST['trailer']);
    
    // Ejecutar la consulta
    $stmt->execute();
    
    // Redirigir con mensaje de éxito
    header("Location: index.php?success=1");
    exit();

} catch(PDOException $e) {
    // Redirigir con mensaje de error
    header("Location: index.php?error=" . urlencode($e->getMessage()));
    exit();
}
?>