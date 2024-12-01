<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

$host = 'mysql-techwork-udgvirtual-techwork.e.aivencloud.com';
$db   = 'movies';
$user = 'avnadmin';
$pass = 'AVNS_1Dye_sfp1FZnU6d4yOr';
$port = '18118';

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("INSERT INTO movies (title, year, synopsis, cover, trailer) VALUES (:title, :year, :synopsis, :cover, :trailer)");
    
    $stmt->bindParam(':title', $_POST['title']);
    $stmt->bindParam(':year', $_POST['year']);
    $stmt->bindParam(':synopsis', $_POST['synopsis']);
    $stmt->bindParam(':cover', $_POST['cover']);
    $stmt->bindParam(':trailer', $_POST['trailer']);
    
    $stmt->execute();
    
    http_response_code(200);
    echo json_encode(['success' => true]);

} catch(PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>