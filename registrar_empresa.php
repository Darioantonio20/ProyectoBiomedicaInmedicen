<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Añadir Empresa</title>
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
        input[type="text"],
        input[type="email"],
        input[type="tel"],
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
    </style>
</head>
<body>
    <div class="container">
        <h2 class="heading">Añadir Nueva Empresa</h2>
        <div class="card-body">
            <form method="POST" action="guardar_empresa.php">
                <div class="form-group">
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre de la Empresa" required>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" id="mail" name="mail" placeholder="Correo Electrónico" required>
                </div>
                <div class="form-group">
                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Teléfono" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="type_company" name="type_company" placeholder="Tipo de Empresa" required>
                </div>
                <button type="submit" >Guardar Empresa</button>
                <a href="empresas.php" class="action-btn">Cancelar</a>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS y dependencias actualizados -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
