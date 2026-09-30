<?php
// Rabbit hole - Communications Center
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>⭐</text></svg>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estrella de la Muerte - Centro de Comunicaciones</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <div class="dashboard-container">
        <div class="dashboard-header">
            <h1>📡 Centro de Comunicaciones</h1>
            <a href="../dashboard.php" class="btn-logout">← Volver</a>
        </div>

        <div class="welcome-box">
            <h2>> Estado de las Comunicaciones</h2>
            <div class="status-grid">
                <div class="status-card">
                    <span class="value">ACTIVO</span>
                    <span class="label">HoloNet Imperial</span>
                </div>
                <div class="status-card">
                    <span class="value">3</span>
                    <span class="label">Frecuencias Monitorizadas</span>
                </div>
                <div class="status-card">
                    <span class="value">CIFRADO</span>
                    <span class="label">Canal Vader</span>
                </div>
                <div class="status-card">
                    <span class="value">147</span>
                    <span class="label">Mensajes Hoy</span>
                </div>
            </div>
        </div>

        <div class="welcome-box">
            <h2>> Transmisiones Interceptadas</h2>
            <p style="color: var(--sw-green);">[CANAL IMPERIAL - ABIERTO]</p>
            <p style="color: var(--sw-text);">DE: Almirante Motti | PARA: Todos los Comandantes de Sector</p>
            <p style="color: var(--sw-text);">"Recuerdo a todo el personal que el superlaser estará en pruebas de
                calibración
                durante las próximas 72 horas. Eviten acercarse a los conductos principales de energía."</p>
            <br>
            <p style="color: var(--sw-amber);">[CANAL CIFRADO - PARCIALMENTE DECODIFICADO]</p>
            <p style="color: var(--sw-text);">DE: ??? | PARA: ???</p>
            <p style="color: var(--sw-text);">
                "...l0s pl4n0s h4n s1d0 tr4nsm1t1d0s... l4 pr1nc3s4 t13n3 l4 1nf0rm4c10n...
                3l pu3rt0 d3 3sc4p3 t3rm1c0 3s l4 cl4v3... n0 p0dr4n d3t3n3rn0s..."
            </p>
            <br>
            <p style="color: var(--sw-red);">[CANAL REBELDE - INTERCEPTADO]</p>
            <p style="color: var(--sw-text);">DE: Líder Rojo | PARA: Base Yavin</p>
            <p style="color: var(--sw-text);">"Confirmamos recepción de los planos. El análisis muestra una debilidad
                estructural
                en el conducto de ventilación del reactor. Preparando escuadrón de ataque. Que la Fuerza nos acompañe."
            </p>
        </div>

        <div class="welcome-box">
            <h2>> Frecuencias Monitorizadas</h2>
            <p style="color: var(--sw-text);">FREQ-7700 — Canal de emergencia Imperial ................. <span
                    style="color: var(--sw-green);">LIMPIO</span></p>
            <p style="color: var(--sw-text);">FREQ-1138 — Canal táctico de la flota .................... <span
                    style="color: var(--sw-green);">LIMPIO</span></p>
            <p style="color: var(--sw-text);">FREQ-0066 — Canal secreto del Emperador .................. <span
                    style="color: var(--sw-red);">BLOQUEADO</span></p>
            <p style="color: var(--sw-text);">FREQ-2187 — Canal de la Alianza Rebelde .................. <span
                    style="color: var(--sw-amber);">MONITORIZANDO</span></p>
            <!-- TODO: Investigar frecuencia 2187 - posible punto de acceso al sistema rebelde. Clave provisional: R2D2-C3PO-LEIA -->
        </div>

        <div class="footer">
            Imperio Galáctico &bull; División de Inteligencia Imperial &bull; Clasificado
        </div>
    </div>
</body>

</html>