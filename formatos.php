<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formatos</title>
    <!-- Bootstrap CSS modificado para cambiar los colores -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #e9ecef; /* Color de fondo ligeramente más claro */
        }
        .container {
            margin-top: 50px;
            text-align: center;
        }
        h1 {
            margin-bottom: 30px;
        }
        .btn-formato {
            padding: 20px 50px;
            font-size: 1.5rem;
            margin: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Formatos</h1>
        <div>
            <a href="fpdf/cotizacion.pdf" class="btn btn-primary btn-formato" target="_blank">Formato de Cotización</a>
            <a href="fpdf/hoja_salida.pdf" class="btn btn-primary btn-formato" target="_blank">Formato de Hoja de Salida</a>
            <a href="fpdf/hoja_servicio.pdf" class="btn btn-primary btn-formato" target="_blank">Formato de Hoja de Servicio</a>
        </div>
    </div>

    <!-- Bootstrap JS y dependencias actualizados -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
