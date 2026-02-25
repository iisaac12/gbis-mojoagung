<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>500 | Internal Error</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            background: black;
            color: #00ff41;
            font-family: "Courier New", monospace;
            overflow: hidden;
        }

        .container {
            text-align: center;
            margin-top: 15vh;
        }

        h1 {
            font-size: 120px;
            margin: 0;
            animation: glitch 1s infinite;
        }

        p {
            font-size: 20px;
            margin: 10px 0;
        }

        .terminal {
            margin-top: 30px;
            font-size: 18px;
        }

        .cursor {
            display: inline-block;
            width: 10px;
            background: #00ff41;
            margin-left: 5px;
            animation: blink 1s infinite;
        }

        a {
            display: inline-block;
            margin-top: 40px;
            padding: 10px 20px;
            border: 1px solid #00ff41;
            color: #00ff41;
            text-decoration: none;
            transition: 0.3s;
        }

        a:hover {
            background: #00ff41;
            color: black;
        }

        @keyframes blink {
            0%, 50%, 100% { opacity: 1; }
            25%, 75% { opacity: 0; }
        }

        @keyframes glitch {
            0% { text-shadow: 2px 2px red; }
            25% { text-shadow: -2px -2px blue; }
            50% { text-shadow: 2px -2px lime; }
            75% { text-shadow: -2px 2px purple; }
            100% { text-shadow: 2px 2px red; }
        }

        /* Matrix rain background */
        canvas {
            position: fixed;
            top: 0;
            left: 0;
            z-index: -1;
        }
    </style>
</head>
<body>

<canvas id="matrix"></canvas>

<div class="container">
    <h1>500</h1>

    <p>> SYSTEM ERROR</p>
    <p>> TARGET NOT FOUND</p>

    <div class="terminal">
        root@server:~$ redirect --home<span class="cursor"></span>
    </div>

    <a href="{{ url('/') }}">Return to Safe Zone</a>
</div>

<script>
    const canvas = document.getElementById("matrix");
    const ctx = canvas.getContext("2d");

    canvas.height = window.innerHeight;
    canvas.width = window.innerWidth;

    const letters = "01";
    const fontSize = 14;
    const columns = canvas.width / fontSize;
    const drops = [];

    for (let x = 0; x < columns; x++) {
        drops[x] = 1;
    }

    function draw() {
        ctx.fillStyle = "rgba(0, 0, 0, 0.05)";
        ctx.fillRect(0, 0, canvas.width, canvas.height);

        ctx.fillStyle = "#00ff41";
        ctx.font = fontSize + "px monospace";

        for (let i = 0; i < drops.length; i++) {
            const text = letters[Math.floor(Math.random() * letters.length)];
            ctx.fillText(text, i * fontSize, drops[i] * fontSize);

            if (drops[i] * fontSize > canvas.height && Math.random() > 0.975)
                drops[i] = 0;

            drops[i]++;
        }
    }

    setInterval(draw, 33);
</script>

</body>
</html>