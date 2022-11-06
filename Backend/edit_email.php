<?php
include("connection.php");
include("functions.php");

$email = "";
$param_user_id = 0;
$results = [];
$response = [];
$flag = true;
if (isset($_POST["email"]) && $_POST["email"] != ""){
    $check_email_query = $mysqli->prepare("SELECT `userId` FROM `users` WHERE `email` = ? AND `userId` = ?");
    $param_email = filter_data($_POST["email"]);
    $param_user_id = filter_data($_POST["userId"]);
    $check_email_query->bind_param("si",$param_email,$param_user_id);
    if($check_email_query->execute()){
        $check_email_query->store_result();
        if($check_email_query->num_rows == 1){
            $results["Email Success"] = false;
            return;
        }else {
            $email = filter_data($_POST["email"]);
            $results["Email Success"] = true;
            
        }
    }
    $check_email_query->close();
}else {
    $results["Email Success"] = false;
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
    $response["Edit Email"] = false;
    return;
}else {
    $response["Edit Email"] = true;
    $query = $mysqli->prepare("UPDATE users SET email = ? WHERE userId= ?");
    $query->bind_param("si",$email,$param_user_id);
    if ($query->execute()){
        $response["Querry Success"] = true;
    }else {
        $response["Querry Success"] = false;
        return;
    }
}
echo json_encode($response);
?>
