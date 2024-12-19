<?php

header("Access-Control-Allow-Origin: *");

include "../../include/config.php";

ini_set('display_errors', 1);
error_reporting(E_ALL);

if (isset($_GET["id"]) && $_GET["id"] != "") {
    $condition = "id = ".$_GET["id"];
} else {
    $condition = "1=1";
}

if(isset($_GET["status"]) && $_GET["status"] != "") {
    $condition .= " AND status='".$_GET["status"]."'";
}

$list_greeting = [];

$sql = "SELECT * FROM account WHERE $condition ORDER BY updatedate  DESC";


try {
    $result = $conn->query($sql);
    $list_greeting["status"] = "OK";
    $list_greeting["message"] = "";
    $list_greeting["data"] = [];

    $info = array(
        "id" => "",
        "user" => "",
        "password" => "",
        "role" => "",
        "createdate" => "",
        "updatedate" => "",
        "status" => ""
    );

    if ($result && $result->num_rows > 0) {

        $list_greeting["total_rec"] = $result->num_rows;

        while ($row = $result->fetch_assoc()) {
            $info["id"] = $row["id"];
            $info["user"] = $row["user"];
            $info["password"] = $row["password"];
            $info["role"] = $row["role"];
            $info["createdate"] = $row["createdate"];
            $info["updatedate"] = $row["updatedate"];
            $info["status"] = $row["status"];

            array_push($list_greeting["data"], $info);
        }
    } else {
        $list_greeting["message"] = "Successfully Query";
        array_push($list_greeting["data"], $info);
    }
} catch (Exception $e) {

    $list_greeting["status"] = "ERROR";
    $list_greeting["message"] = $e->getMessage();
}

echo json_encode($list_greeting);

$result->close();
$conn->close();
