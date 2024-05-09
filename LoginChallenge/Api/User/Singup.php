<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Success</title>
    <style>
         body {
             margin:0;
             color:#6a6f8c;
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
            background:rgba(255,255,255,.2);
        }
        .returnbutton {
            display: inline-block;
            padding: 10px 20px;
            background:#1161ee;
            color: #fff;
            text-decoration: none;
            border-radius: 25px;
            border:none;
            transition: background-color 0.3s ease;
        }
        .returnbutton:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="return-wrap">
<div class="return-html">

        <p id="responseTitle">Processing. . .</p>
        
        
        <form action="index.php">
        <a href="http://localhost/LoginChallenge/index.php" class="returnbutton">Login</a>
        </form>
    </div>

<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
//Including the files for connection and User object.
include_once '../config/Database.php';
include_once '../objects/User.php';

//Connection logic.
$database = new Database();
$db = $database->getConnection();

//User stores the information we need.
$user = new User($db);
//Although this is handled on the front-end, I was using this for POST JSON testing. 
//Screenshot included in API testing folder.
if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
    $userArray = array(
        "status" => false,
        "message" => "Please fill in all the required fields."
    );
} else {
    //This is my POST API logic for signing in! 
    $user->username=$_POST['username'];
    $user->password=$_POST['password'];
    $user->email=$_POST['email'];

    //Executing Signup() method in our User class
    if($user->Signup()){
        $userArray=array(
            "status" => true,
            "message" => "Successfully Signed Up!",
            "id" => $user->id,
            "username" => $user->username
        );
    } else{
        $userArray=array(
            "status" => false,
            "message" => "Username already exists!"
        );
    }
}


 //This was used for testing purposes to ensure the API endpoints were being used effectively. 
 //The screenshot capturing it is in the same folder as my Postman files. 
// -- echo '<pre>' . json_encode($userArray, JSON_PRETTY_PRINT) . '</pre>';
?>
    <!<!-- I wanted to add in some sort of method to show the user exactly what was going wrong, this also helped me with testing. -->
     <script>
        // Parse the JSON response from PHP
        var response = <?php echo json_encode($userArray); ?>; //Originally I had this printing out as is just to see the JSON response

        // Get the h1 element
        var responseTitle = document.getElementById("responseTitle");

        // Change the text based on the response status
        if (response.status) {
            responseTitle.textContent = response.message;
            responseTitle.style.color = "green"; // Change color to green for success
        } else {
            responseTitle.textContent = response.message;
            responseTitle.style.color = "red"; // Change color to red for error
        }
    </script>
</body>
</html>

