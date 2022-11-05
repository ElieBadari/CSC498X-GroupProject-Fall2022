<?php
include("connection.php");
include("functions.php");

$content = "";
$owner_id = 0;
$results = [];
$response = [];
$flag = true;


if (isset($_POST["content"]) && $_POST["content"] != ""){
    $content = filter_data($_POST["content"]);
    $results["Content Success"] = true;
}else {
    $results["Content Success"] = false;
    return;
}
if (isset($_POST["owner_id"]) && $_POST["owner_id"] != 0){
    $owner_id = filter_data($_POST["owner_id"]);
    $results["Owner ID Success"] = true;
}else {
    $results["Owner ID Success"] = false;
    return;
}
foreach($results as $key => $value){
    if(!$value){
        $flag = false;
    }
    $response[$key] = $value;
}
unset($value);

if(!$flag){
    $response["Post Success"] = false;
}else {
    $query = $mysqli->prepare("INSERT INTO posts ('ownerId','content') VALUES (?,?)");
    $query->bind_param("is",$owner_id,$content);
    if ($query->execute() === true){
        $response["Post Success"] = true;
    }else {
        $response["Post Success"] = false;
    }
}
echo json_encode($response);



?>