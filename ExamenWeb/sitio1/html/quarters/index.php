<?php
// Rabbit hole - Officers' Quarters
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>⭐</text></svg>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estrella de la Muerte - Cuartel de Oficiales</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        .officer-card {
            background: var(--sw-dark);
            border: 1px solid var(--sw-gray);
            border-radius: 6px;
            padding: 1.2rem;
            margin-bottom: 1rem;
            transition: border-color 0.3s;
        }

        .officer-card:hover {
            border-color: var(--sw-green-dim);
        }

        .officer-name {
            font-family: 'Orbitron', sans-serif;
            font-size: 0.9rem;
            color: var(--sw-amber);
            letter-spacing: 2px;
            margin-bottom: 0.5rem;
        }

        .officer-rank {
            color: var(--sw-green);
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 0.8rem;
        }

        .officer-info {
            color: var(--sw-text);
            font-size: 0.85rem;
            line-height: 1.6;
        }

        .classified {
            color: var(--sw-red);
            font-size: 0.75rem;
            letter-spacing: 1px;
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <div class="dashboard-header">
            <h1>👤 Cuartel de Oficiales</h1>
            <a href="../dashboard.php" class="btn-logout">← Volver</a>
        </div>

        <div class="welcome-box">
            <h2>> Directorio de Personal de Alto Rango</h2>

            <div class="officer-card">
                <div class="officer-name">Wilhuff Tarkin</div>
                <div class="officer-rank">Gran Moff — Comandante de la Estación</div>
                <div class="officer-info">
                    Responsable máximo de la Estrella de la Muerte. Reporta directamente al Emperador Palpatine.
                    Impulsor de la Doctrina Tarkin: gobernar a través del miedo. Veterano de las Guerras Clon.
                </div>
                <p class="classified" style="margin-top: 0.5rem;">[CLASIFICADO] Clave de acceso personal: ████████████
                </p>
            </div>

            <div class="officer-card">
                <div class="officer-name">Darth Vader</div>
                <div class="officer-rank">Lord Sith — Comandante de las Fuerzas Imperiales</div>
                <div class="officer-info">
                    Brazo ejecutor del Emperador. Anterior Jedi conocido como ████████.
                    Mantiene cámaras personales en el nivel 40. Acceso irrestricto a todos los sistemas.
                    Última misión: interrogatorio de la Princesa Leia sobre la ubicación de la base rebelde.
                </div>
                <p class="classified" style="margin-top: 0.5rem;">[ALTO SECRETO] Identidad anterior: REDACTADO por
                    Seguridad Imperial</p>
            </div>

            <div class="officer-card">
                <div class="officer-name">Conan Antonio Motti</div>
                <div class="officer-rank">Almirante — Jefe de Operaciones Navales</div>
                <div class="officer-info">
                    Responsable de las operaciones navales de la estación. Convencido defensor del superlaser como
                    arma definitiva. Tuvo un "desacuerdo" con Lord Vader durante la última reunión de mandos
                    (actualmente en recuperación médica).
                </div>
                <p class="classified" style="margin-top: 0.5rem;">[NOTA MÉDICA] Daño leve en tráquea. Causa: "accidente
                    laboral"</p>
            </div>

            <div class="officer-card">
                <div class="officer-name">Cassio Tagge</div>
                <div class="officer-rank">General — Jefe del Ejército Imperial</div>
                <div class="officer-info">
                    Encargado de las fuerzas terrestres. Ha expresado preocupación sobre la vulnerabilidad
                    de la estación ante un ataque rebelde a pequeña escala. Sus advertencias han sido ignoradas
                    por el Almirante Motti y el Gran Moff Tarkin.
                </div>
                <p class="classified" style="margin-top: 0.5rem;">[MEMO INTERNO] "Insisto en que los cazas rebeldes
                    pueden representar una amenaza"</p>
            </div>

            <div class="officer-card">
                <div class="officer-name">TK-421</div>
                <div class="officer-rank">Stormtrooper — Guardia del Hangar Principal</div>
                <div class="officer-info">
                    Asignado a la vigilancia del hangar de atraque nivel 5. Último reporte: fue visto
                    abandonando su puesto sin autorización. Su paradero actual es desconocido.
                    Se ha abierto una investigación interna.
                </div>
                <p class="classified" style="margin-top: 0.5rem;">[URGENTE] ¿TK-421 por qué no estás en tu puesto? —
                    Control del Hangar</p>
                <!-- Diario personal de TK-421: "Hoy he visto algo extraño en el hangar. Una nave carguero corelliana que nadie parece haber autorizado. Voy a investigar..." -->
            </div>
        </div>

        <div class="welcome-box">
            <h2>> Tablón de Anuncios</h2>
            <p style="color: var(--sw-text);">📋 Torneo de Dejarik — Inscripciones abiertas. Contactar Oficial Praxis,
                nivel 12.</p>
            <p style="color: var(--sw-text);">📋 Comedor de oficiales — Nuevo menú disponible. Ahora con bantha estofado
                los miércoles.</p>
            <p style="color: var(--sw-text);">📋 Gimnasio nivel 8 — Cerrado por mantenimiento hasta nuevo aviso.</p>
            <p style="color: var(--sw-amber);">📋 RECORDATORIO — Todo el personal debe actualizar su código de acceso
                antes del fin del ciclo. Los códigos por defecto serán desactivados.</p>
            <p style="color: var(--sw-text);">📋 Club de lectura — Esta semana: "La doctrina del Nuevo Orden" por W.
                Tarkin. Asistencia obligatoria.</p>
        </div>

        <div class="footer">
            Imperio Galáctico &bull; Recursos Humanos Imperiales &bull; Nivel de Acceso: Oficial
        </div>
    </div>
</body>

</html>