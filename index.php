<?php 

    session_start();
    include "functions.php";
    include "db-functions.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
        <title>Accueil</title>
    </head>
    <body>
        <?php include "menu.php"; ?>
        <div class='grille'>
<?php

    $product = findAll();

    foreach($product as $prod){

        echo "<div class='product my-1 mx-1'><a href='product.php?id=".$prod["id"]."'>".$prod["name"] ."</a><br>".
        mb_strimwidth($prod["description"], 0, 50, "...") ."<br>".
            $prod["price"] ."€<br>
            <a href='traitement.php?action=addProdById&id=".$prod["id"]."'>Ajouter au panier</a></div>";
            
    }

?>
</div>
