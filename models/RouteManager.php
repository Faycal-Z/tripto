<?php 

    require_once('models/Manager.php');

    class RouteManager extends Manager{

        // Fonction ajout d'un itinéraire
        public function addRoute($routeNamePreview, $routeSteps, $routeImage, $routeContent, $recommended_route){

                $bdd = $this->connection();

                $requete = $bdd->prepare('INSERT INTO routes(route_name, route_steps, route_image, route_content, recommended_route) VALUES(?, ?, ?, ?, ?)');
                $requete->execute(
                    [ 
                        $routeNamePreview,
                        $routeSteps,
                        $routeImage,
                        $routeContent,
                        $recommended_route

                    ]);
                
                // Récupération de l'id de l'itinéraire
                return $bdd->lastInsertId();
                   
            }

                // Récuperation du contenu de l'itinéraire via l'id
                public function getRouteContent($routeId){
        
                    $bdd = $this->connection();
                    $requete = $bdd->prepare('SELECT route_id, route_name, route_steps, route_image,  route_content, recommended_route FROM routes WHERE route_id = ?');
                    $requete->execute([$routeId]);
        
                    return $requete->fetch();
               
        
                }

            // Fonction de modification d'un itinéraire    
            public function updateRouteContent($routeNamePreview, $routeSteps, $routeImage, $routeContent, $routeId, $recommendedRoute){

                $bdd = $this->connection();
                $requete = $bdd->prepare('UPDATE routes 
                                        SET route_name = ?,
                                            route_steps = ?,
                                            route_image = ?,
                                            route_content = ?,
                                            recommended_route = ?
                                        WHERE route_id = ?');
                $requete->execute([
                                    $routeNamePreview,
                                    $routeSteps, 
                                    $routeImage, 
                                    $routeContent,
                                    $recommendedRoute,
                                    $routeId         
            ]);
            }

            // Fonction de suppression d'un itinéraire
            public function deleteRoute($routeId){

                $bdd = $this->connection();
                $requete = $bdd->prepare('DELETE FROM routes WHERE route_id = ?');
                $requete->execute([$routeId]);
            }
            
            // Fonction récupération données des itinéraires
            public function getRoutes(){

                $bdd = $this->connection();
                $requete = $bdd->query('SELECT route_id, route_name, route_steps, route_image FROM routes');
    
                return $requete;
            }

            // Fonction récupération données itinéraires recommandés
            public function getRecommendedRoutes(){

                $bdd = $this->connection();
                $requete = $bdd->prepare('SELECT route_id, route_name, route_steps, route_image FROM routes WHERE recommended_route = ?');
                $requete->execute([1]);

                return $requete;
            }
                
        }
        