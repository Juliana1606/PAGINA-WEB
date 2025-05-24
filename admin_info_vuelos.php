<?php
// Conexión
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
$conn = new mysqli("localhost", "root", "Natachita.16", "aerosport");
if ($conn->connect_error) die("Conexión fallida: " . $conn->connect_error);

// Insertar nuevo registro
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["crear"])) {
  $stmt = $conn->prepare("INSERT INTO info_vuelos (duracion, pasajeros, estacionamiento, recorrido, salida, imagen_url, precio, descripcion, itinerario, mapa_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssssisss", $_POST["duracion"], $_POST["pasajeros"], $_POST["estacionamiento"], $_POST["recorrido"], $_POST["salida"], $_POST["imagen_url"], $_POST["precio"], $_POST["descripcion"], $_POST["itinerario"], $_POST["mapa_url"]);
  $stmt->execute();
  $stmt->close();
  header("Location: admin_info_vuelos.php");
  exit();
}

// Actualizar registro existente
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["editar"])) {
  $stmt = $conn->prepare("UPDATE info_vuelos SET duracion=?, pasajeros=?, estacionamiento=?, recorrido=?, salida=?, imagen_url=?, precio=?, descripcion=?, itinerario=?, mapa_url=? WHERE id=?");
  $stmt->bind_param("ssssssisssi", $_POST["duracion"], $_POST["pasajeros"], $_POST["estacionamiento"], $_POST["recorrido"], $_POST["salida"], $_POST["imagen_url"], $_POST["precio"], $_POST["descripcion"], $_POST["itinerario"], $_POST["mapa_url"], $_POST["id"]);
  $stmt->execute();
  $stmt->close();
  header("Location: admin_info_vuelos.php");
  exit();
}

// Eliminar registro
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["eliminar"])) {
  $stmt = $conn->prepare("DELETE FROM info_vuelos WHERE id=?");
  $stmt->bind_param("i", $_POST["id"]);
  $stmt->execute();
  $stmt->close();
  header("Location: admin_info_vuelos.php");
  exit();
}

// Consultar registros
$info = $conn->query("SELECT * FROM info_vuelos");
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Administrar Info Vuelos</title>
  <link href="https://fonts.googleapis.com/css2?family=Jockey+One&display=swap" rel="stylesheet">
  <style>
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

    h2 {
      font-size: 2.5rem;
      color: #001dff;
      margin-bottom: 10px;
    }

    img {
      width: 180px;
      height: auto;
    }

    form:not(.inline) {
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

    form:not(.inline) input,
    form:not(.inline) button {
      padding: 10px;
      font-size: 1rem;
      border: 1px solid #ccc;
      border-radius: 6px;
    }

    form:not(.inline) button {
      background-color: #001dff;
      color: white;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    form:not(.inline) button:hover {
      background-color: #0003c4;
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

    table form.inline {
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
      padding: 6px 12px;
      border-radius: 6px;
      cursor: pointer;
      font-size: 14px;
      margin: 2px;
      transition: background 0.3s ease;
    }

    table button:hover {
      background-color: #0003c4;
    }

    @media (max-width: 768px) {
      form:not(.inline) {
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

    form.eliminar button {
      background-color: #d9534f;
      width: ;
    }

    form.eliminar button:hover {
      background-color: #c9302c;
    }
   

    /* Botón eliminar específico */
    table form button[name="eliminar"] {
    background-color: #d9534f;
    }

    table form button[name="eliminar"]:hover {
    background-color: #c9302c;
    }
    


  </style>
</head>
<body>

  <img src="logo.jpg" alt="Logo">
  <h2>Administración de Información de Vuelos</h2>

  <!-- Formulario de creación -->
  <form method="post">
    <input type="text" name="duracion" placeholder="Duración" required>
    <input type="text" name="pasajeros" placeholder="Pasajeros" required>
    <input type="text" name="estacionamiento" placeholder="Estacionamiento" required>
    <input type="text" name="recorrido" placeholder="Recorrido" required>
    <input type="text" name="salida" placeholder="Salida" required>
    <input type="text" name="imagen_url" placeholder="Imagen URL" required>
    <input type="number" name="precio" placeholder="Precio" required>
    <input type="text" name="descripcion" placeholder="Descripción" required>
    <input type="text" name="itinerario" placeholder="Itinerario" required>
    <input type="text" name="mapa_url" placeholder="Mapa URL" required>
    <button type="submit" name="crear">Crear</button>
  </form>

  <!-- Tabla de registros -->
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Duración</th>
        <th>Pasajeros</th>
        <th>Estacionamiento</th>
        <th>Recorrido</th>
        <th>Salida</th>
        <th>Imagen</th>
        <th>Precio</th>
        <th>Descripción</th>
        <th>Itinerario</th>
        <th>Mapa</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $info->fetch_assoc()): ?>
        <tr>
          <form method="post">
            <td><?= $row["id"] ?></td>
            <input type="hidden" name="id" value="<?= $row["id"] ?>">
            <td><input type="text" name="duracion" value="<?= $row["duracion"] ?>"></td>
            <td><input type="text" name="pasajeros" value="<?= $row["pasajeros"] ?>"></td>
            <td><input type="text" name="estacionamiento" value="<?= $row["estacionamiento"] ?>"></td>
            <td><input type="text" name="recorrido" value="<?= $row["recorrido"] ?>"></td>
            <td><input type="text" name="salida" value="<?= $row["salida"] ?>"></td>
            <td><input type="text" name="imagen_url" value="<?= $row["imagen_url"] ?>"></td>
            <td><input type="number" name="precio" value="<?= $row["precio"] ?>"></td>
            <td><input type="text" name="descripcion" value="<?= $row["descripcion"] ?>"></td>
            <td><input type="text" name="itinerario" value="<?= $row["itinerario"] ?>"></td>
            <td><input type="text" name="mapa_url" value="<?= $row["mapa_url"] ?>"></td>
            <td>
              <button type="submit" name="editar">Editar</button>
          </form>
          <form method="post" action="admin_info_vuelos.php">
            <input type="hidden" name="id" value="<?= $row["id"] ?>">
            <button type="submit" name="eliminar">Eliminar</button>
          </form>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

</body>
</html>
