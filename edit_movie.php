<?php
$host = 'mysql-techwork-udgvirtual-techwork.e.aivencloud.com';
$db   = 'movies';
$user = 'avnadmin';
$pass = 'AVNS_1Dye_sfp1FZnU6d4yOr';
$port = '18118';

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Preparar la consulta con placeholders nombrados
    $stmt = $pdo->prepare('UPDATE movies SET 
        title = :title,
        year = :year,
        synopsis = :synopsis,
        cover = :cover,
        trailer = :trailer
        WHERE id = :id');

    // Debug: ver qué datos están llegando
    error_log("Datos recibidos: " . print_r($_POST, true));

    // Ejecutar con los parámetros nombrados
    $result = $stmt->execute([
        ':title' => $_POST['title'],
        ':year' => $_POST['year'],
        ':synopsis' => $_POST['synopsis'],
        ':cover' => $_POST['cover'],
        ':trailer' => $_POST['trailer'],
        ':id' => $_POST['id']
    ]);

    if($result) {
        header('Location: index.php?success=1');
    } else {
        throw new Exception("Error al actualizar la película");
    }
} catch(PDOException $e) {
    error_log("Error SQL: " . $e->getMessage());
    header('Location: index.php?error=' . urlencode($e->getMessage()));
} catch(Exception $e) {
    error_log("Error General: " . $e->getMessage());
    header('Location: index.php?error=' . urlencode($e->getMessage()));
}
?>