<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Confirmar Borrar Alumno</title>
</head>
<body>
  <?php
  include 'conexion.php';

  $error = "";
  $mensaje_confirmacion = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    if (empty($nombre)) {
      $sql = "DELETE FROM ALUMNOS";
      if ($idCone->query($sql) === TRUE) {
        $mensaje_confirmacion = "Todos los alumnos han sido borrados.";
      } else {
        $error = "Error al borrar alumno(s): " . $idCone->error;
      }
    } else {
      $nombre = $_POST["nombre"];
      $sql = "DELETE FROM ALUMNOS WHERE nombre='$nombre'";
      if ($idCone->query($sql) === TRUE) {
        $mensaje_confirmacion = "El alumno con el nombre $nombre se ha borrado correctamente.";
      } else {
        $error = "Error al borrar alumno: " . $idCone->error;
      }
    }
    
    if (!empty($error)) {
      echo '<div><p style="color: red;">' . $error . '</p></div>';
    }

    if (isset($mensaje_confirmacion)) {
      echo '<div><p style="color: green;">' . $mensaje_confirmacion . '</p></div>';
    }
  }
  ?>

  <p><a href="borrar_alumno.html">Volver a la búsqueda</a></p>
</body>
</html>

