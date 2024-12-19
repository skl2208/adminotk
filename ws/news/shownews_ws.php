<?php

header("Access-Control-Allow-Origin: *");

include "../../include/config.php";


if (isset($_GET["id"]) && $_GET["id"] != "") {
    $condition .= "id = $_GET[id]";
} else {
    $condition = "1=1";
}

$list_greeting = [];


$sql = "SELECT id,headnews,headimageurl,headimage,createdate,content,status from news where $condition";


try {
    $result = $conn->query($sql);

    $info = array(
        "id" => "",
        "headnews" => "",
        "headimageurl" => "",
        "headimage" => "",
        "content" => "",
        "createdate" => "",
        "updatedate" => "",
        "status" => ""
    );
    $list_greeting["status"] = "OK";
    $list_greeting["total_rec"] = $result->num_rows;
    $list_greeting["message"] = "Good";
    $list_greeting["data"] = [];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $info["id"] = $row["id"];
            $info["headnews"] = $row["headnews"];
            $info["headimageurl"] = $row["headimageurl"];
            $info["headimage"] = $row["headimage"];
            $info["content"] = $row["content"];
            $info["createdate"] = $row["createdate"];
            $info["updatedate"] = $row["updatedate"];
            $info["status"] = $row["status"];

            array_push($list_greeting["data"], $info);
        }
    }
} catch (Exception $e) {

    $list_greeting["status"] = "ERROR";
    $list_greeting["message"] = $e->getMessage();
}

echo json_encode($list_greeting);

$result->close();
$conn->close();
