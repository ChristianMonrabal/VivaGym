<?php
include './conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombreCompleto = $_POST['nombreCompleto'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $cv = $_FILES['cv'];

    // Validar los datos y el archivo subido
    $allowedExtensions = ['pdf', 'doc', 'docx'];
    $fileExtension = pathinfo($cv['name'], PATHINFO_EXTENSION);

    if (in_array($fileExtension, $allowedExtensions) && $cv['size'] <= 2 * 1024 * 1024) { // Tamaño máximo de archivo: 2MB
        $cvData = file_get_contents($cv['tmp_name']);
        $cvData = addslashes($cvData); // Escapar caracteres especiales para SQL

        // Insertar los datos en la base de datos
        $sql = "INSERT INTO Candidatos (nombre_completo, telefono, email, cv) VALUES ('$nombreCompleto', '$telefono', '$email', '$cvData')";

        if ($conn->query($sql) === TRUE) {
            header("Location: ../index.php?upload=success");
            exit();
        } else {
            echo "Error al subir los datos: " . $conn->error;
        }
    } else {
        echo "Archivo no válido. Asegúrese de que el archivo sea PDF o Word y no exceda los 2MB.";
    }
}
?>
