<?php
include_once "../connexion/connexion.php";
include_once "../model/Users.php";
include_once "../dao/UsersDAO.php";

$users = new Users();
$usersdao = new UsersDAO();

// Vérifier si la requête est de type POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $username = $_POST['username'];
    $role = $_POST['role'];
    $sex = $_POST['sex'];
    $id = $_POST['id'];

    

    // formatage par l'objet User
    $users->setNom($nom);
    $users->setPrenom($prenom );
    $users->setUsername($username );
    $users->setRole($role);
    $users->setSex($sex);
    $users->setId($id);

    $usersdao->update($users);
    header("Location: ../home.php");
    

  // Envoyer la réponse JSON
  header('Content-Type: application/json');
  echo json_encode($response);
}
?>
