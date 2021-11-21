<?php
session_start();
require("db.php");
var_dump($_SESSION['user']);

if($_SESSION['user'] == 'ADMIN'){
    
    echo "Welcome ADMIN";
}
else {
    header("Location:index.php");
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
    <title>ADMIN</title>
</head>
<body>
<table>
<thead>
    <?php
    foreach ($titres as $titre) 
        {
            echo "<td>" . $titre['COLUMN_NAME'] . "</td>";
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
                    echo "<td>" . $value . "</td>";
                }
                echo "</tr>";
            }
            ?>
    
</tbody>
</table>    
</body>
</html>