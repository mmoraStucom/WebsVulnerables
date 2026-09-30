<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Sensores de Largo Alcance - Sector Dev</title>
    <style>
        :root {
            --lcars-orange: #ff9900;
            --lcars-red: #cc0000;
            --lcars-blue: #99ccff;
            --lcars-bg: #000;
        }

        body {
            background-color: var(--lcars-bg);
            color: var(--lcars-blue);
            font-family: monospace;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            overflow: hidden;
        }

        .scanner-interface {
            border: 2px solid var(--lcars-orange);
            border-radius: 20px;
            padding: 2rem;
            width: 80%;
            max-width: 600px;
            background: rgba(255, 153, 0, 0.05);
            position: relative;
        }

        h1 {
            color: var(--lcars-orange);
            text-transform: uppercase;
            letter-spacing: 2px;
            border-bottom: 1px solid var(--lcars-orange);
            padding-bottom: 0.5rem;
        }

        .data-stream {
            margin: 2rem 0;
            line-height: 1.5;
        }

        .alert {
            color: var(--lcars-red);
            font-weight: bold;
            animation: blink 1s infinite;
        }

        @keyframes blink {
            0% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }

            100% {
                opacity: 1;
            }
        }

        .btn {
            display: inline-block;
            background: var(--lcars-orange);
            color: black;
            padding: 0.5rem 1rem;
            text-decoration: none;
            font-weight: bold;
            border-radius: 10px;
            text-transform: uppercase;
            margin-top: 1rem;
        }
    </style>
</head>

<body>
    <div class="scanner-interface">
        <h1>Reporte de Sensores</h1>
        <div class="data-stream">
            <p>> Iniciando barrido de nivel 4...</p>
            <p>> Análisis de estructura de directorios completado.</p>
            <p>> Detectando anomalía subespacial...</p>
            <br>
            <p class="alert">⚠ ALERTA DE PROXIMIDAD ⚠</p>
            <p>Los sensores indican la presencia de un objeto de tipo <strong>"flag.txt"</strong> no identificado en
                este sector.</p>
            <p>Coordenadas: <em>local_directory/flag.txt</em></p>
            <p>> Acceso directo visual: NEGATIVO. Requiere protocolo de inclusión.</p>
        </div>
        <a href="../index.php" class="btn">Retirarse al Puente</a>
    </div>
</body>

</html>