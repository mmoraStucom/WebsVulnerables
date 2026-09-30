<?php
session_name("StarTrekCookie");
session_start();
require_once __DIR__ . '/../db.php';

// Verificar acceso: sesión PHP O cookie de sesión válida en BD
$authorized = false;

if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    $authorized = true;
} elseif (isset($_COOKIE['admin_session'])) {
    $token = $_COOKIE['admin_session'];
    $stmt = $conn->prepare("SELECT username FROM admin_users WHERE session_token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_user'] = $row['username'];
        $authorized = true;
    }
}

if (!$authorized) {
    header("Location: ../login.php");
    exit();
}

$admin_user = $_SESSION['admin_user'] ?? 'Oficial';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link rel="icon"
        href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🖖</text></svg>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USS Enterprise - Panel de Mando Clasificado</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        .flag-box {
            background: linear-gradient(135deg, rgba(255, 153, 0, 0.15), rgba(255, 153, 0, 0.05));
            border: 2px solid var(--lcars-orange);
            border-radius: 8px;
            padding: 1.5rem 2rem;
            margin-top: 1rem;
            text-align: center;
        }

        .flag-label {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 3px;
            color: var(--lcars-text-dim);
            margin-bottom: 0.5rem;
        }

        .flag-value {
            font-size: 1.1rem;
            font-weight: bold;
            color: var(--lcars-orange);
            font-family: monospace;
            letter-spacing: 1px;
            word-break: break-all;
        }

        .classified-badge {
            display: inline-block;
            background: rgba(255, 50, 50, 0.2);
            border: 1px solid #ff3232;
            color: #ff6666;
            padding: 0.2rem 0.8rem;
            border-radius: 4px;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
    <div class="lcars-bar-top">
        <div class="lcars-elbow-top">NCC-1701</div>
        <div class="lcars-strip-top">
            <div class="block"></div>
            <div class="block"></div>
            <div class="block"></div>
            <div class="block"></div>
            <div class="block"></div>
        </div>
    </div>

    <div class="lcars-layout">
        <div class="lcars-sidebar">
            <div class="panel orange">PANEL<br>MANDO</div>
            <div class="panel blue">CLASIFICADO</div>
            <div class="panel red">TOP SECRET</div>
        </div>

        <div class="lcars-content">
            <div class="page-header">
                <h1>Panel de Mando — Capitán
                    <?php echo htmlspecialchars($admin_user); ?>
                </h1>
                <p class="subtitle">Acceso Nivel Alfa — Información Clasificada de Starfleet</p>
            </div>

            <div class="nav-links">
                <a href="../index.php" class="nav-link">← Puente</a>
                <a href="../login.php?logout=1" class="nav-link">🔓 Cerrar Sesión</a>
            </div>

            <div class="content-box">
                <h2>🔐 Datos Clasificados de la Misión</h2>
                <div class="classified-badge">⚠ CLASIFICADO — NIVEL ALFA</div>
                <p>Has accedido al panel de mando clasificado de la USS Enterprise. La siguiente información es de
                    acceso restringido al Capitán y al Alto Mando de Starfleet.</p>

                <div class="flag-box">
                    <div class="flag-label">🏴 Código de Acceso Clasificado — Misión NCC-1701</div>
                    <div class="flag-value">FLAG{XSS_ST0L3N_C00K13_STARFL33T_x4k9p2}</div>
                </div>
            </div>

            <div class="content-box">
                <h2>📋 Estado de la Misión</h2>
                <p style="color: var(--lcars-text-dim);">- Sector de patrulla: Zona Neutral Klingon</p>
                <p style="color: var(--lcars-text-dim);">- Estado de escudos: 100%</p>
                <p style="color: var(--lcars-text-dim);">- Velocidad Warp: <a href="navigation.php"
                        style="color:var(--lcars-orange); text-decoration:none; font-weight:bold;">[PANEL DE
                        NAVEGACIÓN]</a></p>
                <p style="color: var(--lcars-text-dim);">- Estado de la tripulación: Operativo</p>
            </div>
        </div>
    </div>

    <div class="lcars-bar-bottom">
        <div class="lcars-elbow-bottom">STARFLEET</div>
        <div class="lcars-strip-bottom">
            <div class="block"></div>
            <div class="block"></div>
            <div class="block"></div>
            <div class="block"></div>
        </div>
    </div>
</body>

</html>