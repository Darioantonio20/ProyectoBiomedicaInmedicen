<?php
// Recibir los datos del formulario
$nombre = $_POST['nombre'];
$mail = $_POST['mail'];
$phone = $_POST['phone'];
$type_company = $_POST['type_company'];

// Realizar la conexión a la base de datos (reemplaza los valores según tu configuración)
$host = "127.0.0.1";
$username = "root";
$password = "";
$database = "inmedicen";

$conn = new mysqli($host, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Preparar la consulta SQL para insertar los datos en la tabla
$sql = "INSERT INTO institucion (nombre, mail, phone, type_company) VALUES ('$nombre', '$mail', '$phone', '$type_company')";

// Ejecutar la consulta
if ($conn->query($sql) === TRUE) {
    // Redirigir a empresa.php si la inserción fue exitosa
    header("Location: empresas.php");
    exit();
} else {
    echo "Error al guardar la empresa: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>
