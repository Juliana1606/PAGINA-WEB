<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

$conn = new mysqli("localhost", "root", "Natachita.16", "aerosport");
$resultado = $conn->query("SELECT * FROM vuelos");

session_start();

// Chequeamos si hay sesión iniciada
$logueado = isset($_SESSION['usuario_id']);
?>

<!DOCTYPE html>
<html lang="es">
  <header >
    <?php if ($logueado): ?>
        <!-- Lado izquierdo: Imagen de perfil y nombre de usuario -->
        <div style="display:flex; align-items:center;">
            <img src="https://www.w3schools.com/howto/img_avatar.png" 
                 alt="Perfil" 
                 style="width:60px; height:60px; border-radius:50%; background-color:#a0d8ff; object-fit:cover; margin-right:15px;">
            <span >
                <?= htmlspecialchars($_SESSION['usuario_nombre']) ?>
            </span>
        </div>

        <!-- Lado derecho: Botón cerrar sesión -->
        <form method="POST" action="cerrar_sesion.php" style="margin:0;">
            <button type="submit" onmouseover="this.style.backgroundColor='#0033cc'" onmouseout="this.style.backgroundColor='blue'">
                Cerrar Sesión
            </button>
        </form>

    <?php else: ?>
        <div style="font-weight: bold; color: red;">No has iniciado sesión</div>
    <?php endif; ?>

</header>
<head>
  <meta charset="UTF-8">
  <title>Administrar Vuelos</title>
  <style>
    /* Mismos estilos que ya tenías */
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
      font-family: 'Jockey One-Regular', sans-serif;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 20px;
      gap: 30px;
      background-color: #f5f7ff;
      min-height: 100vh;
    }
    h2 { font-size: 2.5rem; color: #001dff; margin-bottom: 10px; }
    img { width: 180px; height: auto; }
    form[action="insertar_vuelo.php"] {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 15px;
      width: 100%;
      max-width: 1000px;
      background-color: #ffffff;
      padding: 10px;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0, 0, 255, 0.2);
    }
    form[action="insertar_vuelo.php"] input,
    form[action="insertar_vuelo.php"] button {
      padding: 10px;
      font-size: 1rem;
      border: 1px solid #ccc;
      border-radius: 6px;
    }
    form[action="insertar_vuelo.php"] button {
      background-color: #001dff;
      color: white;
      cursor: pointer;
      transition: background 0.3s ease;
    }
    form[action="insertar_vuelo.php"] button:hover {
      background-color: #0003c4;
    }
    form[action="cerrar_sesion.php"] button {
      
        background-color: blue;
        color: white;
       padding: 10px 20px;
        border-radius: 15px;
        font-weight: bold;
        font-size: 16px;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s;
           
    }
    table {
      width: 100%;
      max-width: 1200px;
      border-collapse: collapse;
      background-color: white;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      border-radius: 8px;
      overflow: hidden;
    }
    th, td {
      padding: 12px 15px;
      border: 1px solid #ddd;
      text-align: center;
      font-size: 0.95rem;
    }
    th {
      background-color: #001dff;
      color: white;
    }
    table form {
      display: flex;
      flex-direction: column;
      gap: 5px;
    }
    table input[type="text"],
    table input[type="number"] {
      width: 100%;
      padding: 6px;
      font-size: 0.9rem;
      border: 1px solid #aaa;
      border-radius: 4px;
    }
    table button {
      background-color: #001dff;
      color: white;
      border: none;
      padding: 6px 10px;
      border-radius: 4px;
      cursor: pointer;
      margin: 3px 0;
      font-size: 0.85rem;
      transition: background 0.3s ease;
    }
    table button:hover {
      background-color: #0003c4;
    }
    form[action="eliminar_vuelo.php"] button {
      background-color: #d9534f;
    }
    form[action="eliminar_vuelo.php"] button:hover {
      background-color: #c9302c;
    }
    .Navegar {
      background-color: #001dff;
      color: white;
      border: none;
      padding: 6px 12px;
      border-radius: 6px;
      cursor: pointer;
      font-size: 20px;
      margin: 3px;
      transition: background 0.3s ease;
      text-decoration: none;
    }
    .Navegar:hover {
      background-color: #0003c4;
      transform: scale(1.05);
    }
    @media (max-width: 768px) {
      form[action="insertar_vuelo.php"] { grid-template-columns: 1fr; }
      th, td { font-size: 0.85rem; padding: 10px; }
      h2 { font-size: 2rem; }
    }
    header{
      display:flex;
      width: 100%;
      background:#fff; 
      padding:10px 20px; 
      display:flex; 
      justify-content:space-between; 
      align-items:center; 
      border-bottom: 1px solid #ccc;
    }
    span{
      font-size:22px;
       font-weight:bold; 
       color:blue;
    }
  </style>
</head>
<body>
  <h2>Gestión de Vuelos</h2>
  <img src="Logo.jpg" alt="Logo de Aerosport">

  <?php if ($logueado): ?>
    <!-- Solo usuarios logueados pueden agregar -->
    <form action="insertar_vuelo.php" method="POST">
      <input type="text" name="titulo" placeholder="Título" required>
      <input type="number" name="personas" placeholder="Personas" required>
      <input type="text" name="duracion" placeholder="Duración" required>
      <input type="number" name="precio" placeholder="Precio" required>
      <input type="text" name="descripcion" placeholder="Descripción" required>
      <input type="text" name="imagen_url" placeholder="URL imagen" required>
      <input type="text" name="enlace_info" placeholder="Enlace info" required>
      <input type="text" name="enlace_reserva" placeholder="Enlace reserva" required>
      <input type="text" name="valor" placeholder="Valor" required>
      <button type="submit">Agregar Vuelo</button>
    </form>
  <?php else: ?>
    <p style="color: #777;">Inicia sesión para agregar, editar o eliminar vuelos.</p>
    <a href="Login.php" class="Navegar">Inciar Sesion</a>
  <?php endif; ?>

  <table border="1">
    <tr>
      <th>ID</th><th>Título</th><th>Personas</th><th>Duración</th><th>Precio</th>
      <th>Descripción</th><th>Imagen</th><th>Info</th><th>Reserva</th><th>Valor</th>
      <?php if ($logueado): ?><th>Acciones</th><?php endif; ?>
    </tr>
    <?php while($vuelo = $resultado->fetch_assoc()): ?>
    <tr>
      <?php if ($logueado): ?>
        <form action="actualizar_vuelo.php" method="POST">
          <td>
            <?= $vuelo['id'] ?>
            <input type="hidden" name="id" value="<?= $vuelo['id'] ?>">
          </td>
          <td><input type="text" name="titulo" value="<?= htmlspecialchars($vuelo['titulo']) ?>"></td>
          <td><input type="number" name="personas" value="<?= htmlspecialchars($vuelo['personas']) ?>"></td>
          <td><input type="text" name="duracion" value="<?= htmlspecialchars($vuelo['duracion']) ?>"></td>
          <td><input type="number" name="precio" value="<?= htmlspecialchars($vuelo['precio']) ?>"></td>
          <td><input type="text" name="descripcion" value="<?= htmlspecialchars($vuelo['descripcion']) ?>"></td>
          <td><input type="text" name="imagen_url" value="<?= htmlspecialchars($vuelo['imagen_url']) ?>"></td>
          <td><input type="text" name="enlace_info" value="<?= htmlspecialchars($vuelo['enlace_info']) ?>"></td>
          <td><input type="text" name="enlace_reserva" value="<?= htmlspecialchars($vuelo['enlace_reserva']) ?>"></td>
          <td><input type="text" name="valor" value="<?= htmlspecialchars($vuelo['valor']) ?>"></td>
          <td>
            <button type="submit">Actualizar</button>
        </form>
        <form action="eliminar_vuelo.php" method="POST" style="display:inline;">
          <input type="hidden" name="id" value="<?= $vuelo['id'] ?>">
          <button type="submit" onclick="return confirm('¿Eliminar vuelo?')">Eliminar</button>
        </form>
          </td>
      <?php else: ?>
          <td><?= $vuelo['id'] ?></td>
          <td><?= htmlspecialchars($vuelo['titulo']) ?></td>
          <td><?= htmlspecialchars($vuelo['personas']) ?></td>
          <td><?= htmlspecialchars($vuelo['duracion']) ?></td>
          <td><?= htmlspecialchars($vuelo['precio']) ?></td>
          <td><?= htmlspecialchars($vuelo['descripcion']) ?></td>
          <td><img src="<?= htmlspecialchars($vuelo['imagen_url']) ?>" alt="Imagen" width="100"></td>
          <td><a href="<?= htmlspecialchars($vuelo['enlace_info']) ?>" target="_blank" rel="noopener noreferrer">Info</a></td>
          <td><a href="<?= htmlspecialchars($vuelo['enlace_reserva']) ?>" target="_blank" rel="noopener noreferrer">Reserva</a></td>
          <td><?= htmlspecialchars($vuelo['valor']) ?></td>
      <?php endif; ?>
    </tr>
    
    <?php endwhile; ?>
  </table>

  <br><br>
  <?php if ($logueado): ?>
      <a href="admin_info_vuelos.php" class="Navegar">Administrar Información Vuelos</a>
  <?php endif; ?>
  
  

</body>
</html>
