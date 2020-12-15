<?php
namespace App\model;
date_default_timezone_set('Europe/Brussels');
    class Database{
        public static function connect(){
            try {
                $db = new \PDO("mysql:host=localhost;dbname=chat_php;port=3306", "Joann", "becode");
                $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                return $db;
            }
            catch(\PDOException $e){
                throw "Connection failed: " . $e->getMessage();
            }
        }
    }
?>