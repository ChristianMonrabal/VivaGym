<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VivaGym</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="shortcut icon" href="./img/icon.png" type="image/x-icon">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="navbar">
    <a class="navbar-brand" href="#">
        <img src="./img/icon.png" class="d-inline-block align-top" alt="VivaGym Logo">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item dropdown" onmouseover="mostrarEstablecimientos(this)">
                <a class="nav-link dropdown-toggle" href="#" id="clubesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Clubes
                </a>
                <div class="dropdown-menu" aria-labelledby="clubesDropdown">
                <?php
                    include './includes/conexion.php';

                    // Consulta SQL para obtener las ciudades
                    $ciudades_sql = "SELECT DISTINCT ciudad FROM Establecimientos";
                    $ciudades_resultado = $conn->query($ciudades_sql);

                    // Variable para generar un ID único para cada ciudad
                    $ciudad_index = 0;

                    while ($ciudad = $ciudades_resultado->fetch_assoc()) {
                        $ciudad_id = strtolower(str_replace(' ', '_', $ciudad['ciudad']));
                        $ciudad_index++; // Incrementar el índice para generar un ID único

                        // Generar un ID único y establecerlo como aria-labelledby para el elemento de la ciudad
                        echo '<a class="dropdown-item dropdown-toggle" href="#" id="ciudad_' . $ciudad_index . '" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' . $ciudad['ciudad'] . '</a>';
                        echo '<div class="dropdown-menu" aria-labelledby="ciudad_' . $ciudad_index . '">';

                        // Consulta SQL para obtener los establecimientos de la ciudad actual
                        $establecimientos_sql = "SELECT nombre, direccion FROM Establecimientos WHERE ciudad = '{$ciudad['ciudad']}'";
                        $establecimientos_resultado = $conn->query($establecimientos_sql);

                        while ($establecimiento = $establecimientos_resultado->fetch_assoc()) {
                            echo '<a class="dropdown-item" href="https://www.google.com/maps/search/?api=1&query=' . urlencode($establecimiento['direccion']) . '" target="_blank">' . $establecimiento['nombre'] . ' - ' . $establecimiento['direccion'] . '</a>';
                        }

                        echo '</div>'; // Cierre de dropdown-menu
                    }

                    // Cerrar conexión
                    $conn->close();
                    ?>
                </div> <!-- Cierre de dropdown-menu -->
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Empleo</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Ayuda</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-orange" href="#">Inscríbete</a>
            </li>
        </ul>
    </div>
</nav>



<div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="3000">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="./img/slider1.png" class="d-block w-100" alt="Slider 1">
        </div>
        <div class="carousel-item">
            <img src="./img/slider2.png" class="d-block w-100" alt="Slider 2">
        </div>
        <div class="carousel-item">
            <img src="./img/slider3.png" class="d-block w-100" alt="Slider 3">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<div class="container">
    <h2 class="text-center text-orange" id="vivagym">¿Por qué VivaGym?</h2>
    <div class="row">
        <div class="col-md-3 text-center">
            <img src="./img/permanencia.png">
            <h4>Sin permanencia</h4>
            <p>Así es, en VivaGym tienes la máxima flexibilidad posible para darte de baja cuando desees ya que no tenemos permanencia mínima (¡sin letra pequeña!)</p>
        </div>
        <div class="col-md-3 text-center">
            <img src="./img/instalacion.png">
            <h4>Amplias instalaciones</h4>
            <p>Te ofrecemos 7 zonas diferentes de entrenamiento para que hagas tu rutina como más te gusta. ¡Todo lo que necesitas para entrenar a tu manera!</p>
        </div>
        <div class="col-md-3 text-center">
            <img src="./img/actividades.png">
            <h4>Gran variedad de actividades dirigidas</h4>
            <p>En VivaGym no hay lugar para el aburrimiento. Encuentra las mejores actividades dirigidas: Clases Les Mills, Zumba, Hyrox, Cycling… ¡vas a querer probar todas!</p>
        </div>
        <div class="col-md-3 text-center">
            <img src="./img/horario.png">
            <h4>Amplio horario de apertura</h4>
            <p>¡Ven cuando quieras! En VivaGym abrimos 363 días al año con un amplio horario de apertura. ¡Todas las opciones están a tu alcance!</p>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12 footer-info">
                <p>© VIVAGYM - RESERVADOS TODOS LOS DERECHOS</p>
            </div>
        </div>
    </div>
</footer>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="./js/main.js"></script>
</body>
</html>