<?php

include("connection.php");
include("functions.php");

$username = $email = $pass = "";
$results = [];
$response = [];
$flag = true;

//retrieving and validating info
//------------------------------

//validate user
//-------------
if (isset($_POST["username"]) && $_POST["username"] != ""){
    $check_user_query = $mysqli->prepare("SELECT userId FROM users WHERE username = ?");
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
//validate email
//--------------
if (isset($_POST["email"]) && $_POST["email"] != ""){
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $results["Email Format"] = false;
        return; 
        }else {
        $email = filter_data($_POST["email"]);
        $results["Email Format"] = true;
        $results["Email Success"] = true;
        }
}else {
    $results["Email Success"] = false;
    return;
}
//validate password
//-----------------
if (isset($_POST["password"]) && $_POST["password"] != ""){
    $pass = hash('sha256', filter_data($_POST["pass"]));
    $results["Password Success"] = true;
}else {
    $results["Password Success"] = false;
    return;
}

//adding the user to the database
//------------------------------
foreach($results as $key => $value){
    if(!$value){   
        $flag = false;
    }
    $response[$key] = $value;
}
unset($value);

if (!$flag){
    $response["User Success Values"] = false;
    return;
}else {
    $response["User Success Values"] = true;
    $query = $mysqli->prepare("INSERT INTO users ('username', 'email', 'password','bioContent') VALUES (?,?,?,?)");
    $query->bind_param("ssss", $username, $email, $password, null);
    if ($query->execute()){
        $response["User Success Query"] = true;
    }else {
        $response["User Success Query"] = false;
        return;
    }
}

echo json_encode($response);

?>