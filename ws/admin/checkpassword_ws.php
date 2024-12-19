<?php

header("Access-Control-Allow-Origin: *");

include "../../include/config.php";

ini_set('display_errors', 1);
error_reporting(E_ALL);

$user = "";
$password = "";
$list_result = [];

if (isset($_POST["user"]) && $_POST["user"] != "") {
    $user = trim($_POST["user"]);
}

if (isset($_POST["password"]) && $_POST["password"] != "") {
    $password = $_POST["password"];
}

$list_result["user"] = $user;
$list_result["password"] = $password;



$sql = "SELECT user,password,role FROM account WHERE status = 'T' AND user = '" . $user . "' ";

try {

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $list_result["status"] = "OK";
        $list_result["message"] = "Found 1 user";

        $info["user"] = $row["user"];
        $info["role"] = $row["role"];
        $info["password"] = $row["password"];

        if ($info["password"] != $password) {
            $list_result["status"] = "FAIL";
            $list_result["message"] = "password mismatch!";
        } else {
            session_start();
            $_SESSION["username"] = $info["user"];
            $_SESSION["role"] = $info["role"];            
        }
    } else {
        $list_result["status"] = "FAIL";
        $list_result["message"] = "Not found any row";
    }
} catch (Exception $e) {

    $list_result["status"] = "FAIL";
    $list_result["message"] = $e->getMessage();
}

echo json_encode($list_result);

$conn->close();
