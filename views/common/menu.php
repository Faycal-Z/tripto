<!-- Ajout de la navbar -->
 
  <nav class="navbar navbar-light bg-primary navbar-expand-md mb-2 sticky-top">
    <div class="container">
    
      <div class="navbar-brand text-quaternary">
        TRIPTO
      </div>

      <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarText">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mx-auto">

          <li class="nav-item">
            <a href="accueil" class="nav-link">Accueil</a>
          </li>
          <li class="nav-item">
            <a href="routes" class="nav-link">Itinéraires</a> 
          </li>
          <?php if (isset($_SESSION['connect']) && $_SESSION['connect'] === 1) { ?>
            <li class="nav-item">
            <a href="account" class="nav-link">Mon compte</a> 
          </li>
          <?php } ?>
          
          <li class="nav-item">
            <?php 
            if (isset($_SESSION['connect']) && $_SESSION['admin'] == 1) {?>
            <a href="new-article" class="nav-link">Créer un itinéraire</a> 
            <?php } ?>
          </li>
          <li class="nav-item px-5">
            <?php if(isset($_SESSION['connect'])){?>

              <a href="logout" class="nav-link">Se Déconnecter</a>
            <?php } 
            
            else { ?>
            <a href="connection" class="nav-link">Se connecter</a>
            <?php } ?>
          </li>

        </ul>
      </div>

    </div>

  </nav>
