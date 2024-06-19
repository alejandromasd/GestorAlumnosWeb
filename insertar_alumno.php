<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Insertar Alumno</title>
</head>
<body>
<?php
include 'conexion.php';

$error = "";
$mensaje_confirmacion = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $grado = $_POST["grado"];
  $sexo = $_POST["sexo"];
  $actividades = isset($_POST["actividades"]) ? implode(', ', $_POST["actividades"]) : "";
  if (empty($_POST["nombre"])) {
    $error .= "El campo nombre es obligatorio.<br>";
  }
  if (empty($_POST["direccion"])) {
    $error .= "El campo dirección es obligatorio.<br>";
  }
  if (empty($_POST["email"])) {
    $error .= "El campo email es obligatorio.<br>";
  }
  if (empty($_POST["telefono"])) {
    $error .= "El campo teléfono es obligatorio.<br>";
  }

  // Directorio donde se guardarán las imágenes
$target_dir = "imagenes/";



$target_file = $target_dir . basename($_FILES["foto"]["name"]);

// Intenta mover el archivo subido al directorio de imágenes
if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] == 0) {
  // Comprobar si el archivo es una imagen
  $check = getimagesize($_FILES["foto"]["tmp_name"]);
  if ($check !== false) {
      // Directorio donde se guardarán las imágenes
      $target_dir = "imagenes/";
      
      // Crear el directorio si no existe
      if (!file_exists($target_dir)) {
          mkdir($target_dir, 0777, true);
      }

      $target_file = $target_dir . basename($_FILES["foto"]["name"]);

      // Intenta mover el archivo subido al directorio de imágenes
      if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
          $mensaje_confirmacion .= "<br>La imagen se ha subido correctamente.";
      } else {
          $error .= "<br>Error al subir la imagen.";
      }
  } else {
      $error .= "<br>El archivo subido no es una imagen.";
  }
} else {
  $error .= "<br>No se subió ninguna imagen.";
}


  if ($error == "") {
    $nombre = $_POST["nombre"];
    $direccion = $_POST["direccion"];
    $email = $_POST["email"];
    $telefono = $_POST["telefono"];

    $sql = "INSERT INTO ALUMNOS (nombre, direccion, email, telefono, grado, sexo, ruta_imagen) VALUES ('$nombre', '$direccion', '$email', $telefono, '$grado', '$sexo', '$target_file')";
    if ($idCone->query($sql) === TRUE) {
      $mensaje_confirmacion = "El alumno con nombre $nombre se ha insertado correctamente.";
      // Obtén el id del alumno recién insertado
      $id_alumno = $idCone->insert_id;
      // Divide las actividades en un array
      $actividades_array = explode(', ', $actividades);

      // Para cada actividad, inserta una nueva fila en la tabla ACTIVIDADES
    foreach ($actividades_array as $actividad) {
      $sql = "INSERT INTO ACTIVIDADES (nombre, id_alumno) VALUES ('$actividad', $id_alumno)";
      
      if ($idCone->query($sql) !== TRUE) {
        $error .= "Error al insertar actividad: " . $idCone->error;
      }
    }
    } else {
      $error = "Error al insertar alumno: " . $idCone->error;
    }
  }

  if (!empty($error)) {
    echo '<div><p style="color: red;">' . $error . '</p></div>';
  }

  if (!empty($mensaje_confirmacion)) {
    echo '<div><p style="color: green;">' . $mensaje_confirmacion . '</p></div>';
  }
}

?>
  <p><a href="insertar_alumno.html">Volver</a></p>
</body>
</html>



