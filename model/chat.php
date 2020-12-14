<?php
namespace model;

    class Chat{
        private $id;
        private $name;
        private static $instances_ = [];

        public function __construct(int $id, string $name){
            $this->id = $id;
            $this->name = $name;
            $this->instances_[] = $this;
        }

        protected static function getChats():array{
            try{
                $db = Database::connect();
            }
            catch(Exception $e){
                throw $e->getMessage();
            }
            $request = $db->prepare("SELECT * FROM `chats`;");
            $request->execute();
            while($donnees = $request->fetch()){
                new Chat($donnees['id'], $donnees['name']); 
            }
            return Chat::instances_;
        }

        protected static function addMessage(User $user, Message $msg):Message{
            try{
                $db = Database::connect();
            }
            catch(Exception $e){
                throw $e->getMessage();
            }
            $request = $db->prepare("INSERT IGNORE INTO `messages` (`id`, `content`, `creationdate`, `author`) VALUES (NULL, :content, :creationDate, :userId, :idChat);");
            $request->execute(array(':content' => $msg->getContent(), ':creationDate' => date('Y-m-d'), ':userId' => $user->getId(), ':idChat' => $msg->getIdChat()));
            return $msg;
        }

        protected function get10LastMessages():array{
            try{
                $db = Database::connect();
            }
            catch(Exception $e){
                throw $e->getMessage();
            }
            $request = $db->prepare("SELECT * FROM `messages` WHERE `chat_fk` = :idChat ORDER BY id DESC LIMIT 10;");
            $request->execute(array(':idChat' => $this->id));
            while($donnees = $request->fetch()){
                $messages[] = new Message($donnees['id'], $donnees['content'], $donnees['creationdate'], $donnees['author'], $donnees['chat_fk']);
            }
            return  $messages; // return array of Message
        }
    }
?>