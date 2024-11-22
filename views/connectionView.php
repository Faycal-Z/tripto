<?php

        $description = "Connexion";
        $title = "Connexion";

        ob_start();
?>

<h1 class="text-center text-quaternary display-6">Veuillez entrer vos identifiants</h1>

    <!-- Formulaire de connexion -->
    <div class="bg-primary w-75 p-2 my-5 rounded shadow d-block mx-auto">
        <form method="post" action="index.php?page=connection" class="mt-5 w-50 mx-auto">
            
            <p class="text-secondary fw-bold fs-2 text-center">Connexion</p>
            
            <?php if(isset($_GET['success'])) { ?>
                    <div class="alert alert-success text-center text-quaternary">
                        Vous êtes maintenant connecté.
                    </div>
                <?php } elseif(isset($_GET['error']) && isset($_GET['message'])){ ?>
                    <div class="alert alert-danger text-center">
                        <?= htmlspecialchars($_GET['message']) ?>
                    </div>
                <?php }
                ?>

            <p>
                <label for="email" class="form-label text-secondary">Adresse email</label>
                <input type="email" required name="email" id="email" class="form-control border border-tertiary" placeholder="Votre adresse email">
            </p>
            <p>
                <label for="password" class="form-label text-secondary">Mot de passe</label>
                <input type="password" required name="password" id="password" class="form-control border border-tertiary" placeholder="Votre mot de passe">
            </p>

            <button type="submit" class="btn btn-secondary fw-bold d-block mx-auto w-75 my-5">Valider</button>

            <p class="text-tertiary text-center">Pas encore inscrit? <a href="index.php?page=inscription" class="link link-quaternary">Inscrivez-vous</a></p>
        </form>
    </div>

<?php

        $content = ob_get_clean();
        require_once('views/common/template.php');
?>
        