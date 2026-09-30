<?php // Señuelo ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link rel="icon"
        href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🖖</text></svg>">
    <title>USS Enterprise - Buscados</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <div class="lcars-bar-top">
        <div class="lcars-elbow-top">NCC-1701</div>
        <div class="lcars-strip-top">
            <div class="block"></div>
            <div class="block"></div>
        </div>
    </div>
    <div class="lcars-layout">
        <div class="lcars-sidebar">
            <div class="panel red">BUSCADOS</div>
            <div class="panel orange">CRIMEN</div>
            <div class="panel yellow">ALERTA</div>
            <div class="panel blue">DATABASE</div>
        </div>
        <div class="lcars-content">
            <div class="page-header">
                <h1>Base de Datos de Seguridad</h1>
                <p class="subtitle">Individuos Buscados por la Federación de Planetas Unidos</p>
            </div>

            <div class="nav-links">
                <a href="../index.php" class="nav-link">← Volver al Puente</a>
            </div>

            <div class="alert-box danger">
                ⚠ ALERTA DE SEGURIDAD: Los siguientes individuos se consideran peligrosos. Contactar con seguridad
                inmediatamente si son avistados.
            </div>

            <div class="content-box">
                <h2>🔍 Destacados</h2>

                <div style="display:flex; gap:2rem; flex-wrap:wrap; margin-top:1rem;">
                    <!-- Harry Mudd -->
                    <div
                        style="flex:1; min-width:300px; background:rgba(255,153,0,0.05); padding:1rem; border:1px solid var(--lcars-orange-dim); border-radius:10px;">
                        <h3
                            style="color:var(--lcars-orange); text-transform:uppercase; border-bottom:1px solid var(--lcars-orange); margin-bottom:0.5rem;">
                            Harcourt Fenton Mudd</h3>
                        <p><strong>Alias:</strong> Harry Mudd</p>
                        <p><strong>Especie:</strong> Humano</p>
                        <p><strong>Cargos:</strong> Contrabando, fraude interestelar, transporte ilegal de mercancías,
                            operación de nave sin licencia.</p>
                        <p style="margin-top:0.5rem; color:var(--lcars-red);"><strong>Prioridad:</strong> MEDIA -
                            Capturar para interrogatorio.</p>
                    </div>

                    <!-- Khan -->
                    <div
                        style="flex:1; min-width:300px; background:rgba(204,102,102,0.05); padding:1rem; border:1px solid var(--lcars-red); border-radius:10px;">
                        <h3
                            style="color:var(--lcars-red); text-transform:uppercase; border-bottom:1px solid var(--lcars-red); margin-bottom:0.5rem;">
                            Khan Noonien Singh</h3>
                        <p><strong>Alias:</strong> Khan</p>
                        <p><strong>Especie:</strong> Humano (Aumentado)</p>
                        <p><strong>Cargos:</strong> Tiranía genética, crímenes de guerra, intento de secuestro de la USS
                            Enterprise.</p>
                        <p style="margin-top:0.5rem; color:var(--lcars-red);"><strong>Prioridad:</strong> EXTREMA -
                            Aproximarse con máxima precaución.</p>
                    </div>
                </div>
            </div>

            <div class="content-box">
                <h2>📡 Últimos Reportes de Inteligencia</h2>
                <ul style="list-style:none; padding:0;">
                    <li style="padding:0.5rem 0; border-bottom:1px solid rgba(255,255,255,0.1);">>> Actividad sospechosa
                        detectada en el Sector 9 (Zona Neutral Romulana).</li>
                    <li style="padding:0.5rem 0; border-bottom:1px solid rgba(255,255,255,0.1);">>> Robo de cristales de
                        dilitio reportado en la estación minera Janus VI.</li>
                    <li style="padding:0.5rem 0; border-bottom:1px solid rgba(255,255,255,0.1);">>> Tribbles confiscados
                        en la estación K-7. Cuarentena efectiva.</li>
                </ul>
            </div>
        </div>
    </div>
</body>

</html>