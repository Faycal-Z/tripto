<?php 

        $description = "Page de déconnexion";
        $title = "Vous avez bien été déconnecté";
        
        ob_start();?>

       
        <p class="m-4 fs-4">Vous avez bien été déconnecté. <br> <a href="index.php">Retour à la page d'accueil</a></p>
        

<?php
        $content = ob_get_clean();
        
        require_once('views/common/template.php');

?>
