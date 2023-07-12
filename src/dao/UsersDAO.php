<?php
session_start();
class UsersDAO{
    
    public function create(Users $users) {
        try {
            $sql = "INSERT INTO users (nom,prenom,username,password,role,sex,statut) VALUES (:nom,:prenom,:username,:password,:role,:sex,:statut)";
            $pass = $users->getPassword();
            $p_sql = connexion::getConnexion()->prepare($sql);
            $p_sql->bindValue(":nom", $users->getNom());
            $p_sql->bindValue(":prenom", $users->getPrenom());
            $p_sql->bindValue(":username", $users->getUsername());
            $p_sql->bindValue(":password", $pass);
            $p_sql->bindValue(":role", $users->getRole());
            $p_sql->bindValue(":sex", $users->getSex());
            $p_sql->bindValue(":statut", $users->getStatut());
    
            $p_sql->execute();
            
        } catch (Exception $e) {
            print "Error insert of new user <br>" . $e . '<br>';
        }
    }

    public function read() {
        try {
            $user = $_SESSION['user'];
            $sql = "SELECT * FROM users"; 
            $result = connexion::getConnexion()->query($sql);
            $lista = $result->fetchAll(PDO::FETCH_ASSOC);
            $f_lista = array();
            foreach ($lista as $l) {
                $f_lista[] = $this->listUsers($l);
            }
            return $f_lista;
        } catch (Exception $e) {
            print "erreur." . $e;
        }
    }

    public function read_user() {
        try {
            $user = $_SESSION['user'];
            $sql = "SELECT * FROM users  where  username = '$user' and statut=1 ";
            $result = connexion::getConnexion()->query($sql);
            $lista = $result->fetchAll(PDO::FETCH_ASSOC);
            $f_lista = array();
            foreach ($lista as $l) {
                $f_lista[] = $this->listUsers($l);
            }
            return $f_lista;
        } catch (Exception $e) {
            print "erro." . $e;
        }
    }


    private function listUsers($row) {
        $users = new Users();
        $users->setId($row['id']);
        $users->setNom($row['nom']);
        $users->setPrenom($row['prenom']);
        $users->setUsername($row['username']);
        $users->setPassword($row['password']);
        $users->setRole($row['role']);
        $users->setSex($row ['sex']);
        $users->setStatut($row ['statut']);
        
        return $users;
    }

    public function update(Users $users) {
        try {
            $sql = "UPDATE users set
                  nom =:nom,
                  prenom =:prenom,
                  username=:username,
                  role=:role,
                  sex =:sex                 
                                                                       
                  WHERE id = :id";

             $p_sql = connexion::getConnexion()->prepare($sql);
             $p_sql->bindValue(":nom", $users->getNom());
             $p_sql->bindValue(":prenom", $users->getPrenom());
             $p_sql->bindValue(":username", $users->getUsername());
            // $p_sql->bindValue(":password", $users->getPassword());
             $p_sql->bindValue(":role", $users->getRole());
             $p_sql->bindValue(":sex", $users->getSex());
             $p_sql->bindValue(":id", $users->getId());

            
            if ($p_sql->execute()) {
                // Insertion réussie
                echo "update réussie !";
            } else {
                // Erreur lors de l'insertion
                echo "<script>alert('Erreur lors de la modification: " . $p_sql->errorInfo()[2] . "');</script>";
            }

            //header("Location: ../");

        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar fazer Update<br> $e <br>";
        }
    }

    public function delete(Users $users) {
        try {
            $sql = "DELETE FROM users WHERE id = :id";
            $p_sql = connexion::getConnexion()->prepare($sql);
            $p_sql->bindValue(":id", $users->getId());
            return $p_sql->execute();
        } catch (Exception $e) {
            echo "Erro ao Excluir usuario<br> $e <br>";
        }
    }

    public function desactiver_user(Users $users) {
        try {
            $sql = "UPDATE users set statut = 0 WHERE id = :id";
             $p_sql = connexion::getConnexion()->prepare($sql);
             $p_sql->bindValue(":id", $users->getId());

            
            if ($p_sql->execute()) {
                // Insertion réussie
                echo "update réussie !";
            } else {
                // Erreur lors de l'insertion
                echo "<script>alert('Erreur lors de la modification: " . $p_sql->errorInfo()[2] . "');</script>";
            }

        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar fazer Update<br> $e <br>";
        }
    }

    public function activer_user(Users $users) {
        try {
            $sql = "UPDATE users set statut = 1 WHERE id = :id";
             $p_sql = connexion::getConnexion()->prepare($sql);
             $p_sql->bindValue(":id", $users->getId());

            if ($p_sql->execute()) {
                // Insertion réussie
                echo "update réussie !";
            } else {
                // Erreur lors de l'insertion
                echo "<script>alert('Erreur lors de la modification: " . $p_sql->errorInfo()[2] . "');</script>";
            }

        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar fazer Update<br> $e <br>";
        }
    }

    public function tcheck_user() {
        try {
            
            $user = $_SESSION['user'];
            $sql1 = "SELECT * FROM `users` where username = '$user' and statut = 1 ";
            $result = connexion::getConnexion()->query($sql1);
            $lista = $result->fetchAll(PDO::FETCH_ASSOC);
            $f_lista = array();
            foreach ($lista as $l) {
                $f_lista[] = $this->listUsers($l);
            }
            
            return $f_lista;
        } catch (Exception $e) {
            print "Error." . $e;
        }
    }

    public function login_users($username, $password) {
        try {

            $sql ="SELECT * FROM `users` WHERE username=:username and password=:password ";

            $query= connexion::getConnexion()->prepare($sql);
            
            $query->bindParam(':username', $username);
            $query->bindParam(':password', $password);
            $query-> execute();

            return $query;
            
        } catch (Exception $e) {
            print "erreur est produit." . $e;
        }
    }

 }

 ?>