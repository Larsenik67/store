<?php 

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

function findAll(){

    $db = connexion();
    $query = "SELECT * FROM product";
    $stmt = $db->query($query);
    
    $stmt->fetchAll();
}

function findOneById($id){

    $db = connexion();
    $query = "SELECT * FROM product WHERE id = ".$id;
    $stmt = $db->query($query);

    $stmt->fetch();
}

function insertProduct($name, $descr, $price){
    $db = connexion();
    $query = "INSERT INTO product (name, description, price)
              VALUES (:name, :descr, :price)";
    $stmt = $db->prepare($query);
    return $stmt->execute([
        ":name" => $name,
        ":descr" => $descr,
        ":price" => $price,
    ]);

}

?>