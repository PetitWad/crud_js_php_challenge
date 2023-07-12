<?php
include_once "../connexion/connexion.php";
include_once "../model/Product.php";
include_once "../dao/ProductDao.php";

$prod = new Product();
$proddao = new ProductDao();


$d = filter_input_array(INPUT_POST);

if(isset($_POST['submit'])){

    $prod->setNomProduit($d['nomProduit']);
    $prod->setPrix($d['prix']);
    $prod->setDescription($d['description']);

    $proddao->create($prod);

    header("Location: ../home.php");
} 