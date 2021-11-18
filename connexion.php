<?php
session_start();
require 'db.php';

$_SESSION['user'] = '';

if(isset($_POST['submit'])){
    try{
        $connect = new PDO($bdd, $username, $Dbpassword);
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $login = $_POST['login'];
        $pwd = $_POST['pwd'];

        $login =  htmlspecialchars(trim($login));
        $pdw = htmlspecialchars(trim($pwd));

        $pwd = password_hash($pwd, PASSWORD_BCRYPT);

        $sql = "SELECT count(id) FROM utilisateurs WHERE login = '$login' and password = '$pwd'";
        $stmt = $connect->prepare($sql);
        $stmt->bindValue(':login', $login);
        $stmt->bindValue(':password', $pwd);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if($user == false) {
            echo "failed";

        }
        else{
            $_SESSION['user'] = $login;
            echo "welcome". $_SESSION['user']; 
        }

    }
    catch(PDOException $e){
        $error = "Erreur: ". $e->getMessage();
        echo $error;echo "cc3";

    }
}
var_dump($_SESSION)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Connexion</title>
</head>
<body>
    <main>
        <article>
            <form method="POST" action="connexion.php">
                <input type="text" name="login"></input>
                <input type="password" name="pwd"></input>
                <button type="submit" name="submit">Connect</button>
            </form>
        </article>
    </main>
</body>
</html>