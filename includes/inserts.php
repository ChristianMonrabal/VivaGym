<?php
session_start(); // Iniciar la sesión

// Incluir el archivo de conexión
require_once './conexion.php'; // Asegúrate de que la ruta sea correcta

// Verificar si no se han enviado todos los datos necesarios
if (
    empty($_POST['nombre']) || empty($_POST['apellidos']) || empty($_POST['dni']) || 
    empty($_POST['email']) || empty($_POST['contraseña']) || empty($_POST['sexo']) || 
    empty($_POST['numero_telefono']) || empty($_POST['fecha_nacimiento']) || 
    empty($_POST['pais']) || empty($_POST['codigo_postal']) || empty($_POST['ciudad']) || 
    empty($_POST['cuota']) || empty($_POST['numero_tarjeta']) || 
    empty($_POST['fecha_caducidad_tarjeta']) || empty($_POST['cvv_tarjeta'])
) {
    exit();
}

// Obtener los datos recibidos del formulario
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$dni = $_POST['dni'];
$email = $_POST['email'];
$contraseña = password_hash($_POST['contraseña'], PASSWORD_BCRYPT); // Encriptar la contraseña
$sexo = $_POST['sexo'];
$numero_telefono = $_POST['numero_telefono'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$pais = $_POST['pais'];
$codigo_postal = $_POST['codigo_postal'];
$ciudad = $_POST['ciudad'];
$selectedCuota = $_POST['cuota'];
$numero_tarjeta = $_POST['numero_tarjeta'];
$fecha_caducidad_tarjeta = $_POST['fecha_caducidad_tarjeta'];
$cvv_tarjeta = $_POST['cvv_tarjeta'];

try {
    // Preparar la inserción en la base de datos
    $sql = "INSERT INTO Usuarios (nombre, apellidos, dni, email, contraseña, sexo, numero_telefono, fecha_nacimiento, pais, codigo_postal, ciudad, numero_tarjeta, fecha_caducidad_tarjeta, cvv_tarjeta, establecimiento_id) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        throw new Exception('Error en la preparación de la consulta: ' . $conn->error);
    }

    // Vincular los parámetros
    $stmt->bind_param("ssssssssssssssi", $nombre, $apellidos, $dni, $email, $contraseña, $sexo, $numero_telefono, $fecha_nacimiento, $pais, $codigo_postal, $ciudad, $numero_tarjeta, $fecha_caducidad_tarjeta, $cvv_tarjeta, $selectedCuota);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Registro completado con éxito";
    } else {
        throw new Exception('Error en la ejecución de la consulta: ' . $stmt->error);
    }

    // Cerrar la declaración
    $stmt->close();
} catch (Exception $e) {
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Registro Completado</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">
<style>
    body {
        background-color: #f0f0f0;
    }

    .container {
        margin-top: 50px;
    }

    .btn-primary {
        background-color: #ff6600;
        border-color: #ff6600;
    }

    .btn-primary:hover {
        background-color: #cc5500;
        border-color: #cc5500;
    }
</style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <p class="text-center">¡Gracias por registrarte en VivaGym!</p>
            <div class="text-center">
                <a href="../index.php" class="btn btn-primary">Volver al inicio</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>

