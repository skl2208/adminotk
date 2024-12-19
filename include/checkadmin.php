<?php
session_start();
$username = isset($_SESSION["username"]) ? $_SESSION["username"] : "";
$role = isset($_SESSION["role"]) ? $_SESSION["role"] : "";

if ($username == "" || $role != "ADMIN") {
    // Admin Zone 
    header('Location: errorpage.php');
    //echo "username : ".$username." , group = ".$usergroup;
}
