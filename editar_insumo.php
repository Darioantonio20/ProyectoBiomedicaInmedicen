<?php
// Configuración de la base de datos
$host = "127.0.0.1";
$username = "root";
$password = "";
$database = "inmedicen"; // Cambio de base de datos

// Crear conexión
$conn = new mysqli($host, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
$conn->set_charset("utf8");

// Verificar si se proporciona un ID de insumo válido
if (!isset($_GET['id']) || empty(trim($_GET['id']))) {
    die("ID de insumo no proporcionado.");
}

// Obtener el ID del insumo de la URL
$id_insumo = trim($_GET['id']);

// Inicializar variables
$nombre = $marca = $modelo = $no_serie = $caducidad = $tipo = $cantidad = $observaciones = "";
$nombre_err = $marca_err = $modelo_err = $no_serie_err = $caducidad_err = $tipo_err = $cantidad_err = $observaciones_err = "";

// Procesar datos del formulario cuando se envía el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar nombre del insumo
    if (empty(trim($_POST["nombre"]))) {
        $nombre_err = "Por favor ingrese el nombre del insumo.";
    } else {
        $nombre = trim($_POST["nombre"]);
    }

    // Validar marca del insumo
    $marca = trim($_POST["marca"]);

    // Validar modelo del insumo
    $modelo = trim($_POST["modelo"]);

    // Validar número de serie del insumo
    $no_serie = trim($_POST["no_serie"]);

    // Validar caducidad del insumo
    $caducidad = trim($_POST["caducidad"]);

    // Validar tipo del insumo
    if (empty(trim($_POST["tipo"]))) {
        $tipo_err = "Por favor ingrese el tipo del insumo.";
    } else {
        $tipo = trim($_POST["tipo"]);
    }

    // Validar cantidad del insumo
    if (empty(trim($_POST["cantidad"]))) {
        $cantidad_err = "Por favor ingrese la cantidad del insumo.";
    } else {
        $cantidad = trim($_POST["cantidad"]);
    }

    // Validar observaciones del insumo
    $observaciones = trim($_POST["observaciones"]);

    // Verificar si no hay errores de entrada antes de actualizar en la base de datos
    if (empty($nombre_err) && empty($tipo_err) && empty($cantidad_err)) {
        // Preparar la declaración SQL
        $sql = "UPDATE insumos SET nombre=?, marca=?, modelo=?, no_serie=?, caducidad=?, tipo=?, cantidad=?, observaciones=? WHERE id_insumo=?";

        if ($stmt = $conn->prepare($sql)) {
            // Vincular variables a la declaración preparada como parámetros
            $stmt->bind_param("ssssssisi", $param_nombre, $param_marca, $param_modelo, $param_no_serie, $param_caducidad, $param_tipo, $param_cantidad, $param_observaciones, $param_id);

            // Establecer parámetros
            $param_nombre = $nombre;
            $param_marca = $marca;
            $param_modelo = $modelo;
            $param_no_serie = $no_serie;
            $param_caducidad = $caducidad;
            $param_tipo = $tipo;
            $param_cantidad = $cantidad;
            $param_observaciones = $observaciones;
            $param_id = $id_insumo;

            // Ejecutar la declaración preparada
            if ($stmt->execute()) {
                // Redireccionar a insumos.php después de actualizar el insumo
                header("location: insumos.php");
                exit();
            } else {
                echo "Algo salió mal. Por favor, inténtelo de nuevo más tarde.";
            }

            // Cerrar declaración
            $stmt->close();
        }
    }
}

// Obtener información del insumo desde la base de datos
$sql = "SELECT nombre, marca, modelo, no_serie, caducidad, tipo, cantidad, observaciones FROM insumos WHERE id_insumo = ?";
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("i", $param_id);
    $param_id = $id_insumo;

    if ($stmt->execute()) {
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            $stmt->bind_result($nombre, $marca, $modelo, $no_serie, $caducidad, $tipo, $cantidad, $observaciones);
            $stmt->fetch();
        } else {
            echo "No se encontró ningún insumo con ese ID.";
            exit();
        }
    } else {
        echo "Algo salió mal. Por favor, inténtelo de nuevo más tarde.";
    }

    // Cerrar declaración
    $stmt->close();
}

// Cerrar conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Insumo</title>
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
            margin-top: 20px;
        }
        .card {
            margin-bottom: 20px;
        }
        .card-header {
            background-color: #5499C7; /* Color verde para el encabezado */
            color: white;
        }
        h3 {
            font-family: sans-serif; 
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h3>Editar Insumo</h3>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        <strong>Por favor complete el formulario</strong>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=" . $id_insumo); ?>" method="post">
                            <div class="form-group">
                                <label>Nombre del Insumo</label>
                                <input type="text" name="nombre" class="form-control <?php echo (!empty($nombre_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nombre; ?>">
                                <span class="invalid-feedback"><?php echo $nombre_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label>Marca</label>
                                <input type="text" name="marca" class="form-control <?php echo (!empty($marca_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $marca; ?>">
                                <span class="invalid-feedback"><?php echo $marca_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label>Modelo</label>
                                <input type="text" name="modelo" class="form-control <?php echo (!empty($modelo_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $modelo; ?>">
                                <span class="invalid-feedback"><?php echo $modelo_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label>Número de Serie</label>
                                <input type="text" name="no_serie" class="form-control <?php echo (!empty($no_serie_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $no_serie; ?>">
                                <span class="invalid-feedback"><?php echo $no_serie_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label>Caducidad</label>
                                <input type="text" name="caducidad" class="form-control <?php echo (!empty($caducidad_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $caducidad; ?>">
                                <span class="invalid-feedback"><?php echo $caducidad_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label>Tipo de Insumo</label>
                                <input type="text" name="tipo" class="form-control <?php echo (!empty($tipo_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $tipo; ?>">
                                <span class="invalid-feedback"><?php echo $tipo_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label>Cantidad</label>
                                <input type="number" name="cantidad" class="form-control <?php echo (!empty($cantidad_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $cantidad; ?>">
                                <span class="invalid-feedback"><?php echo $cantidad_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label>Observaciones</label>
                                <textarea name="observaciones" class="form-control <?php echo (!empty($observaciones_err)) ? 'is-invalid' : ''; ?>"><?php echo $observaciones; ?></textarea>
                                <span class="invalid-feedback"><?php echo $observaciones_err; ?></span>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Actualizar">
                                <a href="insumos.php" class="btn btn-secondary">Cancelar</a>
                            </div>
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
