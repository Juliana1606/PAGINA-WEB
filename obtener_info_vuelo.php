<?php
// Permitir CORS para cualquier origen
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}
header('Content-Type: application/json');

if (!isset($_GET['id'])) {
  echo json_encode(['error' => 'ID no proporcionado']);
  exit;
}

$id = intval($_GET['id']);

$conexion = new mysqli("localhost", "root", "Natachita.16", "aerosport");

if ($conexion->connect_error) {
  echo json_encode(['error' => 'Error de conexión']);
  exit;
}

$sql = "SELECT * FROM info_vuelos WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();

if ($fila = $resultado->fetch_assoc()) {
  echo json_encode($fila);
} else {
  echo json_encode(['error' => 'Vuelo no encontrado']);
}

$stmt->close();
$conexion->close();
