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

// Lógica para obtener datos de empresas
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

$searchTerm = $conn->real_escape_string($searchTerm);

// Consulta para obtener datos de empresas
$query = "SELECT id_institucion, nombre, mail, phone, type_company FROM institucion WHERE 1=1";

if ($searchTerm !== '') {
    $query .= " AND (nombre LIKE '%$searchTerm%' OR mail LIKE '%$searchTerm%' OR phone LIKE '%$searchTerm%' OR type_company LIKE '%$searchTerm%')";
}

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración de Empresas</title>
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

        .card-header {
            background-color: #5499C7; /* Color azul */
            color: white;
        }

        h3 {
            font-family: 'Roboto', sans-serif;
            text-align: center;
            margin-top: 20px; /* Ajusta el margen superior según sea necesario */
        }


        .btn-success {
            background-color: #CB4335; /* Color rojo */
            border-color: #CB4335; /* Borde del botón */
        }

        .btn-success:hover {
            background-color: #B03A2E; /* Color rojo más oscuro al pasar el cursor */
            border-color: #B03A2E; /* Borde del botón al pasar el cursor */
        }

        .btn-primary {
            background-color: #5DADE2; /* Color azul claro */
            border-color: #5DADE2; /* Borde del botón */
        }

        .btn-primary:hover {
            background-color: #3498DB; /* Color azul más oscuro al pasar el cursor */
            border-color: #3498DB; /* Borde del botón al pasar el cursor */
        }

    </style>
</head>
<body>
    <h3>Panel de Administración de Empresas</h3>
    <div class="container">
        <!-- Formulario de Búsqueda actualizado -->
        <div class="row mb-4">
            <div class="col-lg-12">
                <form method="GET" class="form-inline justify-content-center">
                    <input type="text" id="search" name="search" class="form-control" placeholder="Buscar..." value="<?php echo htmlspecialchars($searchTerm); ?>">
                    <button type="submit" class="btn btn-primary">Buscar</button> 
                </form>
                <button type="button" class="btn btn-success" onclick="window.location.href='inicio.html';">Cerrar Sesión</button>
                <button type="button" class="btn btn-primary" onclick="window.location.href='registrar_empresa.php';">Añadir Empresa</button>
            </div>
        </div>

        <div class="row">
            <!-- Lista de Empresas en la primera columna -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <strong>Lista de Empresas</strong>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <?php
                            if ($result && $result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<li class='list-group-item'><a href='empresas.php?id=" . urlencode($row["id_institucion"]) . "'>" . htmlspecialchars($row["nombre"]) . "</a></li>";
                                }
                            } else {
                                echo "<li class='list-group-item'>No se encontraron empresas.</li>";
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Información detallada de cada empresa en la segunda columna -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <strong>Información Detallada de la Empresa</strong>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_GET['id'])) {
                            $id_empresa = $_GET['id'];
                            $sql = "SELECT * FROM institucion WHERE id_institucion = '$id_empresa'";
                            $result = $conn->query($sql);

                            if ($result && $result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                echo "<p><strong>ID:</strong> " . htmlspecialchars($row["id_institucion"]) . "</p>";
                                echo "<p><strong>Nombre:</strong> " . htmlspecialchars($row["nombre"]) . "</p>";
                                echo "<p><strong>Correo Electrónico:</strong> " . htmlspecialchars($row["mail"]) . "</p>";
                                echo "<p><strong>Teléfono:</strong> " . htmlspecialchars($row["phone"]) . "</p>";
                                echo "<p><strong>Tipo de Empresa:</strong> " . htmlspecialchars($row["type_company"]) . "</p>";
                                // Puedes agregar más detalles aquí si los necesitas
                            } else {
                                echo "<p>No se encontró información para esta empresa.</p>";
                            }
                        } else {
                            echo "<p>Seleccione una empresa de la lista para ver su información detallada.</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS y dependencias actualizados -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
