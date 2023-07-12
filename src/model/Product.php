<?php

class Product
{
    private $id;
    private $nomProduit;
    private $description;
    private $prix;

    // getter
    function getId()
    {
        return $this->id;
    }

    function getNomProduit()
    {
        return $this->nomProduit;
    }

    function getDescription()
    {
        return $this->description;
    }

    function getPrix()
    {
        return $this->prix;
    }



    // setter
    function setId($id)
    {
        $this->id = $id;
    }

    function setNomProduit($nomProduit)
    {
        $this->nomProduit = $nomProduit;
    }

    function setDescription($description)
    {
        $this->description = $description;
    }

    function setPrix($prix)
    {
        $this->prix = $prix;
    }


 
}
