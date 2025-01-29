
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 403 - Access forbidden</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700&display=swap');

        :root {
            --primary-color: #3498db;
            --secondary-color: #e74c3c;
            --background-color: #f0f0f0;
            --text-color: #2c3e50;
        }

        body {
            font-family: 'Tajawal', Arial, sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            overflow: hidden;
        }

        .container {
            text-align: center;
            background-color: white;
            padding: 3rem;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            max-width: 500px;
            width: 90%;
        }

        h1 {
            color: var(--secondary-color);
            font-size: 4rem;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }

        p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        #lock-container {
            width: 150px;
            height: 150px;
            margin: 0 auto 2rem;
            position: relative;
        }

        #message {
            opacity: 0;
            transition: opacity 0.5s, transform 0.5s;
            font-weight: bold;
            color: var(--secondary-color);
            font-size: 2rem;
            margin-top: 1rem;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
        }

        #particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }

        .particle {
            position: absolute;
            background-color: var(--primary-color);
            border-radius: 50%;
            opacity: 0;
        }

        @keyframes fadeInOut {
            0%, 100% { opacity: 0; transform: scale(0.5); }
            50% { opacity: 1; transform: scale(1); }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        .container {
            animation: float 6s ease-in-out infinite;
        }
    </style>
</head>
<body>
    <div id="particles"></div>
    <div class="container">
    <h1>error 403</h1>
    <p>Sorry, you do not have access to this page.</p>
        <div id="lock-container">
            <svg width="150" height="150" viewBox="0 0 150 150">
                <g id="lock">
                    <rect id="lock-body" x="35" y="70" width="80" height="65" rx="10" ry="10" fill="#3498db"/>
                    <path id="lock-hook" d="M50 70 V40 A25,25 0 0 1 100,40 V70" stroke="#3498db" stroke-width="12" fill="none"/>
                    <circle id="keyhole" cx="75" cy="100" r="8" fill="#f0f0f0"/>
                </g>
            </svg>
        </div>
        <div id="message">Stop!</div>
    </div>

    <script>
        const lock = document.getElementById('lock');
        const message = document.getElementById('message');
        const particles = document.getElementById('particles');

        function animateLock() {
            lock.animate([
                { transform: 'rotate(0deg)' },
                { transform: 'rotate(-5deg)' },
                { transform: 'rotate(5deg)' },
                { transform: 'rotate(0deg)' }
            ], {
                duration: 500,
                iterations: 2
            });

            setTimeout(() => {
                message.style.opacity = '1';
                message.style.transform = 'scale(1.1)';
                createParticles();
                setTimeout(() => {
                    message.style.opacity = '0';
                    message.style.transform = 'scale(1)';
                    setTimeout(animateLock, 2000);
                }, 1000);
            }, 1000);
        }

        function createParticles() {
            for (let i = 0; i < 20; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');
                particle.style.width = `${Math.random() * 10 + 5}px`;
                particle.style.height = particle.style.width;
                particle.style.left = `${Math.random() * 100}%`;
                particle.style.top = `${Math.random() * 100}%`;
                particle.style.animation = `fadeInOut ${Math.random() * 2 + 1}s ease-out`;
                particles.appendChild(particle);
                setTimeout(() => particle.remove(), 2000);
            }
        }

        animateLock();
    </script>
</body>
</html>