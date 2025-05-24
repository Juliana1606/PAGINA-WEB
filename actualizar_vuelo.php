<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
$conn = new mysqli("localhost", "root", "Natachita.16", "aerosport");

$stmt = $conn->prepare("UPDATE vuelos SET titulo=?, personas=?, duracion=?, precio=?, descripcion=?, imagen_url=?, enlace_info=?, enlace_reserva=?, valor=? WHERE id=?");
$stmt->bind_param("sisisssssi", $_POST['titulo'], $_POST['personas'], $_POST['duracion'], $_POST['precio'], $_POST['descripcion'], $_POST['imagen_url'], $_POST['enlace_info'], $_POST['enlace_reserva'], $_POST['valor'], $_POST['id']);
$stmt->execute();
$stmt->close();
$conn->close();

header("Location: admin_vuelos.php");
exit;
