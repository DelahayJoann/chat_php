<?php
namespace model;

    class User{
        private $id = null;
        private $username = null;
        private $password = null;
        private $joinDate = "0000/00/00";

        function __construct(string $username, string $password){
            $this->setUsername($username);
            $this->setPassword($password);
        }

        protected function authentification(){
            try{
                $db = Database::connect();
            }
            catch(Exception $e){
                throw $e->getMessage();
            }
            
            $request = $db->prepare("SELECT * FROM `users` (`id`, `username`, `password`, `joindate`) WHERE `username` = :username AND `password` = :password LIMIT 1;");
            $request->execute(array(':username' => $this->getUsername(), ':password' => $this->getPassword()));
            $user = $request->fetch();
            try{
                $this->setJoinDate($user['joindate']);
                $this->setId($user['id']);
                session_start();
                $_SESSION['username'] = $this->username;
                $_SESSION['password'] = $this->password;
            }
            catch(Exception $e){
                throw "Utilisateur inconnu";
            }
        }
        protected function disconnect(){
            unset($_SESSION);
            session_destroy();
        }

        protected function getId():int{
            return $this->id;
        }
        private function setId(int $id){
            $this->id = $id;
        }

        protected function getUsername():string{
            return $this->username;
        }
        protected function setUsername(string $username){
            //validate ->
            $this->username = $username;
        }

        private function getPassword():string{
            return $this->password;
        }
        protected function setPassword(string $password){
            $this->password = sha1($password);
        }

        protected function getJoinDate():date{
            return $this->joinDate;
        }
        protected function setJoinDate(date $joinDate){
            $this->joinDate = $joinDate;
        }

        protected static function addUser(string $username, string $password){
            //validate ->
            try{
                $db = Database::connect();
            }
            catch(Exception $e){
                throw $e->getMessage();
            }
            $request = $db->prepare("INSERT IGNORE INTO `users` (`id`, `username`, `password`, `joindate`) VALUES (NULL, :username, :password, :joindate);");
            $request->execute(array(':username' => $username, ':password' => sha1($password), ':joindate' => date('Y-m-d')));
        }
    }
?>