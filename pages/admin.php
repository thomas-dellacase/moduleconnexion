<?php
session_start();
require("../db/db.php");
//var_dump($_SESSION['user']);

if($_SESSION['user']['login'] != 'ADMIN'){
    header("Location:../index.php");
}


$getUser = new PDO($bdd, $username, $Dbpassword);
$getUser->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "SELECT id,login, prenom, nom, password FROM utilisateurs";
$stmt = $getUser->prepare($sql);
$stmt->execute();

$sql2 = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'utilisateurs'";
$stmt2 = $getUser->prepare($sql2);
$stmt2->execute();


$titres = $stmt2->fetchAll();
$row = $stmt->fetchAll(PDO::FETCH_ASSOC);


// echo '<pre>';
// print_r($titres);
// echo '</pre>';

// echo '<pre>';
// print_r($row);
// echo '</pre>';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=`device-width`, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>ADMIN</title>
</head>
<body>
<header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link active" href="../index.php">Home <span class="sr-only">(current)</span></a>
                    <?php
                    if(!(isset($_SESSION['user'])) && $_SESSION['user'] != ""){
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
                    echo "<a class='nav-item nav-link' href='deconnection.php'>Deconnexion</a>";
                    }else{ echo "";}?>
                    <a class="nav-item nav-link" href="admin.php"><?php if(isset($_SESSION['user']['login']) && $_SESSION['user']['login'] == 'ADMIN'){ 
                                                                                    echo 'Page admin';
                                                                                }else{ echo '';} ?></a>
                </div>
            </div>
        </nav>
    </header>
<main>
        <h1>
            <?php
                if($_SESSION['user'] == 'ADMIN'){
                    echo "Welcome to Admin";
                }
            ?>
        </h1>
<article>
<table>
<thead>
    <?php
    foreach ($titres as $titre) 
        {
            echo "<td class='table'>" . $titre['COLUMN_NAME'] . "</td>";
        }
    ?>
    </thead>
    <tbody>
            <?php
            foreach ($row as $key => $values) 
            {
                echo "<tr>";
                foreach ($values as $value) 
                {
                    echo "<td class='table'>" . $value . "</td>";
                }
                echo "</tr>";
            }
            ?>
    
</tbody>
</table> 
</article>
</main>   
</body>
</html>