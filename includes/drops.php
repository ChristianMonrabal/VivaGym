<?php
session_start();
include './conexion.php';

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    $sql = "DELETE FROM usuarios WHERE email = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $email);
        if ($stmt->execute()) {
            $_SESSION = array();
            session_destroy();
            header("location: ../index.php");
            exit;
        } else {
            echo "Error: No se pudo borrar la cuenta. Inténtalo de nuevo más tarde.";
        }
        $stmt->close();
    } else {
        echo "Error: No se pudo preparar la consulta.";
    }

    $conn->close();
} else {
    header("location: ../index.php");
    exit;
}
?>
