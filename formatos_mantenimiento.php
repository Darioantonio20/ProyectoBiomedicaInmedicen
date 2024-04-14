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
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
        }

.btn-primary-serch{
    display: inline-block; /* Cambia a inline-block */
    width: 100%;
    font-weight: bold;
    background: #0048A0;
    color: white;
    padding-block: 15px;
    margin: 1.25rem 23% 1.25rem 5%; /* Reduce el margen izquierdo */
    border-radius: 20px;
    box-shadow: #0048A0 0px 20px 10px -15px;
    border: none;
    transition: all 0.2s ease-in-out;
}
.btn-primary-serch:hover {
    transform: scale(1.03);
    box-shadow: #0048A0 0px 23px 10px -20px;
}

.btn-primary-serch:active {
    transform: scale(0.95);
    box-shadow: #0048A0 0px 15px 10px -10px;
} 

.btn-danger{
    display: inline-block; /* Cambia a inline-block */
    width: 100%;
    font-weight: bold;
    background: #ff0000;
    color: white;
    padding-block: 15px;
    margin: 1.25rem 23% 1.25rem 5%; /* Reduce el margen izquierdo */
    border-radius: 20px;
    box-shadow: #ff0000 0px 20px 10px -15px;
    border: none;
    transition: all 0.2s ease-in-out;
}
.btn-danger:hover {
    transform: scale(1.03);
    box-shadow: #ff0000 0px 23px 10px -20px;
}

.btn-danger:active {
    transform: scale(0.95);
    box-shadow: #ff0000 0px 15px 10px -10px;
}

.heading {
    text-align: center;
    font-weight: 900;
    font-size: 2.6rem;
    color: rgb(16, 137, 211);
}
.btn-primary-serch, .btn-danger {
    color: #ffffff; /* Cambia el color del texto a blanco */
    text-decoration: none; /* Elimina la línea debajo del texto */
}
.col-md-4 {
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
}
.btn-primary-serch:hover, .btn-danger:hover {
    color: #ffffff; /* Cambia el color del texto a blanco cuando se pasa el cursor sobre el enlace */
    text-decoration: none; 
}
.rowBtnRegresar{
    display: flex;
    justify-content: center;
}
    </style>
</head>
    <div class="container">
        <h1 class="heading mb-5 ">Formatos de Mantenimiento</h1>
        <div class="row">
            <div class="col-md-4">
                <a href="fpdf/cotizacion.pdf" class="btn-primary-serch" target="_blank">Formato de Cotización</a>
            </div>
            <div class="col-md-4">
                <a href="fpdf/hoja_salida.pdf" class="btn-primary-serch" target="_blank">Formato de Hoja de Salida</a>
            </div>
            <div class="col-md-4">
                <a href="reportefpdf.php?id_equipo=<?php echo $id_equipo; ?>" class="btn-primary-serch" target="_blank">Formato de Hoja de Servicio</a>
            </div>
        </div>
        <div class="rowBtnRegresar">
            <div class="col-md-4" style="display: flex; justify-content: center;">
                <a href="mantenimiento.php?id_equipo=<?php echo $id_equipo; ?>" class="btn-danger">Regresar</a>
            </div>
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
