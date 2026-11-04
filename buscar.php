<?php
require_once 'conexion.php';

header('Content-Type: application/json');

$busqueda = isset($_GET['q']) ? trim($_GET['q']) : '';

if ($busqueda === '') {
    echo json_encode([]);
    exit;
}

try {
    $sql = "SELECT * FROM sistemas 
            WHERE maquina LIKE :busq 
               OR aplicacion LIKE :busq 
               OR organismo LIKE :busq 
               OR servidores LIKE :busq 
               OR bases_datos LIKE :busq";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['busq' => "%$busqueda%"]);
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($resultados);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>