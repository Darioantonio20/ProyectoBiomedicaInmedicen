<?php
// Configuración de la base de datos
$host = "127.0.0.1";
$username = "root";
$password = "";
$database = "inmedicen"; // Asegúrate de que el nombre de la base de datos sea correcto

// Crear conexión
$conn = new mysqli($host, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
$conn->set_charset("utf8");

// Inicializar variables para los campos del formulario
$nombre_equipo = $modelo = $marca = $no_serie = $no_control = $compania = $fecha_entrada = $fecha_salida = $ingeniero_responsable = $ciudad = $estado = $cp = $email = $tel = $ubicacion = $area = "";

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre_equipo = $_POST['nombre_equipo'];
    $modelo = $_POST['modelo'];
    $marca = $_POST['marca'];
    $no_serie = $_POST['no_serie'];
    $no_control = $_POST['no_control'];
    $compania = $_POST['compania'];
    $fecha_entrada = $_POST['fecha_entrada'];
    $fecha_salida = $_POST['fecha_salida'];
    $ingeniero_responsable = $_POST['ingeniero_responsable'];
    $ciudad = $_POST['ciudad'];
    $estado = $_POST['estado'];
    $cp = $_POST['cp'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $ubicacion = $_POST['ubicacion'];
    $area = $_POST['area'];

    // Preparar la consulta SQL para insertar los datos en la tabla "mantenimiento"
    $query = "INSERT INTO mantenimiento (nombre_equipo, modelo, marca, no_serie, no_control, compania, fecha_entrada, fecha_salida, ingeniero_responsable, ciudad, estado, cp, email, tel, ubicacion, area) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Preparar la declaración SQL
    $stmt = $conn->prepare($query);

    // Vincular los parámetros
    $stmt->bind_param("ssssssssssssssss", $nombre_equipo, $modelo, $marca, $no_serie, $no_control, $compania, $fecha_entrada, $fecha_salida, $ingeniero_responsable, $ciudad, $estado, $cp, $email, $tel, $ubicacion, $area);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Si la inserción fue exitosa, redirigir a la página de mantenimiento
        header("Location: mantenimiento.php");
        exit;
    } else {
        // Si hubo un error en la inserción, mostrar un mensaje de error
        echo "Error al registrar el equipo en mantenimiento: " . $stmt->error;
    }

    // Cerrar la declaración SQL
    $stmt->close();
}

// Cerrar la conexión a la base de datos
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Equipo en Mantenimiento</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="date"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 0; /* Cambiado */
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%; /* Ajustado */
            margin-top: 20px; /* Añadido margen superior */
        }
        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Registrar Equipo en Mantenimiento</h2>
        <form id="maintenance-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="nombre-equipo">Nombre del Equipo:</label>
                <input type="text" id="nombre-equipo" name="nombre_equipo" value="<?php echo htmlspecialchars($nombre_equipo); ?>" required>
            </div>
            <div class="form-group">
                <label for="modelo">Modelo:</label>
                <input type="text" id="modelo" name="modelo" value="<?php echo htmlspecialchars($modelo); ?>" required>
            </div>
            <div class="form-group">
                <label for="marca">Marca:</label>
                <input type="text" id="marca" name="marca" value="<?php echo htmlspecialchars($marca); ?>" required>
            </div>
            <div class="form-group">
                <label for="no_serie">Número de Serie:</label>
                <input type="text" id="no_serie" name="no_serie" value="<?php echo htmlspecialchars($no_serie); ?>">
            </div>
            <div class="form-group">
                <label for="no_control">Número de Inventario:</label>
                <input type="text" id="no_control" name="no_control" value="<?php echo htmlspecialchars($no_control); ?>" required>
            </div>
            <div class="form-group">
                <label for="area">Área:</label>
                <input type="text" id="area" name="area" value="<?php echo htmlspecialchars($area); ?>">
            </div>
            <div class="form-group">
                <label for="compania">Institución:</label>
                <input type="text" id="compania" name="compania" value="<?php echo htmlspecialchars($compania); ?>" required>
            </div>
            <div class="form-group">
                <label for="fecha_entrada">Fecha de Entrada:</label>
                <input type="date" id="fecha_entrada" name="fecha_entrada" value="<?php echo htmlspecialchars($fecha_entrada); ?>" required>
            </div>
            <div class="form-group">
                <label for="fecha_salida">Fecha de Salida:</label>
                <input type="date" id="fecha_salida" name="fecha_salida" value="<?php echo htmlspecialchars($fecha_salida); ?>">
            </div>
            <div class="form-group">
                <label for="ingeniero_responsable">Ingeniero Responsable:</label>
                <input type="text" id="ingeniero_responsable" name="ingeniero_responsable" value="<?php echo htmlspecialchars($ingeniero_responsable); ?>" required>
            </div>
            <div class="form-group">
                <label for="ciudad">Ciudad de la Institución:</label>
                <input type="text" id="ciudad" name="ciudad" value="<?php echo htmlspecialchars($ciudad); ?>">
            </div>
            <div class="form-group">
                <label for="estado">Estado:</label>
                <input type="text" id="estado" name="estado" value="<?php echo htmlspecialchars($estado); ?>">
            </div>
            <div class="form-group">
                <label for="cp">Código Postal:</label>
                <input type="text" id="cp" name="cp" value="<?php echo htmlspecialchars($cp); ?>">
            </div>
            <div class="form-group">
                <label for="email">Email de la Institución:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
            </div>
            <div class="form-group">
                <label for="tel">Teléfono:</label>
                <input type="text" id="tel" name="tel" value="<?php echo htmlspecialchars($tel); ?>">
            </div>
            <div class="form-group">
                <label for="ubicacion">Ubicación:</label>
                <input type="text" id="ubicacion" name="ubicacion" value="<?php echo htmlspecialchars($ubicacion); ?>">
            </div>
            <button type="submit">Registrar Equipo en Mantenimiento</button>
        </form>
    </div>
</body>
</html>
