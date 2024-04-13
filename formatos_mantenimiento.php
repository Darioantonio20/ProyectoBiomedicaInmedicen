<?php
// Recibe el ID del equipo a través de la URL.
$id_equipo = isset($_GET['id']) ? intval($_GET['id']) : 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formatos de Mantenimiento</title>
    <!-- Enlace a Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            margin-top: 50px;
        }

        .titulo {
            text-align: center;
        }

        h1 {
            text-align: center;
        }

        /* Estilos para los botones de formato */
        .btn-formato {
            display: block;
            margin-bottom: 10px;
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
        }

        .btn-formato:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .btn-success {
            display: block;
            margin-bottom: 10px;
            background-color: #CB4335;
            border-color: #CB4335;
        }
        

    </style>
</head>
    <div class="container">
        <h1>Formatos de Mantenimiento</h1>
        <div class="row">
            <div class="col-md-4">
                <!-- Botón para Formato de Cotización (general para todos los equipos) -->
                <a href="fpdf/cotizacion.pdf" class="btn btn-formato" target="_blank">Formato de Cotización</a>
            </div>
            <div class="col-md-4">
                <!-- Botón para Formato de Hoja de Salida (general para todos los equipos) -->
                <a href="fpdf/hoja_salida.pdf" class="btn btn-formato" target="_blank">Formato de Hoja de Salida</a>
            </div>
            <div class="col-md-4">
                <!-- Botón para Formato de Hoja de Servicio (específico para el equipo) -->
                <a href="reportefpdf.php?id_equipo=<?php echo $id_equipo; ?>" class="btn btn-formato" target="_blank">Formato de Hoja de Servicio</a>
            </div>
            <div class="col-md-4">
                <!-- Botón pa regresar-->
                <a href="mantenimiento.php?id_equipo=<?php echo $id_equipo; ?>" class="btn btn-success">Regresar</a>
            </div>
        </div>
    </div>

    <!-- ... Tus scripts de JS ... -->
</body>
</html>
