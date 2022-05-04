<?php 

    abstract class Db{
        private static $conn;
        public static function getConnection(){
            $config = parse_ini_file(__DIR__. "/../config/config.ini");
            if(self::$conn !== null){
                return self::$conn;
            }
            else{
                self::$conn = new PDO("mysql:host=".$config['host'].";dbname=".$config['name']."", $config['user'], $config['password']);
                return self::$conn;
            }
        }
    }