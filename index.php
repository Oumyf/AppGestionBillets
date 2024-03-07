<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Billets</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            /* background-color: #f4f4f4; */
            margin: 0;
            padding: 0;

        }

        .baniere {
            background-image: url('./images/Fotolia_52234181_Subscription_Monthly_M-1.jpg');
            width: 100%;
            height: 600px;
            color: #3011BC;
            text-align: center;

        }
        .baniere p{
            width: 1200px;
            padding-top: 300px;
            padding-left: 400px;
            font-style: italic;
            font-weight: 700;
            color: #000;
        }


        .container {
            /* background-color: #fff; */
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.7);
            transition: box-shadow 0.3s ease;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .card:hover {
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body>
    <div class="header">
        <?php
        include "header.php";
        ?>
        <div class="baniere">
            <p> <strong>  Bienvenue à Oumy Tukki  Où l'Aventure Commence 

Explorez le monde avec Oumy Tukki, votre passerelle vers des expériences extraordinaires et des souvenirs inoubliables. Nous sommes bien plus qu'une agence de voyage, nous sommes vos compagnons de route, prêts à transformer vos rêves de voyage en réalité
.</strong></p>
          
        </div>

    </div>
</body>

</html>