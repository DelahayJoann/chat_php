<?php
namespace App\model;

require_once 'database.php';

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

        static function addMessage(User $user, Message $msg):Message{
            try{
                $db = Database::connect();
            }
            catch(\Exception $e){
                throw $e->getMessage();
            }
            $request = $db->prepare("INSERT IGNORE INTO `messages` (`id`, `content`, `creationdate`, `author`, `chat_fk`) VALUES (NULL, :content, :creationDate, :userId, :idChat);");
            $request->execute(array(':content' => $msg->getContent(), ':creationDate' => date('Y-m-d h:i:s'), ':userId' => $user->getId(), ':idChat' => $msg->getIdChat()));
            return $msg;
        }

        function get10LastMessages():array{
            try{
                $db = Database::connect();
            }
            catch(\Exception $e){
                throw $e->getMessage();
            }
            $request = $db->prepare("(SELECT * FROM `messages` WHERE `chat_fk` = :idChat ORDER BY id DESC LIMIT 10) ORDER BY id ASC;");
            $request->execute(array(':idChat' => $this->id));
            while($donnees = $request->fetch()){
                $messages[] = new Message(intval($donnees['id']), $donnees['content'], $donnees['creationdate'], $donnees['author'], $donnees['chat_fk']);
            }
            return  $messages; // return array of Message
        }
    }
?>