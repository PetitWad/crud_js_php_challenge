<?php
include_once "../connexion/connexion.php";
include_once "../model/Users.php";
include_once "../dao/UsersDAO.php";

$users = new Users();
$usersdao = new UsersDAO();

// Vérifier si la requête est de type POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // Récupérer les données du formulaire
  $username = $_POST['login_username'];
  $password = $_POST['login_password'];

  // Effectuer le traitement nécessaire, par exemple vérifier les informations de connexion dans une base de données
  $daOk = $usersdao->login_users($username, $password);


  if ($daOk->rowCount() > 0 ) {
    $usersdao->login_users($username, $password);
    $response['status'] = true;
    $response['message'] = "Connexion réussie.";
    $_SESSION['user'] = $username;
  }else {
    $response['status'] = false;
    $response['message'] = "Identifiants incorrects.";
  }

  // Envoyer la réponse JSON
  header('Content-Type: application/json');
  echo json_encode($response);
}
?>