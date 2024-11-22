<?php
    // Initialisation des sessions
    session_start();

    require_once('controllers/controller.php');


    try {
        // Vérification et décomposition de l'url
        if (empty($_GET['page'])) {
            $page = 'accueil';
        }
        else {
            $url = explode("/", filter_var($_GET['page'], FILTER_SANITIZE_URL));
            $page = $url[0];
        }

        // Parcours des différentes pages et gestion des erreurs
        switch ($page) {
            case 'accueil':
                home();
                break;
            case 'connection':
                if (!empty($_POST['email']) && !empty($_POST['password'])) {
                    $email = htmlspecialchars($_POST['email']);
                    $password = htmlspecialchars($_POST['password']);
                    connection($email, $password, $admin); 

                    if(connection($email, $password, $admin)){
                        header('location: index.php?page=accueil');
                        exit();
                    }
                    
                }
                    else {
                        connectionPage();
                    }
                break;
            case 'inscription':
                if (!empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password_two'])) {
                    
                    
                    $firstName = htmlspecialchars($_POST['first_name']);
                    $lastName = htmlspecialchars($_POST['last_name']);
                    $pseudo = htmlspecialchars($_POST['pseudo']);
                    $email = htmlspecialchars($_POST['email']);
                    $password = htmlspecialchars($_POST['password']);
                    $password_two = htmlspecialchars($_POST['password_two']);

                    
                    registration($userId, $firstName, $lastName, $pseudo, $email, $password, $password_two, $admin);
                    
                }
                else{
                    if (isset($_GET['success'])) {
                       home();
                    }
                    register();
                }
                break;
            case 'logout':
                    logOut();
                break;
            case 'routes':
                routesPage();
                break;
            case 'route':
                getRouteContent();
                break;
            case 'account':
                if (isset($_SESSION['user_id'])) {
                    $userId = $_SESSION['user_id'];
                    checkUser($userId);
                } else {
                    echo "vous n'etes pas connecté";
                }
                
                break;
            case 'new-article':
                if (isset($_POST['route_name']) && isset($_POST['route_steps']) && isset($_POST['route_content'])) {
                    newRoute();
                }
                else {
                    creationArticlePage();
                }
                case 'update-route':
                    updateRoute();
                    break;
                case 'delete-route':
                deleteRoute($routeId);
                break;
                case 'delete-account':
                    if (isset($_POST['user_id'])) {
                        deleteAccount();
                    }
                    else {
                        require('Views/deleteAccountView.php');
                    }
                    break;
            default:
                throw new Exception("Cette page n'existe pas ou a été suprimée.");
                break;
    }
    } catch (Exception $e) {
        error($e->getMessage());
    }
