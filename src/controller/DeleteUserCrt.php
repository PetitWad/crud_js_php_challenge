<?php
include_once "../connexion/connexion.php";
include_once "../model/Users.php";
include_once "../dao/UsersDAO.php";

$users = new Users();
$usersdao = new UsersDAO();

//$d = filter_input_array(INPUT_POST);

if(isset($_GET['del'])){

    $users->setId($_GET['del']);
    $usersdao->delete($users);

    header("Location: ../home.php");
}