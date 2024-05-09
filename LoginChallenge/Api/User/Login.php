<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Successful</title>
    <style>
        body {
             margin:0;
             color:#adb0c4;
             background: url(https://images.rawpixel.com/image_png_800/czNmcy1wcml2YXRlL3Jhd3BpeGVsX2ltYWdlcy93ZWJzaXRlX2NvbnRlbnQvbHIvcm00NTUtMTA1MF8yLnBuZw.png) repeat;
             font:600 16px/18px 'Open Sans',sans-serif;
             align-items: center;
        }
        .return-wrap{
            width:100%;
            margin:auto;
             margin-top: 30px;
            max-width:525px;
            min-height:570px;
            position:relative;
            background:rgba(40,57,101,.9);
            box-shadow:0 12px 15px 0 rgba(0,0,0,.24),0 17px 50px 0 rgba(0,0,0,.19);
            align-content:center;
        }
        .return-html{
            padding: 90px 70px 50px 70px;
            background: rgba(40, 57, 101, .9);
            text-align: center;
        }
        .message {
            font-size: 24px;
            margin-bottom: 20px;            
        }
        .hr{
            height:2px;
            margin:60px 0 50px 0;
            align-content: center;
            position: relative;
        }
        .logoutbutton {
            display: inline-block;
            padding: 10px 20px;
            background:#1161ee;
            color: #fff;
            text-decoration: none;
            border-radius: 25px;
            border:none;
            transition: background-color 0.3s ease;
        }
        .logoutbutton:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="return-wrap">
<div class="return-html">
<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

//Including the files for database connection and User object.
include_once '../config/Database.php';
include_once '../objects/User.php';

//Getting the connection.
$database = new Database();
$db = $database->getConnection();

//Setting User object to store the information.
$user = new User($db);

//GET Endpoints!
$user->username = isset($_GET['username']) ? $_GET['username'] : die();
$user->password = isset($_GET['password']) ? $_GET['password'] : die();

//Executing Login method() from User class
$stmt = $user->Login();


if ($stmt !== false) { // Check if $stmt is not false
    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        //Generating a token for the user's session.
        $token = bin2hex(random_bytes(32));
        
        //More secure way possible by attaching to user ID maybe? 
        session_start();
        $_SESSION['user_token'] = $token;
        
        //A lot of testing statements
        $userArray = array(
            "status" => true,
            "message" => "Successful Login!",
            "id" => $row['id'],
            "username" => $row['username'],
            "token" => $token
        );
        echo '<div class="message">' . $userArray["message"] . '</div>';
    } else {
        $userArray = array(
            "status" => false,
            "message" => "Invalid Username or Password!"
        );
        echo '<div class="message">' . $userArray["message"] . '</div>';
    }
} else {
    $userArray = array(
        "status" => false,
        "message" => "Database error occurred!"
    );
    echo '<div class="message">' . $userArray["message"] . '</div>';
}


?>

        <form action="Logout.php" method="post">
            <button type="submit" class="logoutbutton">Logout</button>
        </form>
    
     <!-- Below is another testing code for verifying my API connections as  I was coding.
     Although not necessary give the Postman collection for this particular GET, I still wanted to include how I was actively 
     debugging during my process.-->
     
     <!-- <!--  echo json_encode($userArray, JSON_PRETTY_PRINT);  -->
     
    </div>
</div>
</body>
</html>

