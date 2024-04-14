<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Búsqueda de Equipos</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
        }

        h2 {
            text-align: center;
        }

        h3 {
            text-align: center;
            font-size: 18px; /* Ajustar el tamaño del texto */
            margin-bottom: 10px; /* Espacio inferior */
        }

        form {
            margin: 20px 0;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        input[type="text"] {
            padding: 10px;
            margin-right: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        input[type="submit"] {
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            background-color: #5DADE2;
            color: white;
            cursor: pointer;
            border-radius: 20px;
            box-shadow: #0048A0 0px 20px 10px -15px;
            border: none;
            font-weight: bold;
            background: #0048A0;
            transition: all 0.2s ease-in-out;
        }

        input[type="submit"]:hover {
            transform: scale(1.03);
            box-shadow: #0048A0 0px 23px 10px -20px;
        }
        
        input[type="submit"]:active {
            transform: scale(0.95);
            box-shadow: #0048A0 0px 15px 10px -10px;
        } 

        .results {
            margin-top: 20px;
        }

        .results table {
            width: 100%;
            border-collapse: collapse;
        }

        .results th, .results td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .results th {
            background-color: #5DADE2; /* Color de fondo igual al botón "Buscar" */
            color: white; /* Texto blanco para contraste */
        }

        .results th:first-child {
            border-top-left-radius: 5px; /* Estilo de borde redondeado en la primera celda del encabezado */
            border-bottom-left-radius: 5px;
        }

        .results th:last-child {
            border-top-right-radius: 5px; /* Estilo de borde redondeado en la última celda del encabezado */
            border-bottom-right-radius: 5px;
        }

        /* Estilos para el botón de salir */
        #btn-salir {
            margin-top: 20px;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            color: white;
            cursor: pointer;
            width: 20%;
            font-weight: bold;
            background: #0048A0;
            color: white;
            padding-block: 15px;
            margin: 1.25rem auto; /* Centra el botón horizontalmente */
            border-radius: 20px;
            box-shadow: #0048A0 0px 20px 10px -15px;
            border: none;
            transition: all 0.2s ease-in-out;
        }
        #btn-salir:hover {
            transform: scale(1.03);
            box-shadow: #0048A0 0px 23px 10px -20px;
        }

        .btn-salir:active {
            transform: scale(0.95);
            box-shadow: #0048A0 0px 15px 10px -10px;
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
    
    }

   

    </style>
</head>
<body>

<h2>Búsqueda de Equipos por ID</h2>
<p style="text-align: center;">Por favor, ingrese el ID que se le asignó para encontrar su información.</p>
<form action="busqueda.php" method="post">
    ID: <input type="text" name="id_equipo">
    <input type="submit" value="Buscar">
</form>

<div class="results">
<?php
// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idEquipo = $_POST['id_equipo'];

    // Datos de conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "inmedicen";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Prepara la consulta SQL para buscar por ID
    $stmt = $conn->prepare("SELECT * FROM mantenimiento WHERE id_equipo = ?");
    $stmt->bind_param("i", $idEquipo); // 'i' significa que la variable es de tipo entero

    // Ejecutar la consulta
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica si se encontró el equipo
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr style='background-color: #5DADE2; color: white;'><th>ID</th><th>Nombre</th><th>Modelo</th><th>Marca</th><th>Número de Serie</th><th>Número de Control</th><th>Compañía</th><th>Fecha de Entrada</th><th>Fecha de Salida</th></tr>"; // Modificado el estilo del encabezado
        // Salida de datos de cada fila
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["id_equipo"]."</td><td>".$row["nombre_equipo"]."</td><td>".$row["modelo"]."</td><td>".$row["marca"]."</td><td>".$row["no_serie"]."</td><td>".$row["no_control"]."</td><td>".$row["compania"]."</td><td>".$row["fecha_entrada"]."</td><td>".$row["fecha_salida"]."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<h3 style='font-weight: normal;'>No se encontraron resultados.</h3>"; // Modificado para usar elemento h3
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $conn->close();
}
?>
</div>

<!-- Botón de salir -->
<button id="btn-salir" onclick="location.href='inicio.html'">Salir</button>

</body>
</html>
