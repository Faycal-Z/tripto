<?php

        $description = "Description de la page 1";
        $title = "Titre de la page 1";

        ob_start()
?>

1

<?php

        $content = ob_get_clean();
        require_once('views/common/template.php');

?>