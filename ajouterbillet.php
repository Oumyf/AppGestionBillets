<?php
// Vérifier si le formulaire a été soumis
if (isset($_POST['button'])) {
    // Extraction des données du formulaire
    $description = $_POST['description'];
    $statut = $_POST['statut'];
    $id_client = $_POST['ID_client'];
    $date_depart = $_POST['date_depart'];
    $heure_depart = $_POST['heure_depart'];
    $date_arrivee = $_POST['date_arrivee'];
    $heure_arrivee = $_POST['heure_arrivee'];
    $prix = $_POST['prix'];
    $destination = $_POST['destination']; // Ajout de la variable destination

    // Vérification des champs obligatoires
    if (!empty($description) && !empty($statut) && !empty($id_client) && !empty($date_depart) && !empty($heure_depart) && !empty($date_arrivee) && !empty($heure_arrivee) && !empty($prix) && !empty($destination)) {
        // Inclure le fichier de connexion à la base de données
        include_once "config.php";

        // Requête d'insertion avec des requêtes préparées pour éviter les injections SQL
        $stmt = $con->prepare("INSERT INTO Billet (description, statut, ID_client, date_depart, heure_depart, date_arrivee, heure_arrivee, prix, destination) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssissssis", $description, $statut, $id_client, $date_depart, $heure_depart, $date_arrivee, $heure_arrivee, $prix, $destination);
        $stmt->execute();

        // Vérifier si l'insertion a réussi
        if ($stmt->affected_rows > 0) {
            $stmt->close(); // Fermer la requête préparée
            $con->close(); // Fermer la connexion à la base de données
            header("Location: index.php?success=1"); // Rediriger avec un indicateur de succès
            exit(); // Terminer le script après la redirection
        } else {
            $message = "Erreur lors de l'insertion du billet.";
        }
    } else {
        $message = "Veuillez remplir tous les champs !";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un billet</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<style>
    body {
        background-image: url('./images/agence-voyage-pas-cher.jpg');
        background-repeat: no-repeat;
        background-size: contain;
    
    }
    .card{
        background-color: transparent;
        width: 700px;
        margin-left: -850px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.9);
        margin-top: 20px;
    }
    .header {
            /* display: block; */
            color: #000;
            text-decoration: none;
            /* padding: 10px; */
            transition: background-color 0.3s;
            margin-right: 40px;
        }



</style>

<body>
<div class="header">
        <?php
        include "header.php";
        ?>
        </div>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                    <a href="index.php" class="back_btn"><img src="images/back.png"><strong>Retour</strong> </a>
                        <h2 class="text-center">Ajouter un billet</h2>
                    </div>
                    <div class="card-body">
                        <?php if (isset($message)) echo "<p class='message'>$message</p>"; ?>
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" name="description" required>
                            </div>
                            <div class="form-group">
                                <label for="statut">Statut</label>
                                <select class="form-control" name="statut" required>
                                    <option value="en_attente">En Attente</option>
                                    <option value="en_cours">En cours</option>
                                    <option value="valider">Validé</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="id_client">Client</label>
                                <!-- Remplacez les options par les clients réels de votre base de données -->
                                <select name="ID_client">
                                    <!-- <option value="">Sélectionner un client</option> -->
                                    <?php
                                    // Inclure le fichier de connexion à la base de données
                                    include_once "config.php";

                                    // Récupérer la liste des catégories depuis la base de données
                                    $query_clients = "SELECT ID, nom , prenom FROM Client";
                                    $result_clients = mysqli_query($con, $query_clients);
                                    while ($row_client = mysqli_fetch_assoc($result_clients)) {
                                        echo "<option value='" . $row_client['ID'] . "'>" . $row_client['prenom'] . " " .$row_client['nom'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="date_depart">Date de Départ</label>
                                <input type="date" class="form-control" name="date_depart" required>
                            </div>
                            <div class="form-group">
                                <label for="heure_depart">Heure de Départ</label>
                                <input type="time" class="form-control" name="heure_depart" required>
                            </div>
                            <div class="form-group">
                                <label for="date_arrivee">Date d'Arrivée</label>
                                <input type="date" class="form-control" name="date_arrivee" required>
                            </div>
                            <div class="form-group">
                                <label for="heure_arrivee">Heure d'Arrivée</label>
                                <input type="time" class="form-control" name="heure_arrivee" required>
                            </div>
                            <div class="form-group">
                                <label for="prix">Prix</label>
                                <input type="number" class="form-control" name="prix" required>
                            </div>
                            <div class="form-group">
                                <label for="destination">Destination</label>
                                <select class="form-control" name="destination" required>
                                    <option value="France">France</option>
                                    <option value="Londres">Londres</option>
                                    <option value="Espagne">Espagne</option>
                                    <option value="Dubaï">Dubaï</option>
                                    <option value="Canada">Canada</option>
                                    <option value="Maroc">Maroc</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary btn-block" value="Ajouter" name="button">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>