<?php
session_start();

if(empty($_POST['nombre']) || empty($_POST['apellidos']) || empty($_POST['dni']) || empty($_POST['email']) || empty($_POST['contraseña']) || empty($_POST['sexo']) || empty($_POST['numero_telefono']) || empty($_POST['fecha_nacimiento']) || empty($_POST['pais']) || empty($_POST['codigo_postal']) || empty($_POST['ciudad']) || empty($_POST['cuota']))
{
    header("Location: ./user.php"); 
    exit();
}

$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$dni = $_POST['dni'];
$email = $_POST['email'];
$contraseña = $_POST['contraseña'];
$sexo = $_POST['sexo'];
$numero_telefono = $_POST['numero_telefono'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$pais = $_POST['pais'];
$codigo_postal = $_POST['codigo_postal'];
$ciudad = $_POST['ciudad'];
$selectedCuota = $_POST['cuota'];
$_SESSION['cuota'] = $selectedCuota;
$selectedCity = $_POST['ciudad'];
$_SESSION['city'] = $selectedCity;

?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Inscribete en VivaGym</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="../css/pay.css">
<link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">
</head>
<body>
<div class="container-fluid">
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h2 class="title-header">Selecciona tu cuota</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="progress-bar-icons">
                <a href="./center.php" class="icon-link">
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                </a>
                <a href="./prices.php" class="icon-link">
                    <i class="fa fa-money" aria-hidden="true"></i>
                </a>
                <a href="./user.php" class="icon-link">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </a>
                <i class="fa fa-credit-card" aria-hidden="true"></i>
            </div>
        </div>
    </div>
    <form id="userForm" action="../includes/inserts.php" method="post" class="orange-border">
        <input type="hidden" name="nombre" value="<?php echo $nombre; ?>">
        <input type="hidden" name="apellidos" value="<?php echo $apellidos; ?>">
        <input type="hidden" name="dni" value="<?php echo $dni; ?>">
        <input type="hidden" name="email" value="<?php echo $email; ?>">
        <input type="hidden" name="contraseña" value="<?php echo $contraseña; ?>">
        <input type="hidden" name="sexo" value="<?php echo $sexo; ?>">
        <input type="hidden" name="numero_telefono" value="<?php echo $numero_telefono; ?>">
        <input type="hidden" name="fecha_nacimiento" value="<?php echo $fecha_nacimiento; ?>">
        <input type="hidden" name="pais" value="<?php echo $pais; ?>">
        <input type="hidden" name="codigo_postal" value="<?php echo $codigo_postal; ?>">
        <input type="hidden" name="ciudad" value="<?php echo $selectedCity; ?>">
        <input type="hidden" name="cuota" value="<?php echo $selectedCuota; ?>">
        
        <div class="form-group">
        <label for="numero_tarjeta">Número de Tarjeta:</label>
        <input type="text" class="form-control" id="numero_tarjeta" name="numero_tarjeta" placeholder="Introduce el número de la tarjeta">
        </div>
        <div class="form-group">
        <label for="fecha_caducidad_tarjeta">Fecha de Caducidad:</label>
        <input type="date" class="form-control" id="fecha_caducidad_tarjeta" name="fecha_caducidad_tarjeta">
        </div>
        <div class="form-group">
        <label for="cvv_tarjeta">CVV:</label>
        <input type="text" class="form-control" id="cvv_tarjeta" name="cvv_tarjeta" placeholder="Introduce el Card Verification Value">
        </div>
            <!-- Botón de envío -->
            <div class="row">
                <div class="col-sm-12 text-center">
                    <button type="submit" class="btn btn-lg orange">Finalizar</button>
                </div>
            </div>
        </form>
<script src="../js/pay.js"></script>
</div>
</div>
</body>
</html>

