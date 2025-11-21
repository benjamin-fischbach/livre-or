<?php

session_start();
  if(isset($_POST['disconnect'])){
    unset ($_SESSION['pseudo']);
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/livreor.css">
    <title>Livre d'Or - Connexion</title>
</head>
<body>

<header>

<h1>♛ GOLD ✦ BOOK ♛</h1>
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
    <a class="active" href="connexion.php">Connexion</a>
    •	
    <a href="livre-or.php">Livre d'Or</a>
    <?php 
    if(isset($_SESSION['pseudo'])){
    ?>
    •	
    <a href="commentaires.php">Commentaire</a>
    <?php 
    }
    ?>
  </nav>
  <!-- <a class="active" href="connexion.php">Connexion</a>-->
  <!-- <a href="connexion.php">commentaire.php</a>-->
</header>

<article id="inscript-main">
<div id="inscript-card">
    <br />
  <h3>Connectez-vous a votre profil Gold Book</h3>
    <form method="post" action="connexion.php">
    <label for="pseudo">Login :</label><br/>
    <input type="text" name="pseudo"><br/>
    <label for="password">Password :</label><br/>
    <input type="password" name="mdp"><br/><br/>
        <?php 
    if(isset($_SESSION['pseudo'])){
    ?>
    <input type="submit" name="disconnect" value="deconnexion">
    <?php 
    }else{
    ?>
    <input type="submit" name="connexion" value="connexion">
    <?php
    }
    ?>
  </form>
  <?php
  //si le bouton "Connexion" est cliqué
if(isset($_POST['connexion'])){
  // on vérifie que le champ "Pseudo" n'est pas vide
  // empty vérifie à la fois si le champ est vide et si le champ existe belle et bien (is set)
  if(empty($_POST['pseudo'])){
    echo "<p class=\"oops\">Le champ \"Login\" est vide.</p>";
  } else {
    // on vérifie maintenant si le champ "Mot de passe" n'est pas vide"
    if(empty($_POST['mdp'])){
      echo "<p class=\"oops\">Le champ \"Password\" est vide.</p>";
    } else {
      // les champs pseudo & mdp sont bien postés et pas vides, on sécurise les données entrées par l'utilisateur
      //le htmlentities() passera les guillemets en entités HTML, ce qui empêchera en partie, les injections SQL
      $Pseudo = htmlentities($_POST['pseudo'], ENT_QUOTES, "UTF-8"); 
      $MotDePasse = htmlentities($_POST['mdp'], ENT_QUOTES, "UTF-8");
      //on se connecte à la base de données:
      $mysqli = mysqli_connect("localhost", "root", "", "livreor");
      //on vérifie que la connexion s'effectue correctement:
      if(!$mysqli){
        echo "<p class=\"oops\">Erreur de connexion à la base de données.</p>";
      } else {
        //on fait maintenant la requête dans la base de données pour rechercher si ces données existent et correspondent:
        //si vous avez enregistré le mot de passe en md5() il vous faudra faire la vérification en mettant mdp = '".md5($MotDePasse)."' au lieu de mdp = '".$MotDePasse."'
        $Requete = mysqli_query($mysqli,"SELECT * FROM utilisateurs WHERE login = '".$Pseudo."' AND password = '".md5($MotDePasse)."'");
        //si il y a un résultat, mysqli_num_rows() nous donnera alors 1
        //si mysqli_num_rows() retourne 0 c'est qu'il a trouvé aucun résultat
        if(mysqli_num_rows($Requete) == 0) {
          echo "<p class=\"oops\">Le pseudo ou le mot de passe est incorrect, le compte n'a pas été trouvé.</p>";
        } else {
          //on ouvre la session avec $_SESSION:
          //la session peut être appelée différemment et son contenu aussi peut être autre chose que le pseudo
          $_SESSION['pseudo'] = $Pseudo;
          echo "<p class=\"cool\">Vous êtes à présent connecté, ".$Pseudo."  !</p>";
        }
      }
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