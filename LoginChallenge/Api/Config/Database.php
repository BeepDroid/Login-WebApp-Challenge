<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of Database
 *
 * @author Kerrigan
 */
class Database {
    //Databse variables. 
    private $host = "localhost";
    private $dbName = "LoginCreds";
    private $user = "postgres";
    private $password="Dragon28";
    public $conn;
    
    //Connection to the database method. 
    public function getConnection(){
        try{
            $this->conn = new PDO("pgsql:host=" . $this->host . ";dbname=" . $this->dbName, $this->user, $this->password);
            //The below section of code was removed due to an error I continously ran into that wouldn't register this line.
            //$this->conn->exec("set names utf8");
        }
        catch (PDOException $e) {
            // Handle database connection errors
            echo "Connection failed: " . $e->getMessage();
        }
         return $this->conn;
    }    
}
