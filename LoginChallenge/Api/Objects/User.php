<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of User
 *
 * @author Kerrigan
 */
class User {
    private $conn;
    private $dbTable = "users";
    
    public $id;
    public $username;
    public $password;
    public $email;
    
    public function __construct($db){
        $this->conn = $db;
    }
    
    function Signup(){
        if($this->isAlreadyExist()){
            return false;
        }
        
         $query = "INSERT INTO " . $this->dbTable . " (username, password, email) VALUES (:1, :2, :3)";
        
        $stmt =  $this->conn->prepare($query);
        
          $this->username= htmlspecialchars(strip_tags($this->username));
          $this->password= htmlspecialchars(strip_tags($this->password));
          $this->email= htmlspecialchars(strip_tags($this->email));
        
        $stmt->bindParam(":1", $this->username);
        $stmt->bindParam(":2", $this->password);
        $stmt->bindParam(":3", $this->email);
        
        if($stmt->execute()){
            return true;
        }
        return false; 
    }
    
    function Login(){
        $query = "SELECT id, username, password, email FROM " . $this->dbTable . " WHERE username=:1 AND password=:2";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":1", $this->username);
        $stmt->bindParam(":2", $this->password);
        
        $stmt->execute();
    // Debugging statement -- This statement was to ensure the parameters were being passed correctly. 
    //echo "Query executed: " . $query . "<br>"; -- They're being used correctly!
    
    return $stmt;     
    }
       
    function isAlreadyExist(){
        
        $query = "SELECT * FROM " . $this->dbTable . " WHERE username=:1";
       
       $stmt = $this->conn->prepare($query);
       
       $stmt->bindParam(":1", $this->username);
       
       $stmt->execute();
       
       if($stmt->rowCount() > 0){
           return true;
       } else {
           return false;
       }        
    }
}
