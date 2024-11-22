<?php

    class Manager {
        // Connexion à la base de données
        protected function connection(){
            try {
                $bdd = new PDO('mysql:host=localhost;dbname=tripto;charset=utf8', 'root', '');
                return $bdd;
            } catch (Exception $e) {
                die('Erreur: '.$e->getMessage());
            }

        }
    }