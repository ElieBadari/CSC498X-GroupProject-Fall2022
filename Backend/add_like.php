<?php 
include("connection.php");

$post_id = 0;
$owner_id = 0;
$results = [];
$response = [];
$flag = true;

if (isset($_POST["postId"]) && $_POST["postId"] != 0){
    $post_id = $_POST["postId"];
    $results["Post ID Success"] = true;
}else {
    $results["Post ID Success"] = false;
    return;
}
if (isset($_POST["ownerId"]) && $_POST["ownerId"] != 0){
    $post_id = $_POST["ownerId"];
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

if (!$flag){
    $response["Add Like Success Values"] = false;
    return;
}else {
    $response["Add Like Success Values"] = true;
    $query = $mysqli->prepare("UPDATE `posts` SET `likeCount` = likeCount+1 WHERE `postId` = ? AND `ownerId`= ?");
    $query->bind_param("ii",$post_id,$owner_id);
    if($query->execute()){
        $response["Add Like Success Query"] = true;
    }else {
        $response["Add Like Success Query"] = false;
    }
}
echo json_encode($response);

?>