<?php
include_once "../connexion/connexion.php";
include_once "../model/Product.php";
include_once "../dao/ProductDao.php";

$prod = new Product();
$proddao = new ProductDao();

if(isset($_GET['delProd'])){

    $prod->setId($_GET['delProd']);
    $proddao->delete($prod);

    header("Location: ../home.php");
}