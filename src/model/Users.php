<?php

class Users
{
    private $id;
    private $nom;
    private $prenom;
    private $username;
    private $password;
    private $login_username;
    private $login_password;
    private $sex;
    private $role;
    private $statut;


    // setter
    function getId()
    {
        return $this->id;
    }

    function getNom()
    {
        return $this->nom;
    }

    function getPrenom()
    {
        return $this->prenom;
    }

    function getUsername()
    {
        return $this->username;
    }

    function getPassword()
    {
        return $this->password;
    }

    function getLogin_Username()
    {
        return $this->login_username;
    }

    function getLogin_Password()
    {
        return $this->login_password;
    }

    function getRole()
    {
        return $this->role;
    }

    function getSex()
    {
        return $this->sex;
    }

    function getStatut()
    {
        return $this->statut;
    }


    // setter
    function setId($id)
    {
        $this->id = $id;
    }

    function setNom($nom)
    {
        $this->nom = $nom;
    }

    function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    function setUsername($username)
    {
        $this->username = $username;
    }

    function setPassword($password)
    {
        $this->password = $password;
    }

    function setLogin_Username($login_username)
    {
        $this->login_username = $login_username;
    }

    function setLogin_Password($login_password)
    {
        $this->login_password = $login_password;
    }

    function setSex($sex)
    {
        $this->sex = $sex;
    }

    function setRole($role)
    {
        $this->role = $role;
    }
    function setStatut($statut)
    {
        $this->statut = $statut;
    }
}
