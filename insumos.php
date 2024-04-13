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

// Lógica para obtener datos de insumos
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

$searchTerm = $conn->real_escape_string($searchTerm);

// Ajuste en la consulta para incluir nuevas columnas
$query = "SELECT id_insumo, nombre, marca, modelo, no_serie, caducidad, tipo, cantidad, observaciones FROM insumos WHERE 1=1";

if ($searchTerm !== '') {
    $query .= " AND (nombre LIKE '%$searchTerm%' OR tipo LIKE '%$searchTerm%' OR marca LIKE '%$searchTerm%' OR modelo LIKE '%$searchTerm%')";
}

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Insumos</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
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
    <h3>Busqueda de Insumos</h3>
    <div class="container">
        <div class="row mb-4">
            <div class="col-lg-12">
                <form method="GET" class="form-inline justify-content-center">
                    <input type="text" id="search" name="search" class="form-control" placeholder="Buscar..." value="<?php echo htmlspecialchars($searchTerm); ?>">
                    <button type="submit" class="btn btn-success">Buscar</button>
                </form>
            </div>
        </div>

        <div class="text-center mb-4">
            <button type="button" class="btn btn-primary" onclick="window.location.href='registro_insumo.php';">Añadir Insumo</button>
            <button type="button" class="btn btn-primary" onclick="window.location.href='inventario.php';">Busqueda de Equipos</button>
            <button type="button" class="btn btn-danger" onclick="window.location.href='inicio.html';">Cerrar Sesión</button>
        </div>

        <table class='table'>
            <thead class='thead-light'>
                <tr>
                    <th>#</th>
                    <th>ID Insumo</th>
                    <th>Nombre</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>No. Serie</th>
                    <th>Caducidad</th>
                    <th>Tipo</th>
                    <th>Cantidad</th>
                    <th>Observaciones</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php
            if ($result && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td></td>
                            <td>" . htmlspecialchars($row["id_insumo"]) . "</td>
                            <td>" . htmlspecialchars($row["nombre"]) . "</td>
                            <td>" . htmlspecialchars($row["marca"]) . "</td>
                            <td>" . htmlspecialchars($row["modelo"]) . "</td>
                            <td>" . htmlspecialchars($row["no_serie"]) . "</td>
                            <td>" . htmlspecialchars($row["caducidad"]) . "</td>
                            <td>" . htmlspecialchars($row["tipo"]) . "</td>
                            <td>" . htmlspecialchars($row["cantidad"]) . "</td>
                            <td>" . htmlspecialchars($row["observaciones"]) . "</td>
                            <td>
                                <a href='editar_insumo.php?id=" . urlencode($row["id_insumo"]) . "'>Editar</a> |
                                <a href='eliminar_insumo.php?id=" . urlencode($row["id_insumo"]) . "' onclick='return confirm(\"¿Está seguro de que desea eliminar este insumo?\");'>Eliminar</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='11'>No se encontraron resultados.</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
