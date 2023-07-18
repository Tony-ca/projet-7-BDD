<?php session_start()?>
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

<header>
        <div>
            <h1>Panneau d'administration</h1>
            <img class="troll" src="img\Sans titre.png" height="120px" width="160px">
        </div>
        <div class="all-btn">
            <button class="btn"><a class="btn-text" href="index.php?page=acceuil">Acceuil</a></button>
            <button class="btn"><a class="btn-text" href="index.php?page=ajouter/supprimer">Ajouter/supprimer un film</a></button>
            <button class="btn"><a class="btn-text" href="index.php?page=parametres">Paramètres</a></button>
            <?php
                if (empty($_SESSION)) {
                echo '<button class="btn"><a class="btn-text" href="index.php?page=connexion">Connexion</a></button>';
                }
                else {?>
                    <form method="post">
                        <input class="deco" type="submit" name="destroy" value="Déconnection">
                        </form>
                
            <?php } 
        
            
            ?>
            

        </div>
    </header>


   
    
        <?php

        if (empty($_SESSION)) {
             echo  
                '<form class="form1" action="index.php" method="post">
            
                <label class="all-form">Identifiant</label>
                <input class="all-form" type="text" name="identifiant">
                
                <label class="all-form">Mot de passe</label>
                <input class="all-form" type="password" name="password">
                
                <input class="log" type="submit" name="btn-user-pass" value="Se connecter">
               
                </form>';
                
        }
        
        if (isset($_POST['btn-user-pass'])){
            if ($_POST['identifiant'] == 'Snoop' && ($_POST['password']) == '123'){
            $_SESSION ['data'] = [ 'prenom' => "Snoop", 'nom' => 'Dog', 'age' => '30', 'role' => 'Rapeur']; ?>

            <p class="connect">Vous êtes maintenant connecté</p>
        <?php header("refresh:1; index.php?page=acceuil");
        
            }
        else { ?>
            <p class="connect-error">Mot de passe ou identifiant incorrect</p> 
        <?php }
    
    
        }

        if (!empty($_SESSION)){

            if (isset($_GET['page']) && $_GET['page'] == "acceuil"  ){ ?>
                <div class="h3_container">
                    <div class="h3_like">
                        <h3>Bienvenue <?php echo $_SESSION['data']['prenom']; ?> <?php echo $_SESSION['data']['nom']; ?></h3>
                    </div> 
                </div>
            
            <?php 
                $host = "localhost";
                $dbname = "marvel";
                $username = "root";
                $password = ""; 

                $dbConnect = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

                $sql = "SELECT * 
                        FROM `film`
                        ";
                $stmt = $dbConnect->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC); ?>

                    <section class="container">
                        <div class="cards">
                    <?php
                    foreach ($result as $value) {
                        echo '
                        <div class="card">
                            <img class="affiche" src=" ' . $value['affiche'] . ' ">
                            <h3>' . $value['titre'] . '</h3>
                            <p><strong>Date:</strong> ' . $value['date'] . '</p>
                            <p><strong>Durée:</strong> ' . $value['duree'] . ' minutes</p>
                            </div>';
                }
                
            ?>
                    
                    
           <?php     
            }    

            if (isset($_GET['page']) && $_GET['page'] == "ajouter/supprimer"  ){ ?>

                <form method="POST">
                    <label class="label1">Ajouter un film</label>
                    <input class="input-ajout" type="text" name="titre" placeholder="Titre">
                    <input class="input-ajout" type="date" name="date">    
                    <input class="input-ajout" type="number" name="duree" placeholder="Durée">
                    <input class="input-ajout" type="text" name="affiche" placeholder="Affiche">
                    <label class="label2">Réalisateur</label>
                    <input class="input-ajout" type="text" name="nom" placeholder="Nom">
                    <input class="input-ajout" type="text" name="prenom" placeholder="Prenom">
                    <label class="label2">Acteur</label>
                    <input class="input-ajout" type="text" name="nom_acteur" placeholder="Nom">
                    <input class="input-ajout" type="text" name="prenom_acteur" placeholder="Prenom">

                    <input class="input-ajout" type="submit" name="submit" value="CREATE">
                    <br>
                    <label class="label1">Supprimer un film</label>
                    <input class="input-ajout" type="number" name="deleteId" placeholder="ID a supprimer">
                    <input class="input-ajout" type="submit" name="deleteSubmit" value="DELETE">
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

        $host = "localhost";
        $dbname = "marvel";
        $username = "root";
        $password = ""; 

        $dbConnect = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

        $sql = "SELECT * FROM `film`";
        $stmt = $dbConnect->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC); ?>

            <section class="container">
                <div class="cards">
            <?php
            foreach ($result as $value) {
                echo '
                <div class="card">
                    <img class="affiche" src=" ' . $value['affiche'] . ' ">
                    <h3>' . $value['titre'] . '</h3>
                    <p><strong>Date:</strong> ' . $value['date'] . '</p>
                    <p><strong>Durée:</strong> ' . $value['duree'] . ' minutes</p>
                    </div>';
        }
        ?>
                </div>
            </section>
            <?php
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




            
        <?php
                }
            
        
            if (isset($_GET['page']) && $_GET['page'] == "parametres" && !empty($_SESSION)){?>

                <form class="all-info" method="post">
                    <h2 class="info">Modification de vos paramètres</h2>
                    <label class="info" for="nom">Nom</label>
                    <input class="info" type="text" name="nom" value="<?php echo $_SESSION['data']['nom']; ?>">
                    <br>
                    <label class="info" for="prenom">Prénom</label>
                    <input class="info" type="text" name="prenom" value="<?php echo $_SESSION['data']['prenom']; ?>">
                    <br>
                    <label class="info" for="age">Age</label>
                    <input class="info" type="number" name="age" value="<?php echo $_SESSION['data']['age']; ?>">
                    <br>
                    <label class="info" for="role">Rôle</label>
                    <input class="info" type="text" name="role" value="<?php echo $_SESSION['data']['role']; ?>">
                    <br>
                    <input class="modification" type="submit" name="update" value="Modifier">
                </form>
            <?php }   
        
        }

        if (isset($_POST['update'])){
            if (empty($_POST['prenom']) || empty($_POST['nom']) || empty($_POST['age']) || empty($_POST['role'])){ ?>
                <p class="connect-error">Toutes les informations ont besoin d'être renseigné</p>
            <?php }
            
            if (!empty($_POST['prenom']) && !empty($_POST['nom']) && !empty($_POST['age']) && !empty($_POST['role'])) {
                $_SESSION ['data']['prenom'] = $_POST['prenom'];
                $_SESSION ['data']['nom'] = $_POST['nom'];
                $_SESSION ['data']['age'] = $_POST['age'];
                $_SESSION ['data']['role'] = $_POST['role'];
                ?>
                <p class="connect">Vos données ont bien été mis à jour</p>
          <?php 
               header("refresh:1; index.php?page=utilisateurs");}
        }
        ?>
            
        <?php 
            if (isset($_POST['destroy'])) {
                session_destroy();
                echo '<p class="connect-error">Vous êtes déconnecter</p>';
                header("refresh:1; index.php?page=acceuil");
                }
             ?>
        
              





    <section class="container">
        <!-- div parent display flex  -->
        <div class="cards">
            <!-- <?php
                foreach ($tab as $key) { ?>
                        <div class="card">
                            <h2>$key["nom"];</h2>
                            <img class="affiche" src="<?= $key["img"]; ?>" alt="">
                            <p><b>Réalisateur : </b><?= $key["realisateur"]; ?></p>
                            <p><b>Date de sortie : </b><?= $key["date"]; ?></p>
                            <p><b>Durée : </b><?php echo ($key["duree"])/60; ?> heures</p>
                            <p><b>Genre : </b><?= $key["genre"]; ?></p>
                            <p><?= $key["synopsis"]; ?></p>
                    </div>
                <?php }

            ?> -->
        </div>
    </section>


<!-- <?php

$sql = "SELECT * FROM `film`";
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

?> -->

            
            
            
    
</body>
</html>