<?php 

        $description = "Votre compte a bien été supprimé";
        $title = "Suppression du compte utilisateur";

        ob_start();

        if (isset($_GET['message'])) { ?>
                <div class="fs-3 m-3">
                        <?=htmlspecialchars($_GET['message'])?>
                </div>
        <?php } 

        $content = ob_get_clean();

        require_once('views/common/template.php');

?>