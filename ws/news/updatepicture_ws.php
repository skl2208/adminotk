<?php

header("Access-Control-Allow-Origin: *");

include "../../include/config.php";

$command = "EDIT";

if (isset($_GET["id"]) && $_GET["id"] != "") {
    $command = "UPDATE";
} else {
    $command = "ADD";
}
if (isset($_POST["imagename"]) && $_POST["imagename"] != "") {
    $imagename = $_POST["imagename"];
}
if (isset($_POST["imageurl"]) && $_POST["imageurl"] != "") {
    $imageurl = $_POST["imageurl"];
}

if ($command == "UPDATE") {
    $sql = "UPDATE image SET imageurl = '$imageurl', imagename = '$imagename' WHERE id = $_GET[id]";
} else {
    $sql = "INSERT INTO image (imageurl,imagename) VALUES ('$imageurl','$imagename')";
}

try {


    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $_GET["id"]);
    $stmt->execute();

    $list_greeting["status"] = "OK";
    $list_greeting["total_rec"] = $stmt->affected_rows;
    $list_greeting["message"] = "Already updated or inserted into the table";

    if ($stmt->affected_rows > 0) {
        //successful update
        header("location: manage_pic.php");
        exit(0);
    } else {
    }

} catch (Exception $e) {

    $list_greeting["status"] = "ERROR";
    $list_greeting["message"] = $e->getMessage();
}

echo json_encode($list_greeting);

$result->close();
$conn->close();
