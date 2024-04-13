<?php
// Configuración de la base de datos
$host = "127.0.0.1";
$username = "root";
$password = "";
$database = "inmedicen";

// Crear conexión
$conn = new mysqli($host, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
$conn->set_charset("utf8");

// Obtener el ID del equipo a eliminar
$idEquipo = isset($_GET['id']) ? $_GET['id'] : '';

// Eliminar el equipo de la base de datos
$sql = "DELETE FROM mantenimiento WHERE id_equipo = '$idEquipo'";

if ($conn->query($sql) === TRUE) {
    header("Location: mantenimiento.php");
    exit();
} else {
    echo "Error al eliminar el equipo: " . $conn->error;
}

$conn->close();
?>
