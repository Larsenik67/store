<?php 

/**
 * Retourne une instance de PDO, représentant la connexion a la DB
 * @return PDO - un objet instance de PDO, connecté à la DB
 */
function connexion() {

    $db = new PDO(
        "mysql:dbname=store;host=localhost:3306",
        "root",
        "",
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
        ]
    );

    return $db;

}

/**
 * Permet de sortir toute les données du tableau "product"
 */
function findAll(){

    $db = connexion();
    $query = "SELECT * FROM product";
    $stmt = $db->query($query);
    
    return $stmt->fetchAll();

}

function findOneById($id){

    $db = connexion();
    $query = "SELECT * FROM product WHERE id = ".$id;
    $stmt = $db->query($query);

    return $stmt->fetch();
}

/**
 * Insère un produit dans la DB
 * @param string $name -    le nom du produit
 * @param string $descr -   la description du produit
 * @param float $price -    le prix du produit
 * 
 * @see 
 * 
 * @return bool             TRUE si l'ajout en DB à fonctionné, FALSE dans le cas inverse
 */
function insertProduct($name, $descr, $price){
    $db = connexion();
    $query = "INSERT INTO product (name, description, price)
              VALUES (:name, :descr, :price)";
    $stmt = $db->prepare($query);
    $stmt->execute([
        ":name" => $name,
        ":descr" => $descr,
        ":price" => $price,
    ]);

    return $db->lastInsertId();

}

?>