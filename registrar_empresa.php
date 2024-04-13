<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Añadir Empresa</title>
    <!-- Bootstrap CSS modificado para cambiar los colores -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #D6EAF8; /* Azul pastel muy claro */
        }

        .container {
            margin-top: 20px;
        }

        .card-header {
            background-color: #5499C7; /* Color azul */
            color: white;
        }

        h3 {
            font-family: 'Roboto', sans-serif;
            text-align: center;
            margin-top: 20px; /* Ajusta el margen superior según sea necesario */
        }

        .btn-primary {
            background-color: #5DADE2; /* Color azul claro */
            border-color: #5DADE2; /* Borde del botón */
        }

        .btn-primary:hover {
            background-color: #3498DB; /* Color azul más oscuro al pasar el cursor */
            border-color: #3498DB; /* Borde del botón al pasar el cursor */
        }

        .form-group {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h3>Añadir Nueva Empresa</h3>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <strong>Ingrese los Detalles de la Empresa</strong>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="guardar_empresa.php">
                            <div class="form-group">
                                <label for="nombre">Nombre de la Empresa:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                            <div class="form-group">
                                <label for="mail">Correo Electrónico:</label>
                                <input type="email" class="form-control" id="mail" name="mail" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Teléfono:</label>
                                <input type="tel" class="form-control" id="phone" name="phone" required>
                            </div>
                            <div class="form-group">
                                <label for="type_company">Tipo de Empresa:</label>
                                <input type="text" class="form-control" id="type_company" name="type_company" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar Empresa</button>
                            <a href="empresas.php" class="btn btn-secondary">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS y dependencias actualizados -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
