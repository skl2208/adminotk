<?php

header("Access-Control-Allow-Origin: *");

include "../../include/config.php";

if (isset($_GET["id"]) && $_GET["id"] != "") {
    $id = $_GET["id"];
}

$list_picture = [];

$sql = "SELECT id,imagename,imageurl,createdate FROM image WHERE id=" . $id;

try {
    $result = $conn->query($sql);

    $info = array(
        "id" => "",
        "imagename" => "",
        "imageurl" => "",
        "createdate" => "",
    );
    $list_picture["status"] = "OK";
    $list_picture["total_rec"] = $result->num_rows;
    $list_picture["message"] = "Query Successfully";
    $list_picture["data"] = [];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $info["id"] = $row["id"];
            $info["imagename"] = $row["imagename"];
            $info["imageurl"] = $row["imageurl"];
            $info["createdate"] = $row["createdate"];

            array_push($list_picture["data"], $info);
        }
    }
} catch (Exception $e) {

    $list_picture["status"] = "ERROR";
    $list_picture["message"] = $e->getMessage();
}

echo json_encode($list_picture);

$result->close();
$conn->close();
