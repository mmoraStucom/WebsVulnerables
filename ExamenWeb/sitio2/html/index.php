<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>👁️</text></svg>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barad-dûr - La Torre Oscura</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .btn-instructions {
            display: block;
            margin: 0 auto 2rem;
            padding: 0.9rem 2.5rem;
            background: linear-gradient(135deg, #2c1a0e, #4a2a14);
            border: 2px solid var(--lotr-gold);
            border-radius: 6px;
            color: var(--lotr-gold);
            font-family: 'Cinzel', serif;
            font-size: 1rem;
            font-weight: 700;
            letter-spacing: 3px;
            cursor: pointer;
            transition: all 0.4s;
            text-transform: uppercase;
            box-shadow: 0 0 20px rgba(255, 213, 79, 0.1);
        }

        .btn-instructions:hover {
            background: linear-gradient(135deg, #4a2a14, #6b3a1e);
            box-shadow: 0 0 40px rgba(255, 213, 79, 0.3);
            transform: translateY(-2px);
        }

        /* ===== PARCHMENT MODAL ===== */
        .parchment-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.95);
            z-index: 10000;
            overflow: hidden;
        }

        .parchment-modal.active {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .parchment-close {
            position: fixed;
            top: 1.5rem;
            right: 2rem;
            font-size: 2rem;
            color: var(--lotr-gold-dim);
            cursor: pointer;
            z-index: 10010;
            transition: color 0.3s;
            background: none;
            border: none;
            font-family: serif;
        }

        .parchment-close:hover {
            color: var(--lotr-gold);
        }

        /* Parchment scroll container */
        .parchment-scroll {
            width: 700px;
            max-width: 90vw;
            max-height: 85vh;
            overflow-y: auto;
            position: relative;
            opacity: 0;
            transform: scale(0.8) rotateX(10deg);
            transition: all 0.8s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .parchment-modal.active .parchment-scroll {
            opacity: 1;
            transform: scale(1) rotateX(0deg);
        }

        /* Parchment background */
        .parchment-paper {
            background:
                linear-gradient(135deg, #d4c5a0 0%, #e8dcc0 20%, #d4c5a0 40%, #c9b991 60%, #d4c5a0 80%, #e0d4b4 100%);
            border-radius: 8px;
            padding: 3rem 2.5rem;
            position: relative;
            box-shadow:
                0 0 40px rgba(0, 0, 0, 0.5),
                inset 0 0 60px rgba(139, 119, 75, 0.3);
        }

        /* Burnt edges effect */
        .parchment-paper::before {
            content: '';
            position: absolute;
            top: -3px;
            left: -3px;
            right: -3px;
            bottom: -3px;
            border-radius: 10px;
            background: linear-gradient(45deg,
                    #3d2b1f 0%, transparent 15%,
                    transparent 85%, #3d2b1f 100%);
            z-index: -1;
        }

        /* Stains and texture */
        .parchment-paper::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 8px;
            background:
                radial-gradient(ellipse at 20% 80%, rgba(139, 100, 50, 0.15) 0%, transparent 50%),
                radial-gradient(ellipse at 80% 20%, rgba(120, 90, 40, 0.1) 0%, transparent 40%),
                radial-gradient(ellipse at 50% 50%, rgba(100, 80, 40, 0.05) 0%, transparent 60%);
            pointer-events: none;
        }

        /* Text styles on parchment */
        .parchment-title {
            font-family: 'Cinzel', serif;
            font-size: 1.6rem;
            font-weight: 900;
            color: #2c1a0e;
            text-align: center;
            margin-bottom: 0.5rem;
            letter-spacing: 4px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        }

        .parchment-subtitle {
            font-family: 'Cinzel', serif;
            font-size: 0.85rem;
            color: #5d4037;
            text-align: center;
            letter-spacing: 3px;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #a09070;
        }

        .parchment-text {
            font-family: 'MedievalSharp', cursive;
            font-size: 1rem;
            color: #3e2723;
            line-height: 1.9;
            margin-bottom: 1.2rem;
            text-align: justify;
        }

        .parchment-section-title {
            font-family: 'Cinzel', serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: #2c1a0e;
            text-align: center;
            margin: 1.5rem 0 1rem;
            letter-spacing: 2px;
        }

        .parchment-objective {
            font-family: 'MedievalSharp', cursive;
            font-size: 0.95rem;
            color: #3e2723;
            line-height: 1.7;
            margin-bottom: 0.8rem;
            padding-left: 1.5rem;
            position: relative;
        }

        .parchment-objective::before {
            content: '⚔';
            position: absolute;
            left: 0;
        }

        .parchment-divider {
            text-align: center;
            color: #8b7355;
            font-size: 1.2rem;
            margin: 1.5rem 0;
            letter-spacing: 8px;
        }

        .parchment-ring {
            display: block;
            margin: 1.5rem auto;
            width: 60px;
            height: 60px;
            border: 2px solid #8b6914;
            border-radius: 50%;
            position: relative;
            box-shadow: 0 0 15px rgba(139, 105, 20, 0.3), inset 0 0 10px rgba(139, 105, 20, 0.2);
        }

        .parchment-ring::after {
            content: '💍';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 1.5rem;
        }

        .parchment-inscription {
            text-align: center;
            font-style: italic;
            color: #8b6914;
            font-size: 0.8rem;
            margin-top: 1.5rem;
            line-height: 1.6;
            opacity: 0.7;
        }

        .parchment-seal {
            text-align: center;
            margin-top: 2rem;
            padding-top: 1rem;
            border-top: 1px solid #a09070;
            font-family: 'Cinzel', serif;
            font-size: 0.75rem;
            color: #5d4037;
            letter-spacing: 2px;
        }

        /* Scrollbar for parchment */
        .parchment-scroll::-webkit-scrollbar {
            width: 8px;
        }

        .parchment-scroll::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.3);
            border-radius: 4px;
        }

        .parchment-scroll::-webkit-scrollbar-thumb {
            background: #8b7355;
            border-radius: 4px;
        }

        /* Fade-in animations for text */
        .parchment-fade {
            opacity: 0;
            transform: translateY(10px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }

        .parchment-fade.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* ===== BURN ANIMATION ===== */
        .parchment-scroll.burning {
            pointer-events: none;
        }

        .parchment-scroll.burning .parchment-paper {
            animation: paper-burn 1.8s ease-in forwards;
        }

        @keyframes paper-burn {
            0% {
                filter: brightness(1) sepia(0);
                transform: scale(1);
                opacity: 1;
            }
            20% {
                filter: brightness(1.1) sepia(0.3);
                box-shadow: 0 0 40px rgba(255, 100, 0, 0.4), inset 0 -40px 60px rgba(255, 60, 0, 0.3);
            }
            40% {
                filter: brightness(1.3) sepia(0.6);
                box-shadow: 0 0 80px rgba(255, 80, 0, 0.6), inset 0 -80px 80px rgba(255, 40, 0, 0.5);
                transform: scale(1.01) rotateZ(0.5deg);
            }
            60% {
                filter: brightness(1.5) sepia(0.8) contrast(1.2);
                box-shadow: 0 0 100px rgba(255, 60, 0, 0.7), inset 0 0 120px rgba(200, 30, 0, 0.6);
                transform: scale(0.98) rotateZ(-0.5deg) rotateX(3deg);
            }
            80% {
                filter: brightness(0.6) sepia(1) contrast(1.5) saturate(0.3);
                box-shadow: 0 0 60px rgba(150, 30, 0, 0.4);
                transform: scale(0.92) rotateZ(1deg) rotateX(8deg);
                opacity: 0.6;
            }
            100% {
                filter: brightness(0.1) sepia(1) contrast(2) saturate(0);
                box-shadow: 0 0 20px rgba(80, 20, 0, 0.2);
                transform: scale(0.85) rotateZ(1.5deg) rotateX(15deg) translateY(-20px);
                opacity: 0;
            }
        }

        /* Fire particles */
        .fire-particle {
            position: absolute;
            width: 6px;
            height: 6px;
            border-radius: 50%;
            pointer-events: none;
            z-index: 10;
            animation: particle-rise 1s ease-out forwards;
        }

        @keyframes particle-rise {
            0% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
            50% {
                opacity: 0.8;
            }
            100% {
                opacity: 0;
                transform: translateY(-120px) translateX(var(--drift)) scale(0);
            }
        }

        /* Ember edge glow */
        .ember-edge {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 0;
            background: linear-gradient(to top, 
                rgba(255, 80, 0, 0.9), 
                rgba(255, 140, 0, 0.5), 
                transparent);
            border-radius: 0 0 8px 8px;
            pointer-events: none;
            z-index: 5;
            animation: ember-spread 1.6s ease-in forwards;
        }

        @keyframes ember-spread {
            0% { height: 0; opacity: 0; }
            20% { height: 15%; opacity: 1; }
            50% { height: 50%; opacity: 0.9; }
            80% { height: 90%; opacity: 0.6; }
            100% { height: 100%; opacity: 0; }
        }
    </style>
</head>

<body>
    <div class="main-container">
        <div class="page-header">
            <div class="eye-of-sauron"></div>
            <h1>Barad-dûr</h1>
            <p class="subtitle">La Fortaleza del Señor Oscuro &bull; Sistema de los Servidores de Mordor</p>
        </div>

        <button class="btn-instructions" onclick="openParchment()">📜 Instrucciones de la Misión</button>

        <div class="content-box">
            <h2>🔥 Bienvenido a Mordor</h2>
            <p>Tres Anillos para los Reyes Elfos bajo el cielo. Siete para los Señores Enanos en casas de piedra. Nueve
                para los Hombres Mortales condenados a morir. Un Anillo para gobernarlos a todos.</p>
        </div>

        <div class="content-box">
            <h2>📜 Accesos</h2>
            <ul class="scroll-list">
                <li><a href="library.php?file=historia.txt">Biblioteca de Mordor — Textos y archivos antiguos</a></li>
                <li><a href="mordor/wall.php">Muro del Orco — Tablón de mensajes de las tropas</a></li>
                <li><a href="login.php">Portal de Sauron — Acceso de comandantes</a></li>
            </ul>
        </div>

        <div class="footer">
            Barad-dûr &bull; Mordor &bull; Un Anillo para gobernarlos a todos
        </div>
    </div>

    <!-- Parchment Modal -->
    <div class="parchment-modal" id="parchmentModal">
        <button class="parchment-close" onclick="closeParchment()">&times;</button>
        <div class="parchment-scroll" id="parchmentScroll">
            <div class="parchment-paper">
                <div class="parchment-ring"></div>

                <div class="parchment-title parchment-fade">MISIÓN SECRETA</div>
                <div class="parchment-subtitle parchment-fade">Consejo Blanco &bull; Solo para los ojos del agente</div>

                <p class="parchment-text parchment-fade">
                    Agente de los Pueblos Libres, este pergamino ha sido enviado en secreto
                    por Gandalf el Gris desde Minas Tirith. Lo que lees aquí no debe caer
                    en manos del enemigo.
                </p>

                <p class="parchment-text parchment-fade">
                    Te has infiltrado con éxito en las redes de comunicación de Mordor,
                    haciéndote pasar por un soldado orco en la fortaleza de Barad-dûr.
                    Desde aquí, tienes acceso al sistema interno del Señor Oscuro.
                </p>

                <p class="parchment-text parchment-fade">
                    Tu misión: compromete los sistemas de Sauron desde dentro.
                    Intercepta sus comunicaciones, roba su identidad y sabotea
                    sus planes de guerra. Cada FLAG que captures es información
                    vital que la Comunidad necesita para la batalla que se avecina.
                </p>

                <div class="parchment-divider parchment-fade">✦ ✦ ✦</div>

                <div class="parchment-section-title parchment-fade">OBJETIVOS DE LA MISIÓN</div>

                <div class="parchment-objective parchment-fade">
                    Reconoce el terreno. La fortaleza de Barad-dûr es vasta
                    y los ingenieros orcos no son conocidos por su diligencia.
                    Todo sistema tiene grietas si sabes dónde mirar.
                </div>

                <div class="parchment-objective parchment-fade">
                    Los archivos de Mordor guardan secretos que Sauron
                    cree protegidos. Encuentra información que no debería
                    estar al alcance de un simple soldado.
                </div>

                <div class="parchment-objective parchment-fade">
                    Sauron vigila personalmente las comunicaciones de
                    sus tropas. Eso le hace vulnerable. Si logras
                    suplantar su identidad, tendrás acceso a todo Mordor.
                </div>

                <div class="parchment-objective parchment-fade">
                    Con el poder del Señor Oscuro en tus manos,
                    sabotea sus operaciones militares desde dentro.
                    La guerra se gana antes de la batalla.
                </div>

                <div class="parchment-objective parchment-fade">
                    Captura las 4 FLAGS ocultas en los sistemas de
                    Mordor y documenta cada vulnerabilidad en tu
                    informe para el Consejo Blanco.
                </div>

                <div class="parchment-divider parchment-fade">✦ ✦ ✦</div>

                <p class="parchment-inscription parchment-fade">
                    «No todo lo que es oro reluce,<br>
                    ni toda la gente errante anda perdida.»<br>
                    — Gandalf el Gris
                </p>

                <div class="parchment-seal parchment-fade">
                    🕊 Sellado por el Consejo Blanco &bull; Tercera Edad &bull; Confidencial
                </div>
            </div>
        </div>
    </div>

    <script>
        function openParchment() {
            const modal = document.getElementById('parchmentModal');
            const scroll = document.getElementById('parchmentScroll');
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';

            // Animate text elements appearing one by one
            const items = modal.querySelectorAll('.parchment-fade');
            items.forEach((item, index) => {
                setTimeout(() => {
                    item.classList.add('visible');
                }, 300 + (index * 200));
            });
        }

        let isBurning = false;

        function closeParchment() {
            if (isBurning) return;
            isBurning = true;

            const modal = document.getElementById('parchmentModal');
            const scroll = document.getElementById('parchmentScroll');
            const paper = scroll.querySelector('.parchment-paper');

            // Hide close button
            document.querySelector('.parchment-close').style.display = 'none';

            // Add ember edge glow
            const ember = document.createElement('div');
            ember.classList.add('ember-edge');
            paper.style.position = 'relative';
            paper.style.overflow = 'hidden';
            paper.appendChild(ember);

            // Spawn fire particles
            const rect = paper.getBoundingClientRect();
            for (let i = 0; i < 30; i++) {
                setTimeout(() => {
                    const p = document.createElement('div');
                    p.classList.add('fire-particle');
                    const colors = ['#ff6d00', '#ff8f00', '#ffab00', '#ff3d00', '#dd2c00'];
                    p.style.background = colors[Math.floor(Math.random() * colors.length)];
                    p.style.boxShadow = `0 0 6px ${p.style.background}`;
                    p.style.setProperty('--drift', `${(Math.random() - 0.5) * 60}px`);
                    p.style.left = `${Math.random() * 100}%`;
                    p.style.bottom = `${Math.random() * 40}%`;
                    p.style.animationDuration = `${0.6 + Math.random() * 0.8}s`;
                    paper.appendChild(p);
                    setTimeout(() => p.remove(), 1500);
                }, i * 50);
            }

            // Start burn animation
            scroll.classList.add('burning');

            // After burn completes, hide and reset
            setTimeout(() => {
                modal.classList.remove('active');
                scroll.classList.remove('burning');
                document.body.style.overflow = '';
                document.querySelector('.parchment-close').style.display = '';

                // Clean up particles and ember
                paper.querySelectorAll('.fire-particle, .ember-edge').forEach(el => el.remove());
                paper.style.position = '';
                paper.style.overflow = '';

                // Reset text animations
                modal.querySelectorAll('.parchment-fade').forEach(item => {
                    item.classList.remove('visible');
                });

                isBurning = false;
            }, 2000);
        }

        // Close on Escape
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeParchment();
        });

        // Close on backdrop click
        document.getElementById('parchmentModal').addEventListener('click', (e) => {
            if (e.target === e.currentTarget) closeParchment();
        });
    </script>
</body>

</html>