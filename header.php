<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="./style.css"> -->
    <style>
        body {
            font-family: Arial, sans-serif;
                background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
    .menu {
            /* padding: 20px; */
            /* margin-bottom: 20px; */
            /* background-color: #3011BC; */
            width: 800px;
            /* background-color: #fff; */

            margin-top: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-left: 400px;
            margin-bottom: 10px;
            padding-left: 30px;

            
            

            
        }

        .menu ul {
            display: flex;
            justify-content: center;
            list-style-type: none;
            margin: 0;
            /* padding: 30px; */
            overflow: hidden;
        }

        .menu li {
            float: left;
            margin-right: 50px;
        }

        .menu li:last-child {
            margin-right: 0;
        }

        .menu li a {
            /* display: block; */
            color: #3011BC;
            text-decoration: none;
            /* padding: 10px; */
            transition: background-color 0.3s;
            margin-right: 40px;
        }

        .menu li a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="menu">
<nav class="navbar">
    <ul>
        <li><a href="index.php">Accueil</a></li>
        <li><a href="billets.php">Billets</a></li>
        <li><a href="clients.php">Clients</a></li>
        <li><a href="./ajouterbillet.php">Réservations</a></li>
    </ul>
</nav>

</div>
</body>
</html>