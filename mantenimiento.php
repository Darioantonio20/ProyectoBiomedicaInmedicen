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
$query = "SELECT id_equipo, nombre_equipo FROM mantenimiento WHERE 1=1";

if ($searchTerm !== '') {
    $query .= " AND (nombre_equipo LIKE '%$searchTerm%')";
}

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mantenimiento de Equipos Médicos</title>
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
    <h3>Listado de Equipos Médicos en Mantenimiento</h3>
    <div class="container">
        <!-- Formulario de Búsqueda actualizado -->
        <div class="row mb-4">
            <div class="col-lg-12">
                <form method="GET" class="form-inline justify-content-center">
                    <input type="text" id="search" name="search" class="form-control" placeholder="Buscar..." value="<?php echo htmlspecialchars($searchTerm); ?>">
                    <button type="submit" class="btn btn-primary">Buscar</button> 
                </form>
                <button type="button" class="btn btn-success" onclick="window.location.href='inicio.html';">Cerrar Sesión</button>
                <button type="button" class="btn btn-primary" onclick="window.location.href='inventario.php';">Inventario</button>
                <button type="button" class="btn btn-primary" onclick="window.location.href='registrar_mantenimiento.php';">Crear Mantenimiento</button>
            </div>
        </div>

        <div class="row">
            <!-- Lista de Equipos en la primera columna -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <strong>Lista de Equipos</strong>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <?php
                            if ($result && $result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<li class='list-group-item'><a href='mantenimiento.php?id=" . urlencode($row["id_equipo"]) . "'>" . htmlspecialchars($row["nombre_equipo"]) . "</a></li>";
                                }
                            } else {
                                echo "<li class='list-group-item'>No se encontraron equipos.</li>";
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Información detallada de cada equipo en la segunda columna -->
            <div class="col-md-8">
    <div class="card">
        <div class="card-header">
            <strong>Información Detallada del Equipo</strong>
        </div>
        <div class="card-body">
            <?php
            if (isset($_GET['id'])) {
                $id_equipo = $_GET['id'];
                $sql = "SELECT * FROM mantenimiento WHERE id_equipo = '$id_equipo'";
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    $row = $result->fetch_assoc();
            ?>
                    <div class="row">
                        <!-- Columna Izquierda -->
                        <div class="col-md-6">
                            <p><strong>ID:</strong> <?php echo htmlspecialchars($row["id_equipo"]); ?></p>
                            <p><strong>Nombre:</strong> <?php echo htmlspecialchars($row["nombre_equipo"]); ?></p>
                            <p><strong>Marca:</strong> <?php echo htmlspecialchars($row["marca"]); ?></p>
                            <p><strong>Modelo:</strong> <?php echo htmlspecialchars($row["modelo"]); ?></p>
                            <p><strong>Número de Serie:</strong> <?php echo htmlspecialchars($row["no_serie"]); ?></p>
                            <p><strong>Número de Control:</strong> <?php echo htmlspecialchars($row["no_control"]); ?></p>
                            <p><strong>Institución:</strong> <?php echo htmlspecialchars($row["compania"]); ?></p>
                            <p><strong>Fecha de Entrada:</strong> <?php echo htmlspecialchars($row["fecha_entrada"]); ?></p>
                            <p><strong>Fecha de Salida:</strong> <?php echo htmlspecialchars($row["fecha_salida"]); ?></p>
                            <p><strong>Ingeniero Responsable:</strong> <?php echo htmlspecialchars($row["ingeniero_responsable"]); ?></p>
                            <!-- Añade más elementos si es necesario -->
                        </div>

                        <!-- Columna Derecha -->
                        <div class="col-md-6">
                            <p><strong>Ciudad:</strong> <?php echo htmlspecialchars($row["ciudad"]); ?></p>
                            <p><strong>Estado:</strong> <?php echo htmlspecialchars($row["estado"]); ?></p>
                            <p><strong>Código Postal:</strong> <?php echo htmlspecialchars($row["cp"]); ?></p>
                            <p><strong>Email:</strong> <?php echo htmlspecialchars($row["email"]); ?></p>
                            <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($row["tel"]); ?></p>
                            <p><strong>Ubicación:</strong> <?php echo htmlspecialchars($row["ubicacion"]); ?></p>
                            <p><strong>Área:</strong> <?php echo htmlspecialchars($row["area"]); ?></p>
                            <!-- Añade más elementos si es necesario -->
                        </div>
                    </div>
                    <a href='formatos_mantenimiento.php?id=<?php echo urlencode($row["id_equipo"]); ?>' class='btn btn-primary'>Formato</a>
                    <button onclick="confirmarEliminacion(<?php echo htmlspecialchars($row["id_equipo"]); ?>)" class='btn btn-danger'>Eliminar Mantenimiento</button>

            <?php
                } else {
                    echo "<p>No se encontró información para este equipo.</p>";
                }
            } else {
                echo "<p>Seleccione un equipo de la lista para ver su información detallada.</p>";
            }
            ?>
        </div>
    </div>
</div>


    <!-- Bootstrap JS y dependencias actualizados -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
    function confirmarEliminacion(idEquipo) {
        var confirmar = confirm("¿Está seguro de que quiere eliminar este mantenimiento?");
        if (confirmar) {
            // Redirecciona a un script de PHP que eliminará el registro
            window.location.href = 'eliminar_mantenimiento.php?id=' + idEquipo;
        }
    }
    </script>


</body>
</html>
