<?php
session_start();
require 'db.php';
var_dump($_SESSION['user']);

    if(isset($_POST['submit'])){
        try{
            $inscrip = new PDO($bdd, $username, $Dbpassword);
            $inscrip->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $login = $_POST['login'];
            $prenom = $_POST['prenom'];
            $nom = $_POST['nom'];
            $password = $_POST['pwd'];

            $login =  htmlspecialchars(trim($login));
            $prenom = htmlspecialchars(trim($prenom));
            $nom = htmlspecialchars(trim($nom)); 
            $password = htmlspecialchars(trim($password));

            $sql = "SELECT COUNT(login) AS num FROM utilisateurs WHERE login = :login";
            $stmt = $inscrip->prepare($sql);
            $stmt->bindValue(':login',$login);
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
                $sql2 ="INSERT INTO utilisateurs(login, prenom, nom, password) VALUES(:login, :prenom, :nom, :password)";
                $stmt = $inscrip->prepare($sql2);
                $stmt->bindValue(':login' , $login, PDO::PARAM_STR);
                $stmt->bindValue(':prenom' , $prenom, PDO::PARAM_STR);
                $stmt->bindValue(':nom' , $nom, PDO::PARAM_STR);
                $stmt->bindValue(':password' , $password, PDO::PARAM_STR);
                
                if($stmt->execute()){
                    echo "inscripiption reussi";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Inscripiption</title>
</head>
<body>
<main>
<nav>
        <a href="connexion.php">Connexion</a>
        <a href="inscription.php">Inscription</a>
        <a href="profil.php">Profils</a>
        <a href="deconnection.php">Deco</a>
    </nav>
        <article>
            <form method="POST" action="inscription.php">
                <input type="text" name="login" placeholder="Login" required="required"></input>
                <input type="text" name="prenom" placeholder="Prenom" required="required"></input>
                <input type="text" name="nom" placeholder="nom" required="required"></input>
                <input type="password" name="pwd" placeholder="Password" required="required"></input>
                <input type="password" name="confpwd" placeholder=" Confim Password" required="required"></input>
                <button type="submit" name="submit">Inscripiption</button>
            </form>
        </article>
    </main>
</body>
</html>