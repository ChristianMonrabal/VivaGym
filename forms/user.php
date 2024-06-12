<?php
session_start(); // Iniciar la sesión

if(!isset($_SESSION['city'])) {
    header("Location: ./center.php"); // Redirigir a center.php
    exit();
}

if(empty($_POST['cuota'])) {
    header("Location: ./prices.php"); // Redirigir a prices.php si no se selecciona una cuota
    exit();
}

$selectedCuota = $_POST['cuota'];
$_SESSION['cuota'] = $selectedCuota;
$selectedCity = $_SESSION['city'];
$selectedCuota = $_SESSION['cuota'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Inscríbete en VivaGym</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/user.css">
    <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="../js/forms.js"></script>
</head>
<body>
<div class="container-fluid">
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h2 class="title-header">Rellena tus datos personales</h2>
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
                <a href="./center.php" class="icon-link">
                    <i class="fa fa-money" aria-hidden="true"></i>
                </a>
                <i class="fa fa-user" aria-hidden="true"></i>
                <i class="fa fa-credit-card" aria-hidden="true"></i>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="scrollable-form-container">
            <form id="userForm" action="./pay.php" method="post">
                <input type="hidden" name="city" value="<?php echo $selectedCity; ?>">
                <input type="hidden" name="cuota" value="<?php echo $selectedCuota; ?>">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="Christian" placeholder="Introduce tu nombre">
                    <small class="error text-danger" style="display: none;">Este campo es obligatorio</small>
                </div>
                <div class="form-group">
                    <label for="apellidos">Apellidos:</label>
                    <input type="text" class="form-control" id="apellidos" name="apellidos" value="Monrabal Donis" placeholder="Introduce tus apellidos">
                    <small class="error text-danger" style="display: none;">Este campo es obligatorio</small>
                </div>
                <div class="form-group">
                    <label for="dni">DNI:</label>
                    <input type="text" class="form-control" id="dni" name="dni" value="49189559B" placeholder="Introduce tu DNI">
                    <small class="error text-danger" style="display: none;">Este campo es obligatorio</small>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="christian@gmail.com" placeholder="Introduce tu email">
                    <small class="error text-danger" style="display: none;">Este campo es obligatorio</small>
                    <small class="error text-danger" id="email-error" style="display: none;">Correo electrónico inválido</small>
                </div>
                <div class="form-group">
                    <label for="contraseña">Contraseña:</label>
                    <input type="password" class="form-control" id="contraseña" name="contraseña" value="qweQWE123" placeholder="Introduce tu contraseña">
                    <small class="error text-danger" style="display: none;">Este campo es obligatorio</small>
                </div>
                <div class="form-group">
                    <label for="sexo">Sexo:</label>
                    <select class="form-control" id="sexo" name="sexo" placeholder="Selecciona tu sexo">
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                        <option value="Otro">Otro</option>
                    </select>
                    <small class="error text-danger" style="display: none;">Este campo es obligatorio</small>
                </div>
                <div class="form-group">
                    <label for="numero_telefono">Número de Teléfono:</label>
                    <input type="text" class="form-control" id="numero_telefono" name="numero_telefono" value="620668678" placeholder="Introduce tu número de teléfono">
                    <small class="error text-danger" style="display: none;">Este campo es obligatorio</small>
                    <small class="error text-danger" id="telefono-error" style="display: none;">El número de teléfono debe tener 9 dígitos</small>
                </div>
                <div class="form-group">
                    <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="2004-04-26" placeholder="Selecciona tu fecha de nacimiento">
                    <small class="error text-danger" style="display: none;">Este campo es obligatorio</small>
                    <small class="error text-danger" id="edad-error" style="display: none;">Debe ser mayor de 18 años</small>
                </div>
                <div class="form-group">
                    <label for="pais">País:</label>
                    <input type="text" class="form-control" id="pais" name="pais" value="españa" placeholder="Introduce tu país">
                    <small class="error text-danger" style="display: none;">Este campo es obligatorio</small>
                </div>
                <div class="form-group">
                    <label for="codigo_postal">Código Postal:</label>
                    <input type="text" class="form-control" id="codigo_postal" name="codigo_postal" value="08905" placeholder="Introduce tu código postal">
                    <small class="error text-danger" style="display: none;">Este campo es obligatorio</small>
                </div>
                <div class="form-group">
                    <label for="ciudad">Ciudad:</label>
                    <input type="text" class="form-control" id="ciudad" name="ciudad" value="barcelona" placeholder="Introduce tu ciudad">
                    <small class="error text-danger" style="display: none;">Este campo es obligatorio</small>
                </div>
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <button type="submit" class="btn btn-lg orange">Siguiente</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
</div>
</body>
</html>

                        