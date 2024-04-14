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

// Inicializar variables para los datos del insumo
$nombre = $marca = $modelo = $no_serie = $caducidad = $tipo = $cantidad = $observaciones = "";
$nombre_err = $marca_err = $modelo_err = $no_serie_err = $caducidad_err = $tipo_err = $cantidad_err = $observaciones_err = "";

// Procesar datos del formulario cuando se envía el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar nombre del insumo
    if (empty(trim($_POST["nombre"]))) {
        $nombre_err = "Por favor ingrese el nombre del insumo.";
    } else {
        $nombre = trim($_POST["nombre"]);
    }

    // Validar marca del insumo
    $marca = trim($_POST["marca"]);

    // Validar modelo del insumo
    $modelo = trim($_POST["modelo"]);

    // Validar número de serie del insumo
    $no_serie = trim($_POST["no_serie"]);

    // Validar caducidad del insumo
    $caducidad = trim($_POST["caducidad"]);

    // Validar tipo del insumo
    if (empty(trim($_POST["tipo"]))) {
        $tipo_err = "Por favor ingrese el tipo del insumo.";
    } else {
        $tipo = trim($_POST["tipo"]);
    }

    // Validar cantidad del insumo
    if (empty(trim($_POST["cantidad"]))) {
        $cantidad_err = "Por favor ingrese la cantidad del insumo.";
    } else {
        $cantidad = trim($_POST["cantidad"]);
    }

    // Validar observaciones del insumo
    $observaciones = trim($_POST["observaciones"]);

    // Verificar si no hay errores de entrada antes de insertar en la base de datos
    if (empty($nombre_err) && empty($tipo_err) && empty($cantidad_err)) {
        // Preparar la declaración SQL
        $sql = "INSERT INTO insumos (nombre, marca, modelo, no_serie, caducidad, tipo, cantidad, observaciones) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            // Vincular variables a la declaración preparada como parámetros
            $stmt->bind_param("ssssssis", $param_nombre, $param_marca, $param_modelo, $param_no_serie, $param_caducidad, $param_tipo, $param_cantidad, $param_observaciones);

            // Establecer parámetros
            $param_nombre = $nombre;
            $param_marca = $marca;
            $param_modelo = $modelo;
            $param_no_serie = $no_serie;
            $param_caducidad = $caducidad;
            $param_tipo = $tipo;
            $param_cantidad = $cantidad;
            $param_observaciones = $observaciones;

            // Ejecutar la declaración preparada
            if ($stmt->execute()) {
                // Redireccionar a insumos.php después de agregar el insumo
                header("location: insumos.php");
                exit();
            } else {
                echo "Algo salió mal. Por favor, inténtelo de nuevo más tarde.";
            }

            // Cerrar declaración
            $stmt->close();
        }
    }

    // Cerrar conexión
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Insumo</title>
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
        <h2 class="heading">Registro de Nuevo Insumo</h2>
        <strong>Por favor complete el formulario</strong>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <input type="text" name="nombre" placeholder="Nombre del Insumo" class="form-control <?php echo (!empty($nombre_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nombre; ?>">
                    <span class="invalid-feedback"><?php echo $nombre_err; ?></span>
                </div>
                <div class="form-group">
                    <input type="text" name="marca"  placeholder="Marca" class="form-control <?php echo (!empty($marca_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $marca; ?>">
                    <span class="invalid-feedback"><?php echo $marca_err; ?></span>
                </div>
                <div class="form-group">
                    <input type="text" name="modelo"  placeholder="Modelo" class="form-control <?php echo (!empty($modelo_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $modelo; ?>">
                    <span class="invalid-feedback"><?php echo $modelo_err; ?></span>
                </div>
                <div class="form-group">
                    <input type="text" name="no_serie"  placeholder="Número de Serie" class="form-control <?php echo (!empty($no_serie_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $no_serie; ?>">
                    <span class="invalid-feedback"><?php echo $no_serie_err; ?></span>
                </div>
                <div class="form-group">
                    <input type="text" name="caducidad"  placeholder="Caducidad" class="form-control <?php echo (!empty($caducidad_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $caducidad; ?>">
                    <span class="invalid-feedback"><?php echo $caducidad_err; ?></span>
                </div>
                <div class="form-group">
                    <input type="text" name="tipo"  placeholder="Tipo de Insumo" class="form-control <?php echo (!empty($tipo_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $tipo; ?>">
                    <span class="invalid-feedback"><?php echo $tipo_err; ?></span>
                </div>
                <div class="form-group">
                    <input type="number" name="cantidad"  placeholder="Cantidad" class="form-control <?php echo (!empty($cantidad_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $cantidad; ?>">
                    <span class="invalid-feedback"><?php echo $cantidad_err; ?></span>
                </div>
                <div class="form-group">
                    <textarea name="observaciones"  placeholder="Observaciones" class="form-control <?php echo (!empty($observaciones_err)) ? 'is-invalid' : ''; ?>"><?php echo $observaciones; ?></textarea>
                    <span class="invalid-feedback"><?php echo $observaciones_err; ?></span>
                </div>
                <div class="form-group">
                    <input type="submit" class="buttoncito" value="Registrar">
                    <a href="insumos.php" class="action-btn">Cancelar</a>
                </div>
            </form>
        </div>
    <!-- Bootstrap JS y dependencias actualizados -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
