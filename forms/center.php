<?php
session_start(); // Iniciar la sesión

if(isset($_POST['city'])) {
    $_SESSION['city'] = $_POST['city'];
    header("Location: ./prices.php");
    exit();
}
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
<link rel="stylesheet" href="../css/center.css">
<link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h2 class="title-header">Selecciona tu ciudad</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="progress-bar-icons">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                <i class="fa fa-money" aria-hidden="true"></i>
                <i class="fa fa-user" aria-hidden="true"></i>
                <i class="fa fa-credit-card" aria-hidden="true"></i>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <form id="city-form" action="./center.php" method="post" class="border-orange form-max-width">
                <div class="form-group">
                    <label for="city-select">Selecciona tu ciudad:</label>
                    <select class="form-control" id="city-select" name="city">
                        <?php
                        include "../includes/conexion.php";
                        $sql = "SELECT DISTINCT id ciudad, nombre, direccion FROM Establecimientos";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row["ciudad"] . "'>" . $row["ciudad"] . " - " . $row["nombre"] . " - " . $row["direccion"] . "</option>";
                            }
                        }
                        $conn->close();
                        ?>
                    </select>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-lg orange">Siguiente</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
