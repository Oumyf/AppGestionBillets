<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Billets</title>
    <link rel="stylesheet" href="./style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>

    body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    background-color: #f4f4f4;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    width: 100%;
    margin-top: 20px;
    margin: 20px auto;
}
/* 
.header {
    background-color: #007bff;
    color: white;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 20px;
} */

h2 {
    text-align: center;
    margin-bottom: 20px;
}

.card {
    border: 1px solid #ccc;
    border-radius: 10px;
    margin-bottom: 20px;
    transition: box-shadow 0.3s ease;
}

.card:hover {
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

.card-title {
    font-size: 1.25rem;
    margin-bottom: 10px;
}

.card-text {
    font-size: 0.9rem;
}

.btn {
    padding: 8px 16px;
    border-radius: 5px;
    cursor: pointer;
}

.btn-primary {
    background-color: #3011BC;
    color: white;
}

.btn-primary:hover {
    background-color:#3011BC ;
}

.btn-danger {
    background-color: #FE7A15;
    color: white;
}

.btn-danger:hover {
    background-color: #3011BC;
}

.achat{
    background-color: #FE7A15;
}
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <?php include "header.php"; ?>
        </div>
        <h2>Liste des billets</h2>
        <a href="./ajouterbillet.php" class="btn btn-success mb-3 achat">Acheter un billet</a>
        
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <?php
            //inclure la page de connexion
            include_once "config.php";

            //requête pour afficher la liste des billets
            // Récupérer les informations sur les billets avec les informations des clients
            $query = "SELECT Billet.*, Client.*
                      FROM Billet 
                      LEFT JOIN Client ON Billet.ID_client = Client.ID ";
            $result = mysqli_query($con, $query);
            if(mysqli_num_rows($result) == 0){
                //s'il n'existe pas de billets dans la base de données, afficher un message
                echo "<p class='text-center'>Il n'y a pas encore de billet acheté !</p>";
            } else {
                // Afficher chaque billet sous forme de carte Bootstrap
                while($row=mysqli_fetch_assoc($result)){
            ?>
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?= $row['description'] ?></h5>
                            <p class="card-text">
                                <strong>Date de départ:</strong> <?= $row['date_depart'] ?><br>
                                <strong>Heure de départ:</strong> <?= $row['heure_depart'] ?><br>
                                <strong>Date d'arrivée:</strong> <?= $row['date_arrivee'] ?><br>
                                <strong>Heure d'arrivée:</strong> <?= $row['heure_arrivee'] ?><br>
                                <strong>Statut:</strong> <?= $row['statut'] ?><br>
                                <strong>Client:</strong> <?= $row['nom'] ?> <?= $row['prenom'] ?><br>
                                <strong>Téléphone:</strong> <?= $row['numero_tel'] ?><br>
                                <strong>Email:</strong> <?= $row['mail'] ?><br>
                                <strong>Pays:</strong> <?= $row['pays'] ?><br>
                                <strong>Ville:</strong> <?= $row['ville'] ?><br>
                                <strong>Destination:</strong> <?= $row['destination'] ?><br>
                            </p>
                            <div class="d-grid gap-2">
                                <a href='modifierbillet.php?id=<?= $row['numero'] ?>' class='btn btn-primary'>Modifier</a>
                                <a href='supprimerbillet.php?id=<?= $row['numero'] ?>' class='btn btn-danger'>Supprimer</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                }
            }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
