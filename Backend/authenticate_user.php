<?php
include("connection.php");
include("functions.php");

$username = $user_pass = "";
$response = [];
$results = [];
$flag = true;

if (isset($_POST["username"]) && $_POST["username"] !=""){
    $param_username = filter_data($_POST["username"]);
    $check_user_query = $mysqli->prepare("SELECT * FROM users WHERE username = ?");
    $check_user_query->bind_param("s",$param_username);
    if($check_user_query->execute()){
        $check_user_query->store_result();
        if($check_user_query->num_rows == 1){
            $results["Username Success"] = true;
            $username = filter_data($_POST["username"]);
        }else {
            $results["Username Success"] = false;
            return;
        }
    }
    $check_user_query->close();
}else {
    $results["Username Success"] = false;
    return;
}

if (isset($_POST["password"]) && $_POST["password"] != ""){
    $param_pass = hash('sha256', filter_data($_POST["password"]));
    $check_password_query = $mysqli->prepare("SELECT * FROM users WHERE password = ? AND username = ?");
    $check_password_query->bind_param("ss",$param_pass,$param_username);
    if ($check_password_query->execute()){
        $check_password_query->store_result();
        if($check_password_query->num_rows == 1){
            $results["Password Success"] = true;
            $user_pass = $param_pass;
        }else {
            $results["Password Success"] = false;
            return;
        }
    }
    $check_password_query->close();   
}else {
    $results["Password Success"] = false;
}

foreach ($results as $key => $value){
    if(!$value){
        $flag = false;
    }
    $response[$key] = $value;
}
if (!$flag){
    $response["Login Success"] = false;
    return;
}else {
    $response["Login Success"] = true;
    $query = $mysqli->prepare("SELECT userId FROM users WHERE username = ? AND password = ?");
    $query->bind_param("ss",$username,$user_pass);
    if($query->execute()){
        $response["Query Success"] = true;
        $query->get_result();
        $response["userId"] = $query->fetch_assoc();
    }else{
        $response["Query Success"] = false;
        return;
    }
}
echo json_encode($response);

?>