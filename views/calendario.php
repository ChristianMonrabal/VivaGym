<?php
session_start();

if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    $_SESSION = array();
    session_destroy();
    header("location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VivaGym - Calendario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">
    <script src="../js/main.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="navbar">
    <a class="navbar-brand" href="../index.php">
        <img src="../img/icon.png" class="d-inline-block align-top" alt="VivaGym Logo">
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
                    include '../includes/conexion.php';

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
                <a class="nav-link" href="#">Calendario</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./help.php">Ayuda</a>
            </li>
            <?php if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true): ?>
                <li class="nav-item">
                    <a class="btn btn-orange" href="../forms/center.php">Inscríbete</a>
                </li>
            <?php endif; ?>
            <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle user" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo htmlspecialchars($_SESSION['email']); ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">Perfil</a>
                        <a class="dropdown-item" href="?action=logout">Cerrar sesión</a>
                        <a class="dropdown-item text-danger" href="#" data-toggle="modal" data-target="#confirmDeleteModal">Borrar cuenta</a>
                    </div>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="btn btn-signin" href="../forms/signin.php">Iniciar sesión</a>
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

<div class="container mt-5">
    <h2 class="text-center text-orange calendar">Calendario de Clases</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Hora</th>
                    <th>Lunes</th>
                    <th>Martes</th>
                    <th>Miércoles</th>
                    <th>Jueves</th>
                    <th>Viernes</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include '../includes/conexion.php';

                $dias_semana = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'];
                $horas = [
                    '08:00:00', '09:00:00', '10:00:00', '11:00:00', '12:00:00',
                    '13:00:00', '14:00:00', '15:00:00', '16:00:00', '17:00:00',
                    '18:00:00', '19:00:00', '20:00:00', '21:00:00'
                ];

                $colores_clases = [
                    'Yoga' => 'yoga',
                    'Pilates' => 'pilates',
                    'Spinning' => 'spinning',
                    'Zumba' => 'zumba',
                    'Crossfit' => 'crossfit',
                    'Boxeo' => 'boxeo',
                    'Body Pump' => 'body-pump',      
                    'HIIT' => 'hiit',                 
                    'Aerobic' => 'aerobic',        
                    'Cardio' => 'cardio',             
                    'Kickboxing' => 'kickboxing',
                    'Bailes Latinos' => 'bailes-latinos', 
                    'TRX' => 'trx', 
                    'Estiramientos' => 'estiramientos'    
                ];

                $reservas = [];
                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                    $usuario_id = $_SESSION['id'];
                    $reservas_sql = "SELECT actividad, dia_semana, hora FROM Reservas WHERE usuario_id = ?";
                    if ($stmt = $conn->prepare($reservas_sql)) {
                        $stmt->bind_param("i", $usuario_id);
                        $stmt->execute();
                        $resultado = $stmt->get_result();
                        while ($reserva = $resultado->fetch_assoc()) {
                            $reservas[] = $reserva;
                        }
                        $stmt->close();
                    }
                }

                foreach ($horas as $hora) {
                    echo '<tr>';
                    echo '<td>' . date('H:i', strtotime($hora)) . '</td>';

                    foreach ($dias_semana as $dia) {
                        $sql = "SELECT actividad, duracion, monitor, descripcion, capacidad 
                                FROM Calendario 
                                WHERE dia_semana = '$dia' AND hora = '$hora'";
                        $resultado = $conn->query($sql);

                        if ($resultado->num_rows > 0) {
                            $clase = $resultado->fetch_assoc();
                            $clase_color = isset($colores_clases[$clase['actividad']]) ? $colores_clases[$clase['actividad']] : '';

                            echo '<td class="' . $clase_color . '">';
                            $tiene_reserva = false;
                            foreach ($reservas as $reserva) {
                                if ($reserva['actividad'] == $clase['actividad'] && $reserva['dia_semana'] == $dia && $reserva['hora'] == $hora) {
                                    $tiene_reserva = true;
                                    break;
                                }
                            }

                            echo '<strong>' . $clase['actividad'] . '</strong><br>';
                            echo 'Duración: ' . $clase['duracion'] . ' min<br>';
                            echo 'Monitor: ' . $clase['monitor'] . '<br>';
                            echo 'Capacidad: ' . $clase['capacidad'] . ' personas<br>';
                            echo '<em>' . $clase['descripcion'] . '</em>';

                            if ($tiene_reserva) {
                                echo '<br><span class="icono-reserva">✔</span>';
                            }

                            echo '</td>';
                        } else {
                            echo '<td>-</td>';
                        }
                    }

                    echo '</tr>';
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <!-- Formulario de Reserva -->
    <h2 class="text-center text-orange mt-5">Reservar Clase</h2>
    <form action="../includes/reservas.php" method="POST">
        <div class="form-group">
            <label for="actividad">Actividad</label>
            <select class="form-control" id="actividad" name="actividad" required onchange="actualizarHoras()">
                <option value="" disabled selected>Seleccione una actividad</option>
                <?php
                include '../includes/conexion.php';
                $actividades_sql = "SELECT DISTINCT actividad FROM Calendario";
                $actividades_resultado = $conn->query($actividades_sql);

                while ($actividad = $actividades_resultado->fetch_assoc()) {
                    echo '<option value="' . $actividad['actividad'] . '">' . $actividad['actividad'] . '</option>';
                }
                $conn->close();
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="dia_semana">Día de la Semana</label>
            <select class="form-control" id="dia_semana" name="dia_semana" required onchange="actualizarHoras()">
                <option value="" disabled selected>Seleccione un día</option>
                <option value="Lunes">Lunes</option>
                <option value="Martes">Martes</option>
                <option value="Miércoles">Miércoles</option>
                <option value="Jueves">Jueves</option>
                <option value="Viernes">Viernes</option>
            </select>
        </div>
        <div class="form-group">
            <label for="hora">Hora</label>
            <select class="form-control" id="hora" name="hora" required>
                <option value="" disabled selected>Seleccione una hora</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary orange reservar">Reservar</button>
    </form>
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
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
function actualizarHoras() {
    var actividad = document.getElementById('actividad').value;
    var dia_semana = document.getElementById('dia_semana').value;
    var horaSelect = document.getElementById('hora');
    horaSelect.innerHTML = '<option value="" disabled selected>Seleccione una hora</option>'; // Reset options

    if (actividad && dia_semana) {
        <?php
        include '../includes/conexion.php';
        $horarios_sql = "SELECT actividad, dia_semana, hora FROM Calendario";
        $horarios_resultado = $conn->query($horarios_sql);
        $horarios = [];
        while ($horario = $horarios_resultado->fetch_assoc()) {
            $horarios[] = $horario;
        }
        $conn->close();
        ?>
        var horarios = <?php echo json_encode($horarios); ?>;
        for (var i = 0; i < horarios.length; i++) {
            if (horarios[i].actividad === actividad && horarios[i].dia_semana === dia_semana) {
                var option = document.createElement('option');
                option.value = horarios[i].hora;
                option.text = horarios[i].hora.slice(0, 5); // Format to HH:mm
                horaSelect.appendChild(option);
            }
        }
    }
}
</script>
</body>
</html>
