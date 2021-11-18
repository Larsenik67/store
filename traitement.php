<?php
    session_start();
    include "functions.php";
    include "db-functions.php";

    $action = filter_input(INPUT_GET, "action", FILTER_VALIDATE_REGEXP, [
        "options" => [
            "regexp" => "/addProd|addProdById|updateQtt|deleteProd|deleteAll/"
        ]
    ]);

    if($action){

        switch($action){
            
            /*case "addProd":
                if(isset($_POST['submit'])){

                    $name= filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
                    $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);
            
                    if($name && $price && $qtt){
            
                        $product = [
                            "name"  => $name,
                            "price" => $price,
                            "qtt"   => $qtt,
                        ];
            
                        $_SESSION['products'][] = $product;
                        
                        setMessage("success", "Produit $name ajouté avec succès ! <a href='recap.php'>Voir le panier</a>");
                    }
                    else{
                        setMessage("notice", "Vérifiez les données du formulaire !");
                    }
                }
                else{
                    setMessage("error", "Sale pirate de ta maman, tu valides le formulaire STP !");
                }
                redirect("index.php");
                break;*/

                case "addProdDB":
                    if(isset($_POST['submit'])){
    
                        $name= filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
                        $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                        $descr = filter_input(INPUT_POST, "description", FILTER_DEFAULT);;

                        insertProduct($name, $descr,$price);
                
                    }
                    else{
                        setMessage("error", "Sale pirate de ta maman, tu valides le formulaire STP !");
                    }
                    redirect("index.php");
                    break;

                case "addProdById":
                    if(isset($_GET['id'])){
                        
                        $products = findOneById($_GET['id']);
                        $name= $products['name'];
                        $price = $products['price'];
                        $qtt = 1;

                        $product = [
                            "name"  => $name,
                            "price" => $price,
                            "qtt"   => $qtt,
                        ];

                        $_SESSION['products'][] = $product;
                            
                            setMessage("success", "Produit $name ajouté avec succès ! <a href='recap.php'>Voir le panier</a>");
                            
                    }
                    else{
                        setMessage("error", "Sale pirate de ta maman, tu valides le formulaire STP !");
                    }
                    redirect("recap.php");
                    break;

            case "updateQtt":
                $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
                $mode = filter_input(INPUT_GET, "mode", FILTER_VALIDATE_REGEXP, [
                    "options" => [
                        "regexp" => "/incr|decr/"
                    ]
                ]);

                //$id == 0 est équivalent à id == false ou id == null
                if($id >= 0 && $mode){
                    switch($mode){
                        case "incr":
                            $_SESSION["products"][$id]["qtt"]++;
                            break;
                        case "decr":
                            $_SESSION["products"][$id]["qtt"]--;
                            
                            if($_SESSION["products"][$id]["qtt"] == 0){
                                redirect("traitement.php?action=deleteProd&id=$id");
                            }
                            break;
                    }
                }
                else setMessage("error", "Problème de requête, réessayez !");
                break;

            case "deleteProd": 
                $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

                if(isset($_SESSION['products'][$id])){
                    $name = $_SESSION['products'][$id]["name"];//récupère le nom du produit qui va être supprimé
                    unset($_SESSION['products'][$id]);//on le supprime
                    /*------ACHTUNG------*/
                    $_SESSION["products"] = array_values($_SESSION["products"]);//réattribue les index des produits restants
                    /*----fin ACHTUNG----*/
                    setMessage("success", "Le produit $name a été supprimé !");
                }
                else setMessage("error", "Le produit n'existe pas !");
                break;
            
            case "deleteAll": 
                if(isset($_SESSION['products'])){
                    unset($_SESSION['products']);
                    setMessage("success", "Votre panier a été vidé avec succès !");
                }
                else setMessage("error", "Pas de panier... pas de panier !");
                break;
        }
    }

    redirect("recap.php");