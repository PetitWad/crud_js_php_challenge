<?php
class ProductDao{
    
    public function create(Product $prod) {
        try {
            $sql = "INSERT INTO product (nomProduit,prix,description) VALUES (:nomProduit, :prix, :description)";

            $p_sql = connexion::getConnexion()->prepare($sql);
            $p_sql->bindValue(":nomProduit", $prod->getNomProduit());
            $p_sql->bindValue(":prix", $prod->getPrix());
            $p_sql->bindValue(":description", $prod->getDescription());
    
            $p_sql->execute();
            
        } catch (Exception $e) {
            print "Error insert of new product <br>" . $e . '<br>';
        }
    }

    public function read() {
        try {
            $sql = "SELECT * FROM product"; 
            $result = connexion::getConnexion()->query($sql);
            $lista = $result->fetchAll(PDO::FETCH_ASSOC);
            $f_lista = array();
            foreach ($lista as $l) {
                $f_lista[] = $this->listProduct($l);
            }
            return $f_lista;
        } catch (Exception $e) {
            print "erreur." . $e;
        }
    }

    public function read_by_id($id) {
        try {
            $sql = "SELECT * FROM product where id = $id"; 
            $result = connexion::getConnexion()->query($sql);
            $lista = $result->fetchAll(PDO::FETCH_ASSOC);
            $f_lista = array();
            foreach ($lista as $l) {
                $f_lista[] = $this->listProduct($l);
            }
            return $f_lista;
        } catch (Exception $e) {
            print "erreur." . $e;
        }
    }

    private function listProduct($row) {
        $product = new Product();
        $product->setId($row['id']);
        $product->setNomProduit($row['nomProduit']);
        $product->setDescription($row['description']);
        $product->setPrix($row['prix']);
        
        return $product;
    }

    public function update(Product $prod) {
        try {
            $sql = "UPDATE product set nomProduit =:nomProduit, description =:description, prix=:prix WHERE id = :id";

             $p_sql = connexion::getConnexion()->prepare($sql);
             $p_sql->bindValue(":nomProduit", $prod->getNomProduit());
             $p_sql->bindValue(":description", $prod->getDescription());
             $p_sql->bindValue(":prix", $prod->getPrix());
             $p_sql->bindValue(":id", $prod->getId());
            
            if ($p_sql->execute()) {
                echo "update réussie !";
            } else {
                echo "<script>alert('Erreur lors de la modification: " . $p_sql->errorInfo()[2] . "');</script>";
            }

        } catch (Exception $e) {
            print "Error: $e";
        }
    }

    public function delete(Product $prod) {
        try {
            $sql = "DELETE FROM product WHERE id = :id";
            $p_sql = connexion::getConnexion()->prepare($sql);
            $p_sql->bindValue(":id", intval($prod->getId()));
            return $p_sql->execute();
        } catch (Exception $e) {
            echo "Error : $e ";
        }
    }

 }

 ?>