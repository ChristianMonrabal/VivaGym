<?php
include "../includes/conexion.php";
session_start();

if(!isset($_SESSION['city'])) {
    header("Location: ./center.php");
    exit();
}

$selectedCity = $_SESSION['city'];

$sql = "SELECT id, nombre FROM Tarifas ORDER BY id ASC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $tarifas = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $tarifas = [];
}

$conn->close();
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
<link rel="stylesheet" href="../css/prices.css">
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
                <i class="fa fa-money" aria-hidden="true"></i>
                <i class="fa fa-user" aria-hidden="true"></i>
                <i class="fa fa-credit-card" aria-hidden="true"></i>
            </div>
        </div>
    </div>
    <form action="./user.php" method="post">
        <input type="hidden" name="city" value="<?php echo $selectedCity; ?>">
        <input type="hidden" name="cuota" value="">
        <div class="row">
            <div class="col-sm-4">
                <div class="card text-center">
                    <div class="title">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                        <h2>Básica</h2>
                    </div>
                    <div class="price">
                        <h4><sup>€</sup>25.00</h4>
                    </div>
                    <div class="option">
                        <ul>
                            <li> <i class="fa fa-check" aria-hidden="true"></i> Acceso a 1 gimnasio</li>
                            <li> <i class="fa fa-times" aria-hidden="true"></i> Entrenador personal</li>
                            <li> <i class="fa fa-times" aria-hidden="true"></i> Clases grupales</li>
                            <li> <i class="fa fa-times" aria-hidden="true"></i> Acceso 24/7</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card text-center">
                    <div class="title">
                        <i class="fa fa-heart" aria-hidden="true"></i>
                        <h2>Recomendada</h2>
                    </div>
                    <div class="price">
                        <h4><sup>€</sup>30.00</h4>
                    </div>
                    <div class="option">
                        <ul>
                            <li> <i class="fa fa-check" aria-hidden="true"></i> Acceso a 50 gimnasios</li>
                            <li> <i class="fa fa-check" aria-hidden="true"></i> Entrenador personal</li>
                            <li> <i class="fa fa-check" aria-hidden="true"></i> Clases grupales</li>
                            <li> <i class="fa fa-times" aria-hidden="true"></i> Acceso 24/7</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card text-center">
                    <div class="title">
                        <i class="fa fa-diamond" aria-hidden="true"></i>
                        <h2>Premium</h2>
                    </div>
                    <div class="price">
                        <h4><sup>€</sup>35.00</h4>
                    </div>
                    <div class="option">
                        <ul>
                            <li> <i class="fa fa-check" aria-hidden="true"></i> Acceso a 100 gimnasios</li>
                            <li> <i class="fa fa-check" aria-hidden="true"></i> Entrenador personal</li>
                            <li> <i class="fa fa-check" aria-hidden="true"></i> Clases grupales</li>
                            <li> <i class="fa fa-check" aria-hidden="true"></i> Acceso 24/7</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 text-center radio-container">
            <form action="./prices.php" method="post">
                <?php foreach ($tarifas as $tarifa): ?>
                    <label class="radio-label">
                        <input type="radio" id="<?php echo strtolower($tarifa['nombre']); ?>" name="cuota" value="<?php echo $tarifa['nombre']; ?>" required>
                        <span class="custom-radio"></span> <?php echo $tarifa['nombre']; ?>
                    </label>
                <?php endforeach; ?>
                <br>
                <button type="submit" class="btn btn-orange">Siguiente</button>
            </form>
        </div>
    </div>
</div>

    </form>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
