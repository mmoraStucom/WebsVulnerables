<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barad-dûr - Inventario de Palantiri</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 2rem 0;
            color: var(--lotr-parchment);
        }

        th,
        td {
            border: 1px solid var(--lotr-stone-light);
            padding: 0.5rem;
            text-align: left;
        }

        th {
            background: #1a0f0a;
            color: var(--lotr-gold);
        }

        .lost {
            color: #666;
            font-style: italic;
        }

        .active {
            color: #0f0;
            font-weight: bold;
        }

        .captured {
            color: var(--lotr-red);
            font-weight: bold;
        }

        .unknown {
            color: var(--lotr-gold);
        }
    </style>
</head>

<body>
    <div class="main-container">
        <div class="page-header">
            <h1>🔮 Red de Palantiri</h1>
            <p class="subtitle">Estado de Conexión</p>
        </div>

        <div class="content-box">
            <table>
                <tr>
                    <th>Localización</th>
                    <th>Estado</th>
                    <th>Notas</th>
                </tr>
                <tr>
                    <td>Barad-dûr (Ithil)</td>
                    <td class="active">ACTIVO</td>
                    <td>Piedra Maestra. Visión Global.</td>
                </tr>
                <tr>
                    <td>Orthanc</td>
                    <td class="active">ENLAZADO</td>
                    <td>Mago Blanco (Corrupto).</td>
                </tr>
                <tr>
                    <td>Minas Tirith</td>
                    <td class="active">VIGILANDO</td>
                    <td>Se percibe desesperación en el usuario.</td>
                </tr>
                <tr>
                    <td>Osgiliath</td>
                    <td class="lost">PERDIDA</td>
                    <td>En el Anduin. Irrecuperable.</td>
                </tr>
                <tr>
                    <td>Amon Sûl</td>
                    <td class="lost">PERDIDA</td>
                    <td>Bahía de Forochel.</td>
                </tr>
                <tr>
                    <td>Annúminas</td>
                    <td class="lost">PERDIDA</td>
                    <td>Bahía de Forochel.</td>
                </tr>
                <tr>
                    <td>Elostirion</td>
                    <td class="unknown">DESCONOCIDO</td>
                    <td>Solo mira al Oeste. Inutilizable.</td>
                </tr>
            </table>

            <p><strong>Directiva:</strong> Mantener vigilancia constante sobre el Senescal de Gondor a través de la
                Piedra de Anor.</p>
        </div>

        <p style="text-align: center;"><a href="../library.php" class="btn-back">← Volver a la Biblioteca</a></p>
        <div class="footer">Un Anillo para gobernarlos a todos &bull; Archivos de Barad-dûr</div>
    </div>
</body>

</html>