<?php
namespace App\Model;
use PDO;
date_default_timezone_set('Europe/Brussels');
    class Database{
        public static function connect(){
            try {
                /* $db = new \PDO("mysql:host=localhost;dbname=chat_php;port=3306", "Joann", "becode");
                $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                return $db; */
                $db = new PDO("sqlite:".dirname(__FILE__)."/db.db");
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $db;
            }
            catch(\PDOException $e){

            }
        }
    }
?>