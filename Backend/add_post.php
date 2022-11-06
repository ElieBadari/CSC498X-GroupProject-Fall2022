<?php
include("connection.php");
include("functions.php");

$content = "";
$user_id = 0;
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
if (isset($_POST["userId"]) && $_POST["userId"] != 0){
    $user_id = filter_data($_POST["userId"]);
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

if(!$flag){
    $response["Post Success Values"] = false;
    return;
}else {
    $response["Post Success Values"] = true;
    $query = $mysqli->prepare("INSERT INTO `posts` (`userId`,`content`,`likeCount`) VALUES (?,?,?)");
    $query->bind_param("isi",$user_id,$content,$in);
    if ($query->execute()){
        $response["Post Success Query"] = true;
    }else {
        $response["Post Success Query"] = false;
        return;
    }
}
echo json_encode($response);



?>