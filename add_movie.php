<?php
header('Content-Type: application/json');
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

    // Validar que todos los campos necesarios estén presentes
    $requiredFields = ['title', 'year', 'synopsis', 'cover', 'trailer'];
    foreach ($requiredFields as $field) {
        if (!isset($_POST[$field]) || empty(trim($_POST[$field]))) {
            throw new Exception("El campo $field es requerido");
        }
    }

    $stmt = $pdo->prepare("INSERT INTO movies (title, year, synopsis, cover, trailer) VALUES (:title, :year, :synopsis, :cover, :trailer)");
    
    $stmt->bindParam(':title', $_POST['title']);
    $stmt->bindParam(':year', $_POST['year']);
    $stmt->bindParam(':synopsis', $_POST['synopsis']);
    $stmt->bindParam(':cover', $_POST['cover']);
    $stmt->bindParam(':trailer', $_POST['trailer']);
    
    $stmt->execute();
    
    echo json_encode([
        'success' => true,
        'message' => 'Película agregada exitosamente'
    ]);

} catch(Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
?>