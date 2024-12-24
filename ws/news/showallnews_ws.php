<?php

header("Access-Control-Allow-Origin: *");

include "../../include/config.php";


if (isset($_GET["status"]) && $_GET["status"] != "") {
    $condition .= "status = '$_GET[status]'";
} else {
    $condition = "1=1";
}

if(isset($_GET["limit"]) && $_GET["limit"] != ""){
    $limit = " LIMIT 3";
} else {
    $limit = "";
}

$list_greeting = [];

$sql = "SELECT id,headnews,headimageurl,headimage,createdate,updatedate,status from news where $condition order by updatedate DESC ".$limit;


try {
    $result = $conn->query($sql);

    $info = array(
        "id" => "",
        "headnews" => "",
        "headimageurl" => "",
        "headimage" => "",
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
