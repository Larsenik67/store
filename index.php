<?php 

    include "db-functions.php";

    $product = findAll();

    foreach($product as $prod){

        echo "<a href='product.php?id=".$prod["id"]."'>".$prod["name"] ."</a><br>".
        mb_strimwidth($prod["description"], 0, 50, "...") ."<br>".
            $prod["price"] ."€<br>
            <a href='traitement.php?action=addProdById&id=".$prod["id"]."'>Ajouter au panier</a><br><br>";
            
    }

?>