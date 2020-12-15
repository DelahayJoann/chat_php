<?php
namespace App\model;

require_once 'database.php';

    class Message{
        private $id;
        private $authorId;
        private $content;
        private $creationDate;
        private $idChat;

        public function __construct(string $content, int $authorId, int $idChat){
            $this->setContent($content);
            $this->setCreationDate();
            $this->setAuthorId($authorId);
            $this->setIdChat($idChat);
        }

        function getId():int{
            return $this->id;
        }
        function setId(int $id){
            $this->id = $id;
        }

        function getIdChat():int{
            return $this->idChat;
        }
        function setIdChat(int $idChat){
            $this->idChat = $idChat;
        }

        function getContent():string{
            return $this->content;
        }
        function setContent(string $content){
            $this->content = $content;
        }

        function getAuthorId():int{
            return $this->authorId;
        }
        function setAuthorId(int $userId){
            $this->authorId = $userId;
        }

        function getCreationDate():\DateTime{
            return $this->creationDate;
        }
        function setCreationDate(){
            $this->creationDate = date("Y-m-d h:i:s");
        }

        function removeMessage(User $user){
            if($user->getId() == $this->getAuthorId()){
                try{
                    $db = Database::connect();
                }
                catch(\Exception $e){
                    throw $e->getMessage();
                }
                $request = $db->prepare("DELETE FROM `messages` WHERE `id` = :id;");
                $request->execute(array(':id' => $this->getId()));
            }
        }

        // STATIC
                
        static function getSpecificMessage(int $id):array{
            try{
                $db = Database::connect();
            }
            catch(\Exception $e){
                throw $e->getMessage();
            }
            $request = $db->prepare("SELECT * FROM `messages` WHERE `id` = :id;");
            $request->execute(array(':id' => $id));
            return $request->fetch();
        }
    }
?>