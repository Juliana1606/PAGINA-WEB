<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
$conn = new mysqli("localhost", "root", "Natachita.16", "aerosport");

$stmt = $conn->prepare("DELETE FROM vuelos WHERE id = ?");
$stmt->bind_param("i", $_POST['id']);
$stmt->execute();
$stmt->close();
$conn->close();

header("Location: admin_vuelos.php");
exit;
