<?php
// Encabezados para permitir CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Si es una petición OPTIONS (preflight), termina aquí
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}
// Datos de conexión
$hostDB = 'localhost';
$nombreDB = 'aerosport';
$usuarioDB = 'root';
$contrasenyaDB = 'Natachita.16';

try {
    // Cadena de conexión PDO
    $hostPDO = "mysql:host=$hostDB;dbname=$nombreDB;charset=utf8";

    // Crear instancia PDO
    $miPDO = new PDO($hostPDO, $usuarioDB, $contrasenyaDB);

    // Configurar modo de error para excepciones
    $miPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Preparar consulta
    $miConsulta = $miPDO->prepare('SELECT * FROM vuelos;');

    // Ejecutar consulta
    $miConsulta->execute();

    // Obtener todos los resultados
    $vuelos = $miConsulta->fetchAll(PDO::FETCH_ASSOC);

    // Mostrar resultados en JSON
    header('Content-Type: application/json');
    echo json_encode($vuelos);

} catch (PDOException $e) {
    // En caso de error mostrar mensaje
    http_response_code(500);
    echo json_encode(['error' => 'Error en la conexión o consulta: ' . $e->getMessage()]);
    exit();
}
?>
