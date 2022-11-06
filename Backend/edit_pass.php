<?php
include("connection.php");
include("functions.php");

$pass = "";
$param_user_id = 0;
$results = [];
$response = [];
$flag = true;

if (isset($_POST["password"]) && $_POST["password"] != ""){
    $pass = hash('sha256', filter_data($_POST["password"]));
    $results["Password Success"] = true;
}else {
    $results["Password Success"] = false;
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
    $response["Edit Password"] = false;
    return;
}else {
    $response["Edit Password"] = true;
    $param_user_id = filter_data($_POST["userId"]);
    $query = $mysqli->prepare("UPDATE users SET password = ? Where userId =?");
    $query->bind_param("si",$pass,$param_user_id);
    if ($query->execute()){
        $response["Query Success"] = true;
    }else {
        $response["Query Success"] = false;
        return;
    }
}
echo json_encode($response);
?>