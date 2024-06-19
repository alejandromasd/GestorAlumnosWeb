<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Borrar Alumno</title>
  <script>
    function confirmarBorrado() {
      return confirm('¿Está seguro de que desea borrar este alumno?');
    }
  </script>
</head>
<body>
  <?php
  include 'conexion.php';

  $error = "";
  $mensaje_confirmacion = "";
  $alumno = null;

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["nombre"])) {
      $borrar_todos = true;
      $sql = "DELETE FROM ALUMNOS";
      if ($idCone->query($sql) === TRUE) {
        $mensaje_confirmacion = "Todos los alumnos han sido borrados.";
      } else {
        $error = "Error al borrar alumno(s): " . $idCone->error;
      }
    } else {
      $nombre = $_POST["nombre"];
      $sql = "SELECT * FROM ALUMNOS WHERE nombre='$nombre'";
      $result = $idCone->query($sql);
      if ($result->num_rows > 0) {
        $alumno = $result->fetch_assoc();
      } else {
        $error .= "No se ha encontrado un alumno con ese nombre.<br>";
      }
    }
  }

  if (!empty($error)) {
    echo '<div><p style="color: red;">' . $error . '</p></div>';
  }

  if (isset($mensaje_confirmacion)) {
    echo '<div><p style="color: green;">' . $mensaje_confirmacion . '</p></div>';
  }

  if (isset($alumno)) {
    echo '<h1>Confirmar Borrar Alumno</h1>
    <form method="post" action="confirmar_borrar_alumno.php" onsubmit="return confirmarBorrado();">
      <input type="hidden" name="nombre" value="' . $alumno["nombre"] . '">
      <p>Nombre: ' . $alumno["nombre"] . '</p>
      <p>Dirección: ' . $alumno["direccion"] . '</p>
      <p>Email: ' . $alumno["email"] . '</p>
      <p>Teléfono: ' . $alumno["telefono"] . '</p>
      <input type="submit" value="Borrar">
    </form>';
  }
  ?>

  <p><a href="borrar_alumno.html">Volver a la búsqueda</a></p>
</body>
</html>


