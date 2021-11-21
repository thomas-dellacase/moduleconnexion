<?php
        
    $host = 'localhost:3306';
    $username = 'thomas-dellacase';
    $Dbpassword = 'ProjetPP2';
    $database = 'thomas-dellacase_moduleconnexion';
    $bdd = '';

    try{
        $bdd = 'mysql:host='.$host.';dbname='.$database;
        
        $pdo = new PDO($bdd, $username, $Dbpassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
            echo "Failed: ". $e->getMessage();
    }
        




?>