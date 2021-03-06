<?php
session_start();
require("../db/db.php");


if(isset($_POST['submit'])){
    try{
      if(!(isset($_SESSION['user']))){
        $_SESSION['user'] = '';
    }

      $connect = new PDO($bdd, $username, $Dbpassword);
      $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
      $login = $_POST['login'];
      $pwd = $_POST['pwd'];
    
      $login =  htmlspecialchars(trim($login));
      $pwd = htmlspecialchars(trim($pwd));
    
      $hpwd = password_hash($pwd, PASSWORD_BCRYPT);
    
      $sql = "SELECT * FROM utilisateurs WHERE login = '$login'";
      $stmt = $connect->prepare($sql);
      $stmt->bindValue(':login', $login);
      $stmt->execute();
    
      $user = $stmt->fetch(PDO::FETCH_ASSOC);
      // var_dump($user);
    
      if ($user)
      {
        $check_pwd = $user['password'];
        if (password_verify($pwd, $check_pwd))
        {
          $_SESSION['user'] = $user;
          header('Location:../index.php');
          // echo ('<pre>');
          // var_dump($_SESSION);
          // echo ('</pre>');
        }
        else
        {
          $failedlog = "login ou mot de passe incorrect";
        }
      }
      else
      {
        $failedlog = "login ou mot de passe incorrect";
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
    <meta name="viewport" content="width=`device-width`, initial-scale=1.0">
    <link rel="stylesheet" href="../css/connexion.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Connexion</title>
</head>
<body>
<header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link active" href="../index.php">Home <span class="sr-only">(current)</span></a>
                    <?php
                    if(!(isset($_SESSION['user']))){
                    echo "<a class='nav-item nav-link' href='connexion.php'>Connexion</a>";
                    }else{ echo "";}?>
                    <?php
                    if(!(isset($_SESSION['user']))){
                    echo "<a class='nav-item nav-link' href='inscription.php'>Inscription</a>";
                    }else{ echo "";}?>
                    <?php
                    if(isset($_SESSION['user'])){
                    echo "<a class='nav-item nav-link' href='profil.php'>Profil</a>";
                    }else{ echo "";}?>
                                        <?php
                    if(isset($_SESSION['user'])){ 
                    "<a class='nav-item nav-link' href='deconnection.php'>Deconnexion</a>";
                    }else{ echo "";}?>
                    <a class="nav-item nav-link" href="admin.php"><?php if(isset($_SESSION['user']['login']) && $_SESSION['user']['login'] == 'admin'){ 
                                                                                    echo 'Page admin';
                                                                                }else{ echo '';} ?></a>
                </div>
            </div>
        </nav>
    </header>
    <main>

      <h1><?php if(isset($_SESSION['user']['login']) && $_SESSION['user']['login'] != ''){echo "Vous etes deja connecter ". $_SESSION['user']['login']. "<br>";
      }elseif(isset($failedlog)){echo $failedlog;} ?></h1>

        <article id="artco">
            <div class="container">
                <h2 class="text-center">Connexion</h2>
            <form method="POST" action="connexion.php">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <input class="form-control" type="text" name="login" placeholder="Login" required="required"></input>
                        </div>
                    </div>
                    <div class="col">
                            <div class="form-group">
                                <input class="form-control" type="password" name="pwd" placeholder="Password" required="required"></input>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    <div id="divbtn" class="col">
                        <button class="btn btn-success from-group" type="submit" name="submit">Connexion</button>
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
      Il int??gre tout ce qu'il faut, dans sa version gratuite, 
      pour jouer sereinement. Not?? que les options de paiement vous permette certaines choses sp??cifiques, 
      comme la lumi??re dynamique, les SFX (effets sp??ciaux) ou alors la possibilit?? de transf??rer des personnages d'une partie ?? une autre, 
      tout ceci est totalement facultatif et surtout, ne va concerner que des "gros joueurs" qui font beaucoup de parties via roll20.

      </p>
      <a class="nav-item nav-link" href="https://github.com/thomas-dellacase/moduleconnexion">Depot github</a>
    </section>
</footer>
</body>
</html>