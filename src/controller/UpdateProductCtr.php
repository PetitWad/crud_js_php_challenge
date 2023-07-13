<?php
include_once "../connexion/connexion.php";
include_once "../model/Product.php";
include_once "../dao/ProductDao.php";

$prod = new Product();
$proddao = new ProductDao();
$response = [];
// Vérifier si la requête est de type POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // Récupérer les données du formulaire
    $nomproduit = $_POST['nomProduit'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $id = intval($_POST['id']);

    // formatage par l'objet Users
    $prod->setNomProduit($nomproduit);
    $prod->setDescription($description);
    $prod->setPrix($prix);
    $prod->setId($id);

  // $proddao->update($prod);
   //header("Location: ../home.php");

   if (isset($prod) > 0){
    $msg = "Modification réussie.";
      $proddao->update($prod);
      $response = ["status" => true, "message" => "Modification réussie." ];
  }else {
    $response = ["status" => true, "message" => "Identifiants incorrects." ];
  } 

  // Envoyer la réponse JSON
  header('Content-Type: application/json');
  echo json_encode($response);
}
?>