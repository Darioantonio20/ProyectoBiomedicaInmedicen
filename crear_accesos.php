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
        font-family: 'Nunito', sans-serif;
        background-color: #D6EAF8;
        margin: 0;
        padding: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        flex-direction: column;
    }

    /* Estilo para contenedores */
    .container {
        max-width: 1200px;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
    }

    /* Estilo para cada sección */
    .section {
        width: 45%;
        background-color: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        margin: 20px;
    }

    /* Estilo para títulos h2 */
    h2 {
        text-align: center;
        color: #333;
        font-weight: bold;
        margin-bottom: 20px;
    }

    /* Estilo para formularios */
    form {
        display: flex;
        flex-direction: column;
    }

    /* Estilo para etiquetas */
    label {
        margin-top: 10px;
        margin-bottom: 5px;
        color: #333;
    }

    /* Estilo para entradas de texto y contraseñas */
    input[type="text"],
    input[type="password"],
    select {
        padding: 8px;
        margin-bottom: 15px;
        border-radius: 5px;
        border: 1px solid #ccc;
        box-shadow: inset 0 1px 3px rgba(0,0,0,0.1);
        width: 100%;
    }

    /* Estilo para botones */
    button {
        padding: 8px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 10px;
        transition: background-color 0.2s ease-in-out;
        width: 100%;
    }

    button:hover {
        background-color: #0056b3;
    }

    /* Estilo para tablas */
    table {
        width: 100%;
        border-collapse: collapse;
        border-radius: 5px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }

    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #007bff;
        color: white;
    }

    /* Estilo para lista de usuarios */
    .user-list {
        margin-top: 20px;
    }
    </style>
</head>
<body>

<div class="container">
    <div class="section">
        <h2>Registro de Usuarios</h2>
        <form method="post">
            <label for="username">Usuario:</label>
            <input type="text" name="username" required>
            <label for="password">Contraseña:</label>
            <input type="password" name="password" required>
            <label for="role">Rol:</label>
            <select name="role" required>
                <option value="admin">Administrador</option>
                <option value="inventario">Inventario/Mantenimiento</option>
            </select>
            <button type="submit" name="add" class="btn btn-primary">Añadir Usuario</button>
        </form>
    </div>

    <div class="section">
        <h2>Lista de Usuarios</h2>
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
            echo "<table class='table'><thead class='thead-light'><tr><th>ID</th><th>Usuario</th><th>Rol</th><th>Acción</th></tr></thead><tbody>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"]. "</td>";
                echo "<td>" . $row["username"]. "</td>";
                echo "<td>" . $row["role"]. "</td>";
                echo "<td>";
                // Formulario de eliminación
                echo "<form method='post' onsubmit=\"return confirm('¿Estás seguro de que quieres eliminar este usuario?');\">";
                echo "<input type='hidden' name='delete' value='" . $row["id"] . "'>";
                echo "<button type='submit' class='btn btn-danger'>Eliminar</button>"; 
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

<!-- Bootstrap JS y dependencias actualizados -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
