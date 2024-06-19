<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Actualizar Alumno</title>
</head>
<body>
<?php
include 'conexion.php';

$error = "";
$mensaje_confirmacion = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nombre_original = $_POST["nombre_original"];
  $nombre = $_POST["nombre"];
  $direccion = $_POST["direccion"];
  $email = $_POST["email"];
  $telefono = $_POST["telefono"];

  $sql = "UPDATE ALUMNOS SET nombre='$nombre', direccion='$direccion', email='$email', telefono='$telefono' WHERE nombre='$nombre_original'";

  if ($idCone->query($sql) === TRUE) {
    $mensaje_confirmacion = "Alumno actualizado correctamente.";
  } else {
    $error = "Error al actualizar alumno: " . $idCone->error;
  }
}

if (!empty($error)) {
  echo '<div><p style="color: red;">' . $error . '</p></div>';
}

if (isset($mensaje_confirmacion)) {
  echo '<div><p style="color: green;">' . $mensaje_confirmacion . '</p></div>';
}
?>

<p><a href="buscar_alumno.html">Volver a la búsqueda</a></p>
</body>
</html>

