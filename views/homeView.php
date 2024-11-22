<?php



$description = "Tripto les meilleures journées d'excursion en France.";
$title = "Tripto";
ob_start() ?>

<section>
    <div class="text-center text-secondary fs-3">
        Bienvenue sur Tripto ! <br> Ici, nous partageons les meilleures journées d'excursion en France.
    </div>
    <div class="text-center text-quaternary fs-4 m-4">Partagez vos avis, experiences, rejoignez la communauté ! </div>
</section>

<section>
    <div class="bg-light p-1 border rounded">
        <h1 class="display-3 fw-bold text-quaternary text-center m-4">Itinéraires à la une</h1>
        <!-- GRILLE -->
        <div class="row g-4 mb-5 m-4">
                <?php

                while($route = $recommendedRoutes->fetch()) { ?>

                        <div class="col-md-4 col-sm-6">
                                <!-- Carte -->
                                <a href="index.php?page=route&id=<?=htmlspecialchars($route['route_id'])?>" class="card-link text-decoration-none">
                                        <div class="card h-100 border-tertiary">

                                                <div>
                                                        <img src="public/assets/images/<?= htmlspecialchars($route['route_image']) ?>" alt="Image de l'itinéraire" class="img-fluid w-100" style="height: 300px; object-fit: cover;">
                                                </div>
                                                <div class="card-header bg-primary text-center text-quaternary">
                                                        <h2>
                                                                <?= htmlspecialchars($route['route_name']) ?>
                                                        </h2>
                                                </div>
                                                <div class="card-body">
                                                        <?= htmlspecialchars($route['route_steps']) ?>
                                                </div>

                                                <!-- Modification ou Suppression d'article si admin -->
                                                <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] = 1) { ?>
                                                        <div class="card-footer text-center bg-primary">
                                                                

                                                                <form method="post" action="index.php?page=update-route">
                                                                        <input type="hidden" name="route_id" value="<?= htmlspecialchars($route['route_id']) ?>">
                                                                        <button type="submit" class="btn btn-success">Modifier cette route</button>
                                                                </form><hr>

                                                                <form method="post" action="index.php?page=delete-route" onsubmit="return confirm('Confirmer la suppression de l\'itinéraire ?');">
                                                                        <input type="hidden" name="route_id" value="<?= htmlspecialchars($route['route_id']) ?>">
                                                                        <button type="submit" class="btn btn-danger">Supprimer cette route</button>
                                                                </form>
                                                        
                                                        </div>
                                                <?php } ?>
                                                
                                        </div>
                                        </a>
                        </div>
                        <?php } ?>

        </div>
    </div>
</section>

<?php
$content = ob_get_clean();
require_once('views/common/template.php');


?>

