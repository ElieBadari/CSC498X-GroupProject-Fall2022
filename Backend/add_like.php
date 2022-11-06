<?php 
include("connection.php");

$post_id = 0;
$user_id = 0;
$results = [];
$response = [];
$flag = true;
//retrieving and validating info
//------------------------------

//validate data
//-------------
if (isset($_POST["postId"]) && $_POST["postId"] != 0){
    $post_id = $_POST["postId"];
    $results["Post ID Success"] = true;
}else {
    $results["Post ID Success"] = false;
    return;
}
if (isset($_POST["userId"]) && $_POST["userId"] != 0){
    $user_id = $_POST["userId"];
    $results["User ID Success"] = true;
}else {
    $results["User ID Success"] = false;
    return;
}

foreach($results as $key => $value){
    if(!$value){
        $flag = false;
    }
    $response[$key] = $value;
}
unset($value);  
//adding the likes to the database
//------------------------------
if (!$flag){
    $response["Add Like Success Values"] = false;
    return;
}else {
    $response["Add Like Success Values"] = true;
    $query = $mysqli->prepare("UPDATE `posts` SET `likeCount` = likeCount+1 WHERE `postId` = ? AND `userId`= ?");
    $query->bind_param("ii",$post_id,$user_id);
    if($query->execute()){
        $response["Add Like Success Query"] = true;
    }else {
        $response["Add Like Success Query"] = false;
    }
}
echo json_encode($response);

?>