<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/livreor.css">
    <title>Livre d'Or - Main</title>
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
    <a class="active" href="profil.php">Profil</a>
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

<article id="mainprofil">
<div id="profil">
<svg height="100" width="100">
<image height="100" width="100" href='assets/img/book.png' >
</svg>
<div id="profiltext">
<h3>Profil d'Utilisateur</h3>

<p>
<b>Login : </b><?php echo $_SESSION['pseudo']; ?><br>
<b>Password : </b><?php echo $_SESSION['password'];  ?>
</p>

</div>
</div>
</article>
    <footer>
        Ben Fischbach - CDPI La Plateforme, Marseille - 2025-2026
    </footer>
</body>

</html>