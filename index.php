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
        <link rel="stylesheet" href="style.css">
        <title>Accueil</title>
    </head>
    <body>

<?php

    include "menu.php";

    $product = findAll();

    foreach($product as $prod){

        echo "<a href='product.php?id=".$prod["id"]."'>".$prod["name"] ."</a><br>".
        mb_strimwidth($prod["description"], 0, 50, "...") ."<br>".
            $prod["price"] ."€<br>
            <a href='traitement.php?action=addProdById&id=".$prod["id"]."'>Ajouter au panier</a><br><br>";
            
    }

?>