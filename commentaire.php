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

<h1>♛ GOLD ✦ BOOK ♛</h1>
  <nav>
    <a class="active" href="index.php">Home</a>
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
    <a href="commentaire.php">Commentaire</a>
    <?php 
    }
    ?>
  </nav>
</header>

<article id="livremain">
<div id="livretext">
<h3>Ajoutez votre message au livre d'or</h3>
    <form method="post" action="livre-or.php">
    <label for="commentaire">Votre message :</label><br/>
    <textarea name="commentaire" rows="10" cols="57" required="required"><?php echo "Ecrivez ici..."; ?></textarea><br/>
    <input type="submit" value="Envoyer">
  </form>
</div>
</article>
    <footer>
        Ben Fischbach - CDPI La Plateforme, Marseille - 2025-2026
    </footer>

</body>

</html>