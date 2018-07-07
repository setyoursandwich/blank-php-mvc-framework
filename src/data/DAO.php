<?php

class DAO {
    private static $servername ="localhost";
    private static $username = "root";
    private static $password ="";
    
    public function createConnection(){
        $conn = false;
		
        try {
            $conn = new PDO("mysql:host=".self::$servername.";dbname=steamskins;charset=utf8", self::$username, self::$password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

        return $conn;
    }
}