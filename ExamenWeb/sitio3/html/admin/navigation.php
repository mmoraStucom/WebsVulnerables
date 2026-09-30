<?php
session_name("StarTrekCookie");
session_start();
require_once __DIR__ . '/../db.php';

// Verificar acceso admin
$authorized = false;
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    $authorized = true;
} elseif (isset($_COOKIE['admin_session'])) {
    // Validar cookie de respaldo
    $token = $_COOKIE['admin_session'];
    $stmt = $conn->prepare("SELECT username FROM admin_users WHERE session_token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    if ($stmt->get_result()->num_rows > 0) {
        $_SESSION['admin_logged_in'] = true;
        $authorized = true;
    }
}

if (!$authorized) {
    header("Location: ../login.php");
    exit();
}

$msg = "";
$error = "";
$success_flag = "";

// Lógica de validación
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $c_sector = $_POST['sector'] ?? '';
    $c_code = $_POST['code'] ?? '';

    // Hardcoded credentials from internal_data/coordinates.txt
    if ($c_sector === "MUTARA_NEBULA_GAMMA" && $c_code === "GENESIS_DEVICE_ARMED") {
        $success_flag = "FLAG{WARP_SPEED_RESCUE_SUCCESS_GENESIS_7k2m9}";
    } else {
        $error = "⚠ ERROR DE NAVEGACIÓN: Coordenadas o Código de Autorización incorrectos. Abortando salto warp.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link rel="icon"
        href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🖖</text></svg>">
    <title>USS Enterprise - Navegación Warp</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        .warp-panel {
            background: rgba(0, 0, 0, 0.8);
            border: 2px solid var(--lcars-prime);
            padding: 2rem;
            text-align: center;
        }

        .input-lcars {
            width: 80%;
            padding: 10px;
            margin: 10px 0;
            background-color: #000;
            border: 1px solid var(--lcars-orange);
            color: var(--lcars-orange);
            font-family: inherit;
            font-size: 1.1rem;
            text-align: center;
        }

        .btn-warp {
            background-color: var(--lcars-red);
            color: black;
            padding: 15px 30px;
            font-size: 1.2rem;
            border: none;
            cursor: pointer;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-top: 20px;
            transition: all 0.3s;
        }

        .btn-warp:hover {
            background-color: #ff3333;
            box-shadow: 0 0 20px #ff3333;
        }

        .success-display {
            background: linear-gradient(rgba(0, 255, 0, 0.1), rgba(0, 255, 0, 0.05));
            border: 2px solid #00ff00;
            color: #00ff00;
            padding: 2rem;
            margin-top: 2rem;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 10px rgba(0, 255, 0, 0.2);
            }

            50% {
                box-shadow: 0 0 30px rgba(0, 255, 0, 0.5);
            }

            100% {
                box-shadow: 0 0 10px rgba(0, 255, 0, 0.2);
            }
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
        </div>
    </div>

    <div class="lcars-layout">
        <div class="lcars-sidebar">
            <a href="index.php" class="panel orange" style="display:block; text-decoration:none;">VOLVER</a>
            <div class="panel blue">ASTROMETRÍA</div>
            <div class="panel purple">SENSORES</div>
            <div class="panel red">NAV</div>
        </div>

        <div class="lcars-content">
            <div class="page-header">
                <h1>Navegación Warp</h1>
                <p class="subtitle">Sistema de Propulsión Interestelar — Misión de Rescate Proyecto Génesis</p>
            </div>

            <?php if ($success_flag): ?>
                <!-- Warp Animation Overlay -->
                <div id="warp-overlay"
                    style="position:fixed; top:0; left:0; width:100%; height:100%; background:black; z-index:9999; display:flex; justify-content:center; align-items:center; flex-direction:column;">
                    <!-- USO CORRECTO: Asset local para entorno sin internet -->
                    <img src="../warp.gif" style="width:100%; height:100%; object-fit:cover;" alt="Warp Jump">
                    <h1
                        style="position:absolute; bottom:20%; color:white; font-family:'Michroma', sans-serif; font-size:3rem; text-shadow:0 0 20px #00aaff; animation: blink 0.5s infinite;">
                        INICIANDO SALTO WARP...</h1>
                </div>

                <!-- Final Victory Screen (Hidden initially) -->
                <div id="victory-screen" style="display:none; text-align:center; animation: fadeIn 2s;">
                    <div class="success-display" style="border-color: #00ff00; background: rgba(0, 20, 0, 0.9);">
                        <h1 style="font-size: 2.5rem; color: #00ff00; margin-bottom: 1rem;">🌟 MISIÓN COMPLETADA 🌟</h1>
                        <p style="font-size: 1.2rem; color: #ccffcc;">La U.S.S. Enterprise ha llegado a los coordenadas del
                            Proyecto Génesis.</p>
                        <p style="font-size: 1.2rem; color: #ccffcc;">Sonda recuperada. La galaxia está a salvo.</p>

                        <div
                            style="margin: 3rem 0; padding: 2rem; border: 3px dashed #00ff00; border-radius: 10px; background: rgba(0, 50, 0, 0.5);">
                            <span style="display:block; font-size: 0.9rem; color: #00ff00; margin-bottom: 10px;">CÓDIGO DE
                                HONOR DE LA FLOTA ESTELAR</span>
                            <span
                                style="font-family: monospace; font-size: 2rem; color: #ffffff; text-shadow: 0 0 10px #00ff00;"><?php echo $success_flag; ?></span>
                        </div>

                        <div style="margin-top:2rem;">
                            <!-- Eliminado GIF de Spock externo para compatibilidad offline -->
                            <div style="font-size: 5rem;">🖖</div>
                            <p style="color:#00ff00; font-style:italic; margin-top:10px;">"Live Long and Prosper."</p>
                        </div>
                    </div>
                </div>

                <script>
                    // Secuencia de animación
                    setTimeout(function () {
                        // Ocultar Overlay de Warp
                        document.getElementById('warp-overlay').style.opacity = '0';
                        document.getElementById('warp-overlay').style.transition = 'opacity 1s';

                        setTimeout(function () {
                            document.getElementById('warp-overlay').style.display = 'none';
                            // Mostrar Pantalla de Victoria
                            document.getElementById('victory-screen').style.display = 'block';
                        }, 1000);
                    }, 4500); // 4.5 segundos de viaje warp
                </script>

                <style>
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

                    @keyframes fadeIn {
                        from {
                            opacity: 0;
                            transform: scale(0.9);
                        }

                        to {
                            opacity: 1;
                            transform: scale(1);
                        }
                    }
                </style>
            <?php else: ?>
                <div class="content-box">
                    <h2>⚠ ALERTA DE MISIÓN PRIORITARIA</h2>
                    <p>La <strong>U.S.S. Enterprise</strong> ha recibido una señal de socorro prioritaria.</p>
                    <p>El sistema de navegación requiere confirmación manual para el salto warp.</p>

                    <?php if ($error): ?>
                        <div class="alert-box danger">
                            <?php echo $error; ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" class="warp-panel">
                        <label style="color:var(--lcars-orange); letter-spacing:2px;">COORDENADAS DE SECTOR</label><br>
                        <input type="text" name="sector" class="input-lcars" placeholder="EJ: SECTOR-001" required
                            autocomplete="off">
                        <br><br>
                        <label style="color:var(--lcars-orange); letter-spacing:2px;">CÓDIGO DE AUTORIZACIÓN</label><br>
                        <input type="password" name="code" class="input-lcars" placeholder="EJ: OMEGA-13" required
                            autocomplete="off">
                        <br>
                        <button type="submit" class="btn-warp">⚡ INICIAR SALTO WARP</button>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="lcars-bar-bottom">
        <div class="lcars-elbow-bottom">NAV</div>
        <div class="lcars-strip-bottom">
            <div class="block"></div>
            <div class="block"></div>
            <div class="block"></div>
        </div>
    </div>
</body>

</html>