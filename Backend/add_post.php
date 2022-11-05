<?php
include("connection.php");
include("functions.php");

$content = "";
$owner_id = 0;
$initial_like_count = 0;
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
if (isset($_POST["ownerId"]) && $_POST["ownerId"] != 0){
    $owner_id = filter_data($_POST["ownerId"]);
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
    $response["Post Success Values"] = false;
    return;
}else {
    $response["Post Success Values"] = true;
    $query = $mysqli->prepare("INSERT INTO `posts` (`ownerId`,`content`,`likeCount`) VALUES (?,?,?)");
    $query->bind_param("isi",$owner_id,$content,$initial_like_count);
    if ($query->execute()){
        $response["Post Success Query"] = true;
    }else {
        $response["Post Success Query"] = false;
        return;
    }
}
echo json_encode($response);



?>