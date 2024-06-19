<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Alumnos</title>
    <style>

        font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
            position: relative;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            position: relative;  /* Agregar esta línea */
        }

        h1 {
            color: #444;
            text-align: center;
        }

        .float-button {
            position: absolute;
            bottom: 20px;  /* Cambiar 'top' por 'bottom' */
            right: 20px;
            padding: 10px 20px;
            background-color: #3c8dbc;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .float-button:hover {
            background-color: #3071a9;
        }

        table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #3c8dbc;
            color: white;
        }

        

        a {
            color: #3c8dbc;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
  <h1>Lista de Alumnos</h1>
  <a href="insertar_alumno.html" class="float-button">Añadir Alumno</a>
  <?php
  include 'conexion.php';

  $sql = "SELECT * FROM ALUMNOS";
  $resultado = $idCone->query($sql);

  if ($resultado->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Nombre</th><th>Dirección</th><th>Email</th><th>Teléfono</th><th>Imagen</th></tr>"; // Agregamos la columna Imagen

    while($row = $resultado->fetch_assoc()) {
      echo "<tr><td>" . $row["nombre"] . "</td><td>" . $row["direccion"] . "</td><td>" . $row["email"] . "</td><td>" . $row["telefono"] . "</td>"; // Cerramos la fila aquí

      // En lugar de crear un div para la imagen, añadimos una celda a la fila de la tabla
      if (!empty($row["ruta_imagen"])) {
        echo "<td><img src=\"" . htmlspecialchars($row["ruta_imagen"]) . "\" alt=\"Imagen de " . htmlspecialchars($row["nombre"]) . "\" style='width:100px; height:100px;'><br>" . "</td>"; // Ajustamos el tamaño de la imagen a 100x100
      } else {
        echo "<td>No image</td>"; // Si no hay imagen, todavía necesitamos cerrar la celda
      }

      echo "</tr>"; // Finalizamos la fila aquí
    }

    echo "</table>";
  } else {
    echo "<p>No hay alumnos en la base de datos.</p>";
  }

  $total_alumnos = $resultado->num_rows;
  echo "<p>En total hay:  " . $total_alumnos .  " alumnos</p>";
  ?>

  <p style="text-align: center;"><a href="index.html">Volver al menú principal</a></p>
</div>
</body>
</html>
