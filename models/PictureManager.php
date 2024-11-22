<?php

    require_once('models/Manager.php');

    class PictureManager extends Manager {

        // Fonction ajoute d'images
        public function checkPicture($picture) {
            
            // Vérification de la taille de l'image
            if ($picture['size'] <= 3000000) {

                $pictureInformations = pathinfo($picture['name']);
                $pictureExtension = $pictureInformations['extension'];
                $arrayExtensions = ['png', 'gif', 'jpg', 'jpeg'];

                // Vérification de l'extension et ajout de l'image
                if (in_array($pictureExtension, $arrayExtensions)) {
                    
                    $newImageName = time().rand().rand().'.'.$pictureExtension;
                    move_uploaded_file($picture['tmp_name'], 'public/assets/images/'.$newImageName);  

                    return $newImageName;
                 }

            }
        }
    }