<?php
namespace model;

    class Message{
        private $id;
        private $authorId;
        private $content;
        private $creationDate;
        private $idChat;

        public function __construct(int $id, string $content, date $creationDate, int $authorId, int $idChat){
            $this->id = $this->setId($id);
            $this->content = $this->setContent($content);
            $this->creationDate = $this->setCreationDate($creationDate);
            $this->authorId = $this->setAuthorId($authorId);
            $this->idChat = $this->setIdChat($idChat);
        }

        protected function getId():int{
            return $this->id;
        }
        protected function setId(int $id){
            $this->id = $id;
        }

        protected function getIdChat():int{
            return $this->idChat;
        }
        protected function setIdChat(int $idChat){
            $this->idChat = $idChat;
        }

        protected function getContent():string{
            return $this->content;
        }
        protected function setContent(string $content){
            $this->content = $content;
        }

        protected function getAuthorId():int{
            return $this->authorId;
        }
        protected function setAuthorId(User $user){
            $this->authorId = $user->getId();
        }

        protected function getCreationDate():date{
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
                
        protected static function getSpecificMessage(int $id):array{
            try{
                $db = Database::connect();
            }
            catch(Exception $e){
                throw $e->getMessage();
            }
            $request = $db->prepare("SELECT * FROM `messages` WHERE `id` = :id;");
            $request->execute(array(':id' => $id));
            return $request->fetch();
        }
    }
?>