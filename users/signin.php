<?php
session_start(); // Starting Session

include "../models/UserRepository.php";
$error=''; // Variable To Store Error Message

if (isset($_POST['submit'])) {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $error = "Username or Password is invalid";
    }
    else
    {
        $config = include("../db/config.php");
        $db = new PDO($config["db"], $config["username"], $config["password"]);
        $userRepo = new UserRepository($db);
        
        $username=$_POST['username'];
        $password=$_POST['password'];
        
        // To protect MySQL injection for Security purpose
        $username = stripslashes($username);
        $password = stripslashes($password);

        // Establishing Connection with Server by passing server_name, user_id and password as a parameter
        if ($userRepo->verifyUser($username,$password) == 1) {
            $id = $userRepo->getID($username); // Initializing Session
            $_SESSION['logged_user']= $id;
            $_SESSION['logged_user_name']=$userRepo->getName($id); // Initializing Session
            header("location: /index.php"); // Redirecting To Other Page
        } else {
            $error = "Username or Password is invalid";
             header("location: /login.html"); // Redirecting To Other Page     
         }
    }
}
?>