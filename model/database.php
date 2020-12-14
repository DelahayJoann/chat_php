<?php
namespace model;

    class database{
        private $servername = "localhost";
        private $username = "Joann";
        private $password = "becode";
        private $dbname = "chat_php";

        protected function connect(){
            try {
                $db = new PDO("mysql:host=$servername;dbname=$dbname;port=3306", $username, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $db;
            }
            catch(PDOException $e){
                throw "Connection failed: " . $e->getMessage();
            }
        }
        protected function addMessage(User $from, Message $msg){}
        protected function removeMessage(User $from, Message $msg){}
    }
?>