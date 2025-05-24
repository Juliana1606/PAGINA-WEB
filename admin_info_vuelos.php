<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
$conn = new mysqli("localhost", "root", "Natachita.16", "aerosport");
$resultado = $conn->query("SELECT * FROM info_vuelos");
//Validamos el inicio de sersion
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
  <title>Administrar Información de Vuelos</title>
  <style>
      /* Gestión de Información de Vuelos - Estilos Adaptados */

    /* Reset y globales */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

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

    /* Título */
    h2 {
      font-size: 2.5rem;
      color: #001dff;
      margin-bottom: 10px;
    }

    /* Logo */
    img {
      width: 180px;
      height: auto;
    }

    /* Formulario de ingreso */
    form[action="insertar_info_vuelo.php"] {
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

    form[action="insertar_info_vuelo.php"] input,
    form[action="insertar_info_vuelo.php"] button {
      padding: 10px;
      font-size: 1rem;
      border: 1px solid #ccc;
      border-radius: 6px;
    }

    form[action="insertar_info_vuelo.php"] button {
      background-color: #001dff;
      color: white;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    form[action="insertar_info_vuelo.php"] button:hover {
      background-color: #0003c4;
    }

    /* Tabla */
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

    /* Inputs en tabla */
    table input[type="text"],
    table input[type="number"] {
      width: 100%;
      padding: 6px;
      font-size: 0.9rem;
      border: 1px solid #aaa;
      border-radius: 4px;
    }

    /* Formulario por fila */
    table form {
      display: contents;
    }

    /* Botones */
    table button {
      background-color: #001dff;
      color: white;
      border: none;
      padding: 6px 12px;
      border-radius: 6px;
      cursor: pointer;
      font-size: 14px;
      margin: 3px;
      transition: background 0.3s ease;
    }

    table button:hover {
      background-color: #0003c4;
    }
    /* Botón eliminar */
    form[action="eliminar_info_vuelo.php"] button {
      background-color: #d9534f;
    }

    form[action="eliminar_info_vuelo.php"] button:hover {
      background-color: #c9302c;
    }
    /* Botón eliminar */
    button[name="action"][value="eliminar"] {
      background-color: #d9534f;
    }

    button[name="action"][value="eliminar"]:hover {
      background-color: #c9302c;
    }

    /* Responsive */
    @media (max-width: 768px) {
      form[action="insertar_info_vuelo.php"] {
        grid-template-columns: 1fr;
      }

      th, td {
        font-size: 0.85rem;
        padding: 10px;
      }

      h2 {
        font-size: 2rem;
      }
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
    
 
  </style>

  
</head>

<body>
  

  <h2>Gestión de Información de Vuelos</h2>
   <img src="Logo.jpg" alt="Logo de Aerosport">

<?php if ($logueado): ?>
  <form action="insertar_info_vuelo.php" method="POST">
    <input type="text" name="duracion" placeholder="Duración" required>
    <input type="text" name="pasajeros" placeholder="Pasajeros" required>
    <input type="text" name="estacionamiento" placeholder="Estacionamiento" required>
    <input type="text" name="salida" placeholder="Lugar de salida" required>
    <input type="text" name="imagen_url" placeholder="URL de imagen" required>
    <input type="number" name="precio" placeholder="Precio" required>
    <input name="recorrido" placeholder="Recorrido" required>
    <input name="descripcion" placeholder="Descripción" required>
    <input name="itinerario" placeholder="Itinerario" required>
    <input name="mapa_url" placeholder="URL de mapa" required>
    <button type="submit">Agregar Informacion</button>
  </form>
<?php else: ?>
    <p style="color: #777;">Inicia sesión para agregar, editar o eliminar informacion de los vuelos.</p>
    <a href="Login.php" class="Navegar">Inciar Sesion</a>
  <?php endif; ?>

  
  <table border="1">
  <tr>
    <th>ID</th><th>Duración</th><th>Pasajeros</th><th>Estacionamiento</th><th>Salida</th>
    <th>Imagen</th><th>Precio</th><th>Recorrido</th><th>Descripción</th><th>Itinerario</th><th>Mapa</th>
    <?php if ($logueado): ?><th>Acciones</th><?php endif; ?>
  </tr>

  <?php while($info_vuelo = $resultado->fetch_assoc()): ?>
    <tr>
      <?php if ($logueado): ?>
        <form method="POST" action="actualizar_info_vuelo.php">
          <td><?= $info_vuelo['id'] ?><input type="hidden" name="id" value="<?= $info_vuelo['id'] ?>"></td>
          <td><input type="text" name="duracion" value="<?= htmlspecialchars($info_vuelo['duracion']) ?>"></td>
          <td><input type="text" name="pasajeros" value="<?= htmlspecialchars($info_vuelo['pasajeros']) ?>"></td>
          <td><input type="text" name="estacionamiento" value="<?= htmlspecialchars($info_vuelo['estacionamiento']) ?>"></td>
          <td><input type="text" name="salida" value="<?= htmlspecialchars($info_vuelo['salida']) ?>"></td>
          <td><input type="text" name="imagen_url" value="<?= htmlspecialchars($info_vuelo['imagen_url']) ?>"></td>
          <td><input type="number" name="precio" value="<?= htmlspecialchars($info_vuelo['precio']) ?>"></td>
          <td><input type="text" name="recorrido" value="<?= htmlspecialchars($info_vuelo['recorrido']) ?>"></td>
          <td><input type="text" name="descripcion" value="<?= htmlspecialchars($info_vuelo['descripcion']) ?>"></td>
          <td><input type="text" name="itinerario" value="<?= htmlspecialchars($info_vuelo['itinerario']) ?>"></td>
          <td><input type="text" name="mapa_url" value="<?= htmlspecialchars($info_vuelo['mapa_url']) ?>"></td>
          <td>
            <button type="submit">Actualizar</button>
        </form>
        <form action="eliminar_info_vuelo.php" method="POST" style="display:inline;">
          <input type="hidden" name="id" value="<?= $info_vuelo['id'] ?>">
          <button type="submit" onclick="return confirm('¿Eliminar este vuelo?')">Eliminar</button>
        </form>
          </td>
      <?php else: ?>
        <td><?= $info_vuelo['id'] ?></td>
        <td><?= htmlspecialchars($info_vuelo['duracion']) ?></td>
        <td><?= htmlspecialchars($info_vuelo['pasajeros']) ?></td>
        <td><?= htmlspecialchars($info_vuelo['estacionamiento']) ?></td>
        <td><?= htmlspecialchars($info_vuelo['salida']) ?></td>
        <td><img src="<?= htmlspecialchars($info_vuelo['imagen_url']) ?>" width="100"></td>
        <td><?= htmlspecialchars($info_vuelo['precio']) ?></td>
        <td><?= htmlspecialchars($info_vuelo['recorrido']) ?></td>
        <td><?= htmlspecialchars($info_vuelo['descripcion']) ?></td>
        <td><?= htmlspecialchars($info_vuelo['itinerario']) ?></td>
        <td><a href="<?= htmlspecialchars($info_vuelo['mapa_url']) ?>" target="_blank">Ver mapa</a></td>
      <?php endif; ?>
    </tr>
  <?php endwhile; ?>
</table>

     
      </body>
</html>
