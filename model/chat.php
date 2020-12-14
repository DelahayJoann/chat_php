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

        protected static function getChats(){
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
        protected function getAllMessages(){
            try{
                $db = Database::connect();
            }
            catch(Exception $e){
                throw $e->getMessage();
            }
            $request = $db->prepare("SELECT * FROM `messages` WHERE `chat_fk` = :idChat;");
            $request->execute(array(':idChat' => $this->id));
            while($donnees = $request->fetch()){
                $messages[] = new Message($donnees['id'], $donnees['content'], $donnees['creationdate'], $donnees['author'], $donnees['chat_fk']);
            }
            return  $messages; // return array of Message
        }
    }
?>