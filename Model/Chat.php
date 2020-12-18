<?php
namespace App\Model;

    class Chat{  
        private $id;
        private $name;
        private static $instances_ = [];

        private function __construct(int $id, string $name){
            $this->id = $id;
            $this->name = $name;
            self::$instances_[] = $this;
        }

        static function getChats():array{
            try{
                $db = Database::connect();
            }
            catch(\Exception $e){
                throw $e->getMessage();
            }
            $request = $db->prepare("SELECT * FROM `chats`;");
            $request->execute();
            while($donnees = $request->fetch()){
                new Chat($donnees['id'], $donnees['name']); 
            }
            return self::$instances_;
        }

        function getId(){
            return $this->id;
        }

        function getName(){
            return $this->name;
        }

        static function getLastIdMessage(){
            try{
                $db = Database::connect();
                $request = $db->prepare("SELECT MAX(id) FROM messages");
                $request->execute();
                return $request->fetch()[0];
            }
            catch(\Exception $e){
                throw $e->getMessage();
            }
        }

        static function getNewMessages(int $lastDisplayId){
            try{
                $db = Database::connect();
                $request = $db->prepare("SELECT * FROM messages WHERE id > :lastDisplayId");
                $request->execute(array(":lastDisplayId" => $lastDisplayId));
                while($donnees = $request->fetch()){
                    $messages[] = new Message(intval($donnees['id']), $donnees['content'], $donnees['creationdate'], $donnees['author'], $donnees['chat_fk']);
                }
                return  array_reverse($messages);
            }
            catch(\Exception $e){
                throw $e->getMessage();
            }
        }

        static function addMessage(Message $msg):Message{
            try{
                $db = Database::connect();
                $request = $db->prepare("INSERT INTO `messages` (`id`, `content`, `creationdate`, `author`, `chat_fk`) VALUES (NULL, :content, :creationDate, :userId, :idChat);");
                $request->execute(array(':content' => $msg->getContent(), ':creationDate' => date('Y-m-d H:i:s'), ':userId' => $msg->getAuthorId(), ':idChat' => $msg->getIdChat()));
                return $msg;
            }
            catch(\Exception $e){
                throw $e->getMessage();
            }
        }

        function getLastMessages():array{
            try{
                $db = Database::connect();
            }
            catch(\Exception $e){
                throw $e->getMessage();
            }
            $request = $db->prepare("SELECT * FROM `messages` WHERE `chat_fk` = :idChat ORDER BY id DESC LIMIT 20;");
            // 
            $request->execute(array(':idChat' => $this->id));
            while($donnees = $request->fetch()){
                $messages[] = new Message(intval($donnees['id']), $donnees['content'], $donnees['creationdate'], $donnees['author'], $donnees['chat_fk']);
            }
            return  array_reverse($messages); // return array of Message
        }
    }
?>