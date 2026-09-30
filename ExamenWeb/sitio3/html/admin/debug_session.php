<?php
session_name("StarTrekCookie");
session_start();

echo "<h2>Debug de Sesión</h2>";
echo "<p><strong>Session ID:</strong> " . session_id() . "</p>";
echo "<p><strong>Cookie recibida:</strong> " . htmlspecialchars($_COOKIE['StarTrekCookie'] ?? 'No cookie') . "</p>";
echo "<p><strong>Contenido de \$_SESSION:</strong></p>";
echo "<pre>";
var_dump($_SESSION);
echo "</pre>";

echo "<p><strong>Ruta de la cookie (params):</strong></p>";
print_r(session_get_cookie_params());

echo "<p><a href='index.php'>Intentar ir al Admin</a></p>";
?>