<?php // Señuelo ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link rel="icon"
        href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🖖</text></svg>">
    <title>USS Enterprise - Lanzadera</title>
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
            <div class="panel teal">BAHÍA</div>
            <div class="panel blue">ESTADO</div>
            <div class="panel purple">MANTEN.</div>
            <div class="panel red">SALIDA</div>
        </div>
        <div class="lcars-content">
            <div class="page-header">
                <h1>Bahía de Lanzaderas</h1>
                <p class="subtitle">Control de Tráfico Auxiliar — Cubierta 3</p>
            </div>

            <div class="nav-links">
                <a href="../index.php" class="nav-link">← Volver al Puente</a>
            </div>

            <div class="content-box">
                <h2>🚀 Estado de Naves Auxiliares</h2>
                <table class="data-table">
                    <tr>
                        <th>Identificador</th>
                        <th>Nombre</th>
                        <th>Clase</th>
                        <th>Estado Actual</th>
                    </tr>
                    <tr>
                        <td>NCC-1701/1</td>
                        <td>GALILEO</td>
                        <td>Class F</td>
                        <td><span style="color:var(--lcars-yellow);">EN MANTENIMIENTO (Motores de Impulso)</span></td>
                    </tr>
                    <tr>
                        <td>NCC-1701/2</td>
                        <td>COLUMBUS</td>
                        <td>Class F</td>
                        <td><span style="color:var(--lcars-blue);">OPERATIVO - EN ESPERA</span></td>
                    </tr>
                    <tr>
                        <td>NCC-1701/7</td>
                        <td>COPERNICUS</td>
                        <td>Class F</td>
                        <td><span style="color:var(--lcars-orange);">DESPLEGADO - Sector 7G</span></td>
                    </tr>
                </table>
                <p style="margin-top:1rem; color:var(--lcars-text-dim);">
                    <strong>Nota del ingeniero jefe:</strong> La lanzadera Galileo requiere recalibración de los
                    inyectores de plasma antes del próximo ciclo.
                </p>
            </div>
        </div>
    </div>
</body>

</html>