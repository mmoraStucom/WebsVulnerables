<?php
session_name("StarWarsCookie");
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: ../index.php");
    exit();
}
// Admin Check
$username = $_SESSION['username'] ?? '';
if ($username !== 'admin') {
    header("Location: fail.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>⭐</text></svg>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estrella de la Muerte - Panel de Admin</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <div class="dashboard-container">
        <div class="dashboard-header">
            <h1>⚙ Panel de Control Admin</h1>
            <a href="../logout.php" class="btn-logout">⏻ Desconectar</a>
        </div>

        <div class="welcome-box">
            <h2>> Herramientas Administrativas</h2>
            <p style="color: var(--sw-text);">Bienvenido al área restringida de administración. Las siguientes
                herramientas están disponibles:</p>
            <div class="status-grid" style="margin-top: 1rem;">
                <a href="terminal.php" style="text-decoration: none;">
                    <div class="status-card" style="cursor: pointer;">
                        <span class="value">▶</span>
                        <span class="label">Escáner de Naves Rebeldes</span>
                    </div>
                </a>
                <a href="destruct.php" style="text-decoration: none;">
                    <div class="status-card" style="cursor: pointer; border-color: var(--sw-red);">
                        <span class="value" style="color: var(--sw-red);">🔓</span>
                        <span class="label">Control de Ventilación Térmica</span>
                    </div>
                </a>
            </div>
        </div>

        <div class="footer">
            Imperio Galáctico &bull; Acceso Administrativo &bull; Nivel: Comandante Supremo
        </div>
    </div>
</body>

</html>
