<?php
session_start();
include "functions.php";
include "menu.php";
include "db-functions.php";
require_once 'vendor/autoload.php';

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>Ajout produit</title>
    </head>
    <body>

        <h1>Ajouter des produits random via Faker</h1>
        <form action="traitement.php?action=addFaker" method="post">
            <!--<p>
                <label>
                    Quantité :
                    <input type="number" step="any" name="qtt">
                </label>
            </p>-->
            <p>
                <input type="submit" name="submit" value="Ajouter le produit">
            </p>
        </form>
    </body>
</html>
