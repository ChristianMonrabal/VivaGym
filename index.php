<?php
session_start();

if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    $_SESSION = array();
    session_destroy();
    header("location: ./index.php");
    exit;
}
?>

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
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="clubesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Clubes
                </a>
                <div class="dropdown-menu" aria-labelledby="clubesDropdown">
                <?php
                    include './includes/conexion.php';

                    $ciudades_sql = "SELECT DISTINCT ciudad FROM Establecimientos";
                    $ciudades_resultado = $conn->query($ciudades_sql);

                    $ciudad_index = 0;

                    while ($ciudad = $ciudades_resultado->fetch_assoc()) {
                        $ciudad_id = strtolower(str_replace(' ', '_', $ciudad['ciudad']));
                        $ciudad_index++;

                        echo '<a class="dropdown-item dropdown-toggle" href="#" id="ciudad_' . $ciudad_index . '" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' . $ciudad['ciudad'] . '</a>';
                        echo '<div class="dropdown-menu" aria-labelledby="ciudad_' . $ciudad_index . '">';

                        $establecimientos_sql = "SELECT nombre, direccion FROM Establecimientos WHERE ciudad = '{$ciudad['ciudad']}'";
                        $establecimientos_resultado = $conn->query($establecimientos_sql);

                        while ($establecimiento = $establecimientos_resultado->fetch_assoc()) {
                            echo '<a class="dropdown-item" href="https://www.google.com/maps/search/?api=1&query=' . urlencode($establecimiento['direccion']) . '" target="_blank">' . $establecimiento['nombre'] . ' - ' . $establecimiento['direccion'] . '</a>';
                        }

                        echo '</div>';
                    }
                    $conn->close();
                    ?>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./views/calendario.php">Calendario</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./views/help.php">Ayuda</a>
            </li>
            <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle user" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo htmlspecialchars($_SESSION['email']); ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="./forms/actualizar_user.php">Actualizar perfil</a>
                        <a class="dropdown-item" href="?action=logout">Cerrar sesión</a>
                        <a class="dropdown-item text-danger" href="#" data-toggle="modal" data-target="#confirmDeleteModal">Borrar cuenta</a>
                    </div>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="btn btn-orange" href="./forms/center.php">Inscríbete</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-signin" href="./forms/signin.php">Iniciar sesión</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>

<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar eliminación de cuenta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas borrar tu cuenta? Esto anulará tu suscripción.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <a href="./includes/drops.php" class="btn btn-danger">Borrar cuenta</a>
            </div>
        </div>
    </div>
</div>

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
        <div class="col-md-3 text-center enlarge-on-hover">
            <img src="./img/permanencia.png">
            <h4>Sin permanencia</h4>
            <p>Así es, en VivaGym tienes la máxima flexibilidad posible para darte de baja cuando desees ya que no tenemos permanencia mínima (¡sin letra pequeña!)</p>
        </div>
        <div class="col-md-3 text-center enlarge-on-hover">
            <img src="./img/instalacion.png">
            <h4>Amplias instalaciones</h4>
            <p>Te ofrecemos 7 zonas diferentes de entrenamiento para que hagas tu rutina como más te gusta. ¡Todo lo que necesitas para entrenar a tu manera!</p>
        </div>
        <div class="col-md-3 text-center enlarge-on-hover">
            <img src="./img/actividades.png">
            <h4>Gran variedad de actividades dirigidas</h4>
            <p>En VivaGym no hay lugar para el aburrimiento. Encuentra las mejores actividades dirigidas: Clases Les Mills, Zumba, Hyrox, Cycling… ¡vas a querer probar todas!</p>
        </div>
        <div class="col-md-3 text-center enlarge-on-hover">
            <img src="./img/horario.png">
            <h4>Amplio horario de apertura</h4>
            <p>¡Ven cuando quieras! En VivaGym abrimos 363 días al año con un amplio horario de apertura. ¡Todas las opciones están a tu alcance!</p>
        </div>
    </div>
</div>

<div class="container mt-5">
        <h2 class="text-center text-orange mb-4">¿Quieres trabajar con nosotros?</h2>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form-container">
                    <form id="jobForm" action="./includes/insert_candidatos.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nombreCompleto">Nombre Completo</label>
                            <input type="text" class="form-control" id="nombreCompleto" name="nombreCompleto">
                            <div class="error" id="errorNombreCompleto"></div>
                        </div>
                        <div class="form-group">
                            <label for="telefono">Número de Teléfono</label>
                            <input type="tel" class="form-control" id="telefono" name="telefono">
                            <div class="error" id="errorTelefono"></div>
                        </div>
                        <div class="form-group">
                            <label for="email">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" name="email">
                            <div class="error" id="errorEmail"></div>
                        </div>
                        <div class="form-group">
                            <label for="cv">Subir Currículum (PDF o Word)</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="cv" name="cv" accept=".pdf,.doc,.docx">
                                <label class="custom-file-label" for="cv">Elige archivo...</label>
                            </div>
                            <div class="error" id="errorCv"></div>
                        </div>
                        <div class="d-flex btn-center">
                            <button type="submit" class="btn btn-orange">Enviar</button>
                        </div>
                    </form>
                </div>
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
<script src="./js/user.js"></script>
</body>
</html>
