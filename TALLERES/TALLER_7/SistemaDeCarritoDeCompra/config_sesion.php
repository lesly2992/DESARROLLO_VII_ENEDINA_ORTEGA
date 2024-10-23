<?php
// Configuración de la sesión
session_start([
    'cookie_lifetime' => 86400,  // 1 día
    'cookie_httponly' => true,   // Previene acceso a cookies desde JavaScript
    'use_strict_mode' => true,   // Mitigación de ataques de fijación de sesión
    'use_only_cookies' => true,  // Solo cookies para las sesiones
    'cookie_secure' => isset($_SERVER['HTTPS']), // Cookies solo con HTTPS
]);
?>
