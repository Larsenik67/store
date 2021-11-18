<?php 

include "db-functions.php";
echo "<a href='index.php'>Back</a><br><br>";

if(isset($_GET['id'])){

    $id = $_GET['id'];
    $product = findOneById($id);
    echo $product['name']."<br>".$product["description"]."<br>".$product['price']."€<br>
    <a href='traitement.php?action=addProdById&id=".$product["id"]."'>Ajouter au panier</a><br><br>";
}

?>