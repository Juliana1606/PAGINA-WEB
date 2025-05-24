<?php
session_start();
$conn = new mysqli("localhost", "root", "Natachita.16", "aerosport");

$mensaje = '';
if (isset($_SESSION['mensaje_cierre'])) {
    $mensaje = $_SESSION['mensaje_cierre'];
    unset($_SESSION['mensaje_cierre']);
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['correo'];
    $pass = $_POST['contraseña'];

    $sql = "SELECT * FROM Login WHERE correo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $correo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();
        if (password_verify($pass, $usuario['contraseña'])) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nombre'] = $usuario['nombre'];
            header('Location: admin_vuelos.php');
            exit;
        } else {
            $error = "⚠ Contraseña incorrecta";
        }
    } else {
        $error = "⚠ Usuario no encontrado";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    
<style>

    body {
    margin: 0;
    font-family: 'Arial', sans-serif;
    background:rgb(223, 239, 255);
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
}

.login-container {
    background:rgb(255, 255, 255);
    border-radius: 10px;
    width: 40%;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
}

.login-header {
    background-color:rgb(255, 255, 255);
    color: white;
    text-align: center;
    padding: 0px;
    border-radius: 8px 8px 0 0;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.login-header h1 {
    color:#003bff;
    font-weight: bold;
    font-family: 'Jockey One-Regular', sans-serif;
    font-size: 22px;
    padding:20px;
    flex-grow: 1;
    text-align: center;
    margin: 0;
}

.logo {
    width: 150px;
    height: auto;
}

.login-form {
    display: flex;
    flex-direction: column;
    padding: 20px 0;
}

.login-form label {
    font-weight: bold;
    margin-top: 10px;
}

.login-form input {
    padding: 10px;
    border-radius: 15px;
    border: none;
    margin-top: 5px;
    font-size: 14px;
}

.password-wrapper {
    position: relative;
}

.password-wrapper input {
    width: 90%;
}

.eye-icon {
    position: absolute;
    right: 10px;
    top: 10px;
    cursor: pointer;
}

.login-form button {
    background-color: #003bff;
    width: 50%;
    color: white;
    border: none;
    padding: 12px;
    border-radius: 15px;
    align-self: center;
    font-size: 16px;
    margin-top: 20px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.login-form button:hover {
    background-color: #002bcc;
}

.error-msg {
    color: red;
    font-weight: bold;
    text-align: center;
}

.success-msg {
    color: green;
    font-weight: bold;
    text-align: center;
}

        
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <img src="Logo.jpg" alt="Logo" class="logo">
            <h1>Iniciar Sesión</h1>
            <img src="Logo.jpg" alt="Logo" class="logo">
        </div>

        <?php if ($mensaje): ?>
            <p class="success-msg"><?= htmlspecialchars($mensaje) ?></p>
        <?php endif; ?>

        <form method="POST" action="login.php" class="login-form">
            <label>Usuario</label>
            <input type="email" name="correo" required>

            <label>Contraseña</label>
            <div class="password-wrapper">
                <input type="password" name="contraseña" id="passInput" required>
                <span class="eye-icon" onclick="togglePassword()">👁</span>
            </div>

            <button type="submit">Ingresar</button>
        </form>

        <?php if (!empty($error)): ?>
            <p class="error-msg"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById("passInput");
            input.type = input.type === "password" ? "text" : "password";
        }
    </script>
</body>
</html>
