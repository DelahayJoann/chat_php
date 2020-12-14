<?php
namespace model;

    class Message{
        private $id;
        private $authorId;
        private $content;
        private $creationDate;
        private $idChat;

        protected function getId(){
            return $this->id;
        }
        protected function getIdChat(){
            return $this->idChat;
        }
        protected function setIdChat(int $idChat){
            $this->idChat = $idChat;
        }

        protected function getContent(){
            return $this->content;
        }
        protected function setContent(string $content){
            $this->content = $content;
        }

        protected function getAuthorId(){
            return $this->authorId;
        }
        protected function setAuthorId(User $user){
            $this->authorId = $user->getId();
        }

        protected function getCreationDate(){
            return $this->creationDate;
        }
        protected function setCreationDate(date $creationDate){
            $this->creationDate = $creationDate;
        }

        protected function removeMessage(User $user){
            if($user->getId() == $this->getAuthorId()){
                try{
                    $db = Database::connect();
                }
                catch(Exception $e){
                    throw $e->getMessage();
                }
                $request = $db->prepare("DELETE FROM `messages` WHERE `id` = :id;");
                $request->execute(array(':id' => $this->getId()));
            }
        }

        // STATIC
        protected static function addMessage(User $user, Message $msg){
            try{
                $db = Database::connect();
            }
            catch(Exception $e){
                throw $e->getMessage();
            }
            $request = $db->prepare("INSERT IGNORE INTO `messages` (`id`, `content`, `creationdate`, `author`) VALUES (NULL, :content, :creationDate, :userId, :idChat);");
            $request->execute(array(':content' => $msg->getContent(), ':creationDate' => date('Y-m-d'), ':userId' => $user->getId(), ':idChat' => $msg->getIdChat()));
        }
        protected static function getAllMessages(int $idChat){
            try{
                $db = Database::connect();
            }
            catch(Exception $e){
                throw $e->getMessage();
            }
            $request = $db->prepare("SELECT * FROM `messages` WHERE `chat_fk` = :idChat;");
            $request->execute(array(':idChat' => $idChat));
        }
        protected static function getSpecificMessage(int $id){
            try{
                $db = Database::connect();
            }
            catch(Exception $e){
                throw $e->getMessage();
            }
            $request = $db->prepare("SELECT * FROM `messages` WHERE `id` = :id;");
            $request->execute(array(':id' => $id));
        }
    }
?>