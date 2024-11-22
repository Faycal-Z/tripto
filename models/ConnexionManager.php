<?php 

    require_once('models/Manager.php');

    class ConnectionManager extends Manager {

        // Fonction connexion utilisateur
        public function userConnection($email, $password){

            $bdd = $this->connection();
            
            // Chiffrement du mot de passe
            $password = SecurityManager::cryptPassword($password);

            $requete = $bdd->prepare('SELECT * FROM users WHERE email = ?');
            $requete->execute([$email]);

            while($userconnect = $requete->fetch()){

                if ($password === $userconnect['password']) {
                    
                    return $userconnect;

                }
                else{

                    return false;

                }
            }
        }

    }
