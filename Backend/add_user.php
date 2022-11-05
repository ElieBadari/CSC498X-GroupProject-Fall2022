<?php

include(connection.php);

$username = $email = $pass = "";
$results = [];


//retrieving and validating info
//------------------------------
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST["username"]) && $_POST["username"] != ""){
        $username = filter_data($_POST["username"]);
        $results["Username"] = true;
    }else {
        $results["Username"] = false;
        return;
    }
    if (isset($_POST["email"]) && $_POST["email"] != ""){
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $results["email_format"] = false;
            return; 
         }else {
            $email = filter_data($_POST["email"]);
            $results["email"] = true;
         }
    }else {
       $results["email"] = false;
       return;
    }
    if (isset($_POST["pass"]) && $_POST["pass"] != ""){
        $pass = hash('sha256', filter_data($_POST["pass"]));
        $results["Password"] = true;

    }else {
        $results["Password"] = false;
        return;
    }

    function filter_data($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
}
//adding the user to the database
//------------------------------
$flag = true;

foreach($results as $value){
    if(!$value){
        $flag = false;
    }
}
unset($value);

$response = [];
if (!$flag){
    $response["Success"] = false;
}else {
    $query = $mysqli->prepare("INSERT INTO users (username, email, pass) VALUES (?,?,?)");
    $query->bind_param("sss", $username, $email, $password);
    if ($query->execute() == true){
        $response["Success"] = true;
    }else {
        $response["Success"] = false;
    }

}
echo json_encode($response);





?>