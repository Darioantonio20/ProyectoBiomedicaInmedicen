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

// Lógica para obtener datos de mantenimiento
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

$searchTerm = $conn->real_escape_string($searchTerm);

// Ajuste en la consulta para coincidir con la tabla y columnas de 'mantenimiento'
$query = "SELECT id_equipo, nombre_equipo, marca, modelo, no_serie, no_control, compania FROM inventario WHERE 1=1";

if ($searchTerm !== '') {
    $query .= " AND (nombre_equipo LIKE '%$searchTerm%' OR marca LIKE '%$searchTerm%' OR modelo LIKE '%$searchTerm%' OR no_serie LIKE '%$searchTerm%' OR no_control LIKE '%$searchTerm%' OR compania LIKE '%$searchTerm%')";
}

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inventario</title>
    <!-- Bootstrap CSS modificado para cambiar los colores -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #D6EAF8; /* Azul pastel muy claro */
        }

        .container {
            margin-top: 20px;
        }

        .card {
            margin-bottom: 20px;
        }

        .card-header {
            background-color: #3498DB; /* Azul claro */
            color: white;
        }

        h3 {
            font-family: sans-serif; 
            text-align: center;
            margin-top: 20px;
        }

        .btn-success {
            background-color: #5499C7; /* Azul un poco más oscuro */
            border-color: #5499C7; /* Borde del botón */
        }

        .btn-success:hover {
            background-color: #2980B9; /* Azul más oscuro al hacer hover */
            border-color: #2980B9; /* Borde más oscuro al hacer hover */
        }

        .btn-primary {
            background-color: #5499C7; /* Azul un poco más oscuro */
            border-color: #5499C7; /* Borde del botón */
        }

        .btn-primary:hover {
            background-color: #2980B9; /* Azul más oscuro al hacer hover */
            border-color: #2980B9; /* Borde más oscuro al hacer hover */
        }

        .btn-danger {
            background-color: #CB4335; /* Rojo */
            border-color: #CB4335; /* Borde del botón */
        }

        .btn-danger:hover {
            background-color: #B03A2E; /* Rojo más oscuro al hacer hover */
            border-color: #B03A2E; /* Borde más oscuro al hacer hover */
        }

        .table {
            background-color: white; /* Fondo blanco de la tabla */
        }

        .btn-formato {
            padding: 0.08rem 0.9rem;
            font-size: 0.800rem;
        }


    </style>
</head>
<body>
    <h3>Busqueda en Inventario</h3>
    <div class="container">
        <!-- Formulario de Búsqueda actualizado -->
        <div class="row mb-4">
            <div class="col-lg-12">
                <form method="GET" class="form-inline justify-content-center">
                    <input type="text" id="search" name="search" class="form-control" placeholder="Buscar..." value="<?php echo htmlspecialchars($searchTerm); ?>">
                    <button type="submit" class="btn btn-success">Buscar</button> <!-- Botón verde -->
                </form>
            </div>
        </div>

        <!-- Botón para añadir mantenimiento -->
        <div class="text-center mb-4">
            <button type="button" class="btn btn-success" onclick="window.location.href='mantenimiento.php';">Crear Mantenimiento</button>
            <button type="button" class="btn btn-primary" onclick="window.location.href='registro.html';">Añadir Equipo</button> <!-- Cambio a botón azul -->
            <button type="button" class="btn btn-primary" onclick="window.location.href='insumos.php';">Busqueda de Insumo</button> <!-- Cambio a botón azul -->
            <button type="button" class="btn btn-danger" onclick="window.location.href='inicio.html';">Cerrar Sesión</button> <!-- Cambio a botón azul -->
        </div>

        <!-- Presentación de Resultados con los campos ajustados -->
        <?php
        if ($result && $result->num_rows > 0) {
            echo "<table class='table'>";
            echo "<thead class='thead-light'><tr><th>#</th><th>ID</th><th>Nombre del Equipo</th><th>Marca</th><th>Modelo</th><th>Número de Serie</th><th>Número de Control</th><th>Institución</th><th>Formato</th><th>Acciones</th></tr></thead>";
            echo "<tbody>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td></td>
                        <td>" . htmlspecialchars($row["id_equipo"]) . "</td>
                        <td>" . htmlspecialchars($row["nombre_equipo"]) . "</td>
                        <td>" . htmlspecialchars($row["marca"]) . "</td>
                        <td>" . htmlspecialchars($row["modelo"]) . "</td>
                        <td>" . htmlspecialchars($row["no_serie"]) . "</td>
                        <td>" . htmlspecialchars($row["no_control"]) . "</td>
                        <td>" . htmlspecialchars($row["compania"]) . "</td>
                        <td><a href='formatos.php?id=" . urlencode($row["id_equipo"]) . "' class='btn btn-primary btn-formato'>Formatos</a></td>
                        <td>
                            <a href='editar_inventario.php?id=" . urlencode($row["id_equipo"]) . "'>Editar</a> |
                            <a href='eliminar.php?id=" . urlencode($row["id_equipo"]) . "' onclick='return confirm(\"¿Está seguro de que desea eliminar este registro?\");'>Eliminar</a>
                        </td>
                      </tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<p>No se encontraron resultados.</p>";
        }
        $conn->close();
        ?>
    </div>

    <!-- Bootstrap JS y dependencias actualizados -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
