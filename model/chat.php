<?php
namespace model;

    class Chat{
        private $id;
        private $name;

        public static function getChats(){
            try{
                $db = Database::connect();
            }
            catch(Exception $e){
                throw $e->getMessage();
            }
            $request = $db->prepare("SELECT * FROM `chats`;");
            $request->execute();
            return $request->fetchAll(); // return array of result
        }
    }
?>