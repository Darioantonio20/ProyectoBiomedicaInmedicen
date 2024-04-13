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

// Preparar y ejecutar declaración DELETE
$sql = "DELETE FROM insumos WHERE id_insumo = ?";
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("i", $param_id);
    $param_id = $id_insumo;

    if ($stmt->execute()) {
        // Redireccionar a insumos.php después de eliminar el insumo
        header("location: insumos.php");
        exit();
    } else {
        echo "Algo salió mal. Por favor, inténtelo de nuevo más tarde.";
    }

    // Cerrar declaración
    $stmt->close();
}

// Cerrar conexión
$conn->close();
?>
