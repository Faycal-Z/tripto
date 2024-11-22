<?php 

        $description = "Informations sur votre compte";
        $title = "Mon compte";
        
        ob_start();?>

        <!-- Affichage des information de l'utilisateur -->
        <section class="text-capitalize fw-bold m-3">
            <p>Nom : <?=htmlspecialchars($user['last_name']);?></p>
            <p>Prenom : <?=htmlspecialchars($user['first_name']);?></p>
            <p>Pseudo : <?=htmlspecialchars($user['pseudo']);?></p>
            <p>Email : <?=htmlspecialchars($user['email']);?></p>
            <p>Date de création du compte : <?=htmlspecialchars($user['creation_date']);?></p>

            <div class="text-center p-4">
            <form method="post" action="index.php?page=delete-account" onsubmit="return confirm('Confirmer la suppression du compte ? Ce choix est irréversible.');">
                                                                        <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['user_id']) ?>">
                                                                        <button type="submit" class="btn btn-danger border border-2 border-quaternary fw-bold">Supprimer mon compte</button>
             </form>
             </div>
        </section>
        
        

<?php
        $content = ob_get_clean();
        
        require_once('views/common/template.php');

?>
