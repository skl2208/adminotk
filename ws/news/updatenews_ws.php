<?php

header("Access-Control-Allow-Origin: *");

include "../../include/config.php";

ini_set('display_errors', 1);
error_reporting(E_ALL);

if (isset($_POST["id"]) && ($_POST["id"] != "")) {
    $id = $_POST["id"];
}
if (isset($_POST["headnews"]) && ($_POST["headnews"] != "")) {
    $headnews = trim($_POST["headnews"]);
}
if (isset($_POST["title"]) && ($_POST["title"] != "")) {
    $title = trim($_POST["title"]);
}
if (isset($_POST["headimageurl"]) && ($_POST["headimageurl"] != "")) {
    $headimageurl = trim($_POST["headimageurl"]);
}
if (isset($_POST["content"]) && ($_POST["content"] != "")) {
    $content = trim($_POST["content"]);
}
if (isset($_POST["status"]) && ($_POST["status"] != "")) {
    $status = trim($_POST["status"]);
}



if (isset($_POST["id"]) && $_POST["id"] != "") {
    //=== Update ===//
    $update = 
    $sql = "UPDATE news SET headnews = ?, headimageurl = ?, content = ?, status = ?,updatedate = CURRENT_TIMESTAMP() WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssi', $headnews, $headimageurl, $content, $status, $id);
} else {
    //=== Add ===//
    $sql = "INSERT INTO news (headnews, headimageurl, content,  status) VALUES (?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssss', $headnews,  $headimageurl, $content, $status);
}
$list_result["progress"] = "DONE";
try {
    if ($stmt->execute()) {
        $list_result["status"] = "OK";
        $list_result["message"] = "Insert or Update Successfully";
    } else {
        $list_result["status"] = "ERROR";
    }
} catch (Exception $e) {
    echo $e->getMessage();
    $list_result["status"] = "ERROR";
    $list_result["message"] = $e->getMessage();
}

echo json_encode($list_result);

$conn->close();
