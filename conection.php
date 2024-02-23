<?php 

class Database{

    public static $connection;

    public static function setUpConnections(){
        if(!isset(Database::$connection)){
            Database::$connection=new mysqli("localhost","root","@ISURU9829ip","haritha","3306");
        }
    }

    public static function iud($q){
        Database::setUpConnections();
        Database::$connection->query($q);
    }

    public static function search($q){
        Database::setUpConnections();
        $resultset=Database::$connection->query($q);
        return $resultset;
    }
}

?>