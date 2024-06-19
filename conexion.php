<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conexión php</title>
</head>
<body>
<?php
try{
    $idCone=mysqli_connect("localhost","alex","alex.1", "alumnos");
    //echo "Conexión realizada con éxito ".mysqli_get_server_info($idCone);
    //$x=3/0; Provocar error división entre 0.
    return $idCone;
}
catch(mysqli_sql_exception $e){
    die("Error de conexión ".mysqli_connect_errno()." Motivo: " .mysqli_connect_error());
}
catch(exception $e2){
    die("Excepción general desconocida ".$e2->getMessage());
}		
catch(error $e3){
    die("Error general desconocido ".$e3->getMessage());
}
//echo "Conexión realizada con éxito " . mysqli_get_server_info($idCone);
?>

</body>
</html>