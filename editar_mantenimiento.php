<?php
session_start();

$host = "127.0.0.1";
$username = "root";
$password = "";
$database = "basehm";
$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['no_serie'])) {
    $no_serie = $conn->real_escape_string($_POST['no_serie']);
    $ingeniero_responsable = $conn->real_escape_string($_POST['responsable']);
    $fecha_revision = $_POST['fecha_revision'];
    $fecha_mantenimiento = $_POST['fecha_mantenimiento'];

    // Verifica si los campos están vacíos y establece valores nulos si es necesario
    if (empty($ingeniero_responsable)) {
        $ingeniero_responsable = NULL;
    }
    if (empty($fecha_revision)) {
        $fecha_revision = NULL;
    }
    if (empty($fecha_mantenimiento)) {
        $fecha_mantenimiento = NULL;
    }

    $query = "UPDATE equipos SET responsable = ?, fecha_revision = ?, fecha_mantenimiento = ? WHERE no_serie = ?";
    
    // Preparar una declaración
    $stmt = $conn->prepare($query);
    if ($stmt === FALSE) {
        echo "Error en la preparación de la declaración: " . $conn->error;
        exit;
    }

    // Vincular parámetros y ejecutar la declaración
    $stmt->bind_param("ssss", $ingeniero_responsable, $fecha_revision, $fecha_mantenimiento, $no_serie);

    if ($stmt->execute()) {
        // Guardar una variable de sesión para indicar que la edición fue exitosa
        $_SESSION['edicion_exitosa'] = true;
    } else {
        echo "Error al actualizar el registro: " . $conn->error;
    }

    $stmt->close();
    $conn->close();

    // Redirigir de nuevo a la página de detalles del equipo
    header("Location: ver_equipo.php?no_serie=" . $no_serie);
    exit;
} else {
    echo "No se ha proporcionado un número de serie válido o los datos del formulario están incompletos.";
}
?>
