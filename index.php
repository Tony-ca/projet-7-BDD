<?php include "datas/data.php"; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinéma</title>
    <link rel="stylesheet" href="styles/style.css">
</head>

<body>

<form method="POST">
    <label class="label1">Ajouter un film</label>
    <input type="text" name="titre" placeholder="Titre">
    <input class="date" type="date" name="date">    
    <input type="number" name="duree" placeholder="Durée">
    <input type="text" name="affiche" placeholder="Affiche">
    <label class="label2">Réalisateur</label>
    <input type="text" name="nom" placeholder="Nom">
    <input type="text" name="prenom" placeholder="Prenom">
    <label class="label2">Acteur</label>
    <input type="text" name="nom_acteur" placeholder="Nom">
    <input type="text" name="prenom_acteur" placeholder="Prenom">

    <input type="submit" name="submit" value="CREATE">
    <br>
    <input type="number" name="deleteId" placeholder="ID a supprimer">
    <input type="submit" name="deleteSubmit" value="DELETE">
</form>

<?php

// CRUD
// CREATE / READ / UPDATE / DELETE
// CREER / LIRE / METTRE A JOUR / SUPPRIMER
// 1 - connection BDD (déjà fait)
// 2 - faire une requete SQL
// 3 - Preparer la requete SQL
// 4 - Executer la requete SQL


// CREATE
if (isset($_POST['submit'])) {
    $titre = $_POST['titre'];
    $date = $_POST['date'];
    $duree = $_POST['duree'];
    $affiche = $_POST['affiche'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $nom_acteur = $_POST['nom_acteur'];
    $prenom_acteur = $_POST['prenom_acteur'];

    if (!empty($titre) && !empty($date) && !empty($duree) && !empty($affiche) && !empty($nom) && !empty($prenom) && !empty($nom_acteur) && !empty($prenom_acteur)) {

        $host = "localhost";
        $dbname = "marvel";
        $username = "root";
        $password = "";

        $dbConnect = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

        $sql = "INSERT INTO `film`(`titre`, `date`, `duree`, `affiche`) 
                VALUES (?, ?, ?, ?)";
        $stmt = $dbConnect->prepare($sql);
        $stmt->execute([$titre, $date, $duree, $affiche]);

        $sql = "INSERT INTO `acteur`(`nom_acteur`, `prenom_acteur`) 
                VALUES (?, ?)";
        $stmt = $dbConnect->prepare($sql);
        $stmt->execute([$nom_acteur, $prenom_acteur]);

        $sql = "INSERT INTO `realisateur`(`nom`, `prenom`) 
                VALUES (?, ?)";
        $stmt = $dbConnect->prepare($sql);
        $stmt->execute([$nom, $prenom]);

        header("refresh: 1; http://localhost/projet-7-bdd/");

    } else {
        echo "Veuillez remplir tous les champs nécessaires.";
    }
        header("refresh: 1; http://localhost/projet-7-bdd/");
}






// DELETE ID
if (isset($_POST['deleteSubmit'])){
    $id = $_POST['deleteId'];

    if (!empty($id)) {
        $host = "localhost";
        $dbname = "FilmBDD";
        $username = "root";
        $password = "";

        $dbConnect = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

        $sqlCheckId = "SELECT id FROM film WHERE id = ?";
        $stmtCheckId = $dbConnect->prepare($sqlCheckId);
        $stmtCheckId->execute([$id]);

        if ($stmtCheckId->rowCount() > 0) {
            $sqlDelete = "DELETE FROM film WHERE id = ?";
            $stmtDelete = $dbConnect->prepare($sqlDelete);
            $stmtDelete->execute([$id]);
            
            echo "L'ID $id a été supprimé avec succès.";
        } else {
            echo "L'ID spécifié n'existe pas.";
        }
    } else {
        echo "Veuillez entrer l'ID à supprimer.";
    }
    header("refresh: 1; http://localhost/projet-7-bdd/");
}





?>

    <section class="container">
        <!-- div parent display flex  -->
        <div class="cards">
            <?php
                foreach ($tab as $key) { ?>
                        <div class="card">
                            <h2><?= $key["nom"]; ?></h2>
                            <img class="affiche" src="<?= $key["img"]; ?>" alt="">
                            <p><b>Réalisateur : </b><?= $key["realisateur"]; ?></p>
                            <p><b>Date de sortie : </b><?= $key["date"]; ?></p>
                            <p><b>Durée : </b><?php echo ($key["duree"])/60; ?> heures</p>
                            <p><b>Genre : </b><?= $key["genre"]; ?></p>
                            <p><?= $key["synopsis"]; ?></p>
                            <?php echo $key["bandeAnnonce"]; ?>
                    </div>
                <?php }

            ?>



<?php

$sql = "SELECT * FROM `films`";
    $stmt = $dbConnect->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result as $value) {
      echo '<div class="card">
        <h3>' . $value['nom'] . '</h3>
        <img src="' . $value['image'] . '" alt="Affiche du film">
        <p><strong>Date:</strong> ' . $value['date'] . '</p>
        <p><strong>Réalisateur:</strong> ' . $value['réalisateur'] . '</p>
        <p><strong>Durée:</strong> ' . $value['durée'] . ' minutes</p>
        <p><strong>Genre:</strong> ' . $value['genre'] . '</p>
        <p>' . $value['synopsis'] . '</p>
        <div class="video-container"> ' . $value['bandeannonce'] . '</div>
        </div>';
    }

?>

            
            
            
        </div>
    </section>
</body>
</html>