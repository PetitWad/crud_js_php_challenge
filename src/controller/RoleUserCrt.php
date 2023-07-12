<?php
include_once "../connexion/connexion.php";
include_once "../model/Users.php";
include_once "../dao/UsersDAO.php";

$users = new Users();
$usersdao = new UsersDAO();

$d = filter_input_array(INPUT_POST);

if(isset($_POST['desac'])){
       
    $users->setId($d['id']);
    $usersdao->desactiver_user($users);

    header("Location: ../home.php");
}else if(isset($_POST['activ'])){
       
    $users->setId($d['id']);
    $usersdao->activer_user($users);

    header("Location: ../home.php");
}else{
    header("Location: ../");
}
