<?php
session_start();

// Configuración de la conexión a la base de datos
$host = "127.0.0.1";
$username = "root";
$password = "";
$database = "basehm";
$conn = new mysqli($host, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener y sanear el número de serie
if (isset($_GET['no_serie'])) {
    $no_serie = $_GET['no_serie'];

    // Preparar consulta SQL para obtener detalles del equipo
    $stmt = $conn->prepare("SELECT * FROM equipos WHERE no_serie = ?");
    $stmt->bind_param("s", $no_serie);
    $stmt->execute();
    $result = $stmt->get_result();

    // Preparar consulta SQL para obtener imágenes del equipo
    $stmt_images = $conn->prepare("SELECT ruta_imagen FROM imagenes WHERE id_equipo = (SELECT id_equipo FROM equipos WHERE no_serie = ?)");
    $stmt_images->bind_param("s", $no_serie);
    $stmt_images->execute();
    $result_images = $stmt_images->get_result();
    $images = $result_images->fetch_all(MYSQLI_ASSOC);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalles del Equipo</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
        }
        .container {
            margin-top: 20px;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h2, h4{
            color: #007bff;
        }
        img {
            max-width: 100%;
            height: auto;
        }
        .btn-space {
            margin-right: 8px;
        }
        .align-top {
            align-items: flex-start;
        }

        .carousel {
        position: relative;
        max-width: 600px; /* Adjust as needed */
        margin: auto;
        overflow: hidden;
        }

        .carousel-images img {
        width: 100%;
        display: none; /* Hide images by default */
        }

        .carousel-images img.active {
        display: block; /* Show active image */
        }

        .carousel-button {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background-color: rgba(0,0,0,0.5);
        color: white;
        border: none;
        cursor: pointer;
        padding: 10px;
        z-index: 100;
        }

        .carousel-button.prev {
        left: 10px;
        }

        .carousel-button.next {
        right: 10px;
        }

        /* Estilo para los botones */
        .btn-custom {
            display: block; /* Hace que el botón ocupe toda la anchura del contenedor padre */
            width: 100%; /* Establece la anchura al 100% del contenedor padre */
            margin-bottom: 10px; /* Añade un margen inferior para separar los botones */
            box-sizing: border-box; /* Asegura que el padding y border estén incluidos en el ancho y alto */
        }

        /* Contenedor para alinear los botones */
        .button-container {
            margin-top: 10px;
        }

        /* Más estilos personalizados aquí si es necesario */
    </style>
</head>
<body>
<div class="container">
    <div class="row align-top">
        <div class="col-md-8">
            <h2>Detalles del Equipo</h2>
            <!-- Columna de detalles del equipo -->
            <?php
            // Mostrar detalles del equipo
            $details = ['id_equipo', 'nombre_equipo', 'marca', 'modelo', 'no_serie', 'ubicacion', 'local', 'accesorios'];
            foreach ($details as $detail) {
                echo "<p><strong>" . ucfirst(str_replace('_', ' ', $detail)) . ":</strong> " . htmlspecialchars($row[$detail]) . "</p>";
            }
            ?>
        </div>
                    
                <!-- Columna izquierda para detalles de mantenimiento -->
                <div class="col-md-8">
                    <h2>Mantenimiento del Equipo</h4>
                    <!-- Aquí pondrías los valores actuales del equipo -->
                    <p><strong>Ingeniero Responsable:</strong> <?php echo htmlspecialchars($row['responsable']); ?></p>
                    <p><strong>Fecha de Revisión:</strong> <?php echo htmlspecialchars($row['fecha_revision']); ?></p>
                    <p><strong>Fecha de Próximo Mantenimiento:</strong> <?php echo htmlspecialchars($row['fecha_mantenimiento']); ?></p>
                    <a href="reportepdf.php?no_serie=<?php echo htmlspecialchars($row['no_serie']); ?>" target="_blank" class="btn btn-primary">Generar reportes</a>
                    <!-- Botón para activar el modo de edición -->
                    <button class="btn btn-primary" onclick="habilitarEdicion()">Editar</button>
                    <button class="btn btn-secondary" onclick="ocultarEdicion()" id="btnCerrar" style="display:none;">Cerrar</button>
                    <a href="inventario.php" class="btn btn-success">Regresar</a>

                <!-- Formulario para editar -->
                        <form id="formEdicion" action="editar_mantenimiento.php" method="post" style="display:none;">
                            <input type="hidden" name="no_serie" value="<?php echo htmlspecialchars($row['no_serie']); ?>">
                            <div class="form-group">
                                <label for="ingeniero_responsable">Ingeniero Responsable:</label>
                                <input type="text" id="responsable" name="responsable" class="form-control mb-2" value="<?php echo htmlspecialchars($row['responsable']); ?>">
                            </div>
                            <div class="form-group">
                                <label for="fecha_revision">Fecha de Revisión:</label>
                                <input type="date" id="fecha_revision" name="fecha_revision" class="form-control mb-2" value="<?php echo htmlspecialchars($row['fecha_revision']); ?>">
                            </div>
                            <div class="form-group">
                                <label for="fecha_mantenimiento">Fecha de Próximo Mantenimiento:</label>
                                <input type="date" id="fecha_mantenimiento" name="fecha_mantenimiento" class="form-control mb-2" value="<?php echo htmlspecialchars($row['fecha_mantenimiento']); ?>">
                            </div>
                            <button type="submit" class="btn btn-success">Guardar Cambios</button>
                        </form>
                    </div>


                <!-- Columna para imágenes estáticas (lado derecho) -->
                <div class="col-md-4" style="margin-top: -370px;">
                <h2>Imagen del Equipo</h2>
                <!-- Formulario para subir imagen -->
                <form action="upload_image.php" method="post" enctype="multipart/form-data" class="mb-2 button-container">
                    <input type="hidden" name="no_serie" value="<?php echo $no_serie; ?>">
                    <input type="file" name="fileToUpload" id="fileToUpload" class="form-control mb-2">
                    <button type="submit" class="btn btn-primary btn-custom">Subir Imágenes</button>
                </form>
                <button type="button" class="btn btn-danger btn-custom" onclick="confirmDelete('<?php echo urlencode($no_serie); ?>')">Borrar Imágenes</button>
                                
                <!-- Contenedor de imágenes estáticas -->
                <div class="image-container mt-2">
                    <?php foreach ($images as $index => $img): ?>
                        <div class="image-item">
                            <p>Imagen <?php echo $index + 1; ?></p>
                            <div>
                                <button type="button" class="btn btn-info btn-custom" onclick="location.href='ver_imagen.php?ruta_imagen=<?php echo urlencode($img['ruta_imagen']); ?>'">Ver</button>
                                <!-- Verifica si existe 'id_imagen' en el array $img -->
                                <?php if(isset($img['id_imagen'])): ?>
                                    <button type="button" class="btn btn-danger btn-custom" onclick="confirmDeleteImage('<?php echo $img['id_imagen']; ?>')">Borrar</button>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>


            </div>
        </div>   
    </div>
</div>

        <script>
        function habilitarEdicion() {
            document.getElementById('formEdicion').style.display = 'block';
            document.getElementById('btnCerrar').style.display = 'inline-block'; // Mostrar botón Cerrar
        }

        function ocultarEdicion() {
            document.getElementById('formEdicion').style.display = 'none';
            document.getElementById('btnCerrar').style.display = 'none'; // Ocultar botón Cerrar
        }

        function confirmDelete(no_serie) {
            if (confirm("¿Estás seguro de que deseas borrar estas imágenes?")) {
                location.href = 'delete_image.php?no_serie=' + no_serie;
            }
        }

        function confirmDeleteImage(idImagen) {
        if (confirm("¿Estás seguro de que deseas borrar esta imagen?")) {
            location.href = 'delete_single_image.php?id_imagen=' + idImagen;
        }
    }


        var slideIndex = 0;
        showSlides(slideIndex);

        // Next/previous controls
        function moveSlide(n) {
        showSlides(slideIndex += n);
        }

        function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("carousel-images")[0].getElementsByTagName("img");
        if (n >= slides.length) {slideIndex = 0}    
        if (n < 0) {slideIndex = slides.length - 1}
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";  
        }
        slides[slideIndex].style.display = "block";  
        }

        </script>

        <?php
            // Verificar si la edición se realizó con éxito
            if (isset($_SESSION['edicion_exitosa']) && $_SESSION['edicion_exitosa']) {
                echo '<div class="alert alert-success">Los cambios se han guardado con éxito.</div>';
                // Eliminar la variable de sesión para que no se muestre la alerta en futuras visitas a la página
                unset($_SESSION['edicion_exitosa']);
            }
        ?>

        </body>
        </html>
        <?php
    } else {
        echo "Equipo no encontrado.";
    }
} else {
    echo "No se ha proporcionado un número de serie válido.";
}
$conn->close();
?>
