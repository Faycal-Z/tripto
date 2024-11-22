<?php
    require_once('models/Manager.php');

    class UserManager extends Manager {

        // Attributs

        private $_userId;
        private $_firstName;
        private $_lastName;
        private $_pseudo;
        private $_email;
        private $_password;
        private $_admin;

        // Constructeur

        public function __construct($userId, $firstName, $lastName, $pseudo, $email, $password, $admin){

            $this->setUserId($userId);
            $this->setFirstName($firstName);
            $this->setLastName($lastName);
            $this->setPseudo($pseudo);
            $this->setEmail($email);
            $this->setPassword($password);
            $this->setAdmin($admin);

        }

        // Getter

        public function getUserId(){
            return $this->_userId;
        }

        public function getFirstName(){
            return $this->_firstName;
        }

        public function getLastName(){
            return $this->_lastName;
        }

        public function getPseudo(){
            return $this->_pseudo;
        }

        public function getEmail(){
            return $this->_email;
        }

        public function getPassword(){
            return $this->_password;
        }

        public function getAdmin(){
            return $this->_admin;
        }

        // Setters

        public function setUserId($userId) {
            $this->_userId = $userId;
        }

        public function setFirstName($firstName) {
            $this->_firstName = $firstName;
        }

        public function setLastName($lastName) {
            $this->_lastName = $lastName;
        }

        public function setPseudo($pseudo) {
            $this->_pseudo = $pseudo;
        }

        public function setEmail($email) {
            $this->_email = $email;
        }

        public function setPassword($password) {
            $this->_password = $password;
        }

        public function setAdmin($admin) {
            $this->_admin = $admin;
        }

        // Methodes

        // Ajout d'un utilisateur
        public function addUser($userId, $firstName, $lastName, $pseudo, $email, $password, $admin){

            $bdd = $this->connection();

            $requete = $bdd->prepare('INSERT INTO users(user_id, first_name, last_name, pseudo, email, password, admin) VALUES(?, ?, ?, ?, ?, ?, ?)');
            $requete->execute([
                $this->getUserId(),
                $this->getFirstName(),
                $this->getLastName(),
                $this->getPseudo(),
                $this->getEmail(),
                $this->getPassword(),
                $this->getAdmin()
            ]);

            $this->setUserId($bdd->lastInsertId());

        }

        // Créer les sessions
        public function createNewSession() {

            $bdd = $this->connection();
            $_SESSION['connect'] = 1;
            $_SESSION['user_id'] = $this->getuserId();
            $_SESSION['first_name'] = $this->getFirstName();
            $_SESSION['last_name'] = $this->getLastName();
            $_SESSION['pseudo'] = $this->getPseudo();
            $_SESSION['email'] = $this->getEmail();
            $_SESSION['admin'] = $this->getAdmin();
        }

        // Fonction de deconnexion de l'utilisateur
        public static function logOut(){
            
            session_unset();
            session_destroy();

        }



    }

    class UpdateUser extends Manager {

        public function deleteAccount($userId){

            $bdd = $this->connection();

            $requete = $bdd->prepare('DELETE FROM users WHERE user_id = ?');
            $requete->execute([$userId]);

            return $requete;
        }
    }