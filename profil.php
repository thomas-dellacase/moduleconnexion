<?php
session_start();
require 'db.php';
var_dump($_SESSION['user']);

if(isset($_POST['submit'])){
    try{
        $update = new PDO($bdd, $username, $Dbpassword);
        $update->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $login = $_POST['login'];
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $password = $_POST['pwd'];
        $oldlogin = $_SESSION['user'];

        $login = htmlspecialchars($login);
        $prenom = htmlspecialchars($prenom);
        $nom = htmlspecialchars($nom);
        $password = htmlspecialchars($password);

        $sql = "SELECT COUNT(login) AS num FROM utilisateurs WHERE login = :login";
        $stmt = $update->prepare($sql);
        $stmt->bindValue(':login', $login);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row['num'] > 0){
            echo "Ce login est deja prix veuiller en choisir un autre.";
        }
        elseif($_POST['pwd'] != $_POST['confpwd']){
            echo "Les 2 mots de passe ne sont pas les meme.";
        }
        else{
            $password = password_hash($password, PASSWORD_BCRYPT);
            $sql2="UPDATE utilisateurs SET login = :login, prenom = :prenom, nom =:nom, password = :password WHERE login = :oldlogin";
            $stmt = $update->prepare($sql2);
            $stmt->bindValue(':login', $login, PDO::PARAM_STR);
            $stmt->bindValue(':prenom', $prenom, PDO::PARAM_STR);
            $stmt->bindValue(':nom', $nom, PDO::PARAM_STR);
            $stmt->bindValue(':password', $password, PDO::PARAM_STR);
            $stmt->bindValue(':oldlogin', $oldlogin, PDO::PARAM_STR);

            $upuser = $stmt->fetch(PDO::FETCH_ASSOC);
            //var_dump($upuser);

            if($stmt->execute()){
                $_SESSION['user'] = $login;
                echo $_SESSION['user'] ."Update de profil reussi";
            }
            else{
                $error = "Erreur: ". $e->getMessage();
                echo $error;
            }
        }
        
    }
    catch(PDOException $e){
        $error = "Erreur: ". $e->getMessage();
        echo $error;
    }
}
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
    <nav>
        <a href="connexion.php">Connexion</a>
        <a href="inscription.php">Inscription</a>
        <a href="profil.php">Profils</a>
        <a href="deconnection.php">Deco</a>
    </nav>
    <h1><?php 
    if(isset($_SESSION['user'])){
        var_dump($_SESSION['user']);
        echo $_SESSION['user'] . "profil";
    }
    else{
        echo "Veuiller vous connecter";
    }

    ?></h1>
        <article>
            <form method="POST" action="profil.php">
                <input type="text" name="login" placeholder="Login"></input>
                <input type="text" name="prenom" placeholder="Prenom"></input>
                <input type="text" name="nom" placeholder="nom"></input>
                <input type="password" name="pwd" placeholder="New Password"></input>
                <input type="password" name="confpwd" placeholder=" Confim new Password"></input>
                <button type="submit" name="submit">Update</button>
            </form>
        </article>
    </main>
</body>
</html>