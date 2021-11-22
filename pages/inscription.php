<?php
session_start();
require("../db/db.php");
//var_dump($_SESSION['user']);

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
                $logfailed = "Ce login est deja prix veuiller en choisir un autre.";
            }
            elseif($_POST['pwd'] != $_POST['confpwd']){
                $pdwfailed = "Les 2 mots de passe ne sont pas les meme.";
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
                    $insok = "Inscripiption reussi";
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
    <link rel="stylesheet" href="../css/inscription.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Inscripiption</title>
</head>
<body>
    <header>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link active" href="../index.php">Home <span class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link" href="connexion.php">Connexion</a>
                    <a class="nav-item nav-link" href="inscription.php">Inscription</a>
                    <a class="nav-item nav-link" href="profil.php">Profil</a>
                    <a class="nav-item nav-link" href="deconnection.php">Deconnexion</a>
                    <a class="nav-item nav-link" href="admin.php"><?php if(isset($_SESSION['user']['login']) && $_SESSION['user']['login'] == 'ADMIN'){ 
                                                                                    echo 'Page admin';
                                                                                }else{ echo '';} ?></a>
                </div>
            </div>
        </nav>
    </header>
    </header>
<main>
    <h1 id="title"><?php if(isset($insok)){ echo $insok;
                        }elseif(isset($_SESSION['user']['login']) && $_SESSION['user']['login'] != ''){echo "Vous etes deja inscrits ". $_SESSION['user']['login']. "<br>";
                        }elseif(isset($logfailed)){ echo $logfailed;
                        }elseif(isset($pdwfailed)){echo $pdwfailed;} ?></h1>
        <article id="artins">
            <div class="container">
                <h2 class="text-center">Inscription</h2>
            <form method="POST" action="inscription.php">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <input class="form-control" type="text" name="login" placeholder="Login" required="required"></input>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <input class="form-control" type="text" name="prenom" placeholder="Prenom" required="required"></input>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <input class="form-control" type="text" name="nom" placeholder="nom" required="required"></input>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <input class="form-control" type="password" name="pwd" placeholder="Password" required="required"></input>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <input class="form-control" type="password" name="confpwd" placeholder=" Confim Password" required="required"></input>
                            </div>
                        </div>
                    </div>
                    <div class="col" id="divbtn">
                        <button class="btn btn-success from-group" type="submit" name="submit">Inscripiption</button>
                    </div>
                </div>
            </form>
        </article>
    </main>
    <footer class="bg-dark text-center text-white">
  <!-- Grid container -->
  <div class="container p-4">
    <!-- Section: Social media -->
    <section class="mb-4">
      <!-- Facebook -->
      <a href="#" class="fa fa-facebook"></a>

      <!-- Twitter -->
      <a href="#" class="fa fa-twitter"></a>

      <!-- Google -->
      <a href="#" class="fa fa-google"></a>

      <!-- Instagram -->
      <a href="#" class="fa fa-instagram"></a>

      <!-- Linkedin -->
      <a href="#" class="fa fa-linkedin"></a>

      <!-- Github -->
      <a href="#" class="fa fa-reddit"></a>
    </section>
    <!-- Section: Social media -->

    <!-- Section: Form -->
    <section class="">
      <form action="">
        <!--Grid row-->
        <div class="row d-flex justify-content-center">
          <!--Grid column-->
          <div class="col-auto">
            <p class="pt-2">
              <strong>Sign up for our newsletter</strong>
            </p>
          </div>
          <!--Grid column-->

          <!--Grid column-->
          <div class="col-md-5 col-12">
            <!-- Email input -->
            <div class="form-outline form-white mb-4">
              <input type="email" id="form5Example21" class="form-control" />
              <label class="form-label" for="form5Example21">Email address</label>
            </div>
          </div>
          <!--Grid column-->

          <!--Grid column-->
          <div class="col-auto">
            <!-- Submit button -->
            <button type="submit" class="btn btn-outline-light mb-4">
              Subscribe
            </button>
          </div>
          <!--Grid column-->
        </div>
        <!--Grid row-->
      </form>
    </section>
    <!-- Section: Form -->

    <!-- Section: Text -->
    <section class="mb-4">
      <p>
      Roll20 est une application web qui va vous permettre de faire vos parties de JDR en ligne et par navigateur. 
      Il intègre tout ce qu'il faut, dans sa version gratuite, 
      pour jouer sereinement. Noté que les options de paiement vous permette certaines choses spécifiques, 
      comme la lumière dynamique, les SFX (effets spéciaux) ou alors la possibilité de transférer des personnages d'une partie à une autre, 
      tout ceci est totalement facultatif et surtout, ne va concerner que des "gros joueurs" qui font beaucoup de parties via roll20.

      </p>
      <a class="nav-item nav-link" href="https://github.com/thomas-dellacase/moduleconnexion">Depot github</a>
    </section>
</footer>
</body>
</html>