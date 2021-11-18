<?php
session_start();
require 'db.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
</head>
<body>
<main>
    
        <article>
            <form method="POST" action="profil.php">
                <input type="text" name="login" placeholder="Login"></input>
                <input type="text" name="prenom" placeholder="Prenom"></input>
                <input type="text" name="nom" placeholder="nom"></input>
                <input type="password" name="pwd" placeholder="Password"></input>
                <input type="password" name="confpwd" placeholder=" Confim Password"></input>
                <button type="submit" name="submit">Update</button>
            </form>
        </article>
    </main>
</body>
</html>