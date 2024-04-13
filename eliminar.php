<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexión a la base de datos
    $host = "127.0.0.1";
    $username = "root";
    $password = "";
    $database = "inmedicen"; // Asegúrate de que este es el nombre correcto de tu base de datos
    $conn = new mysqli($host, $username, $password, $database);

    // Chequea la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
    $conn->set_charset("utf8");

    // Obtener el ID y eliminar el registro
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    if ($id > 0) {
        $stmt = $conn->prepare("DELETE FROM inventario WHERE id_equipo = ?"); // Cambio a la tabla mantenimiento
        if ($stmt === false) {
            die("Error preparando la consulta: " . $conn->error);
        }

        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            echo "Registro eliminado correctamente.";
        } else {
            echo "Error al eliminar el registro: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "ID no válido.";
    }
    
    $conn->close();

    // Redireccionar al inventario (o la página que desees)
    header('Location: inventario.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Equipo</title>
    <!-- Estilos aquí -->
</head>
<body>
    <div class="container">
        <h2>Eliminar Equipo</h2>
        <form action="eliminar.php" method="post">
            <label for="id">ID del Equipo:</label>
            <input type="number" id="id" name="id" required>
            <button type="submit" class="btn btn-danger">Eliminar</button>
        </form>
    </div>
</body>
</html>
