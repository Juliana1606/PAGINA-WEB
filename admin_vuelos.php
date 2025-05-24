<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
$conn = new mysqli("localhost", "root", "Natachita.16", "aerosport");
$resultado = $conn->query("SELECT * FROM vuelos");
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Administrar Vuelos</title>
  <style> /* Gestión de Vuelos - Estilos Personalizados */

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

    /* Tabla de vuelos */
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

    /* Formulario por fila */
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

    /* Botones en tabla */
    table button {
    background-color: #001dff;
    color: white;
    border: none;
    padding: 6px 10px;
    border-radius: 4px;
    cursor: pointer;
    margin: 3px 0;
    font-size: 0.85rem;
    }

    table button:hover {
    background-color: #0003c4;
    }

    /* Responsive */
    @media (max-width: 768px) {
    form[action="insertar_vuelo.php"] {
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
    /* Botones de acciones */
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

/* Botón eliminar */
form[action="eliminar_vuelo.php"] button {
  background-color: #d9534f;
}

form[action="eliminar_vuelo.php"] button:hover {
  background-color: #c9302c;
}

</style>
</head>
<body>
  <h2>Gestión de Vuelos</h2>
  <img src="Logo.jpg" alt="Logo de Aerosport">
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

  <table border="1">
    <tr>
      <th>ID</th><th>Título</th><th>Personas</th><th>Duración</th><th>Precio</th><th>Descripción</th>
      <th>Imagen</th><th>Info</th><th>Reserva</th><th>Valor</th><th>Acciones</th>
    </tr>
    <?php while($vuelo = $resultado->fetch_assoc()): ?>
    <tr>
      <form action="actualizar_vuelo.php" method="POST">
        <td><?= $vuelo['id'] ?><input type="hidden" name="id" value="<?= $vuelo['id'] ?>"></td>
        <td><input type="text" name="titulo" value="<?= $vuelo['titulo'] ?>"></td>
        <td><input type="number" name="personas" value="<?= $vuelo['personas'] ?>"></td>
        <td><input type="text" name="duracion" value="<?= $vuelo['duracion'] ?>"></td>
        <td><input type="number" name="precio" value="<?= $vuelo['precio'] ?>"></td>
        <td><input type="text" name="descripcion" value="<?= $vuelo['descripcion'] ?>"></td>
        <td><input type="text" name="imagen_url" value="<?= $vuelo['imagen_url'] ?>"></td>
        <td><input type="text" name="enlace_info" value="<?= $vuelo['enlace_info'] ?>"></td>
        <td><input type="text" name="enlace_reserva" value="<?= $vuelo['enlace_reserva'] ?>"></td>
        <td><input type="text" name="valor" value="<?= $vuelo['valor'] ?>"></td>
        <td>
          <button type="submit">Actualizar</button>
      </form>
      <form action="eliminar_vuelo.php" method="POST" style="display:inline;">
        <input type="hidden" name="id" value="<?= $vuelo['id'] ?>">
        <button type="submit" onclick="return confirm('¿Eliminar vuelo?')">Eliminar</button>
      </form>
        </td>
    </tr>
    <?php endwhile; ?>
  </table>
</body>
</html>
