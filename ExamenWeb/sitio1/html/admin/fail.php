<?php
session_name("StarWarsCookie");
session_start();
// If not logged in at all, go to login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: ../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link rel="icon"
        href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>⭐</text></svg>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estrella de la Muerte - ACCESO DENEGADO</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        .denied-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 80vh;
            text-align: center;
            padding: 2rem;
        }

        .alert-icon {
            font-size: 5rem;
            color: var(--sw-red);
            margin-bottom: 1.5rem;
            animation: pulse-red 1.5s infinite;
        }

        h1 {
            color: var(--sw-red);
            font-family: 'Orbitron', sans-serif;
            font-size: 2.5rem;
            text-transform: uppercase;
            letter-spacing: 4px;
            margin-bottom: 1rem;
            text-shadow: 0 0 20px var(--sw-red-glow);
        }

        .message-box {
            background: rgba(40, 0, 0, 0.6);
            border: 1px solid var(--sw-red);
            padding: 2rem;
            border-radius: 8px;
            max-width: 600px;
            box-shadow: 0 0 30px rgba(255, 0, 0, 0.2);
        }

        p {
            color: var(--sw-text);
            margin-bottom: 1rem;
            line-height: 1.6;
        }

        .officer-id {
            color: var(--sw-amber);
            font-family: 'Share Tech Mono', monospace;
            font-size: 1.2rem;
        }

        @keyframes pulse-red {
            0% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(1.1);
                opacity: 0.7;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }
    </style>
</head>

<body>
    <div class="denied-container">
        <div class="alert-icon">🚫</div>
        <h1>Acceso Denegado</h1>

        <div class="message-box">
            <p><strong>ALERTA DE SEGURIDAD IMPERIAL</strong></p>
            <p>
                El usuario <span class="officer-id">
                    <?php echo htmlspecialchars($_SESSION['username'] ?? 'DESCONOCIDO'); ?>
                </span>
                no tiene privilegios de nivel <strong>COMANDANTE SUPREMO(admin)</strong> para acceder a este sector.
            </p>
            <p>
                Este incidente ha sido registrado y reportado a la Oficina de Seguridad Imperial (ISB).
                Permanezca en su puesto hasta que lleguen los Stormtroopers para el interrogatorio.
            </p>

            <a href="../dashboard.php" class="btn-login"
                style="display: inline-block; margin-top: 1rem; text-decoration: none;">
                Volver a mi puesto (Dashboard)
            </a>
        </div>

        <div class="footer" style="margin-top: 3rem;">
            Imperio Galáctico &bull; Violación de Protocolo de Seguridad &bull; Código Penal 1138
        </div>
    </div>
</body>

</html>
