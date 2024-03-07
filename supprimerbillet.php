<?php
/* confirmer */
if(isset($_POST["numero"]) && !empty($_POST["numero"])){
    /* Inclure le fichier config */
    require_once "config.php";
    
    $sql = "DELETE FROM Billet WHERE numero = ?";
    
    if($stmt = mysqli_prepare($con, $sql)){
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        $param_id = trim($_POST["numero"]);
        
        if(mysqli_stmt_execute($stmt)){
            /* supprimé, retourne */
            header("location: index.php");
            exit();
        } else{
            echo "Oops! une erreur est survenue.";
        }
    }
     
    mysqli_stmt_close($stmt);
    
    mysqli_close($link);
} else{
   // verifier si paramettre id exite 
     if(empty(trim($_GET["id"]))){
         header("location: error.php");
         exit();
     }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Supprimer utilisateur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>

     
        .wrapper{
            width: 700px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5 mb-3">Supprimer ce billet</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger">
                            <input type="hidden" name="numero" value="<?php echo trim($_GET["id"]); ?>"/>
                            <p>Etes vous sûr de vouloir supprimer ce billet ?</p>
                            <p>
                                <input type="submit" value="OUI" class="btn btn-danger">
                                <a href="./index.php" class="btn btn-secondary">NON</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>