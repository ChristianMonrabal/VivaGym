<?php
session_start();
include './conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        $usuario_id = $_SESSION['id']; // Asegúrate de tener el ID del usuario en la sesión
        $actividad = $_POST['actividad'];
        $dia_semana = $_POST['dia_semana'];
        $hora = $_POST['hora'];

        $sql = "INSERT INTO Reservas (usuario_id, actividad, dia_semana, hora) VALUES (?, ?, ?, ?)";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("isss", $usuario_id, $actividad, $dia_semana, $hora);
            if ($stmt->execute()) {
                header("location: ../views/calendario.php");
            } else {
                echo "Error: No se pudo realizar la reserva.";
            }
            $stmt->close();
        }
    } else {
        header("location: ../forms/signin.php");
    }
}
$conn->close();
?>
