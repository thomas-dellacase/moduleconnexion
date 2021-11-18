<?php
session_start();
var_dump($_SESSION['user']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <nav>
        <a href="connexion.php">Connexion</a>
        <a href="inscription.php">Inscription</a>
        <a href="profil.php">Profils</a>
        <a href="deconnection.php">Deco</a>
    </nav>
</body>
</html>