<?php

require_once('vendor/autoload.php');
use setasign\Fpdi\Fpdi;

// Configuración de la conexión a la base de datos
$host = "127.0.0.1";
$username = "root";
$password = "";
$database = "inmedicen";
$conn = new mysqli($host, $username, $password, $database);

// Manejo de errores de conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Configuración del juego de caracteres
$conn->set_charset("utf8");

function obtenerDatosEquipoPorId($conn, $id_equipo) {
    $datos = null;
    $query = "SELECT id_equipo, nombre_equipo, modelo, marca, no_serie, no_control, compania, fecha_entrada, fecha_salida, ingeniero_responsable, ciudad, estado, cp, email, tel, ubicacion, area FROM mantenimiento WHERE id_equipo = ?";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $id_equipo);
        $stmt->execute();
        $resultado = $stmt->get_result();
        if ($resultado->num_rows > 0) {
            $datos = $resultado->fetch_assoc();
        }
        $stmt->close();
    }
    return $datos;
}

// Obtiene el ID del equipo de la URL o establece a 0 si no se proporciona
$id_equipo = isset($_GET['id_equipo']) ? intval($_GET['id_equipo']) : 0;

// Verifica si se proporcionó un ID de equipo válido
if ($id_equipo > 0) {
    // Obtiene los datos del equipo
    $datosEquipo = obtenerDatosEquipoPorId($conn, $id_equipo);

    // Verifica si se encontraron datos del equipo
    if ($datosEquipo) {
        $pdf = new Fpdi();
        
        // Ruta del archivo PDF
        $archivoPdf = 'fpdf/hoja_servicio.pdf';
        
        // Verifica si el archivo PDF existe
        if (file_exists($archivoPdf)) {
            // Carga la página del documento PDF
            $pdf->setSourceFile($archivoPdf);
            $tplIdx = $pdf->importPage(1);
            $pdf->addPage();
            $pdf->useTemplate($tplIdx, ['adjustPageSize' => true]);

            // Configuración de la fuente
            $pdf->SetFont('Arial', '', 10);
            $pdf->SetTextColor(0, 0, 0);

            // Escribe los datos del equipo en el PDF
            $pdf->SetXY(40, 118); 
            $pdf->Write(0, "" . utf8_decode($datosEquipo['nombre_equipo']));
            $pdf->SetXY(171, 118); 
            $pdf->Write(0, "" . utf8_decode($datosEquipo['modelo']));
            $pdf->SetXY(40, 124); 
            $pdf->Write(0, "" . utf8_decode($datosEquipo['marca']));
            $pdf->SetXY(171, 130); 
            $pdf->Write(0, "" . utf8_decode($datosEquipo['no_serie']));
            $pdf->SetXY(171, 136); 
            $pdf->Write(0, "" . utf8_decode($datosEquipo['no_control']));
            $pdf->SetXY(100, 65); 
            $pdf->Write(0, "" . utf8_decode($datosEquipo['compania']));
            $pdf->SetXY(39, 85); 
            $pdf->Write(0, "" . utf8_decode($datosEquipo['ciudad']));
            $pdf->SetXY(92, 85); 
            $pdf->Write(0, "" . utf8_decode($datosEquipo['estado']));
            $pdf->SetXY(162, 79); 
            $pdf->Write(0, "" . utf8_decode($datosEquipo['cp']));
            $pdf->SetXY(39, 94); 
            $pdf->Write(0, "" . utf8_decode($datosEquipo['email']));
            $pdf->SetXY(139, 94); 
            $pdf->Write(0, "" . utf8_decode($datosEquipo['tel']));
            $pdf->SetXY(40, 130); 
            $pdf->Write(0, "" . utf8_decode($datosEquipo['ubicacion']));
            $pdf->SetXY(171, 124); 
            $pdf->Write(0, "" . utf8_decode($datosEquipo['area']));

            // Envía el PDF al navegador
            $pdf->Output('I', "hoja_servicio_{$id_equipo}.pdf");
        } else {
            die('El archivo PDF no existe en la ruta especificada.');
        }
    } else {
        die('No se encontraron datos del equipo con ese ID.');
    }
} else {
    die('ID de equipo no válido o no proporcionado.');
}

// Cierra la conexión a la base de datos
$conn->close();
?>
