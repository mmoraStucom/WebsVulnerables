<?php
// Rabbit hole - Hangar Bay
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>⭐</text></svg>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estrella de la Muerte - Hangar 7-G</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <div class="dashboard-container">
        <div class="dashboard-header">
            <h1>🚀 Hangar 7-G — Control de Naves</h1>
            <a href="../dashboard.php" class="btn-logout">← Volver</a>
        </div>

        <div class="welcome-box">
            <h2>> Inventario de Naves Activas</h2>
            <div class="status-grid">
                <div class="status-card">
                    <span class="value">127</span>
                    <span class="label">TIE Fighters</span>
                </div>
                <div class="status-card">
                    <span class="value">34</span>
                    <span class="label">TIE Interceptors</span>
                </div>
                <div class="status-card">
                    <span class="value">12</span>
                    <span class="label">TIE Bombers</span>
                </div>
                <div class="status-card">
                    <span class="value">1</span>
                    <span class="label">Lambda Shuttle (Vader)</span>
                </div>
            </div>
        </div>

        <div class="welcome-box">
            <h2>> Registro de Vuelos Recientes</h2>
            <p style="color: var(--sw-text);">[14:32] TIE-0217 — Patrulla sector 7. Sin incidentes. Piloto: TK-421.</p>
            <p style="color: var(--sw-text);">[15:01] TIE-0089 — Intercepción fallida. Nave rebelde escapó al
                hiperespacio. Piloto: TK-338.</p>
            <p style="color: var(--sw-text);">[15:44] Lambda-01 — Lord Vader regresó de inspeccionar la flota.
                Aterrizaje en plataforma VIP.</p>
            <p style="color: var(--sw-text);">[16:12] TIE-0142 — Entrenamientoformación Delta. 4 TIE en formación. Sin
                bajas.</p>
            <p style="color: var(--sw-amber);">[16:55] ALERTA — Caza rebelde X-Wing detectado en sector 12. Escuadrón
                Obsidian desplegado.</p>
            <p style="color: var(--sw-text);">[17:30] TIE-0301 — Regreso de escolta a destructor estelar Devastator.</p>
        </div>

        <div class="welcome-box">
            <h2>> Mantenimiento Programado</h2>
            <p style="color: var(--sw-text);">Los técnicos reportan que el TIE-0421 tiene un fallo en el panel izquierdo
                de navegación.
                Se ha solicitado un repuesto al destructor estelar <em>Avenger</em>. Tiempo estimado de llegada: 48h
                estándar.</p>
            <p style="color: var(--sw-text);">Nota del Oficial Praxis: "He revisado los conductos de combustible del
                hangar y todo está en orden.
                El turbo-láser de babor del TIE-0089 necesita recalibración tras el intento de intercepción."</p>
            <!-- Nota del técnico: las contraseñas del panel de navegación se resetearon a valores por defecto. Espero que nadie lea esto... -->
        </div>

        <div class="footer">
            Imperio Galáctico &bull; Operaciones de Hangar &bull; Bahía 7-G
        </div>
    </div>
</body>

</html>