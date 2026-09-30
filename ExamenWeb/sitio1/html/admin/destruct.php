<?php
session_name("StarWarsCookie");
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: ../index.php");
    exit();
}
// Admin Check
$username = $_SESSION['username'] ?? '';
if ($username !== 'admin') {
    header("Location: fail.php");
    exit();
}

$error = "";
$correct = false;
$secret_code = "THX-1138-VENT";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['code'])) {
    $code = trim($_POST['code']);
    if ($code === $secret_code) {
        $correct = true;
    } else {
        $error = "Código incorrecto. El sistema de seguridad ha registrado este intento.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link rel="icon"
        href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>⭐</text></svg>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estrella de la Muerte - Control de Ventilación Térmica</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        .destruct-box {
            background: rgba(17, 17, 19, 0.95);
            border: 1px solid var(--sw-red);
            border-radius: 8px;
            padding: 2.5rem;
            max-width: 600px;
            margin: 0 auto;
            text-align: center;
            box-shadow: 0 0 40px rgba(255, 23, 68, 0.15);
        }

        .destruct-box h2 {
            font-family: 'Orbitron', sans-serif;
            color: var(--sw-red);
            font-size: 1.3rem;
            letter-spacing: 3px;
            margin-bottom: 1.5rem;
        }

        .destruct-box p {
            color: var(--sw-text);
            line-height: 1.8;
            margin-bottom: 1rem;
        }

        .code-input {
            width: 100%;
            max-width: 350px;
            padding: 0.8rem 1rem;
            background: var(--sw-dark);
            border: 1px solid var(--sw-gray);
            border-radius: 4px;
            color: var(--sw-red);
            font-family: 'Share Tech Mono', monospace;
            font-size: 1.2rem;
            text-align: center;
            letter-spacing: 3px;
            outline: none;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .code-input:focus {
            border-color: var(--sw-red);
            box-shadow: 0 0 15px var(--sw-red-glow);
        }

        .btn-destruct {
            margin-top: 1.5rem;
            padding: 0.8rem 2.5rem;
            background: linear-gradient(135deg, #5c0000, #8b0000);
            border: 1px solid var(--sw-red);
            border-radius: 4px;
            color: var(--sw-red);
            font-family: 'Orbitron', sans-serif;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 3px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-destruct:hover {
            background: linear-gradient(135deg, #8b0000, #b20000);
            box-shadow: 0 0 30px var(--sw-red-glow);
            transform: translateY(-1px);
        }

        /* ===== BATTLE SCENE ===== */
        .battle-scene {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #000;
            z-index: 9999;
            overflow: hidden;
        }

        .battle-scene.active {
            display: block;
        }

        /* Stars */
        .battle-scene::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background:
                radial-gradient(1px 1px at 10% 20%, #fff, transparent),
                radial-gradient(1px 1px at 25% 50%, rgba(255, 255, 255, 0.8), transparent),
                radial-gradient(1px 1px at 40% 15%, #fff, transparent),
                radial-gradient(1px 1px at 55% 70%, rgba(255, 255, 255, 0.6), transparent),
                radial-gradient(1px 1px at 70% 35%, #fff, transparent),
                radial-gradient(1px 1px at 85% 60%, rgba(255, 255, 255, 0.7), transparent),
                radial-gradient(1px 1px at 15% 80%, #fff, transparent),
                radial-gradient(1px 1px at 60% 90%, rgba(255, 255, 255, 0.5), transparent),
                radial-gradient(1px 1px at 90% 10%, #fff, transparent),
                radial-gradient(1px 1px at 35% 40%, rgba(255, 255, 255, 0.8), transparent),
                radial-gradient(1px 1px at 80% 85%, #fff, transparent),
                radial-gradient(1px 1px at 5% 55%, rgba(255, 255, 255, 0.6), transparent);
            z-index: 0;
        }

        /* Death Star */
        .death-star {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 250px;
            height: 250px;
            border-radius: 50%;
            background: radial-gradient(circle at 35% 35%, #4a4a4e, #1a1a1e);
            border: 2px solid #555;
            box-shadow: 0 0 60px rgba(100, 100, 100, 0.3), inset 0 0 40px rgba(0, 0, 0, 0.8);
            z-index: 1;
            transition: opacity 0.3s;
        }

        .death-star::before {
            content: '';
            position: absolute;
            top: 40%;
            left: 10%;
            width: 80%;
            height: 2px;
            background: #555;
        }

        .death-star::after {
            content: '';
            position: absolute;
            top: 28%;
            left: 25%;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: radial-gradient(circle, #333 0%, #1a1a1e 70%);
            border: 1px solid #555;
        }

        /* Vent opening glow */
        .vent-glow {
            position: absolute;
            top: 28%;
            left: 25%;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: radial-gradient(circle, var(--sw-red) 0%, transparent 70%);
            opacity: 0;
            z-index: 2;
            animation: ventPulse 1s ease-in-out infinite;
        }

        @keyframes ventPulse {

            0%,
            100% {
                opacity: 0.3;
                transform: scale(1);
            }

            50% {
                opacity: 0.8;
                transform: scale(1.3);
            }
        }

        /* X-Wing */
        .xwing {
            position: absolute;
            z-index: 3;
            opacity: 0;
        }

        .xwing-body {
            width: 40px;
            height: 8px;
            background: linear-gradient(90deg, #ccc, #888);
            border-radius: 0 4px 4px 0;
            position: relative;
        }

        .xwing-body::before {
            content: '';
            position: absolute;
            left: -6px;
            top: 50%;
            transform: translateY(-50%);
            width: 0;
            height: 0;
            border-top: 4px solid transparent;
            border-bottom: 4px solid transparent;
            border-right: 8px solid #ccc;
        }

        .xwing-wing {
            position: absolute;
            width: 30px;
            height: 2px;
            background: #aaa;
            left: 5px;
        }

        .xwing-wing.top-1 {
            top: -8px;
            transform: rotate(-5deg);
        }

        .xwing-wing.top-2 {
            top: -12px;
            transform: rotate(-10deg);
        }

        .xwing-wing.bot-1 {
            bottom: -8px;
            transform: rotate(5deg);
        }

        .xwing-wing.bot-2 {
            bottom: -12px;
            transform: rotate(10deg);
        }

        .xwing-engine {
            position: absolute;
            right: -3px;
            top: 50%;
            transform: translateY(-50%);
            width: 8px;
            height: 4px;
            background: #4af;
            border-radius: 0 2px 2px 0;
            box-shadow: 0 0 10px #4af, 0 0 20px rgba(68, 170, 255, 0.5);
        }

        /* X-Wing 1 - Leader */
        .xwing-1 {
            left: -60px;
            top: 45%;
            animation: flyIn1 3s ease-out 1s forwards;
        }

        /* X-Wing 2 - Wingman top */
        .xwing-2 {
            left: -80px;
            top: 38%;
            transform: scale(0.8);
            animation: flyIn2 3s ease-out 1.3s forwards;
        }

        /* X-Wing 3 - Wingman bottom */
        .xwing-3 {
            left: -80px;
            top: 55%;
            transform: scale(0.8);
            animation: flyIn3 3s ease-out 1.5s forwards;
        }

        @keyframes flyIn1 {
            0% {
                left: -60px;
                opacity: 0;
            }

            20% {
                opacity: 1;
            }

            70% {
                left: 30%;
                opacity: 1;
            }

            100% {
                left: 42%;
                opacity: 1;
                top: 45%;
            }
        }

        @keyframes flyIn2 {
            0% {
                left: -80px;
                opacity: 0;
            }

            20% {
                opacity: 1;
            }

            70% {
                left: 22%;
                opacity: 1;
            }

            100% {
                left: 28%;
                opacity: 1;
                top: 40%;
            }
        }

        @keyframes flyIn3 {
            0% {
                left: -80px;
                opacity: 0;
            }

            20% {
                opacity: 1;
            }

            70% {
                left: 22%;
                opacity: 1;
            }

            100% {
                left: 28%;
                opacity: 1;
                top: 56%;
            }
        }

        /* Proton torpedo */
        .torpedo {
            position: absolute;
            width: 12px;
            height: 4px;
            background: #f44;
            border-radius: 2px;
            box-shadow: 0 0 10px #f44, 0 0 20px #f44, 0 0 40px rgba(255, 68, 68, 0.5);
            opacity: 0;
            z-index: 4;
            left: 42%;
            top: 46%;
        }

        .torpedo.fire {
            animation: torpedoFly 1.2s ease-in forwards;
        }

        @keyframes torpedoFly {
            0% {
                opacity: 1;
                transform: scale(1);
            }

            80% {
                opacity: 1;
                left: 49.5%;
                top: 46.5%;
                transform: scale(0.6);
            }

            100% {
                opacity: 0;
                left: 50%;
                top: 47%;
                transform: scale(0.2);
            }
        }

        /* Torpedo trail */
        .torpedo-trail {
            position: absolute;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, rgba(255, 68, 68, 0.6));
            opacity: 0;
            z-index: 3;
            left: 42%;
            top: 46.5%;
        }

        .torpedo-trail.fire {
            animation: trailGrow 1.2s ease-in forwards;
        }

        @keyframes trailGrow {
            0% {
                opacity: 0;
                width: 0;
            }

            20% {
                opacity: 1;
            }

            80% {
                width: 8%;
                opacity: 0.6;
            }

            100% {
                width: 8%;
                opacity: 0;
            }
        }

        /* Status text */
        .battle-status {
            position: absolute;
            top: 5%;
            left: 50%;
            transform: translateX(-50%);
            font-family: 'Orbitron', sans-serif;
            font-size: 0.9rem;
            color: var(--sw-green);
            letter-spacing: 3px;
            z-index: 10;
            text-align: center;
            opacity: 0;
            transition: opacity 0.5s;
            text-shadow: 0 0 10px var(--sw-green-glow);
        }

        .battle-status.show {
            opacity: 1;
        }

        /* Explosion */
        .explosion-ring {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 10px;
            height: 10px;
            border-radius: 50%;
            border: 3px solid #fff;
            opacity: 0;
            z-index: 5;
        }

        .explosion-ring.boom {
            animation: ringExpand 2s ease-out forwards;
        }

        @keyframes ringExpand {
            0% {
                width: 10px;
                height: 10px;
                opacity: 1;
                border-color: #fff;
            }

            50% {
                opacity: 0.8;
                border-color: #f84;
            }

            100% {
                width: 800px;
                height: 800px;
                opacity: 0;
                border-color: #f44;
            }
        }

        .explosion-ring-2 {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 10px;
            height: 10px;
            border-radius: 50%;
            border: 2px solid #fa0;
            opacity: 0;
            z-index: 5;
        }

        .explosion-ring-2.boom {
            animation: ringExpand2 2.5s ease-out 0.3s forwards;
        }

        @keyframes ringExpand2 {
            0% {
                width: 10px;
                height: 10px;
                opacity: 1;
            }

            100% {
                width: 1200px;
                height: 1200px;
                opacity: 0;
            }
        }

        .explosion-flash {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #fff;
            opacity: 0;
            z-index: 6;
        }

        .explosion-flash.boom {
            animation: flashBoom 2s ease-out forwards;
        }

        @keyframes flashBoom {
            0% {
                opacity: 0;
            }

            5% {
                opacity: 1;
                background: #fff;
            }

            15% {
                opacity: 0.9;
                background: #ffa;
            }

            40% {
                opacity: 0.4;
                background: #f84;
            }

            100% {
                opacity: 0;
                background: #000;
            }
        }

        /* Debris particles */
        .debris-container {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            z-index: 5;
        }

        .debris {
            position: absolute;
            width: 4px;
            height: 4px;
            background: #aaa;
            border-radius: 1px;
            opacity: 0;
        }

        .debris.fly {
            animation: debrisFly var(--duration) ease-out forwards;
        }

        @keyframes debrisFly {
            0% {
                opacity: 1;
                transform: translate(0, 0) scale(1);
            }

            20% {
                opacity: 1;
            }

            100% {
                opacity: 0;
                transform: translate(var(--dx), var(--dy)) scale(0.3);
            }
        }

        /* Flag reveal */
        .flag-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 20;
            opacity: 0;
            transition: opacity 2s ease;
        }

        .flag-overlay.show {
            opacity: 1;
        }

        .flag-overlay h2 {
            font-family: 'Orbitron', sans-serif;
            color: var(--sw-amber);
            font-size: 1.5rem;
            letter-spacing: 4px;
            margin-bottom: 1rem;
        }

        .flag-overlay .battle-text {
            font-family: 'Share Tech Mono', monospace;
            color: var(--sw-text);
            font-size: 1rem;
            margin-bottom: 2rem;
            line-height: 1.8;
            text-align: center;
        }

        .flag-overlay .flag-value {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.3rem;
            color: var(--sw-green);
            background: rgba(0, 255, 65, 0.1);
            border: 1px solid var(--sw-green);
            border-radius: 8px;
            padding: 1.5rem 2rem;
            display: inline-block;
            letter-spacing: 2px;
            text-shadow: 0 0 15px var(--sw-green-glow);
            box-shadow: 0 0 30px rgba(0, 255, 65, 0.15);
        }

        .btn-back {
            margin-top: 2rem;
            padding: 0.7rem 2rem;
            background: transparent;
            border: 1px solid var(--sw-amber);
            border-radius: 4px;
            color: var(--sw-amber);
            font-family: 'Orbitron', sans-serif;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s;
        }

        .btn-back:hover {
            background: rgba(255, 179, 0, 0.1);
            box-shadow: 0 0 20px rgba(255, 179, 0, 0.3);
        }

        /* ===== TRENCH RUN ===== */
        .trench-scene {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #000;
            z-index: 10000;
            overflow: hidden;
            perspective: 400px;
        }

        .trench-scene.active {
            display: block;
        }

        /* Stars above trench */
        .trench-stars {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 35%;
            background:
                radial-gradient(1px 1px at 10% 30%, #fff, transparent),
                radial-gradient(1px 1px at 30% 15%, rgba(255, 255, 255, 0.7), transparent),
                radial-gradient(1px 1px at 50% 50%, #fff, transparent),
                radial-gradient(1px 1px at 70% 20%, rgba(255, 255, 255, 0.6), transparent),
                radial-gradient(1px 1px at 85% 40%, #fff, transparent),
                radial-gradient(1px 1px at 15% 60%, rgba(255, 255, 255, 0.8), transparent),
                radial-gradient(1px 1px at 45% 10%, #fff, transparent),
                radial-gradient(1px 1px at 90% 55%, rgba(255, 255, 255, 0.5), transparent);
            z-index: 1;
        }

        /* 3D Trench container */
        .trench-3d {
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            height: 65%;
            perspective: 500px;
            perspective-origin: 50% 20%;
            overflow: hidden;
        }

        /* Floor */
        .trench-floor {
            position: absolute;
            bottom: 0;
            left: -50%;
            width: 200%;
            height: 100%;
            background: linear-gradient(0deg, #2a2a2e 0%, #1a1a1e 40%, transparent 100%);
            transform: rotateX(60deg);
            transform-origin: bottom center;
        }

        .trench-floor::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background:
                repeating-linear-gradient(90deg, transparent, transparent 80px, #444 80px, #444 82px),
                repeating-linear-gradient(0deg, transparent, transparent 60px, #333 60px, #333 61px);
            animation: floorScroll 0.4s linear infinite;
        }

        @keyframes floorScroll {
            0% {
                transform: translateY(0);
            }

            100% {
                transform: translateY(60px);
            }
        }

        /* Left wall */
        .trench-wall-left {
            position: absolute;
            left: 0;
            top: 0;
            width: 25%;
            height: 100%;
            background: linear-gradient(90deg, #3a3a3e, #1a1a1e);
            transform: perspective(500px) rotateY(-30deg);
            transform-origin: left center;
            overflow: hidden;
        }

        .trench-wall-left::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 200%;
            background:
                repeating-linear-gradient(0deg, transparent, transparent 40px, #555 40px, #555 42px),
                repeating-linear-gradient(90deg, transparent, transparent 50px, #444 50px, #444 51px);
            animation: wallScroll 0.5s linear infinite;
        }

        /* Right wall */
        .trench-wall-right {
            position: absolute;
            right: 0;
            top: 0;
            width: 25%;
            height: 100%;
            background: linear-gradient(-90deg, #3a3a3e, #1a1a1e);
            transform: perspective(500px) rotateY(30deg);
            transform-origin: right center;
            overflow: hidden;
        }

        .trench-wall-right::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 200%;
            background:
                repeating-linear-gradient(0deg, transparent, transparent 40px, #555 40px, #555 42px),
                repeating-linear-gradient(90deg, transparent, transparent 50px, #444 50px, #444 51px);
            animation: wallScroll 0.5s linear infinite;
        }

        @keyframes wallScroll {
            0% {
                transform: translateY(0);
            }

            100% {
                transform: translateY(40px);
            }
        }

        /* Wall detail panels that rush past */
        .wall-panel {
            position: absolute;
            background: #2a2a2e;
            border: 1px solid #555;
            animation: panelRush var(--speed) linear infinite;
        }

        .trench-wall-left .wall-panel {
            right: 10%;
            width: 60%;
        }

        .trench-wall-right .wall-panel {
            left: 10%;
            width: 60%;
        }

        .wall-panel:nth-child(2) {
            top: -120px;
            height: 60px;
            --speed: 1.2s;
            background: #333;
        }

        .wall-panel:nth-child(3) {
            top: -280px;
            height: 80px;
            --speed: 1.5s;
            background: #252528;
        }

        .wall-panel:nth-child(4) {
            top: -450px;
            height: 50px;
            --speed: 1.0s;
        }

        .wall-panel:nth-child(5) {
            top: -600px;
            height: 70px;
            --speed: 1.3s;
            background: #303033;
        }

        @keyframes panelRush {
            0% {
                transform: translateY(0);
            }

            100% {
                transform: translateY(800px);
            }
        }

        /* Pipe/conduit details on walls */
        .wall-pipe {
            position: absolute;
            height: 3px;
            background: #666;
            box-shadow: 0 0 4px rgba(100, 100, 100, 0.3);
        }

        .trench-wall-left .wall-pipe {
            right: 5%;
            width: 40%;
        }

        .trench-wall-right .wall-pipe {
            left: 5%;
            width: 40%;
        }

        .wall-pipe:nth-child(6) {
            top: 20%;
        }

        .wall-pipe:nth-child(7) {
            top: 50%;
        }

        .wall-pipe:nth-child(8) {
            top: 75%;
        }

        /* Targeting overlay */
        .trench-targeting {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 120px;
            height: 120px;
            border: 1px solid rgba(0, 255, 65, 0.4);
            border-radius: 50%;
            z-index: 10;
        }

        .trench-targeting::before {
            content: '';
            position: absolute;
            top: 50%;
            left: -40px;
            width: calc(100% + 80px);
            height: 1px;
            background: rgba(0, 255, 65, 0.3);
        }

        .trench-targeting::after {
            content: '';
            position: absolute;
            left: 50%;
            top: -40px;
            height: calc(100% + 80px);
            width: 1px;
            background: rgba(0, 255, 65, 0.3);
        }

        .trench-targeting-inner {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 40px;
            height: 40px;
            border: 1px solid rgba(0, 255, 65, 0.6);
            border-radius: 50%;
        }

        /* Exhaust port target at end */
        .exhaust-port {
            position: absolute;
            top: 38%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 8px;
            height: 8px;
            background: var(--sw-red);
            border-radius: 50%;
            box-shadow: 0 0 15px var(--sw-red), 0 0 30px rgba(255, 68, 68, 0.4);
            z-index: 5;
            animation: portPulse 0.6s ease-in-out infinite;
        }

        @keyframes portPulse {

            0%,
            100% {
                transform: translate(-50%, -50%) scale(1);
            }

            50% {
                transform: translate(-50%, -50%) scale(1.5);
            }
        }

        /* Trench status text */
        .trench-status {
            position: absolute;
            top: 3%;
            left: 50%;
            transform: translateX(-50%);
            font-family: 'Orbitron', sans-serif;
            font-size: 0.85rem;
            color: var(--sw-green);
            letter-spacing: 3px;
            z-index: 15;
            text-align: center;
            text-shadow: 0 0 10px var(--sw-green-glow);
        }

        .trench-comms {
            position: absolute;
            bottom: 8%;
            left: 50%;
            transform: translateX(-50%);
            font-family: 'Share Tech Mono', monospace;
            font-size: 0.8rem;
            color: var(--sw-amber);
            letter-spacing: 1px;
            z-index: 15;
            text-align: center;
            opacity: 0;
            transition: opacity 0.5s;
        }

        .trench-comms.show {
            opacity: 1;
        }

        /* HUD elements */
        .trench-hud-speed {
            position: absolute;
            bottom: 15%;
            left: 5%;
            font-family: 'Share Tech Mono', monospace;
            font-size: 0.7rem;
            color: var(--sw-green);
            z-index: 15;
            opacity: 0.7;
        }

        .trench-hud-distance {
            position: absolute;
            bottom: 15%;
            right: 5%;
            font-family: 'Share Tech Mono', monospace;
            font-size: 0.7rem;
            color: var(--sw-green);
            z-index: 15;
            opacity: 0.7;
        }

        /* X-Wing cockpit frame */
        .cockpit-frame {
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 300px;
            height: 60px;
            z-index: 12;
        }

        .cockpit-frame::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(0deg, #222 0%, #333 40%, transparent 100%);
            clip-path: polygon(30% 100%, 0% 100%, 40% 0%, 60% 0%, 100% 100%, 70% 100%, 55% 30%, 45% 30%);
        }

        /* X-Wing escape */
        .xwing.flee-1 {
            animation: xwingFlee1 1.5s ease-in forwards !important;
        }

        .xwing.flee-2 {
            animation: xwingFlee2 1.5s ease-in 0.1s forwards !important;
        }

        .xwing.flee-3 {
            animation: xwingFlee3 1.5s ease-in 0.2s forwards !important;
        }

        @keyframes xwingFlee1 {
            0% {
                left: 42%;
                top: 45%;
                opacity: 1;
            }

            100% {
                left: 110%;
                top: 35%;
                opacity: 0;
            }
        }

        @keyframes xwingFlee2 {
            0% {
                left: 28%;
                top: 40%;
                opacity: 1;
            }

            100% {
                left: 110%;
                top: 28%;
                opacity: 0;
            }
        }

        @keyframes xwingFlee3 {
            0% {
                left: 28%;
                top: 56%;
                opacity: 1;
            }

            100% {
                left: 110%;
                top: 65%;
                opacity: 0;
            }
        }

        /* Blink */
        @keyframes blink-alert {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.3;
            }
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <div class="dashboard-header">
            <h1>🔓 Control de Ventilación Térmica</h1>
            <a href="./" class="btn-logout">← Volver a Admin</a>
        </div>

        <?php if (!$correct): ?>
            <div class="destruct-box">
                <h2>⚠ CONDUCTO DE ESCAPE TÉRMICO R-421 ⚠</h2>
                <p>Este panel controla la trampilla del conducto de ventilación térmica
                    que conecta directamente con el núcleo del reactor de hipermateria.</p>
                <p style="color: var(--sw-amber); font-size: 0.8rem;">
                    ADVERTENCIA: La apertura de esta trampilla compromete la integridad
                    estructural de la estación. Se requiere el código de autorización
                    clasificado para proceder.</p>

                <?php if ($error): ?>
                    <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>

                <form method="POST" action="">
                    <input type="text" name="code" class="code-input" placeholder="CÓDIGO DE AUTORIZACIÓN"
                        autocomplete="off" required>
                    <br>
                    <button type="submit" class="btn-destruct">🔓 Abrir Trampilla</button>
                </form>
            </div>
        <?php else: ?>
            <div class="destruct-box" id="activatedBox">
                <h2 style="color: var(--sw-green);">✓ TRAMPILLA ABIERTA</h2>
                <p style="color: var(--sw-red); animation: blink-alert 1s infinite;">
                    ⚠ El conducto de escape térmico R-421 ha sido expuesto.</p>
                <p>La Alianza Rebelde ha sido notificada. Escuadrón Rojo en camino...</p>
                <br>
                <button class="btn-destruct" onclick="startBattle()" id="btnStart">
                    ⚡ Transmitir Coordenadas a la Alianza
                </button>
            </div>
        <?php endif; ?>

        <div class="footer">
            Imperio Galáctico &bull; Ingeniería de la Estación &bull; Clasificado: Ultra Secreto
        </div>
    </div>

    <!-- Trench Run Scene -->
    <div class="trench-scene" id="trenchScene">
        <div class="trench-stars"></div>
        <div class="trench-3d">
            <div class="trench-floor"></div>
            <div class="trench-wall-left">
                <div class="wall-panel"></div>
                <div class="wall-panel"></div>
                <div class="wall-panel"></div>
                <div class="wall-panel"></div>
                <div class="wall-panel"></div>
                <div class="wall-pipe"></div>
                <div class="wall-pipe"></div>
                <div class="wall-pipe"></div>
            </div>
            <div class="trench-wall-right">
                <div class="wall-panel"></div>
                <div class="wall-panel"></div>
                <div class="wall-panel"></div>
                <div class="wall-panel"></div>
                <div class="wall-panel"></div>
                <div class="wall-pipe"></div>
                <div class="wall-pipe"></div>
                <div class="wall-pipe"></div>
            </div>
        </div>
        <div class="trench-targeting">
            <div class="trench-targeting-inner"></div>
        </div>
        <div class="exhaust-port" id="exhaustPort"></div>
        <div class="cockpit-frame"></div>
        <div class="trench-status" id="trenchStatus">[ ENTRANDO EN LA TRINCHERA ]</div>
        <div class="trench-comms" id="trenchComms"></div>
        <div class="trench-hud-speed">VEL: 1,050 km/s</div>
        <div class="trench-hud-distance" id="trenchDistance">DIST: 5,000m</div>
    </div>

    <!-- Battle Scene -->
    <div class="battle-scene" id="battleScene">
        <!-- Status text -->
        <div class="battle-status" id="battleStatus"></div>

        <!-- Death Star -->
        <div class="death-star" id="deathStar">
            <div class="vent-glow" id="ventGlow"></div>
        </div>

        <!-- X-Wings -->
        <div class="xwing xwing-1" id="xwing1">
            <div class="xwing-wing top-1"></div>
            <div class="xwing-wing top-2"></div>
            <div class="xwing-body">
                <div class="xwing-engine"></div>
            </div>
            <div class="xwing-wing bot-1"></div>
            <div class="xwing-wing bot-2"></div>
        </div>
        <div class="xwing xwing-2" id="xwing2">
            <div class="xwing-wing top-1"></div>
            <div class="xwing-wing top-2"></div>
            <div class="xwing-body">
                <div class="xwing-engine"></div>
            </div>
            <div class="xwing-wing bot-1"></div>
            <div class="xwing-wing bot-2"></div>
        </div>
        <div class="xwing xwing-3" id="xwing3">
            <div class="xwing-wing top-1"></div>
            <div class="xwing-wing top-2"></div>
            <div class="xwing-body">
                <div class="xwing-engine"></div>
            </div>
            <div class="xwing-wing bot-1"></div>
            <div class="xwing-wing bot-2"></div>
        </div>

        <!-- Torpedo -->
        <div class="torpedo" id="torpedo"></div>
        <div class="torpedo-trail" id="torpedoTrail"></div>

        <!-- Explosion effects -->
        <div class="explosion-ring" id="ring1"></div>
        <div class="explosion-ring-2" id="ring2"></div>
        <div class="explosion-flash" id="flash"></div>

        <!-- Debris container -->
        <div class="debris-container" id="debrisContainer"></div>

        <!-- Flag reveal -->
        <div class="flag-overlay" id="flagOverlay">
            <h2>💥 ESTRELLA DE LA MUERTE DESTRUIDA 💥</h2>
            <p class="battle-text">
                El torpedo de protones ha impactado en el reactor principal.<br>
                La Estrella de la Muerte ha sido destruida.<br>
                La Alianza Rebelde celebra esta victoria.<br><br>
                Has completado tu misión, agente.
            </p>
            <div class="flag-value">
                <?php
                if ($correct) {
                    echo "FLAG{S3LF_D3STRUCT_R3B3L_W1NS_k9p4z2}";
                } else {
                    echo "ERROR: NO AUTHORIZED";
                }
                ?>
            </div>

            <a href="../dashboard.php" class="btn-back">VOLVER AL INICIO</a>
        </div>
    </div>

    <script>
        // Check if we should auto-start destruction (only if PHP validated code)
        <?php if ($correct): ?>
            window.addEventListener('DOMContentLoaded', (event) => {
                const btn = document.querySelector('.btn-destruct');
                if (btn) btn.click();
            });
        <?php endif; ?>

        function startBattle() {
            const btn = document.getElementById('btnStart');
            btn.disabled = true;
            btn.style.opacity = '0.5';

            // ===== PHASE A: Trench Run (first-person) =====
            const trench = document.getElementById('trenchScene');
            const tStatus = document.getElementById('trenchStatus');
            const tComms = document.getElementById('trenchComms');
            const tDist = document.getElementById('trenchDistance');
            const port = document.getElementById('exhaustPort');

            trench.classList.add('active');

            // Simulate distance countdown
            let dist = 5000;
            const distInterval = setInterval(() => {
                dist -= 50;
                if (dist < 0) dist = 0;
                tDist.textContent = 'DIST: ' + dist.toLocaleString() + 'm';
            }, 100);

            // 1s - Entering trench
            setTimeout(() => {
                tComms.textContent = '"Líder Rojo, estoy en la trinchera."';
                tComms.classList.add('show');
            }, 1000);

            // 2.5s - Wingman comm
            setTimeout(() => {
                tComms.textContent = '"Rojo 2 cubriendo. Tenemos compañía arriba."';
            }, 2500);

            // 4s - Approaching target
            setTimeout(() => {
                tStatus.textContent = '[ OBJETIVO A LA VISTA ]';
                tStatus.style.color = 'var(--sw-amber)';
                tComms.textContent = '"Activando ordenador de ataque..."';
                port.style.width = '12px';
                port.style.height = '12px';
                port.style.boxShadow = '0 0 25px var(--sw-red), 0 0 50px rgba(255,68,68,0.5)';
            }, 4000);

            // 5.5s - Lock on
            setTimeout(() => {
                tStatus.textContent = '[ OBJETIVO FIJADO ]';
                tStatus.style.color = 'var(--sw-green)';
                tComms.textContent = '"Usa la Fuerza, Luke..."';
                port.style.width = '16px';
                port.style.height = '16px';
            }, 5500);

            // 7s - Fire!
            setTimeout(() => {
                tStatus.textContent = '[ ¡TORPEDO LANZADO! ]';
                tStatus.style.color = 'var(--sw-red)';
                tComms.textContent = '"¡Gran disparo, chaval! Eso fue uno en un millón."';
                clearInterval(distInterval);
                tDist.textContent = 'DIST: 0m';
            }, 7000);

            // 8.5s - Transition to exterior battle scene
            setTimeout(() => {
                trench.classList.remove('active');
                startExteriorBattle();
            }, 8500);
        }

        function startExteriorBattle() {
            const scene = document.getElementById('battleScene');
            const status = document.getElementById('battleStatus');

            scene.classList.add('active');

            // Phase 1: Torpedo already fired - show it hitting
            setTimeout(() => {
                status.textContent = '[ TORPEDO DE PROTONES — EN TRAYECTORIA ]';
                status.classList.add('show');
                document.getElementById('ventGlow').style.opacity = '1';
            }, 300);

            // Phase 2: Torpedo hits the vent
            setTimeout(() => {
                status.textContent = '[ ¡IMPACTO EN EL CONDUCTO DE ESCAPE TÉRMICO! ]';
                status.style.color = 'var(--sw-amber)';
                document.getElementById('torpedo').classList.add('fire');
                document.getElementById('torpedoTrail').classList.add('fire');
            }, 2000);

            // Phase 3: X-Wings flee!
            setTimeout(() => {
                status.textContent = '[ ESCUADRÓN ROJO — ¡ALEJAOS DE AHÍ! ]';
                status.style.color = 'var(--sw-amber)';
                document.getElementById('xwing1').classList.add('flee-1');
                document.getElementById('xwing2').classList.add('flee-2');
                document.getElementById('xwing3').classList.add('flee-3');
            }, 3500);

            // Phase 4: Reactor overload
            setTimeout(() => {
                status.textContent = '[ REACCIÓN EN CADENA — REACTOR CRÍTICO ]';
                status.style.color = 'var(--sw-red)';
            }, 5000);

            // Phase 5: BOOM
            setTimeout(() => {
                status.textContent = '[ DESTRUCCIÓN TOTAL ]';
                document.getElementById('deathStar').style.opacity = '0';
                document.getElementById('ring1').classList.add('boom');
                document.getElementById('ring2').classList.add('boom');
                document.getElementById('flash').classList.add('boom');
                createDebris();
            }, 6000);

            // Phase 6: Show flag
            setTimeout(() => {
                status.classList.remove('show');
                document.getElementById('flagOverlay').classList.add('show');
            }, 9500);
        }

        function createDebris() {
            const container = document.getElementById('debrisContainer');
            const colors = ['#aaa', '#888', '#f84', '#fa0', '#ff4', '#666'];

            for (let i = 0; i < 60; i++) {
                const debris = document.createElement('div');
                debris.className = 'debris';

                // Random direction and distance
                const angle = Math.random() * Math.PI * 2;
                const distance = 200 + Math.random() * 500;
                const dx = Math.cos(angle) * distance;
                const dy = Math.sin(angle) * distance;
                const duration = 1.5 + Math.random() * 2;

                debris.style.setProperty('--dx', dx + 'px');
                debris.style.setProperty('--dy', dy + 'px');
                debris.style.setProperty('--duration', duration + 's');
                debris.style.width = (2 + Math.random() * 6) + 'px';
                debris.style.height = (2 + Math.random() * 4) + 'px';
                debris.style.background = colors[Math.floor(Math.random() * colors.length)];

                container.appendChild(debris);

                // Trigger animation
                requestAnimationFrame(() => {
                    debris.classList.add('fly');
                });
            }
        }
    </script>
</body>

</html>
