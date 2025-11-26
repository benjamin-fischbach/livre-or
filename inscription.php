<?php 
session_start();
// Connecte cette page à la base de donnée (ici "livreor" en local)
$BDD = array();
$BDD['host'] = "localhost";
$BDD['user'] = "root";
$BDD['pass'] = "";
$BDD['db'] = "livreor";
$mysqli = mysqli_connect($BDD['host'], $BDD['user'], $BDD['pass'], $BDD['db']);
if(!$mysqli) {
  echo "<p class=\"oops\">Connexion non établie.</p>";
  exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/livreor.css">
    <title>Livre d'Or - Inscription</title>
</head>
<body>

<header>

<h1>♛ GUEST ✦ BOOK ♛</h1>
  <nav>
    <a href="index.php">Home</a>
    <?php 
    if(isset($_SESSION['pseudo'])){
    ?>
    •	
    <a href="profil.php">Profil</a>
    <?php 
    }
    ?>
    •	
    <a class="active" href="inscription.php">Inscription</a>
    •	
    <a  href="connexion.php">Connexion</a>
    •	
    <a href="livre-or.php">Livre d'Or</a>
        <?php 
    if(isset($_SESSION['pseudo'])){
    ?>
    •	
    <a href="commentaire.php">Commentaire</a>
    <?php 
    }
    ?>
  </nav>
</header>

<article id="inscript-main">
<div id="inscript-card">
    <br />
  <h3>Inscrivez-vous sur Guest Book !</h3>
    <form method="post" action="inscription.php">
    <label for="pseudo">Login :</label><br/>
    <input type="text" name="pseudo"><br/><br/>
    <label for="password">Password :</label><br/>
    <input type="password" name="mdp"><br/>
    <label for="passcheck">Confirmer Password :</label><br/>
    <input type="password" name="mdpcheck"><br/><br/>
    <input type="submit" value="S'inscrire">
  </form>
  <?php
//traitement du formulaire:
if(isset($_POST['pseudo'],$_POST['mdp'])){//l'utilisateur à cliqué sur "S'inscrire", on demande donc si les champs sont défini avec "isset"
  if(empty($_POST['pseudo'])){//le champ pseudo est vide, on arrête l'exécution du script et on affiche un message d'erreur
    echo "<p class=\"oops\">Veuillez choisir un login.</p>";
  } elseif(!preg_match("#^[a-z0-9]+$#",$_POST['pseudo'])){//le champ pseudo est renseigné mais ne convient pas au format qu'on souhaite qu'il soit, soit: que des lettres minuscule + des chiffres (je préfère personnellement enregistrer le pseudo de mes membres en minuscule afin de ne pas avoir deux pseudo identique mais différents comme par exemple: Admin et admin)
    echo "<p class=\"oops\">Le login est invalide (minuscules et chiffres uniquement).</p>";
  } elseif(strlen($_POST['pseudo'])>255){//le pseudo est trop long, il dépasse 255 caractères
    echo "<p class=\"oops\">Le login est trop long.</p>";
  }  elseif(strlen($_POST['pseudo'])<3){//le pseudo est trop court, moins de 3 caractères
    echo "<p class=\"oops\">Le login doit contenir au moins 3 caractères.</p>";
  } elseif(empty($_POST['mdp'])){//le champ mot de passe est vide
    echo "<p class=\"oops\">Veuillez choisir un mot de passe.</p>";
  } elseif(mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM utilisateurs WHERE login='".$_POST['pseudo']."'"))==1){//on vérifie que ce pseudo n'est pas déjà utilisé par un autre membre
    echo "<p class=\"oops\">Ce login est déjà utilisé.</p>";
  } elseif($_POST['mdp'] != $_POST['mdpcheck']){//le champ "confirmer mdp" n'est pas identique a mdp
    echo "<p class=\"oops\">Le mot de passe n'a pas pu être confirmé.</p>";
  } else {
    //toutes les vérifications sont faites, on passe à l'enregistrement dans la base de données:
    //Bien évidement il s'agit là d'un script simplifié au maximum, libre à vous de rajouter des conditions avant l'enregistrement comme la longueur minimum du mot de passe par exemple
    if(!mysqli_query($mysqli,"INSERT INTO utilisateurs SET login='".$_POST['pseudo']."', password='".md5($_POST['mdp'])."'")){//on crypte le mot de passe avec la fonction propre à PHP: md5()
      echo "<p class=\"oops\">Une erreur s'est produite: </p>".mysqli_error($mysqli);//je conseille de ne pas afficher les erreurs aux visiteurs mais de l'enregistrer dans un fichier log
    } else {
      echo "<p class=\"cool\">Vous êtes inscrit avec succès!<br/></p>Redirection vers la page de connexion...";
      header("Refresh: 3; connexion.php");
    }
  }
}
?>
</form>
</div>
</article>
    <footer>
        Ben Fischbach - CDPI La Plateforme, Marseille - 2025-2026
    </footer>

</body>

</html>