<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modificar Alumno</title>
</head>
<body>
<?php
include 'conexion.php';

$error = "";
$mensaje_confirmacion = "";
$alumno = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["nombre"])) {
    $error .= "El campo nombre es obligatorio.<br>";
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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($alumno)) {
  echo '<h1>Modificar Alumno</h1>';
  echo '<form method="post" action="actualizar_alumno.php">';
  echo '<input type="hidden" name="nombre_original" value="' . $alumno["nombre"] . '">';
  echo '<label for="nombre">Nombre:</label>';
  echo '<input type="text" name="nombre" value="' . $alumno["nombre"] . '"><br>';
  echo '<label for="direccion">Direccion:</label>';
  echo '<input type="text" name="direccion" value="' . $alumno["direccion"] . '"><br>';
  echo '<label for="email">Email:</label>';
  echo '<input type="email" name="email" value="' . $alumno["email"] . '"><br>';
  echo '<label for="telefono">Telefono:</label>';
  echo '<input type="number" name="telefono" value="' . $alumno["telefono"] . '"><br>';
  echo '<input type="submit" value="Modificar">';
  echo '</form>';
}
?>

<p><a href="index.html">Cancelar la modificación y volver al menú principal</a></p>
</body>
</html>



