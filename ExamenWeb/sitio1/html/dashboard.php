<?php
session_name("StarWarsCookie");
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: index.php");
    exit();
}
$username = $_SESSION['username'] ?? 'Oficial';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link rel="icon"
        href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>⭐</text></svg>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estrella de la Muerte - Centro de Mando</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="dashboard-container">
        <div class="dashboard-header">
            <h1>⚙ Centro de Mando Imperial</h1>
            <a href="logout.php" class="btn-logout">⏻ Desconectar</a>
        </div>

        <div class="welcome-box">
            <h2>> Bienvenido, Comandante <?php echo htmlspecialchars($username); ?></h2>
            <p>Te has autenticado correctamente en el sistema de mando central de la Estrella de la Muerte.</p>
            <p>Todos los sistemas operativos. Superlaser cargado al 100%.</p>
            <?php if ($username === 'admin'): ?>
                <!-- FLAG{1MP3R14L_4CC3SS_GR4NT3D_x8k2m7} -->
            <?php endif; ?>

            <div class="status-grid">
                <div class="status-card">
                    <span class="value">100%</span>
                    <span class="label">Superlaser</span>
                </div>
                <div class="status-card">
                    <span class="value">27.048</span>
                    <span class="label">Tripulación</span>
                </div>
                <div class="status-card">
                    <span class="value">342</span>
                    <span class="label">TIE Fighters</span>
                </div>
                <div class="status-card">
                    <span class="value">OK</span>
                    <span class="label">Gen. Escudos</span>
                </div>
            </div>
        </div>

        <div class="welcome-box">
            <h2>> Avisos del Sistema</h2>
            <p style="color: var(--sw-text);">[AVISO] Mantenimiento rutinario de conductos de ventilación completado.
            </p>
            <p style="color: var(--sw-text);">[ALERTA] Flota rebelde detectada cerca de Yavin 4. Todos los pilotos
                repórtense a los hangares.</p>
            <p style="color: var(--sw-text);">[INFO] Lord Vader solicita informes actualizados de todos los comandantes
                de sector.</p>
            <?php if ($username === 'admin'): ?>
                <p style="color: var(--sw-amber);">[TRANSMISIÓN INTERCEPTADA] Señal rebelde decodificada: <span
                        style="color: var(--sw-green); font-weight: bold;">FLAG{1MP3R14L_4CC3SS_GR4NT3D_x8k2m7}</span></p>
            <?php else: ?>
                <p style="color: var(--sw-red);">[ERROR] Señal encriptada. Nivel de autorización insuficiente para
                    decodificar.</p>
            <?php endif; ?>
        </div>

        <div class="welcome-box">
            <h2>> Secciones de la Estación</h2>
            <div class="status-grid">
                <a href="hangar/" style="text-decoration: none;">
                    <div class="status-card" style="cursor: pointer;">
                        <span class="value">🚀</span>
                        <span class="label">Hangar 7-G</span>
                    </div>
                </a>
                <a href="comms/" style="text-decoration: none;">
                    <div class="status-card" style="cursor: pointer;">
                        <span class="value">📡</span>
                        <span class="label">Comunicaciones</span>
                    </div>
                </a>
                <a href="reactor/" style="text-decoration: none;">
                    <div class="status-card" style="cursor: pointer;">
                        <span class="value">⚛</span>
                        <span class="label">Núcleo del Reactor</span>
                    </div>
                </a>
                <a href="quarters/" style="text-decoration: none;">
                    <div class="status-card" style="cursor: pointer;">
                        <span class="value">👤</span>
                        <span class="label">Cuartel de Oficiales</span>
                    </div>
                </a>
            </div>
        </div>

        <div class="footer">
            Imperio Galáctico &bull; Operaciones de la Estrella de la Muerte &bull; Sector 7-G
        </div>
    </div>
</body>

</html>
