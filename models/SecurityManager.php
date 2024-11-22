<?php 

    class SecurityManager {

        // Fonction chiffrement mot de passe
        public static function cryptPassword($password) {
            
            return "ah12".sha1($password."15ds")."ljs47h";

        }
        
    }