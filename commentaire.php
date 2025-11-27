<?php 
session_start();
// Connecte cette page à la base de donnée (ici "livreor" en local)
$BDD = array();
$BDD['host'] = "localhost";
$BDD['user'] = "root";
$BDD['pass'] = "";
$BDD['db'] = "livreor";

//Print_r ($_SESSION);
$mysqli = mysqli_connect($BDD['host'], $BDD['user'], $BDD['pass'], $BDD['db']);
if(!$mysqli) {
  echo "<p class=\"oops\">Connexion non établie.</p>";
  exit;
}
if(!isset($_SESSION['pseudo'])){ //si 'pseudo' n'est pas set, redirige vers autre page
    header("Location: inscription.php");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/livreor.css">
    <title>Livre d'Or - Commentaire</title>
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
    <a href="inscription.php">Inscription</a>
    •	
    <a href="connexion.php">Connexion</a>
    •	
    <a href="livre-or.php">Livre d'Or</a>
        <?php 
    if(isset($_SESSION['pseudo'])){
    ?>
    •	
    <a class="active" href="commentaire.php">Commentaire</a>
    <?php 
    }
    ?>
  </nav>
</header>

<article id="livremain">
<div id="livretext">
<h3>Ajoutez votre message au livre d'or</h3>
    <form method="post" action="commentaire.php">
    <label for="commentaire">Votre message :</label><br/>
    <textarea name="commentaire" rows="10" cols="57" required="required"  placeholder="Ecrivez ici..."></textarea><br/>
    <input type="submit" value="Envoyer" name="Envoyer">
  </form>
  <?php
  $date_message= date("d-m-y");
  $id_utilisateur =$_SESSION['pseudo'];
//traitement du formulaire:
if(isset($_POST['Envoyer'])){//l'utilisateur à cliqué sur "Envoyer", on demande donc si le message est défini avec "isset"
  if(empty($_POST['commentaire'])){//le commentaire est vide, on arrête l'exécution du script et on affiche un message d'erreur
    echo "<p class=\"oops\">Un commentaire ne peut pas être vide.</p>";
  } elseif(strlen($_POST['commentaire'])>1000){//le commentaire est trop long, il dépasse 255 caractères
    echo "<p class=\"oops\">Le commentaire est trop long. (1000 caractères maximum)</p>";
  }  elseif(strlen($_POST['commentaire'])<3){//le commentaire est trop court, moins de 3 caractères
    echo "<p class=\"oops\">Le commentaire doit contenir au moins 3 caractères.</p>";
  } else {
    $message= $_POST['commentaire'];
    //toutes les vérifications sont faites, enregistrement dans la base de données:
    if(!mysqli_query($mysqli,"INSERT INTO commentaires SET commentaire='".($message)."', id_utilisateur='".($id_utilisateur)."', date='".($date_message)."'")){
      echo "<p class=\"oops\">Une erreur s'est produite: </p>".mysqli_error($mysqli);
    } else {
      echo "<p class=\"cool\">Votre message à été ajouté au livre d'or !<br/>";
      unset($_POST['commentaire']);
    }
  }
}else {
  unset($_POST['commentaire']);
  echo "";
}
  ?>
</div>
</article>
    <footer>
        Ben Fischbach - CDPI La Plateforme, Marseille - 2025-2026
    </footer>

</body>

</html>
<?php
// if(isset($_POST['pseudo'],$_POST['mdp'])){//l'utilisateur à cliqué sur "S'inscrire", on demande donc si les champs sont défini avec "isset"
//   if(empty($_POST['pseudo'])){//le champ pseudo est vide, on arrête l'exécution du script et on affiche un message d'erreur
//     echo "<p class=\"oops\">Veuillez choisir un login.</p>";
//   } elseif(!preg_match("#^[a-z0-9]+$#",$_POST['pseudo'])){//le champ pseudo est renseigné mais ne convient pas au format qu'on souhaite qu'il soit, soit: que des lettres minuscule + des chiffres (je préfère personnellement enregistrer le pseudo de mes membres en minuscule afin de ne pas avoir deux pseudo identique mais différents comme par exemple: Admin et admin)
//     echo "<p class=\"oops\">Le login est invalide (minuscules et chiffres uniquement).</p>";
//   }

?>