
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        #clients-table {
  border-collapse: collapse;
  width: 100%;
}

#clients-table th,
#clients-table td {
  border: 1px solid #ddd;
  padding: 8px;
}

#clients-table tr:nth-child(even) {
  background-color: #3011BC;
}

#clients-table th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #3011BC;
  color: white;
}
    </style>
</head>
<body>
<table id="clients-table">
  <thead>
    <tr>
      <th>ID</th>
      <th>Nom</th>
      <th>Prénom</th>
      <th>Numéro de téléphone</th>
      <th>E-mail</th>
      <th>Pays</th>
      <th>Ville</th>
    </tr>
  </thead>
  <tbody>
    <!-- Rows will be inserted here -->
    <?php
include "config.php" ;

include "header.php";

$sql = "SELECT * FROM client";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["ID"]. "</td><td>" . $row["nom"]. "</td><td>" . $row["prenom"]. "</td><td>" . $row["numero_tel"]. "</td><td>" . $row["mail"]. "</td><td>" . $row["pays"]. "</td><td>" . $row["ville"]. "</td></tr>";
    }
} else {
    echo "<tr><td colspan='7'>Aucun client trouvé.</td></tr>";
}
$con->close();
?>
  </tbody>
</table>
</body>
</html>