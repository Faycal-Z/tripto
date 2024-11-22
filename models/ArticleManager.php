<?php

    require_once('models/Manager.php');

    class ArticleManager extends Manager {

        // Fonction de récupération de l'ininéraire via l'id
        public function getRouteContent($routeId){

            $bdd = $this->connection();
            $requete = $bdd->prepare('SELECT route_name, route_content FROM routes WHERE route_id = ?');
            $requete->execute([$routeId]);

            return $requete;
       

        }
    }