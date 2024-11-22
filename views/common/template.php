<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="icon" href="public/assets/images/favicon.png" type="icon">
            <meta name="description" content="<?= $description ?>">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
            <link rel="stylesheet" href="public/design/defaut.css">
            
            <!-- Ajout balise script si necessaire -->
            <?php if(isset($script)){ 
                echo $script;
                 }
            if (isset($scriptContent)) { 
                echo $scriptContent;
                  } ?>
            
            <!-- Ajout du titre -->
            <title><?= $title ?></title>
        </head>

        
        <body class="d-flex flex-column min-vh-100">
        
            <!-- Ajout du header -->
            <?php require_once('views/common/header.php'); ?>

            <!-- Ajout de la navbar -->
            <?php require_once('views/common/menu.php'); ?>

            <!-- Ajout du contenu -->
            <div class="container flex-grow-1">
                <?= $content ?>
            </div>

            <!-- Ajout du footer -->
            <?php require_once('views/common/footer.php'); ?>
            
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
            
        </body>
    </html>