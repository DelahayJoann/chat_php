<?php
namespace App\Model;
use PDO; 
date_default_timezone_set('Europe/Brussels');
    class Database{
        public static function connect(){
            try {
                $db = new \PDO("mysql:host=sql2.freemysqlhosting.net;dbname=sql2382667;port=3306", "sql2382667", "xU8!wQ5!");
                $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                return $db;
            }
            catch(\PDOException $e){

            }
        }
    }
?>