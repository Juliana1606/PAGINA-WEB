<?php
session_start();
// Guardar mensaje en variable de sesión antes de destruir
$_SESSION['mensaje_cierre'] = "Sesión cerrada correctamente";
session_destroy();
header('Location: login.php');
exit;