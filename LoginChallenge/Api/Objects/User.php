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
    //Variables for database
    private $conn;
    private $dbTable = "users";
    //User variables
    public $id;
    public $username;
    public $password;
    public $email;
    
    //Required function for database connection! 
    public function __construct($db){
        $this->conn = $db;
    }
    
    //Handles the Query logic for inserting user data into the database.
    function Signup(){
        //Making sure this user doesn't already exist in our table!
        if($this->isAlreadyExist()){
            return false;
        }
        
        $query = "INSERT INTO " . $this->dbTable . " (username, password, email) VALUES (:1, :2, :3)";
        
        //Preparing statement through connection.
        $stmt =  $this->conn->prepare($query);
            
            //Code below is to strip any special characters put into the username,password, or email. 
          $this->username= htmlspecialchars(strip_tags($this->username));
          $this->password= htmlspecialchars(strip_tags($this->password));
          $this->email= htmlspecialchars(strip_tags($this->email));
        
        //Assigning the values from our front-end to our query!
        $stmt->bindParam(":1", $this->username);
        $stmt->bindParam(":2", $this->password);
        $stmt->bindParam(":3", $this->email);
        
        //Originally this had some handling to return a message if it wasn't successful, but was edited later on for the Signup file.
        if($stmt->execute()){
            return true;
        }
        return false; 
    }
    
    //Query and database logic for logging in.
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
    
    //Checks to see if the user credentials already exist in the database. 
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
