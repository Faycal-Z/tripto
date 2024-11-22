<?php 

    require_once('models/Manager.php');


    class CommentsManager extends Manager {

        // Fonction ajout d'un commentaire sur un itinéraire
        public function addComment($userId, $routeId, $commentContent, $commentRating, $commentImage){

            $bdd = $this->connection();

            $requete = $bdd->prepare('INSERT INTO comments(comment_user_id, comment_route_id, comment_content, comment_rating, comment_image) VALUES (?, ?, ?, ?, ?)');
            $requete->execute([ 
                                $userId,
                                $routeId, 
                                $commentContent,
                                $commentRating,
                                $commentImage                            
                            ]);
        }

        // Jointure des commentaires et utilisateurs
        public function getComments($routeId){

            $bdd = $this->connection();

            $requete = $bdd->prepare('SELECT c.comment_content, c.comment_rating, c.comment_image, c.comment_date_creation, u.pseudo
                                    FROM comments c
                                    INNER JOIN routes r ON r.route_id = c.comment_route_id
                                    INNER JOIN users u ON u.user_id = c.comment_user_id
                                    WHERE r.route_id = :route_id');
            $requete->execute(['route_id' => $routeId]);

            return $requete;
        }

    }