<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HidroBit</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', Arial, sans-serif; /* Adicionando Montserrat como a primeira opção de fonte */
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: black;
        }
        .container {
            display: flex;
            overflow: hidden;
            width: calc(100% - 100px);
            height: calc(100vh - 100px);
            margin: 20px;
            background-color: black;
        }

        .left {
            width: 60%; 
            height: 100%;
            padding: 50px;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background-image: linear-gradient(to right, #1093EB, #143E63);
            color: white;
            padding: 50px 80px;
        }
        .right {
            width: 50%;
            height: 100%;
            background-image: url('logos/water-ping.jpg');
            background-size: cover;
            background-position: center;
            margin-left: 20px;
        }
        .logo img {
            width: 200px;
            margin-top: 30px;
            margin-bottom: 30px;
        }
        .headline {
            font-size: 64px;
            line-height: 1.2;
            margin-bottom: 50px;
            font-weight: bold;
            white-space: nowrap;
        }
        .btn {
            background-color: black;
            color: #1093EB;
            padding: 15px 30px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            align-self: flex-start;
            width: auto;
            text-decoration: none;
            transition: transform 0.3s ease-in-out;
        }
        .btn:hover {
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left">
            <div class="logo"><img src="logos/2.png" alt="HidroBit Logo"></div>
            <div class="headline">
                Transformando turbidez <br>
                em informação <br>
                clara
            </div>
            <a href="index.php" class="btn">COMECE A MONITORAR</a>
        </div>
        <div class="right"></div>
    </div>
</body>
</html>
