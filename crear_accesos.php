<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Usuarios</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
    /* Estilos generales */
    body {
    font-family: 'Roboto', sans-serif;
}

.btn-formato {
    padding: 0.08rem 0.9rem;
    font-size: 0.800rem;
}

.btn-primary {
    display: block;
    width: 30%;
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
  width: 100%;
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
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1 class="heading text-center mt-5 mb-5">Registro de Usuarios</h1>
                <form method="post">
                    <input type="text" name="username" class="input" placeholder="Usuario" required>
                    <input type="password" name="password" class="input" placeholder="Contraseña" required>
                    <select name="role" class="input" placeholder="Rol" required>
                        <option class="input" value="admin">Administrador</option>
                        <option class="input" value="inventario">Inventario/Mantenimiento</option>
                    </select>
                    <button type="submit" name="add" class="btn-primary">Añadir Usuario</button>
                </form>
            </div>

            <div class="col-md-6">
                <h2 class="heading text-center mt-5 mb-5">Lista de Usuarios</h2>
                <?php
                // Conexión a la base de datos
                $conn = new mysqli('localhost', 'root', '', 'inmedicen');

                // Verificar si el formulario ha sido enviado
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
                    $username = $conn->real_escape_string($_POST['username']);
                    // Obtener la contraseña sin aplicar hash
                    $password = $_POST['password'];
                    $role = $conn->real_escape_string($_POST['role']);

                    $sql = "INSERT INTO usuarios (username, password, role) VALUES ('$username', '$password', '$role')";
                    if ($conn->query($sql) === TRUE) {
                        echo "<p>Nuevo usuario añadido con éxito.</p>";
                    } else {
                        echo "<p>Error al añadir el usuario: " . $conn->error . "</p>";
                    }
                }

                // Verificar si se envió un formulario de eliminación
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
                    $user_id_to_delete = $_POST['delete'];
                    $sql = "DELETE FROM usuarios WHERE id = '$user_id_to_delete'";
                    if ($conn->query($sql) === TRUE) {
                        echo "<script>alert('Usuario eliminado correctamente.');window.location.href = window.location.href;</script>";
                    } else {
                        echo "<p>Error al eliminar el usuario: " . $conn->error . "</p>";
                    }
                }

                // Listar usuarios
                $sql = "SELECT id, username, role FROM usuarios";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "<table class='data-table'><thead class='thead-light'><tr class='colortr'><th>ID</th><th>Usuario</th><th>Rol</th><th>Acción</th></tr></thead><tbody>";
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"]. "</td>";
                        echo "<td>" . $row["username"]. "</td>";
                        echo "<td>" . $row["role"]. "</td>";
                        echo "<td>";
                        // Formulario de eliminación
                        echo "<form method='post' onsubmit=\"return confirm('¿Estás seguro de que quieres eliminar este usuario?');\">";
                        echo "<input type='hidden' name='delete' value='" . $row["id"] . "'>";
                        echo "<button type='submit' class='btn-danger'>Eliminar</button>"; 
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody></table>";
                } else {
                    echo "<p>No hay usuarios registrados.</p>";
                }
                $conn->close();
                ?>
            </div>
        </div>
    </div>

<!-- Bootstrap JS y dependencias actualizados -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
