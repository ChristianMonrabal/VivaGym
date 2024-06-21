<?php
session_start();
include './conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        $usuario_id = $_SESSION['id'];
        list($actividad, $dia_semana, $hora) = explode(',', $_POST['reserva']);

        // Eliminar la reserva de la base de datos
        $sql = "DELETE FROM Reservas WHERE usuario_id = ? AND actividad = ? AND dia_semana = ? AND hora = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("isss", $usuario_id, $actividad, $dia_semana, $hora);
            if ($stmt->execute()) {
                header("location: ../views/calendario.php");
            } else {
                echo "Error: No se pudo anular la reserva.";
            }
            $stmt->close();
        }
    } else {
        header("location: ../forms/signin.php");
    }
}
$conn->close();
?>
