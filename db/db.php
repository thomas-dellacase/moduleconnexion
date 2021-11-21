<?php
        
    $host = 'localhost';
    $username = 'root';
    $Dbpassword = 'root';
    $database = 'moduleconnexion';
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