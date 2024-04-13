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

// Verificar si se ha proporcionado un ID de equipo válido para editar
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    // Obtener el ID del equipo de la URL
    $id_equipo = $conn->real_escape_string($_GET['id']);

    // Consultar la base de datos para obtener los datos del equipo
    $query = "SELECT * FROM inventario WHERE id_equipo = '$id_equipo'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Extraer los datos del equipo de la fila obtenida
        $equipo = $result->fetch_assoc();
    } else {
        echo "No se encontró ningún equipo con el ID proporcionado.";
        exit;
    }
} else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores del formulario
    $id_equipo = $conn->real_escape_string($_POST['id_equipo']);
    $nombre_equipo = $conn->real_escape_string($_POST['nombre_equipo']);
    $marca = $conn->real_escape_string($_POST['marca']);
    $modelo = $conn->real_escape_string($_POST['modelo']);
    $no_serie = $conn->real_escape_string($_POST['no_serie']); // Asegurarse de que este campo es editable si se desea
    $no_control = $conn->real_escape_string($_POST['no_control']);
    $compania = $conn->real_escape_string($_POST['compania']);

    // Actualizar los valores del equipo en la base de datos
    $query_update = "UPDATE inventario SET nombre_equipo='$nombre_equipo', marca='$marca', modelo='$modelo', no_serie='$no_serie', no_control='$no_control', compania='$compania' WHERE id_equipo='$id_equipo'"; // Agregamos la cláusula WHERE

    if ($conn->query($query_update) === TRUE) {
        // Redirigir a la página de inventario después de la edición exitosa
        header("Location: inventario.php");
        exit;
    } else {
        echo "Error al actualizar el equipo: " . $conn->error;
    }
} else {
    echo "Método de solicitud no soportado.";
    exit;
}

// Cerrar la conexión a la base de datos
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Equipo en Inventario</title>
    <!-- Bootstrap CSS modificado para cambiar los colores -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
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
        .action-btn {
            display: block;
            text-align: center;
            text-decoration: none;
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
            width: 100%;
            box-sizing: border-box;
        }
        .action-btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Editar Equipo en Inventario</h2>
        <form id="equipment-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="hidden" name="id_equipo" value="<?php echo $id_equipo; ?>">
            <div class="form-group">
                <label for="nombre-equipo">Nombre del Equipo:</label>
                <input type="text" id="nombre-equipo" name="nombre_equipo" value="<?php echo htmlspecialchars($equipo['nombre_equipo']); ?>" required>
            </div>
            <div class="form-group">
                <label for="marca">Marca:</label>
                <input type="text" id="marca" name="marca" value="<?php echo htmlspecialchars($equipo['marca']); ?>" required>
            </div>
            <div class="form-group">
                <label for="modelo">Modelo:</label>
                <input type="text" id="modelo" name="modelo" value="<?php echo htmlspecialchars($equipo['modelo']); ?>" required>
            </div>
            <div class="form-group">
                <label for="no_serie">Número de Serie:</label>
                <input type="text" id="no_serie" name="no_serie" value="<?php echo htmlspecialchars($equipo['no_serie']); ?>">

            </div>
            <div class="form-group">
                <label for="no_control">Número de Control:</label>
                <input type="text" id="no_control" name="no_control" value="<?php echo htmlspecialchars($equipo['no_control']); ?>" required>
            </div>
            <div class="form-group">
                <label for="compania">Institución:</label>
                <input type="text" id="compania" name="compania" value="<?php echo htmlspecialchars($equipo['compania']); ?>" required>
            </div>
            <button type="submit">Guardar Cambios</button>
        </form>
    </div>
</body>
</html>
