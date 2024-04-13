<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Recoger y sanitizar el id del equipo desde el campo oculto del formulario
    $id_equipo = isset($_POST['id_equipo']) ? $conn->real_escape_string($_POST['id_equipo']) : null;

    // Sanitizar los otros datos recibidos del formulario
    $nombre_equipo = $conn->real_escape_string($_POST['nombre_equipo']);
    $marca = $conn->real_escape_string($_POST['marca']);
    $modelo = $conn->real_escape_string($_POST['modelo']);
    $no_control = $conn->real_escape_string($_POST['no_control']);
    $compania = $conn->real_escape_string($_POST['compania']);
    $fecha_entrada = $conn->real_escape_string($_POST['fecha_entrada']);
    $fecha_salida = $conn->real_escape_string($_POST['fecha_salida']);

    // Asegúrate de que realmente obtuvimos un ID antes de intentar actualizar
    if ($id_equipo) {
        // Preparar la consulta de actualización
        $updateQuery = "UPDATE mantenimiento SET 
                            nombre_equipo = ?, 
                            marca = ?, 
                            modelo = ?, 
                            no_control = ?, 
                            compania = ?, 
                            fecha_entrada = ?, 
                            fecha_salida = ?
                        WHERE id_equipo = ?";

        if ($stmt = $conn->prepare($updateQuery)) {
            // Vincular los parámetros
            $stmt->bind_param("sssssssi", $nombre_equipo, $marca, $modelo, $no_control, $compania, $fecha_entrada, $fecha_salida, $id_equipo);
            
            // Ejecutar la sentencia
            if ($stmt->execute()) {
                // Redireccionar al inventario si la actualización fue exitosa
                header('Location: inventario.php');
                exit;
            } else {
                echo "Error al actualizar el registro: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error preparando la consulta: " . $conn->error;
        }
    } else {
        echo "ID no proporcionado o inválido.";
    }

    // Cerrar la conexión
    $conn->close();
}
?>
