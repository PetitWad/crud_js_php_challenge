<?php
include_once "../connexion/connexion.php";
include_once "../model/Users.php";
include_once "../dao/UsersDAO.php";

$users = new Users();
$usersdao = new UsersDAO();

$d = filter_input_array(INPUT_POST);

 if(isset($_POST['edit'])){   
    
    $users->setNom($d['nom']);
    $users->setPrenom($d['prenom']);
    $users->setUsername($d['username']);
    $users->setRole($d['role']);
    //$users->setSex($d['sex']);
    $users->setId($d['id']);

    $usersdao->update($users);

    header("Location: ../home.php");
}