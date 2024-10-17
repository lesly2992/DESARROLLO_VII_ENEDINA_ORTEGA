<?php
require_once 'validaciones.php';
require_once 'sanitizacion.php';

// Verificar si la solicitud es POST
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    echo "Acceso no permitido.";
    exit;
}

$errores = [];
$datos = [];

// Capturar y validar datos del formulario
$nombre = sanitizarEntrada($_POST['nombre']);
if (!validarNombre($nombre)) {
    $errores[] = "Nombre inválido.";
}
$datos['nombre'] = $nombre;

$email = sanitizarEntrada($_POST['email']);
if (!validarEmail($email)) {
    $errores[] = "Email inválido.";
}
$datos['email'] = $email;

$fecha_nacimiento = $_POST['fecha_nacimiento'];
if (!validarFechaNacimiento($fecha_nacimiento)) {
    $errores[] = "Fecha de nacimiento inválida o menor de 18 años.";
} else {
    $datos['edad'] = calcularEdad($fecha_nacimiento);
}

$sitio_web = sanitizarEntrada($_POST['sitio_web']);
if (!validarSitioWeb($sitio_web)) {
    $errores[] = "Sitio web inválido.";
}
$datos['sitio_web'] = $sitio_web;

$genero = $_POST['genero'];
if (!validarGenero($genero)) {
    $errores[] = "Género inválido.";
}
$datos['genero'] = $genero;

$intereses = isset($_POST['intereses']) ? $_POST['intereses'] : [];
if (!validarIntereses($intereses)) {
    $errores[] = "Intereses inválidos.";
}
$datos['intereses'] = $intereses;

$comentarios = sanitizarEntrada($_POST['comentarios']);
if (!validarComentarios($comentarios)) {
    $errores[] = "Comentarios demasiado largos.";
}
$datos['comentarios'] = $comentarios;

// Procesar la foto de perfil
if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] !== UPLOAD_ERR_NO_FILE) {
    if (!validarFotoPerfil($_FILES['foto_perfil'])) {
        $errores[] = "Foto de perfil inválida o demasiado grande.";
    } else {
        $nombre_foto = uniqid() . "_" . basename($_FILES['foto_perfil']['name']);
        $rutaDestino = "uploads/" . $nombre_foto;
        if (move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $rutaDestino)) {
            $datos['foto_perfil'] = $rutaDestino;
        } else {
            $errores[] = "Error al subir la foto de perfil.";
        }
    }
}

// Si hay errores, mostrarlos y detener el flujo
if (!empty($errores)) {
    echo "<h2>Errores:</h2>";
    echo "<ul>";
    foreach ($errores as $error) {
        echo "<li>$error</li>";
    }
    echo "</ul>";
    echo "<br><a href='formulario.php'>Volver al formulario</a>";
    exit;
}

// Guardar los datos en un archivo JSON
$archivo = 'registros.json';
$registros = file_exists($archivo) ? json_decode(file_get_contents($archivo), true) : [];
$registros[] = $datos;
file_put_contents($archivo, json_encode($registros));

// Redirigir al resumen de registros
header("Location: resumen.php");
exit();
?>
