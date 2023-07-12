<?php
include_once "../connexion/connexion.php";
include_once "../model/Product.php";
include_once "../dao/ProductDao.php";

$prod = new Product();
$proddao = new ProductDao();

$d = filter_input_array(INPUT_POST);

 if(isset($_POST['updateProd'])){   
    
    $prod->setNomProduit($d['nomProduit']);
    $prod->setDescription($d['description']);
    $prod->setPrix($d['prix']);
    $prod->setId(intval($d['id']));

    $proddao->update($prod);

    header("Location: ../home.php");
}