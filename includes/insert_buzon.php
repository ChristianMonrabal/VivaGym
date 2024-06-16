<?php
include './conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $movil = $_POST['movil'];
    $email = $_POST['email'];
    $tipoConsulta = $_POST['tipoConsulta'];
    $establecimiento = $_POST['establecimiento'];
    $consulta = $_POST['consulta'];

    // Preparar la consulta SQL
    $sql = "INSERT INTO Buzon (nombre, apellidos, movil, email, tipoConsulta, establecimiento, consulta) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        // Enlazar los parámetros
        $stmt->bind_param("sssssis", $nombre, $apellidos, $movil, $email, $tipoConsulta, $establecimiento, $consulta);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "Registro insertado correctamente.";
            header("Location: ../index.php");
        } else {
            echo "Error: No se pudo ejecutar la consulta: $sql. " . mysqli_error($conn);
        }

        // Cerrar la declaración
        $stmt->close();
    } else {
        echo "Error: No se pudo preparar la consulta: $sql. " . mysqli_error($conn);
    }

    // Cerrar la conexión
    $conn->close();
}
?>
