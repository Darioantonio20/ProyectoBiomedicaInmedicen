<?php
// Conexión a la base de datos
$host = "127.0.0.1";
$username = "root";
$password = "";
$database = "inmedicen";
$conn = new mysqli($host, $username, $password, $database);

// Chequea la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$id_equipo_editar = isset($_GET['id']) ? $conn->real_escape_string($_GET['id']) : '';
$nombre_equipo = $marca = $modelo = $no_control = $compania = $fecha_entrada = $fecha_salida = '';

// Intenta obtener los datos del equipo para editar
if ($id_equipo_editar != '') {
    $selectQuery = "SELECT * FROM mantenimiento WHERE id_equipo = '$id_equipo_editar'";
    $result = $conn->query($selectQuery);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nombre_equipo = $row['nombre_equipo'];
        $marca = $row['marca'];
        $modelo = $row['modelo'];
        $no_control = $row['no_control'];
        $compania = $row['compania'];
        $fecha_entrada = $row['fecha_entrada'];
        $fecha_salida = $row['fecha_salida'];
    } else {
        echo "No se encontró el registro.";
        exit; 
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Equipo</title>
    <!-- Los estilos se mantienen como en tu ejemplo anterior -->
</head>
<body>
    <div class="container">
        <h2>Editar Equipo</h2>
        <form method="POST" action="procesar_editar_equipo.php">
            <input type="hidden" name="id_equipo" value="<?php echo htmlspecialchars($id_equipo_editar); ?>">
            <div class="form-group">
                <label>Nombre del equipo:</label>
                <input type="text" name="nombre_equipo" value="<?php echo htmlspecialchars($nombre_equipo); ?>" required>
            </div>
            <div class="form-group">
                <label>Marca:</label>
                <input type="text" name="marca" value="<?php echo htmlspecialchars($marca); ?>" required>
            </div>
            <div class="form-group">
                <label>Modelo:</label>
                <input type="text" name="modelo" value="<?php echo htmlspecialchars($modelo); ?>" required>
            </div>
            <div class="form-group">
                <label>Número de Control:</label>
                <input type="text" name="no_control" value="<?php echo htmlspecialchars($no_control); ?>" required>
            </div>
            <div class="form-group">
                <label>Compañía:</label>
                <input type="text" name="compania" value="<?php echo htmlspecialchars($compania); ?>" required>
            </div>
            <div class="form-group">
                <label>Fecha de Entrada:</label>
                <input type="text" name="fecha_entrada" value="<?php echo htmlspecialchars($fecha_entrada); ?>" required>
            </div>
            <div class="form-group">
                <label>Fecha de Salida:</label>
                <input type="text" name="fecha_salida" value="<?php echo htmlspecialchars($fecha_salida); ?>" required>
            </div>
            <input type="submit" value="Actualizar">
        </form>
    </div>
</body>
</html>
