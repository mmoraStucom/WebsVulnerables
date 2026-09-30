<?php
// Rabbit hole - Reactor Core
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>⭐</text></svg>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estrella de la Muerte - Núcleo del Reactor</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        .reactor-bar {
            width: 100%;
            height: 20px;
            background: var(--sw-dark);
            border: 1px solid var(--sw-gray);
            border-radius: 4px;
            overflow: hidden;
            margin: 0.5rem 0 1rem 0;
        }

        .reactor-bar .fill {
            height: 100%;
            border-radius: 3px;
            transition: width 2s ease;
        }

        .fill-green {
            background: linear-gradient(90deg, #003300, var(--sw-green));
            width: 94%;
        }

        .fill-amber {
            background: linear-gradient(90deg, #4a3600, var(--sw-amber));
            width: 78%;
        }

        .fill-red {
            background: linear-gradient(90deg, #3a0000, var(--sw-red));
            width: 62%;
        }

        .fill-blue {
            background: linear-gradient(90deg, #003040, var(--sw-blue));
            width: 100%;
        }

        .blink-warning {
            animation: blink-alert 1.5s ease-in-out infinite;
        }

        @keyframes blink-alert {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.4;
            }
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <div class="dashboard-header">
            <h1>⚛ Núcleo del Reactor — Monitorización</h1>
            <a href="../dashboard.php" class="btn-logout">← Volver</a>
        </div>

        <div class="welcome-box">
            <h2>> Estado del Reactor Principal</h2>
            <p style="color: var(--sw-text);">Reactor de Hipermáteria SFS-CR27200 — Operativo</p>

            <p style="color: var(--sw-green); margin-top: 1rem;">Potencia de Salida: 94%</p>
            <div class="reactor-bar">
                <div class="fill fill-green"></div>
            </div>

            <p style="color: var(--sw-amber);">Temperatura del Núcleo: 78% (Dentro de parámetros)</p>
            <div class="reactor-bar">
                <div class="fill fill-amber"></div>
            </div>

            <p style="color: var(--sw-red);">Integridad del Blindaje: 62% <span class="blink-warning">⚠</span></p>
            <div class="reactor-bar">
                <div class="fill fill-red"></div>
            </div>

            <p style="color: var(--sw-blue);">Reserva de Refrigerante: 100%</p>
            <div class="reactor-bar">
                <div class="fill fill-blue"></div>
            </div>
        </div>

        <div class="welcome-box">
            <h2>> Registro de Incidencias del Reactor</h2>
            <p style="color: var(--sw-text);">[08:14] Ciclo de enfriamiento completado. Todos los parámetros normales.
            </p>
            <p style="color: var(--sw-text);">[09:32] Micro-fluctuación detectada en el circuito secundario de
                contención. Ajuste automático aplicado.</p>
            <p style="color: var(--sw-amber);">[11:47] AVISO: Conducto de ventilación térmico R-421 muestra lecturas
                anómalas. Técnicos enviados.</p>
            <p style="color: var(--sw-text);">[13:05] Prueba de carga al 110% completada exitosamente. Superlaser
                calibrado.</p>
            <p style="color: var(--sw-text);">[14:22] Rotación del personal de mantenimiento del turno diurno
                completada.</p>
            <p style="color: var(--sw-red);">[15:38] ALERTA: Sonda de temperatura en sector 7 fuera de rango. Revisión
                manual requerida.</p>
            <p style="color: var(--sw-text);">[16:50] Sonda sector 7 recalibrada. Falsa alarma — sensor defectuoso
                reemplazado.</p>
        </div>

        <div class="welcome-box">
            <h2>> Especificaciones Técnicas</h2>
            <p style="color: var(--sw-text);">Tipo de reactor: Hipermáteria SFS-CR27200</p>
            <p style="color: var(--sw-text);">Combustible: Cristales Kyber refinados (Jedha)</p>
            <p style="color: var(--sw-text);">Potencia máxima: 7.73 × 10^32 W</p>
            <p style="color: var(--sw-text);">Conductos de ventilación: 384 (2m diámetro)</p>
            <p style="color: var(--sw-text);">Puerto de escape térmico principal: Conducto R-421</p>
            <p style="color: var(--sw-text);">Profundidad del conducto: Conecta directamente con el núcleo del reactor
            </p>
            <p style="color: var(--sw-amber); font-size: 0.75rem; margin-top: 1rem;">
                NOTA CLASIFICADA: El ingeniero Galen Erso dejó una nota sobre una "vulnerabilidad intencionada"
                en el conducto R-421. El Alto Mando ha descartado esta información como irrelevante.
                Archivo cerrado por orden del Director Krennic.
            </p>
            <!-- config_backup: reactor_core_access=kyber_crystal_2187 | root_maintenance_panel=/reactor/maintenance.php -->
        </div>

        <div class="footer">
            Imperio Galáctico &bull; Ingeniería del Reactor &bull; Acceso Restringido Nivel 4
        </div>
    </div>
</body>

</html>