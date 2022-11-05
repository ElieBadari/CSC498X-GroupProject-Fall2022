<?php
include("connection.php");

$owner_id = 0;
$post_id = 0;
$results = [];
$response =[];

if (isset($_POST["ownerId"]) && $_POST["ownerId"] != 0){
    $owner_id = $_POST["ownerId"];
    $results["Owner ID Success"] = true;
}else {
    $results["Owner ID Success"] = false;
    return;
}
if (isset($_POST["postId"]) && $_POST["postId"] != 0){
    $post_id = $_POST["postId"];
    $results["Post ID Success"] = true;
}else {
    $results["Post ID Succses"] = false;
    return;
    
}

foreach($results as $key => $value){
    if(!$value){
        $flag = false;
    }
    $response[$key] = $value;
}
unset($value);

if (!$flag){
    $response["Delete Success Values"] = false;
    return;
}else {
    $response["Delete Sucess Values"] = true;
    $query = $mysqli->prepare("DELETE FROM posts WHERE postId = ? AND ownerId = ?");
    $query->bind_param("ii",$post_id,$owner_id);
    if($query->execute()){
        $response["Delete Succes Query"] = true; 
    }else {
        $response["Delete Success Query"] = false;
        return;
    }
}

echo json_encode($response);


?>