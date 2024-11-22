<?php
    // Vérification si session existante
    if (isset($_SESSION['connect'])) {
        
        header('location: index.php?page=accueil');
        exit();
    }
    $description = "Page d'inscription";
    $title = "Inscription";
    ob_start() 
?>

    <h1 class="text-center text-quaternary display-5">Inscrivez vous dès maintenant et rejoignez la communauté !</h1>

    <!-- Formulaire d'inscription -->
    <div class="bg-primary w-75 p-2 my-5 rounded shadow d-block mx-auto">
        <form method="post" action="index.php?page=inscription" class="mt-5 w-50 mx-auto">
            
            <p class="text-secondary fw-bold fs-2 text-center">Inscription</p>
            
            <?php if(isset($_GET['success'])) { ?>
                    <div class="alert alert-success text-center text-quaternary">
                        Félicitations ! Vous êtes désormais inscrit.
                    </div>
                <?php } elseif(isset($_GET['error']) && isset($_GET['message'])){ ?>
                    <div class="alert alert-danger text-center">
                        <?= htmlspecialchars($_GET['message']) ?>
                    </div>
                <?php }
                ?>
            <p>
                <label for="first_name" class="form-label text-secondary">Prénom</label>
                <input type="text" required name="first_name" id="first_name" class="form-control border border-tertiary" placeholder="Votre Prénom">
            </p>

            <p>
                <label for="last_name" class="form-label text-secondary">Nom</label>
                <input type="text" required name="last_name" id="last_name" class="form-control border border-tertiary" placeholder="Votre Nom">
            </p>

            <p>
                <label for="pseudo" class="form-label text-secondary">Pseudo</label>
                <input type="text" required name="pseudo" id="pseudo" class="form-control border border-tertiary" placeholder="Votre Pseudo">
            </p>

            <p>
                <label for="email" class="form-label text-secondary">Adresse email</label>
                <input type="email" required name="email" id="email" class="form-control border border-tertiary" placeholder="Votre adresse email">
            </p>
            <p>
                <label for="password" class="form-label text-secondary">Mot de passe</label>
                <input type="password" required name="password" id="password" class="form-control border border-tertiary" placeholder="Choisissez un mot de passe">
            </p>
            <p>
                <label for="password_two" class="form-label text-secondary">Confirmer votre mot de passe</label>
                <input type="password" required name="password_two" id="password_two" class="form-control border border-tertiary" placeholder="Confirmez votre mot de passe">
            </p>


            <button type="submit" class="btn btn-secondary fw-bold d-block mx-auto w-75 my-5">Valider</button>

            <p class="text-tertiary text-center">Dejà membre? <a href="index.php?page=connection" class="link link-quaternary">Connectez-vous</a></p>
        </form>
    </div>
 

<?php

    $content = ob_get_clean();
    require_once('views/common/template.php');

?>
