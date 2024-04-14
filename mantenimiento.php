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
}

.btn-formato {
    padding: 0.08rem 0.9rem;
    font-size: 0.800rem;
}

.btn-primary {
    display: block;
    width: 15%;
    font-weight: bold;
    background: #0048A0;
    color: white;
    padding-block: 15px;
    margin: 20px auto;
    border-radius: 20px;
    box-shadow: #0048A0 0px 20px 10px -15px;
    border: none;
    transition: all 0.2s ease-in-out;
  }

   .btn-primary:hover {
    transform: scale(1.03);
    box-shadow: #0048A0 0px 23px 10px -20px;
  }

   .btn-primary:active {
    transform: scale(0.95);
    box-shadow: #0048A0 0px 15px 10px -10px;
  }

  .btn-danger {
  display: block;
  width: 15%;
  font-weight: bold;
  background: linear-gradient(45deg, rgb(211, 16, 16) 0%, rgb(209, 18, 18) 100%);
  color: white;
  padding-block: 15px;
  margin: 20px auto;
  border-radius: 20px;
  box-shadow: rgba(215, 133, 133, 0.878) 0px 20px 10px -15px;
  border: none;
  transition: all 0.2s ease-in-out;
  }

  .btn-danger:hover {
  transform: scale(1.03);
  box-shadow: rgba(215, 133, 133, 0.878) 0px 23px 10px -20px;
  }

  .tn-dange:active {
  transform: scale(0.95);
  box-shadow: rgba(215, 133, 133, 0.878) 0px 15px 10px -10px;
  }
  .button-container {
    display: flex;
    flex-direction: row; /* Changed from column to row */
    align-items: center;
    justify-content: center;
    flex-wrap: wrap; /* Added to wrap buttons to next line if container width is not enough */
}
.button-row {
    display: flex;
    justify-content: center;
    gap: 10px; /* Espacio entre los botones */
}
.colortr{
    color: #ffffff;
}
.data-table th h1 {
    font-weight: bold;
    font-size: 2vw; /* Cambiado de 'auto' a '2vw' */
    text-align: center; 
    color: #ffffff;
}

.data-table td {
    font-weight: normal;
    font-size: 1vw; /* Cambiado de '1em' a '1vw' */
    text-align: center; /* Añadido para centrar el texto */
    -webkit-box-shadow: 0 2px 2px -2px #9d9d9e;
    -moz-box-shadow: 0 2px 2px -2px #9d9d9e;
    box-shadow: 0 2px 2px -2px #9d9d9e;
}

.data-table {
    text-align: center;
    overflow-x: auto; /* Added for horizontal scrolling on smaller screens */
    width: 100%; /* Changed from 90vw to 100% for full width */
    margin: 0 auto;
    display: table;
    padding: 0 0 8em 0;
    border-radius: 3rem; /* Added border radius */
}

.data-table td, .data-table th {
    padding: 4%; 
    width: 10%; /* Added for equal width of all cells */
    margin: 1%; /* Added for spacing */
    font-size: 1.2vw;
}
.data-table tr:nth-child(odd) {
    background-color: #ffffff;
}

.data-table tr:nth-child(even) {
    background-color: #ffffff;
}

.data-table th {
    background-color: #a40000d0;
}
.nombre-alumno,
.tipo-busqueda {
    color: #a8a8b1;
}
.data-table td:first-child { color: #a9b1a8; }

.data-table tr:hover {
    background-color: #ffffff;
    -webkit-box-shadow: 0 6px 6px -6px #9d9d9e;
    -moz-box-shadow: 0 6px 6px -6px #9d9d9e;
    box-shadow: 0 6px 6px -6px #9d9d9e;
}

.data-table td:hover {
    background-color: #ffffff;
    color: #383737;
    font-weight: bold;
    
    box-shadow: #9d9d9e -1px 1px, #9d9d9e -2px 2px, #9d9d9e -3px 3px, #9d9d9e -4px 4px, #9d9d9e -5px 5px, #9d9d9e -6px 6px;
    transform: translate3d(6px, -6px, 0);
    
    transition-delay: 0s;
    transition-duration: 0.4s;
    transition-property: all;
    transition-timing-function: line;
}

@media (max-width: 800px) {
.data-table td:nth-child(4),
.data-table th:nth-child(4) { display: none; }
}

/* Existing styles... */

/* Responsive table */
@media screen and (max-width: 600px) {
    .data-table {
        border: 0;
        width: 100%;
    }

    .data-table thead {
        display: none;
    }

    .data-table tr {
        margin-bottom: 0.625rem;
        display: block;
        border-bottom: 0.125rem solid #ddd;
    }
    
    .data-table td {
        display: block;
        text-align: right;
        font-size: 1.2vw; /* Cambiado de '13px' a '1.3vw' */
        border-bottom: 1px dotted #ccc;
    }

    .data-table td::before {
        content: attr(data-label);
        float: left;
        text-transform: uppercase;
        font-weight: bold;
    }
}

@media screen and (max-width: 600px) {
    .data-table thead {
        display: none;
    }

    .data-table tr {
        margin-bottom: 0.625rem;
        display: block;
        border-bottom: 0.125rem solid #ddd;
    }
    
    .data-table td {
        display: block;
        text-align: right;
        font-size: 1.2vw; 
        border-bottom: 1px dotted #ccc;
    }

    .data-table th::before, .data-table td::before {
        content: attr(data-label);
        float: left;
        text-transform: uppercase;
        font-weight: bold;
    }
}


/* input */

.contenedor {
    margin-top: 3rem; /* Ajusta este valor según tus necesidades */
}

.group {
    display: flex;
    line-height: 2rem;
    align-items: center;
    position: relative;
    max-width: 45%;
    margin: auto;
    margin-bottom: 3rem;
    justify-content: center;
}
.btn-primary-serch{
    display: inline-block; /* Cambia a inline-block */
    width: 20%;
    font-weight: bold;
    background: #0048A0;
    color: white;
    padding-block: 15px;
    margin: 1.25rem 23% 1.25rem 5%; /* Reduce el margen izquierdo */
    border-radius: 20px;
    box-shadow: #0048A0 0px 20px 10px -15px;
    border: none;
    transition: all 0.2s ease-in-out;
}
.btn-primary-serch:hover {
    transform: scale(1.03);
    box-shadow: #0048A0 0px 23px 10px -20px;
}

.btn-primary-serch:active {
    transform: scale(0.95);
    box-shadow: #0048A0 0px 15px 10px -10px;
} 

.btn-danger{
    display: inline-block; /* Cambia a inline-block */
    width: 20%;
    font-weight: bold;
    background: #ff0000;
    color: white;
    padding-block: 15px;
    margin: 1.25rem 23% 1.25rem 5%; /* Reduce el margen izquierdo */
    border-radius: 20px;
    box-shadow: #ff0000 0px 20px 10px -15px;
    border: none;
    transition: all 0.2s ease-in-out;
}
.btn-danger:hover {
    transform: scale(1.03);
    box-shadow: #ff0000 0px 23px 10px -20px;
}

.btn-danger:active {
    transform: scale(0.95);
    box-shadow: #ff0000 0px 15px 10px -10px;
}

.input {
    width: 30vw;
    height: 6vh;
    line-height: 2rem;
    padding: 0 1rem;
    border: 2px solid transparent;
    border-radius: 8px;
    outline: none;
    background-color: #d8d8e8;
    color: #0d0c22;
    text-align: center; /* Añadido para centrar el texto */
    box-shadow: 0 0 5px #9691c2, 0 0 0 10px #f5f5f5eb;
    margin: 1.75rem 1rem 1.25rem 10%;
}
  
.input::placeholder {
    color: #777;
}
  
  .icon {
    position: absolute;
    left: 1rem;
    fill: #777;
    width: 1rem;
    height: 1rem;
  }

  .button-container {
    display: flex;
    flex-direction: row; 
    align-items: center;
    justify-content: center;
    flex-wrap: wrap; 
}

.heading {
    text-align: center;
    font-weight: 900;
    font-size: 2.6rem;
    color: rgb(16, 137, 211);
}

.notification {
  display: flex;
  flex-direction: column;
  isolation: isolate;
  position: relative;
  width: auto;
  height: auto;
  background: #ffffff;
  border-radius: 1rem;
  overflow: hidden;
  font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
  font-size: 1rem;
  --gradient: linear-gradient(to bottom, #2eadff, #3d83ff, #7e61ff);
  --color: #ffffff
}

.notification:before {
  position: absolute;
  content: "";
  inset: 0.0625rem;
  border-radius: 0.9375rem;
  background: #ffffff;
  z-index: 2
}

.notification:after {
  position: absolute;
  content: "";
  width: 0.25rem;
  inset: 0.65rem auto 0.65rem 0.5rem;
  border-radius: 0.125rem;
  background: var(--gradient);
  transition: transform 300ms ease;
  z-index: 4;
}

.notification:hover:after {
  transform: translateX(0.15rem)
}

.notititle {
  color: var(--color);
  padding: 0.65rem 0.25rem 0.4rem 1.25rem;
  font-weight: 500;
  font-size: 1.1rem;
  transition: transform 300ms ease;
  z-index: 5;
}

.notification:hover .notititle {
  transform: translateX(0.15rem)
}

.notibody {
  color: #99999d;
  padding: 0 1.25rem;
  transition: transform 300ms ease;
  z-index: 5;
}

.notification:hover .notibody {
  transform: translateX(0.25rem)
}

.notiglow,
.notiborderglow {
    position: absolute;
    width: 20rem;
    height: 20rem;
    transform: translate(-50%, -50%);
    background: radial-gradient(circle closest-side at center, black, transparent);
    opacity: 0;
    transition: opacity 300ms ease;
}

.notiglow {
  z-index: 3;
}

.notiborderglow {
  z-index: 1;
}

.notification:hover .notiglow {
  opacity: 0.1
}

.notification:hover .notiborderglow {
  opacity: 0.1
}

.note {
  color: var(--color);
  position: fixed;
  top: 80%;
  left: 50%;
  transform: translateX(-50%);
  text-align: center;
  font-size: 0.9rem;
  width: 75%;
}
ul li a {
    color: #000; /* Cambia el color del texto a negro */
    text-decoration: none; /* Elimina la línea debajo del texto */
}
.titleCard{
    font-size:"2rem";
}
.textCard{
    font-size:"1.6em";
}
    </style>
</head>
<body>
    <h3 class="heading text-center mt-5 mb-5">Listado de Equipos Médicos en Mantenimiento</h3>
    <div class="container">
        <div class="row mb-12 lg-12 mb-5">
            <div class="col-lg-12">
                <form method="GET" class="d-flex justify-content-center">
                    <input type="text" id="search" name="search" class="input mb-0" placeholder="Buscar..." value="<?php echo htmlspecialchars($searchTerm); ?>">
                    <button type="submit" class="btn-primary-serch mb-0">Buscar</button> 
                </form>
            </div>
        </div>
        <div class="text-center mb-4 mt-5 button-row">
            <button type="button" class="btn btn-danger" onclick="window.location.href='inicio.html';">Cerrar Sesión</button>
            <button type="button" class="btn btn-primary" onclick="window.location.href='inventario.php';">Inventario</button>
            <button type="button" class="btn btn-primary" onclick="window.location.href='registrar_mantenimiento.php';">Crear Mantenimiento</button>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="notification">
                    <div class="notiglow"></div>
                    <div class="notibody">
                        <h3 class="titleCard text-center">Lista de Equipos</h3>
                        <ul class="">
                            <?php
                            if ($result && $result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<li class='textCard'><a href='mantenimiento.php?id=" . urlencode($row["id_equipo"]) . "'>" . htmlspecialchars($row["nombre_equipo"]) . "</a></li>";
                                }
                            } else {
                                echo "<li class='textCard'>No se encontraron equipos.</li>";
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Información detallada de cada equipo en la segunda columna -->
            <div class="col-md-8">
                <div class="notification">
                    <div class="notiglow"></div>
                    <div class="notibody">
                        <h2 class="titleCard text-center">Información Detallada del Equipo</h2>
                        <div class="">
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
                                    <div style="display: flex; justify-content: center;">
                                        <a href='formatos_mantenimiento.php?id=<?php echo urlencode($row["id_equipo"]); ?>' class='btn btn-primary'>Formato</a>
                                        <button onclick="confirmarEliminacion(<?php echo htmlspecialchars($row["id_equipo"]); ?>)" class='btn btn-danger'>Eliminar Mantenimiento</button>
                                    </div>
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
