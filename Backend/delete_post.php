<?php
include("connection.php");

$user_id = 0;
$post_id = 0;
$results = [];
$response =[];

if (isset($_POST["userId"]) && $_POST["userId"] != 0){
    $user_id = $_POST["userId"];
    $results["User ID Success"] = true;
}else {
    $results["User ID Success"] = false;
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
    $query = $mysqli->prepare("DELETE FROM `posts` WHERE `postId` = ? AND `userId` = ?");
    $query->bind_param("ii",$post_id,$user_id);
    if($query->execute()){
        $response["Delete Succes Query"] = true; 
    }else {
        $response["Delete Success Query"] = false;
        return;
    }
}

echo json_encode($response);


?>