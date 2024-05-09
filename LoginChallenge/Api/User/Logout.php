<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

session_start();

// Unset or destroy the session variable containing the token
unset($_SESSION['user_token']);

// Destroy the session
session_destroy();

// Redirect the user to the login page or any other page
header("Location: /LoginChallenge/index.php");


//JSON Readout for testing purposes with the API. Screenshot of results provided in documentation folder! 
// ----> echo json_encode(array("message" => "Token revoked: $token"));

exit;