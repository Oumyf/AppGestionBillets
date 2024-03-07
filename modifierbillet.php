<?php
session_start();

include_once "config.php";

// Vérifier si l'identifiant du billet est présent dans l'URL
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Récupérer les données du billet à modifier depuis la base de données
    $query_billet = "SELECT * FROM Billet WHERE numero = ?";
    $stmt = $con->prepare($query_billet);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Vérifier si le billet existe
    if($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Vérifier si le formulaire a été soumis
        if(isset($_POST['button'])) {
            // Récupérer et valider les données du formulaire
            $description = htmlspecialchars($_POST['description']);
            $statut = htmlspecialchars($_POST['statut']);
            $ID_client = htmlspecialchars($_POST['ID_client']);
            $date_depart = htmlspecialchars($_POST['date_depart']);
            $heure_depart = htmlspecialchars($_POST['heure_depart']);
            $date_arrivee = htmlspecialchars($_POST['date_arrivee']);
            $heure_arrivee = htmlspecialchars($_POST['heure_arrivee']);
            $destination = htmlspecialchars($_POST['destination']);
            $prix = htmlspecialchars($_POST['prix']);

            // Vérifier que tous les champs sont remplis
            if(!empty($description) && !empty($statut) && !empty($ID_client) && !empty($date_depart) && !empty($heure_depart) && !empty($date_arrivee) && !empty($heure_arrivee) && !empty($destination) && !empty($prix)) {
                // Requête de mise à jour du billet
                $query_update = "UPDATE Billet SET description = ?, statut = ?, ID_client = ?, date_depart = ?, heure_depart = ?, date_arrivee = ?, heure_arrivee = ?, destination = ?, prix = ? WHERE numero = ?";
                $stmt = $con->prepare($query_update);
                $stmt->bind_param("sss", $description, $statut, $ID_client, $date_depart, $heure_depart, $date_arrivee, $heure_arrivee, $destination, $prix, $id);
                $stmt->execute();

                // Vérifier si la mise à jour a réussi
                if($stmt->affected_rows > 0) {
                    header("Location: index.php");
                    exit();
                } else {
                    $message = "Erreur lors de la mise à jour du billet.";
                }
            } else {
                $message = "Veuillez remplir tous les champs !";
            }
        }
    } else {
        $message = "Aucun billet trouvé avec cet identifiant.";
    }
} else {
    $message = "Aucun identifiant de billet fourni.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* style.css */

body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f2f2f2;
}

.form {
    width: 50%;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.back_btn {
    display: inline-block;
    text-decoration: none;
    color: #FE7A15;
    margin-bottom: 10px;
}

.back_btn img {
    vertical-align: middle;
    margin-right: 5px;
}

h2 {
    text-align: center;
}

label {
    display: block;
    margin-top: 10px;
    font-weight: bold;
}

input[type="text"],
input[type="date"],
input[type="time"],
select {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

select {
    height: 40px; /* ajuster la hauteur pour correspondre aux champs de texte */
}

input[type="submit"] {
    background-color:#FE7A15;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    width: 100%;
}

input[type="submit"]:hover {
    background-color: #FE7A15;
}

.erreur_message {
    color: red;
    text-align: center;
    margin-top: 10px;
}
    </style>
</head>
<body>
<div class="form">
    <a href="index.php" class="back_btn"><img src="images/back.png"> Retour</a>
    <h2>Modifier le billet : <?=$row['description']?></h2>
    <?php if(isset($message)) echo "<p class='erreur_message'>$message</p>"; ?>
    <form action="" method="POST">
        <label>Description</label>
        <input type="text" name="description" value="<?=isset($row['description']) ? htmlspecialchars($row['description']) : ''?>">

        <label>Statut</label>
        <input type="text" name="statut" value="<?=isset($row['statut']) ? htmlspecialchars($row['statut']) : ''?>">

        <select name="ID_client">
            <option value="">Sélectionner un client</option>
            <?php
                $query_clients = "SELECT ID, nom , prenom FROM Client";
                $result_clients = mysqli_query($con, $query_clients);
                while ($row_client = mysqli_fetch_assoc($result_clients)) {
                    $selected = ($row['ID_client'] == $row_client['ID']) ? 'selected' : '';
                    echo "<option value='" . $row_client['ID'] . "' $selected>" . $row_client['nom'] . "</option>";
                }
            ?>
        </select>

        <label>Date de départ</label>
        <input type="date" name="date_depart" value="<?=isset($row['date_depart']) ? htmlspecialchars($row['date_depart']) : ''?>"> 

        <label>Heure de départ</label>
        <input type="time" name="heure_depart" value="<?=isset($row['heure_depart']) ? htmlspecialchars($row['heure_depart']) : ''?>"> 

        <label>Date d'arrivée</label>
        <input type="date" name="date_arrivee" value="<?=isset($row['date_arrivee']) ? htmlspecialchars($row['date_arrivee']) : ''?>"> 

        <label>Heure d'arrivée</label>
        <input type="time" name="heure_arrivee" value="<?=isset($row['heure_arrivee']) ? htmlspecialchars($row['heure_arrivee']) : ''?>"> 

        <label>Destination</label>
        <input type="text" name="destination" value="<?=isset($row['destination']) ? htmlspecialchars($row['destination']) : ''?>">

        <label>Prix</label>
        <input type="text" name="prix" value="<?=isset($row['prix']) ? htmlspecialchars($row['prix']) : ''?>"> 
          
        <input type="submit" value="Modifier" name="button">
    </form>
</div>
</body>
</html>
