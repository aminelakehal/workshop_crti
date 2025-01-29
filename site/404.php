<?php

header("HTTP/1.0 404 Not Found");

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page not found</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f4f8;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
        }
        .container {
            text-align: center;
            position: relative;
        }
        .error-code {
            font-size: 180px;
            font-weight: bold;
            color: #2c3e50;
            margin: 0;
            line-height: 1;
        }
        .error-message {
            font-size: 24px;
            color: #34495e;
            margin-top: 20px;
        }
        .eyes {
            position: absolute;
            top: -100px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 40px;
        }
        .eye {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: white;
            border: 5px solid #2c3e50;
            position: relative;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .pupil {
            width: 30px;
            height: 30px;
            background-color: #2c3e50;
            border-radius: 50%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            transition: all 0.1s ease;
        }
        .home-link {
            display: inline-block;
            margin-top: 30px;
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .home-link:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="eyes">
            <div class="eye"><div class="pupil"></div></div>
            <div class="eye"><div class="pupil"></div></div>
        </div>
        <h1 class="error-code">404</h1>
        <p class="error-message">Oops ! The page you are looking for appears to have taken off.</p>
        <a href="/workshop_crti/site/index.php" class="home-link">Retour à l'accueil</a>
    </div>

    <script>
        document.addEventListener('mousemove', (e) => {
            const eyes = document.querySelectorAll('.eye');
            eyes.forEach(eye => {
                const rect = eye.getBoundingClientRect();
                const eyeCenterX = rect.left + rect.width / 2;
                const eyeCenterY = rect.top + rect.height / 2;
                const angle = Math.atan2(e.clientY - eyeCenterY, e.clientX - eyeCenterX);
                const distance = Math.min(rect.width / 4, Math.hypot(e.clientX - eyeCenterX, e.clientY - eyeCenterY) / 10);
                const pupil = eye.querySelector('.pupil');
                const x = Math.cos(angle) * distance;
                const y = Math.sin(angle) * distance;
                pupil.style.transform = `translate(calc(-50% + ${x}px), calc(-50% + ${y}px))`;
            });
        });
    </script>
</body>
</html>





