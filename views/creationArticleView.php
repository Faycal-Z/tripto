<?php

$description = "Créer un nouvel article";
$title = "Nouvel article";



$script = '<script src="https://cdn.tiny.cloud/1/kewru5b1fy0nprsr6x7tnoawfh90ezgb4u6k27gcpfa88kip/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>';

ob_start(); ?>

<!-- Ajout de tinymce -->
<script>
    tinymce.init({
        selector: 'textarea#tiny',
        plugins: [
            'a11ychecker', 'advlist', 'advcode', 'advtable', 'autolink', 'checklist', 'markdown',
            'lists', 'link', 'image', 'charmap', 'preview', 'anchor', 'searchreplace', 'visualblocks',
            'powerpaste', 'fullscreen', 'formatpainter', 'insertdatetime', 'media', 'table', 'help', 'wordcount'
        ],
        toolbar: 'undo redo | a11ycheck casechange blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify |' +
            'bullist numlist checklist outdent indent | removeformat | code table help'
    });
</script>

<?php
$scriptContent = ob_get_clean();

ob_start();
?>

    <div class="display-5 fw-bold text-center text-quaternary my-4">
        <h1>Créer un nouvel itinéraire</h1>
    </div>

    <!-- Formulaire de création d'un itinéraire -->
    <div class="bg-primary border border-tertiary p-2 my-2 rounded shadow d-block mx-auto">
        <form method="post" action="index.php?page=new-article" class="mt-3 w-90 mx-auto" enctype="multipart/form-data">
        <!-- Champs ajout prévisualitation de l'itinéraire    -->
            <div>
                <?php
                    if (isset($_GET['message'])) {
                        if (isset($_GET['error']) && $_GET['error'] === 'true') {?>
                            <div class="alert alert-danger text-center"><?=htmlspecialchars($_GET['message'])?></div>
                        <?php }
                        elseif (isset($_GET['success']) && $_GET['success'] === 'true'){ ?>
                            <div class="alert alert-success text-center"><?=htmlspecialchars($_GET['message'])?></div>
                    <?php }
                        
                    }
                ?>
                <h2 class="text-center text-secondary mb-5">Prévisualisation de l'itinéraire</h2>

                    <label for="route_name" class="form-label" required><h3>Nom de l'itinéraire</h3></label>
                    <input type="text" name="route_name" id="route_name" required>
                    
                    <h3>
                    Etapes de l'itinéraire <br>
                    </h3>
                    <textarea name="route_steps" class="w-50 mt-3"></textarea>
                    
                    <h3>
                    Image de l'itinéraire <br>
                    </h3>
                    <input type="file" name="route_image" class="form-control w-50 m-3" required>
                    <br>

                    <p class="form-check form-switch">
                    <input type="checkbox" name="recommended_route" class="form-check-input" id="recommended_route">
                    <label for="recommended_route" class="form-check-label">Itinéraire Recommandé</label>
                    
            </div>
        <!-- Champ article itinéraire -->
        <h2 class="text-center text-secondary mt-5">Article de l'itinéraire</h2>
            <div class="w-95">
                <textarea id="tiny" name="route_content"></textarea>
            </div>
            <button type="submit" class="btn btn-secondary fw-bold d-block mx-auto w-50 my-3">Ajouter itinéraire</button>
        </form>
    </div>


<?php

    $content = ob_get_clean();
    require_once('views/common/template.php');

?>