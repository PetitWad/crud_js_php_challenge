<?php
include_once "../connexion/connexion.php";
include_once "../model/Product.php";
include_once "../dao/ProductDao.php";

$prod = new Product();
$proddao = new ProductDao();

// Vérifier si la requête est de type POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // Récupérer les données du formulaire
    $nomproduit = $_POST['nomProduit'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];

    // formatage par l'objet Users
    $prod->setNomProduit($nomproduit);
    $prod->setDescription($description);
    $prod->setPrix($prix);

    $proddao->create($prod);
    header("Location: ../home.php");
    

  // Envoyer la réponse JSON
  header('Content-Type: application/json');
  echo json_encode($response);
}
?>