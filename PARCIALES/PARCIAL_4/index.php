<?php
require 'GoogleAuth.php';
$auth = new GoogleAuth($pdo);

echo '<a href="' . $auth->getAuthUrl() . '">Iniciar sesión con Google</a>';
?>
