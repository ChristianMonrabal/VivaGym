<?php
// Iniciar la sesión
session_start();

// Verificar si el usuario ya ha iniciado sesión, si es así, redirigirlo a index.php
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: ../index.php");
    exit;
}

// Incluir el archivo de conexión a la base de datos
require_once '../includes/conexion.php';

// Definir variables e inicializar con valores vacíos
$email = $password = "";
$error_message = "";

// Procesar datos del formulario cuando se envía el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validar correo electrónico y contraseña
    if (empty(trim($_POST["email"])) || empty(trim($_POST["password"]))) {
        $error_message = "Por favor, ingresa tu correo electrónico y contraseña.";
    } else {
        $email = trim($_POST["email"]);
        $password = trim($_POST["password"]);
    }

    // Verificar si no hay errores de entrada antes de procesar la consulta
    if (empty($error_message)) {
        // Preparar la consulta SQL
        $sql = "SELECT id, email, contraseña FROM Usuarios WHERE email = ?";

        if ($stmt = $conn->prepare($sql)) {
            // Vincular variables a la declaración preparada como parámetros
            $stmt->bind_param("s", $param_email);

            // Establecer parámetros
            $param_email = $email;

            // Intentar ejecutar la declaración preparada
            if ($stmt->execute()) {
                // Almacenar el resultado
                $stmt->store_result();

                // Verificar si el correo electrónico existe, si es así, verificar la contraseña
                if ($stmt->num_rows == 1) {
                    // Vincular variables de resultado
                    $stmt->bind_result($id, $email, $hashed_password);
                    if ($stmt->fetch()) {
                        if (password_verify($password, $hashed_password)) {
                            // Contraseña correcta, iniciar sesión
                            session_start();

                            // Almacenar datos de sesión
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["email"] = $email;

                            // Redirigir al usuario a la página de inicio
                            header("location: ../index.php");
                            exit;
                        } else {
                            $error_message = "Correo o contraseña incorrectos.";
                        }
                    }
                } else {
                    $error_message = "No se encontró una cuenta con ese correo electrónico.";
                }
            } else {
                $error_message = "Algo salió mal. Por favor, inténtalo de nuevo más tarde.";
            }

            // Cerrar la declaración
            $stmt->close();
        }
    }

    // Cerrar la conexión
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicia sesión en VivaGym</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="navbar">
    <a class="navbar-brand" href="#">
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

                        echo '</div>';
                    }
                    $conn->close();
                    ?>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Empleo</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Ayuda</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-orange" href="../forms/center.php">Inscríbete</a>
            </li>
            <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle user" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo htmlspecialchars($_SESSION['email']); ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="../perfil.php">Perfil</a>
                        <a class="dropdown-item" href="../index.php?action=logout">Cerrar sesión</a>
                    </div>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="btn btn-signin" href="signin.php">Iniciar sesión</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
<body class="d-flex justify-content-center align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title mb-4 text-center">Iniciar Sesión en VivaGym</h2>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group">
                                <label for="email">Correo Electrónico:</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
                            </div>
                            <div class="form-group">
                                <label for="password">Contraseña:</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="password">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <?php 
                                if (!empty($error_message)) {
                                    echo '<div class="alert alert-danger">' . $error_message . '</div>';
                                } 
                            ?>
                            <button type="submit" class="btn btn-primary btn-lg btn-block orange">Iniciar Sesión</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="../js/main.js"></script>
<script src="../js/toggle_password.js"></script>
</body>
</html>
