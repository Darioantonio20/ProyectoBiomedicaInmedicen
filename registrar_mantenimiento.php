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

// Inicializar variables para los campos del formulario
$nombre_equipo = $modelo = $marca = $no_serie = $no_control = $compania = $fecha_entrada = $fecha_salida = $ingeniero_responsable = $ciudad = $estado = $cp = $email = $tel = $ubicacion = $area = "";

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre_equipo = $_POST['nombre_equipo'];
    $modelo = $_POST['modelo'];
    $marca = $_POST['marca'];
    $no_serie = $_POST['no_serie'];
    $no_control = $_POST['no_control'];
    $compania = $_POST['compania'];
    $fecha_entrada = $_POST['fecha_entrada'];
    $fecha_salida = $_POST['fecha_salida'];
    $ingeniero_responsable = $_POST['ingeniero_responsable'];
    $ciudad = $_POST['ciudad'];
    $estado = $_POST['estado'];
    $cp = $_POST['cp'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $ubicacion = $_POST['ubicacion'];
    $area = $_POST['area'];

    // Preparar la consulta SQL para insertar los datos en la tabla "mantenimiento"
    $query = "INSERT INTO mantenimiento (nombre_equipo, modelo, marca, no_serie, no_control, compania, fecha_entrada, fecha_salida, ingeniero_responsable, ciudad, estado, cp, email, tel, ubicacion, area) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Preparar la declaración SQL
    $stmt = $conn->prepare($query);

    // Vincular los parámetros
    $stmt->bind_param("ssssssssssssssss", $nombre_equipo, $modelo, $marca, $no_serie, $no_control, $compania, $fecha_entrada, $fecha_salida, $ingeniero_responsable, $ciudad, $estado, $cp, $email, $tel, $ubicacion, $area);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Si la inserción fue exitosa, redirigir a la página de mantenimiento
        header("Location: mantenimiento.php");
        exit;
    } else {
        // Si hubo un error en la inserción, mostrar un mensaje de error
        echo "Error al registrar el equipo en mantenimiento: " . $stmt->error;
    }

    // Cerrar la declaración SQL
    $stmt->close();
}

// Cerrar la conexión a la base de datos
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Equipo en Mantenimiento</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            max-width: 95%;
            margin: 2rem auto;
            padding: 2rem;
            background: #F8F9FD;
            background: linear-gradient(0deg, rgb(255, 255, 255) 0%, rgb(244, 247, 251) 100%);
            border-radius: 40px;
            border: 5px solid rgb(255, 255, 255);
            box-shadow: #0048A0 0px 30px 30px -20px;
            margin: 2rem;
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
        input[type="number"],
        input[type="text"],
        input[type="email"],
        input[type="date"] {
            box-sizing: border-box;
            width: 50vw;
            background: white;
            border: none;
            padding: 15px 1.25rem;
            border-radius: 1.25rem;
            margin-top: 2rem;
            box-shadow: #002A6B 0px 10px 10px -5px;
            border-inline: 2px solid transparent;
            font-size: 1.1rem;
            color: #808080;
            color: rgb(170, 170, 170);
        }
        textarea {
            box-sizing: border-box;
            width: 50vw;
            background: white;
            border: none;
            padding: 15px 1.25rem;
            border-radius: 1.25rem;
            margin-top: 2rem;
            box-shadow: #002A6B 0px 10px 10px -5px;
            border-inline: 2px solid transparent;
            font-size: 1.1rem;
            color: #808080;
            color: rgb(170, 170, 170);
        }
        button[type="submit"] {
            display: flex;
            align-items: center; 
            justify-content: center;
            text-decoration: none;
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            margin-top: 4.25rem;
            width: 100%;
            height: 9vh;
            box-sizing: border-box;
            border-radius: 20px;
            box-shadow: #007bff 0px 20px 10px -15px;
            border: none;
            transition: all 0.2s ease-in-out;
        }
        .button:active {
            transform: scale(0.95);
            box-shadow: #007bff 0px 15px 10px -10px;
        }
        button[type="submit"]:hover {
            background-color: #0056b3;
            background-color: #007bff;
            transform: scale(1.03);
            box-shadow: #007bff 0px 23px 10px -20px;
        }
        .action-btn {
            display: flex;
            align-items: center; 
            justify-content: center;
            text-decoration: none;
            background-color: #4fbe69;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            margin-top: 2rem;
            width: 100%;
            height: 9vh;
            box-sizing: border-box;
            border-radius: 20px;
            box-shadow: #0048A0 0px 20px 10px -15px;
            border: none;
            transition: all 0.2s ease-in-out;
        }
        .action-btn:hover {
            background-color: #62986e;
            transform: scale(1.03);
            box-shadow: #3c914f 0px 23px 10px -20px;
        }
        .login-button-red:active {
            transform: scale(0.95);
            box-shadow: #3c914f 0px 15px 10px -10px;
        }
          @keyframes blink {
            0% {opacity: 1;}
            50% {opacity: 0.59;} /* Modificado a 0.59 */
            100% {opacity: 1;}
          }
        
          .heading {
            text-align: center;
            font-weight: 900;
            font-size: 2rem;
            color: #0048A0;
            animation: blink 30s infinite;
          }
              
         .input::placeholder {
          color: rgb(170, 170, 170);
          }
        
          .input:focus {
          outline: none;
          border-inline: 2px solid #0048A0;
          animation: blink 4s infinite;
          }
          textarea::placeholder { 
            color: rgb(170, 170, 170);
          }

          textarea:focus {
            outline: none;
            border-inline: 2px solid #0048A0;
            animation: blink 4s infinite;
        }
        .buttoncito[type="submit"] {
            display: flex;
            align-items: center; 
            justify-content: center;
            text-decoration: none;
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            margin-top: 4.25rem;
            width: 100%;
            height: 9vh;
            box-sizing: border-box;
            border-radius: 20px;
            box-shadow: #007bff 0px 20px 10px -15px;
            border: none;
            transition: all 0.2s ease-in-out;
        }
        .buttoncito:active {
            transform: scale(0.95);
            box-shadow: #007bff 0px 15px 10px -10px;
        }
        .buttoncito[type="submit"]:hover {
            background-color: #0056b3;
            background-color: #007bff;
            transform: scale(1.03);
            box-shadow: #007bff 0px 23px 10px -20px;
        }
        
        /* Consultas de medios para hacer que el texto sea responsive */
        @media (max-width: 1200px) {
            body {
                font-size: 90%;
            }
        }

        @media (max-width: 992px) {
            body {
                font-size: 85%;
            }
        }

        @media (max-width: 768px) {
            body {
                font-size: 80%;
            }
        }

        @media (max-width: 576px) {
            body {
                font-size: 75%;
            }
        }
        a.action-btn {
            color: #fff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="heading">Registrar Equipo en Mantenimiento</h2>
        <form id="maintenance-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <input type="text" id="nombre-equipo" placeholder="Nombre del Equipo" name="nombre_equipo" value="<?php echo htmlspecialchars($nombre_equipo); ?>" required>
            </div>
            <div class="form-group">
                <input type="text" id="modelo" placeholder="Modelo" name="modelo" value="<?php echo htmlspecialchars($modelo); ?>" required>
            </div>
            <div class="form-group">
                <input type="text" id="marca" placeholder="Marca" name="marca" value="<?php echo htmlspecialchars($marca); ?>" required>
            </div>
            <div class="form-group">
                <input type="text" id="no_serie" placeholder="Número de Serie" name="no_serie" value="<?php echo htmlspecialchars($no_serie); ?>">
            </div>
            <div class="form-group">
                <input type="text" id="no_control" placeholder="Número de Inventario" name="no_control" value="<?php echo htmlspecialchars($no_control); ?>" required>
            </div>
            <div class="form-group">
                <input type="text" id="area" placeholder="Área" name="area" value="<?php echo htmlspecialchars($area); ?>">
            </div>
            <div class="form-group">
                <input type="text" id="compania" placeholder="Institución" name="compania" value="<?php echo htmlspecialchars($compania); ?>" required>
            </div>
            <div class="form-group">
                <input type="date" id="fecha_entrada" placeholder="Fecha de Entrada" name="fecha_entrada" value="<?php echo htmlspecialchars($fecha_entrada); ?>" required>
            </div>
            <div class="form-group">
                <input type="date" id="fecha_salida" placeholder="Fecha de Salida" name="fecha_salida" value="<?php echo htmlspecialchars($fecha_salida); ?>">
            </div>
            <div class="form-group">
                <input type="text" id="ingeniero_responsable" placeholder="Ingeniero Responsable" name="ingeniero_responsable" value="<?php echo htmlspecialchars($ingeniero_responsable); ?>" required>
            </div>
            <div class="form-group">
                <input type="text" id="ciudad" placeholder="Ciudad de la Institución" name="ciudad" value="<?php echo htmlspecialchars($ciudad); ?>">
            </div>
            <div class="form-group">
                <input type="text" id="estado" placeholder="Estado" name="estado" value="<?php echo htmlspecialchars($estado); ?>">
            </div>
            <div class="form-group">
                <input type="text" id="cp" placeholder="Código Postal" name="cp" value="<?php echo htmlspecialchars($cp); ?>">
            </div>
            <div class="form-group">
                <input type="email" id="email" placeholder="Email de la Institución" name="email" value="<?php echo htmlspecialchars($email); ?>">
            </div>
            <div class="form-group">
                <input type="text" id="tel" placeholder="Teléfono" name="tel" value="<?php echo htmlspecialchars($tel); ?>">
            </div>
            <div class="form-group">
                <input type="text" id="ubicacion" placeholder="Ubicación" name="ubicacion" value="<?php echo htmlspecialchars($ubicacion); ?>">
            </div>
            <button type="submit">Registrar Equipo en Mantenimiento</button>
        </form>
    </div>
</body>
</html>
