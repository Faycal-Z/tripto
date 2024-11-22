<?php

require_once('models/manager.php');

class CheckManager extends Manager {

    // Fonction de vérificatation de l'email
    public static function checkEmail($email){
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        else {
            return false;
        }
    }

    // Fonction de vérification correspondance mots de passe
    public static function checkPassword($password, $password_two) {

        if ($password === $password_two) {
            return true;
        }
        else {
            return false;
        }

    }

    // Fonction vérification pseudo déja existant
    public function doublePseudo($pseudo){

        $bdd = $this->connection();
        $requete = $bdd->prepare('SELECT COUNT(*) AS numberPseudo from users WHERE pseudo = ?');
        $requete->execute([$pseudo]);
        while ($doublePseudo = $requete->fetch()) {
            if ($doublePseudo['numberPseudo'] != 0) {
                return true;
            } else {
                return false;
            }
            
        }
    }

    // Fonction de vérification si email déja existant
    public function doubleEmail($email){
        $bdd = $this->connection();
        $requete = $bdd->prepare('SELECT COUNT(*) AS numberEmail from users WHERE email = ?');
        $requete->execute([$email]);

        while($nomberEmail = $requete->fetch()){
            if ($nomberEmail['numberEmail'] != 0) {
                return true;
            }
            else {
                return false;
            }
        }
    }
    
    // Fonction de récupération des informations de l'utilisateur via l'id
    public function checkUser($userId){

        $bdd = $this->connection();

        $requete = $bdd->prepare('SELECT * FROM users where user_id = ?');
        $requete->execute([$userId]);

        return $requete->fetch();
    }


}
