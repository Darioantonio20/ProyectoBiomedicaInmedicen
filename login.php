<?php

// login.php
$host = "localhost"; // Ajusta esto a tu configuración
$dbname = "inmedicen";
$dbUsername = "root"; // Asegúrate de que este es tu usuario de base de datos
$dbPassword = ""; // Asegúrate de que esta es tu contraseña de base de datos, si es que tienes una

// Conexión a la base de datos
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $dbUsername, $dbPassword);
} catch (PDOException $e) {
    die("Error connecting to database: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userInput = $_POST['username'];
    $passInput = $_POST['password'];
    $roleInput = $_POST['role']; 

    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE username = ? AND role = ?");
    $stmt->execute([$userInput, $roleInput]);
    $user = $stmt->fetch();

    if ($user && $passInput === $user['password']) {
        echo 'success';
    } else {
        echo "Credenciales incorrectas.";
    }
    exit;
}
// No necesitas las líneas que redirigen con header(), quítalas.



