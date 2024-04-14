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
    display: flex; /* Hace que los hijos del div se alineen en una fila */
    justify-content: space-around; /* Distribuye el espacio alrededor de los botones de manera uniforme */
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
    width: 15%;
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
    flex-direction: row; /* Changed from column to row */
    align-items: center;
    justify-content: center;
    flex-wrap: wrap; /* Added to wrap buttons to next line if container width is not enough */
}
.heading {
    text-align: center;
    font-weight: 900;
    font-size: 2.6rem;
    color: rgb(16, 137, 211);
}
    </style>
</head>
<body>
    <h1 class="heading text-center mt-5 mb-5">Busqueda de Insumos</h1>
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
            <button type="button" class="btn btn-primary" onclick="window.location.href='registro_insumo.php';">Añadir Insumo</button>
            <button type="button" class="btn btn-primary" onclick="window.location.href='inventario.php';">Busqueda de Equipos</button>
            <button type="button" class="btn btn-danger" onclick="window.location.href='inicio.html';">Cerrar Sesión</button>
        </div>

        <table class='data-table'>
            <thead class='thead-light'>
                <tr class="colortr">
                    <th>ID Insumo</th>
                    <th>Nombre</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>No. Serie</th>
                    <th>Caducidad</th>
                    <th>Tipo</th>
                    <th>Cantidad</th>
                    <th>Observación</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
            <?php
            if ($result && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
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
