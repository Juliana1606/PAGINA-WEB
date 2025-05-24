<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "Natachita.16", "aerosport");
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Error de conexión"]);
    exit;
}

// Consulta
$sql = "SELECT id, titulo, precio, descripcion, img_carusel1, img_carusel2, img_carusel3 FROM eventos";
$result = $conn->query($sql);

$eventos = [];
while ($row = $result->fetch_assoc()) {
    $eventos[] = $row;
}

echo json_encode($eventos);
$conn->close();
?>
