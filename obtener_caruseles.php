<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "Natachita.16", "aerosport");
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$sql = "SELECT * FROM CaruselMain LIMIT 1"; // Solo necesitas una fila si es configuración general
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    echo json_encode($resultado->fetch_assoc());
} else {
    echo json_encode(null);
}

$conexion->close();
?>
