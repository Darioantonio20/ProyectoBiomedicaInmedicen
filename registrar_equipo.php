<?php
// Configuración de la base de datos
$host = "localhost";
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

// Verificar que el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Validación simple - asegúrate de personalizarla según tus necesidades
    if (empty($_POST['nombre_equipo']) || empty($_POST['marca']) || empty($_POST['modelo']) || empty($_POST['no_serie']) || empty($_POST['no_control']) || empty($_POST['compania'])) {
        http_response_code(400);
        die('Por favor complete todos los campos del formulario.');
    }
    
    // Asignar valores del formulario a variables
    $nombre_equipo = $_POST['nombre_equipo'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $no_serie = $_POST['no_serie'];
    $no_control = $_POST['no_control'];
    $compania = $_POST['compania'];

    // Preparar el comando SQL usando sentencias preparadas
    $stmt = $conn->prepare("INSERT INTO inventario (nombre_equipo, marca, modelo, no_serie, no_control, compania)
                            VALUES (?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        http_response_code(500);
        die("Error en la preparación de la sentencia: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("ssssss", $nombre_equipo, $marca, $modelo, $no_serie, $no_control, $compania);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        http_response_code(200);
        // Redirigir a la página de éxito
        header("Location: success.html");
        exit();
    } else {
        http_response_code(500);
        echo "Error: " . $stmt->error;
    }

    // Cerrar la sentencia y la conexión
    $stmt->close();
}

$conn->close();
?>
