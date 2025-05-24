<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
$conn = new mysqli("localhost", "root", "Natachita.16", "aerosport");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$stmt = $conn->prepare("UPDATE info_vuelos SET duracion=?, pasajeros=?, estacionamiento=?, salida=?, imagen_url=?, precio=?, recorrido=?, descripcion=?, itinerario=?, mapa_url=? WHERE id=?");
$stmt->bind_param("sssssdssssi",
    $_POST['duracion'],
    $_POST['pasajeros'],
    $_POST['estacionamiento'],
    $_POST['salida'],
    $_POST['imagen_url'],
    $_POST['precio'],
    $_POST['recorrido'],
    $_POST['descripcion'],
    $_POST['itinerario'],
    $_POST['mapa_url'],
    $_POST['id']
);

$stmt->execute();
$stmt->close();
$conn->close();

header("Location: admin_info_vuelos.php");
exit;
?>
