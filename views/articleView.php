<?php 
    $description = "Article";
    $title = ""; 

    ob_start();

    // Récupération des informations de l'itinéraire
    while($route = $routeContent->fetch()){
        $title = htmlspecialchars($route['route_name']);
        $routeArticle = htmlspecialchars($route['route_content']);
    }
    ?>
    <!-- Affichage du contenu de l'itinéraire -->
    <section class="py-3">
        <?= $routeArticle ?>
    </section>

    <section class="bg-secondary border border-tertiary rounded shadow w-95 d-block wx-auto p-3 mt-3">
        
        <!-- Affichage des avis et commentaires de l'itinéraire -->
        <h5 class="text-center text-white display-6 pb-4">Avis et commentaires de l'itinéraire</h5>

        <div class="bg-primary border p-3 my-2 rounded shadow d-block mx-auto">
            <div>
                <?php
                    while ($comments = $allComments->fetch()) {
                        if (isset($comments['comment_content'])) { ?>

                        <div class="bg-white text-center border border-quaternary rounded shadow w-75 py-3 my-3 d-block mx-auto">
                            
                            <p class="text-quaternary fw-bold fs-3">Note : <?=htmlspecialchars($comments['comment_rating'])?> / 10 </p>
                            
                            <p class="mx-3"><?= htmlspecialchars($comments['comment_content']); ?></p><br>

                            <?php if (isset($comments['comment_image'])) { ?>
                            <div><br>
                                <img src="public/assets/images/<?= htmlspecialchars($comments['comment_image']) ?>" alt="Image du commentaire" class="img-fluid w-100" style="height: 300px; object-fit: cover;">
                            </div><br>
                            <?php } ?>
                            <div class="mt-2 text-secondary"><span class="fw-bold text-uppercase fs-5"><?=htmlspecialchars($comments['pseudo'])?></span><br> <span class="fst-italic"><?= htmlspecialchars($comments['comment_date_creation']) ?></span></div>
                        </div>
                            
                        <?php }
                    } 
                ?>

            </div>

            <?php 
                // Formulaire d'ajout d'un commentaire si utilisateur connecté
                if (isset($_SESSION['connect'])) { ?>

                    <form method="post" action="index.php?page=route&id=<?=$routeId?>" class="mt-5 w-90 mx-auto" enctype="multipart/form-data">
                
                        <div class="text-center text-tertiary">
                    
                            <p class="fw-bold mt-3">
                                Ajouter un commentaire <br>
                            </p>

                                <textarea name="comment_content" class="w-75 mt-2 pb-3" required></textarea>
                                
                            <label for="comment_rating" class="mt-2 pb-3 fw-bold">Noter cet itinéraire sur 10 (facultatif)</label><br>
                            <input type="number" id="comment_rating" name="comment_rating" min="0" max="10">

                                <p class="fw-bold p-3">
                                Ajouter une photo (facultatif)<br>
                                </p>

                                <input type="file" name="comment_image" class="form-control d-block mx-auto w-50 m-3">
                            
                        </div>

                            <button type="submit" class="btn btn-outline-secondary fw-bold d-block mx-auto w-30 my-5">Partager mon commentaire</button>
            
                    </form> 
                <?php  } else{ ?>
                <div class="text-center m-5 fw-bold"> Veuillez vous <a href="index.php?page=connection" class="link link-quaternary">connecter</a> pour ajouter un commentaire. </div>
             <?php }
              ?>
        
    </section>
              
<?php
    $content = ob_get_clean(); 
    require_once('views/common/template.php');
?>
