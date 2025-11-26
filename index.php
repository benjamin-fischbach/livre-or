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

<article id="maintext">
<!-- <svg height="50" width="50">
<image height="50" width="50" href='assets/img/book.png' >
</svg> -->
<p><b>Bienvenue sur Guest Book</b>,<br><br>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.<br><br>
    Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum...</p>
</article>
    <footer>
        Ben Fischbach - CDPI La Plateforme, Marseille - 2025-2026
    </footer>
</body>

</html>