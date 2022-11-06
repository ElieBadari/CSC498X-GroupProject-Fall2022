<?php
include("connection.php");
include("functions.php");

$username = "";
$param_user_id = 0;
$results = [];
$response = [];
$flag = true;

if (isset($_POST["username"]) && $_POST["username"] != ""){
    $check_user_query = $mysqli->prepare("SELECT `userId` FROM `users` WHERE `username` = ?");
    $param_username = filter_data($_POST["username"]);
    $check_user_query->bind_param("s",$param_username);
    if($check_user_query->execute()){
        $check_user_query->store_result();
        if($check_user_query->num_rows == 1){
            $results["Username Success"] = false;
            return;
        }else {
            $username = filter_data($_POST["username"]);
            $results["Username Success"] = true;
            
        }
    }
    $check_user_query->close();
}else {
    $results["Username Success"] = false;
    return;
}

foreach ($results as $key => $value){
    if (!$value){
        $flag = false;
    }
    $response[$key] = $value;
}
unset($value);

if (!$flag){
    $response["Edit Username"] = false;
    return;
}else {
    $response["Edit Username"] = true;
    $param_user_id = filter_data($_POST["userId"]);
    $query = $mysqli->prepare("UPDATE users SET username = ? WHERE userId = ?");
    $query->bind_param("si",$username,$param_user_id);
    if ($query->execute()){
        $response["Query Success"] = false;
    }else {
        $response["Query Success"] = false;
        return;
    }
}
echo json_encode($response);


?>