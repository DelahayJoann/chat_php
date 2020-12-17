<?php
namespace App\Model;

    class User{ 
        private $id=null;
        private $username;
        private $password;
        private $joinDate;

        public function __construct(string $username, string $password){
            $this->setUsername($username);
            $this->setPassword($password);
        }

        function authentification(){
            try{
                $db = Database::connect();

                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                $request = $db->prepare("SELECT * FROM `users` WHERE (`username` = :username) AND (`password` = :password) LIMIT 1;");
                $request->execute(array(':username' => $this->getUsername(), ':password' => $this->getPassword() ));
                $user = $request->fetch();
    
                if($user){
                    $this->setJoinDate(new \DateTime($user['joindate']));
                    $this->setId($user['id']);
                    $_SESSION['idUser'] = $this->getId();
                }
                else{echo "Fail to connect";}
            }
            catch(\Exception $e){
                echo "Authentification failed";
            }

        }

        function update(string $username = null, string $password = null){
            if(isset($_SESSION['idUser'])){
                try{
                    $db = Database::connect();
                    $user = ($username == null)?$this->getUsername():$username;
                    $pswd = ($password == null)?$this->getPassword():sha1($password);
                    $request = $db->prepare("UPDATE `users` SET `username` = :username, `password` = :password WHERE `id` = :id;");
                    $request->execute(array(':username' => $user, ':password' => $pswd, ':id' => $this->getId() ));
                    $this->disconnect();
                }
                catch(\Exception $e){
                    echo "Username already in use";
                }
            }
        }

        static function disconnect(){
            if(isset($_SESSION['idUser'])){
                unset($_SESSION['idUser']);
                session_destroy();
                echo "Disconnected";
            }
        }

        function getId():int{
            return $this->id;
        }
        private function setId(int $id){
            $this->id = $id;
        }

        function getUsername():string{
            return $this->username;
        }
        function setUsername(string $username){
            //validate -> ?
            $this->username = $username;
        }

        private function getPassword():string{
            return $this->password;
        }
        function setPassword(string $password){
            $this->password = sha1($password);
        }

        function getJoinDate():\DateTime{
            if(isset($_SESSION['idUser'])) return $this->joinDate;
            else return false;
        }
        function setJoinDate(\DateTime $joinDate){
            $this->joinDate = $joinDate;
        }

        public static function addUser(string $username, string $password){
            //validate -> ?
            try{
                $db = Database::connect();
            }
            catch(Exception $e){
                throw $e->getMessage();
            }
            $request = $db->prepare("INSERT INTO `users` (`id`, `username`, `password`, `joindate`) VALUES (NULL, :username, :password, :joindate);");
            // "INSERT IGNORE INTO `users` (`id`, `username`, `password`, `joindate`) VALUES (NULL, :username, :password, :joindate);"
            $request->execute(array(':username' => $username, ':password' => sha1($password), ':joindate' => date('Y-m-d')));
        }

        public static function getUserById($id){
            try{
                $db = Database::connect();
                $request = $db->prepare("SELECT * FROM `users` WHERE `id` = :id;");
                $request->execute(array(':id' => $id ));
                $user = $request->fetch();
                if($user){
                    return $user;
                }
                else{echo "no user";}
            }
            catch(\Exception $e){
                echo "get user failed";
            }
        }
    }
?>