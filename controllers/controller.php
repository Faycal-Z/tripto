<?php

    // Importation des modeles
    require_once('models/CheckManager.php');
    require_once('models/SecurityManager.php');
    require_once('models/UserManager.php');
    require_once('models/connexionManager.php');
    require_once('models/RouteManager.php');
    require_once('models/pictureManager.php');
    require_once('models/ArticleManager.php');
    require_once('models/CommentsManager.php');

    // Page d'accueil
    function home(){
        // Affichage des routes recommandées
        $recommendedManager = new RouteManager();
        $recommendedRoutes = $recommendedManager->getRecommendedRoutes();
        require('views/homeView.php');
    }

    // Création d'un nouvel itinéraire
    function newRoute(){

        // Ajout des images
        if (isset($_FILES['route_image']) && $_FILES['route_image']['error'] === 0) {
           
            $pictureManager =  new PictureManager();
            $picture = $pictureManager->checkPicture($_FILES['route_image']);
            
        }
        // Vérification si l'itinéraire est recommandé
        if (isset($_POST['recommended_route']) && $_POST['recommended_route'] == 'on') {
           $recommendedRoute = 1;
        } else {
            $recommendedRoute = 0;
        }

        // Ajout des données de l'itineraire
        if (!empty($_POST['route_name']) && !empty($_POST['route_steps']) && !empty($_POST['route_content'])) {
            
            $routeManager = New RouteManager;
            $routeManager->addRoute(htmlspecialchars($_POST['route_name']), htmlspecialchars($_POST['route_steps']), $picture, htmlspecialchars($_POST['route_content']), $recommendedRoute);
            
            
            header('location: index.php?page=new-article&success=true&message=Itinéraire ajouté avec succès !');
            exit();
        }
        else {
            header('location: index.php?page=new-article&error=true&message=L\'itinéraire n\'a pas pu être ajouté. Veuillez vérifiez tous les champs.');
            exit();
        }
        require('views/creationArticleView.php');

    }

    // Mise à jour d'un itinéraire
    function updateRoute(){
        
        // Récuperation des données de l'itinéraire à modifier
        if (isset($_POST['route_id'])) {
            $routeId = htmlspecialchars($_POST['route_id']);

        $routeManager = new RouteManager();
        $route = $routeManager->getRouteContent($routeId);

        if (!$route) {
            header('Location: index.php?page=routes&error=true&message=L\'tinéraire n\'existe pas.');
            exit();
        }

        // Gestion de l'image de l'itinéraire
        if (isset($_FILES['route_image']) && $_FILES['route_image']['error'] === 0) {
           
            $pictureManager = new PictureManager();
            $picture = $pictureManager->checkPicture($_FILES['route_image']);

        } else {
            $picture = $route['route_image'];
        }

        // Vérification si l'itinéraire est recommandé
        if (isset($_POST['recommended_route']) && $_POST['recommended_route'] == 'on') {
            $recommendedRoute = 1;
         } else {
            $recommendedRoute = 0;
         }

        // Ajout des données modifiées à l'itinéraire
        if (!empty($_POST['route_name']) && !empty($_POST['route_steps']) && !empty($_POST['route_content'])) {
        
            $routeManager->updateRouteContent(htmlspecialchars($_POST['route_name']), htmlspecialchars($_POST['route_steps']), $picture, htmlspecialchars($_POST['route_content']), $routeId, $recommendedRoute);

            header('location: index.php?page=routes&success=true&message=Itinéraire mis à jour avec succès.');
            exit();
        }
        } 
        
        require('views/updateRouteView.php');


    }

    // Supprimer un itinéraire
    function deleteRoute($routeId){

        // Vérification des droits d'administrateur
        if (!isset($_SESSION['admin']) || $_SESSION['admin'] != 1) {
            header('Location: index.php?page=routes&error=true&message=Vous n\êtes pas autorisé à éffectuer cette action.');
            exit();
        }

        // Suppression de l'itinéraire
        $routeManager = new RouteManager();
        $routeId = htmlspecialchars($_POST['route_id']);
        $routeManager->deleteRoute($routeId);

        header('Location: index.php?page=routes&success=true&message=L\'itinéraire a bient été supprimé.');
        exit();

    }

    // Page affichant tous les itinéraires
    function routesPage(){

        $routeManager = New RouteManager;

        $requete = $routeManager->getRoutes();
        
        require('views/routesView.php');
    }


    // Affichage du contenu des itinéraires 
    function getRouteContent(){

        // Récupération des données de l'itinéraire via l'url
        $routeId = htmlspecialchars($_GET['id']);
        $routeManager = new ArticleManager();
        $routeContent = $routeManager->getRouteContent($routeId);

        // Récupération des commentaires via l'id de l'itinéraire
        $commentsManager = new CommentsManager();
        $allComments = $commentsManager->getComments($routeId);

        // Vérification de connexion de l'utilisateur
        if (isset($_SESSION['connect']) && isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];

            // Ajout des données du commentaire
            if (!empty($_POST['comment_content'])) {
        
                $commentContent = htmlspecialchars($_POST['comment_content']);
    
                if (isset($_POST['comment_rating'])) {
                    $commentRating = htmlspecialchars($_POST['comment_rating']);
                }
                if (isset($_FILES['comment_image']) && $_FILES['comment_image']['error'] === 0) {
                    $pictureManager =  new PictureManager();
                    $commentImage = $pictureManager->checkPicture($_FILES['comment_image']);
    
                } 
                
                $commentsManager->addComment($userId, $routeId, $commentContent, $commentRating, $commentImage);
    
                header("Location: index.php?page=route&id=$routeId&success=true");
                exit();
            }
        }

        
        require('views/articleView.php');

    }

    // Affichage des informations de l'utilisateur connecté
    function checkUser($userId){

        $userManager = new CheckManager();
        $user = $userManager->checkUser($userId);
        
        require('views/accountView.php');
    }

    // Accès a la page de création d'un nouvel article
    function creationArticlePage(){
        // Vérification droits d'administrateur
        if (!isset($_SESSION['admin']) || $_SESSION['admin'] != 1) {
            header('location: index.php?page=accueil&error=true&message=Vous n\'avez pas accès à cette page.');
            exit();
        }
        require('views/creationArticleView.php');
    }

    // Page de connexion
    function connectionPage (){
        require_once('views/connectionView.php');
    }

    // Connecter l'utilisateur
    function connection($email, $password){
        $connectionManager = new ConnectionManager;
        $connect = $connectionManager->userConnection($email, $password);
        
        if ($connect) {
            
            $_SESSION['connect'] = 1;
            $_SESSION['user_id'] = $connect['user_id'];
            $_SESSION['email'] = $connect['email'];
            $_SESSION['admin'] = $connect['admin'];
            header('location: index.php?page=accueil&success=true&message=Vous êtes désormais connecté.');
            exit();
        } else {
            header('Location: index.php?page=connection&error=true&message=Impossible de vous identifier');
            exit();
        }
        
        require_once('views/connectionView.php');
    }

    // Page d'inscription
    function register(){

        require_once('views/registrationView.php');
    }

    // Inscription de l'utilisateur
    function registration($userId, $firstName, $lastName, $pseudo, $email, $password, $password_two, $admin){

                    // Vérification de l'email
                    if (!CheckManager::checkEmail($email)) {
                        header('location: index.php?page=inscription&error=true&message=Veuillez entrer une adresse email correcte.');
                        exit();
                    }
                    // Vérification des mots de passe
                    if (!CheckManager::checkPassword($password, $password_two)) {
                        header('location: index.php?page=inscription&error=true&message=Les mots de passe ne sont pas identiques.');
                        exit();
                    }

                    $checkManager = new CheckManager();

                    // Vérification si email déja existant
                    if ($checkManager->doubleEmail($email)) {
                        header('location: index.php?page=inscription&error=true&message=Cette adresse email est déja utilisée.');
                        exit();
                    }
                    // Vérification si pseudo déja existant
                    if ($checkManager->doublePseudo($pseudo)) {
                        header('location: index.php?page=inscription&error=true&message=Ce pseudo est déja pris.');
                        exit();
                    }

                    // Chiffrement du mot de passe
                    $password = SecurityManager::cryptPassword($password); 
                    
                    // Ajout des données de l'utilisateur
                    $user = new UserManager($userId, $firstName, $lastName, $pseudo, $email, $password, $admin);
                    $user->addUser($userId, $firstName, $lastName, $pseudo, $email, $password, $admin);
                    $user->createNewSession($userId, $firstName, $lastName, $pseudo, $email, $admin);
                    

        require_once('views/registrationView.php');

    }

    // Deconnexion de l'utilisateur
    function logOut(){

        UserManager::logOut();
        require('views/logoutView.php');
        
    }

    function deleteAccount(){ 
        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
            $userManager = new UpdateUser();
            $user = $userManager->deleteAccount($userId);
            UserManager::logOut();
            header('location: index.php?page=delete-account&success=true&message=Votre compte a bien été supprimé.');
            exit();
        } else {
            header('location: index.php?page=delete-account&error=true&message=Votre compte n\'a pas pu être supprimé.');
            exit();
        } 

        require('Views/deleteAccountView.php');
    }

    // Page d'erreur
    function error($error){
        
        require_once('views/common/errorView.php');
    }









 