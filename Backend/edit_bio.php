<?php 
include("connection.php");
include("functions.php");

$content = "";
$param_user_id = 0;
$results = [];
$response = [];
$flag = true;

if (isset($_POST["bioContent"]) && $_POST["bioContent"] != ""){
    $content = filter_data($_POST["bioContent"]);
    $results["Content Success"] = true;
}else {
    $results["Content Success"] = false;
    return;
}

foreach ($results as $key => $value){
    if(!$value){
        $flag = false;
    }
    $response[$key] = $value;
}
unset($value);

if (!$flag){
    $response["Edit Bio"] = false;
    return;
}else {
    $response["Edit Bio"] = true;
    $param_user_id = filter_data($_POST["userId"]);
    $query = $mysqli->prepare("UPDATE users SET bioContent = ? WHERE userId = ?");
    $query->bind_param("si", $content,$param_user_id);
    if ($query->execute()){
        $response["Query Success"] = true;
    }else {
        $response["Query Success"] = false;
        return;
    }
}
echo json_encode($response);

?>