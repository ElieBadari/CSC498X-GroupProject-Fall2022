<?php

include(connection.php);

$username = $email = $pass = "";
$results = [];
$response = [];
$flag = true;


//retrieving and validating info
//------------------------------
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    //validate user
    //-------------
    if (isset($_POST["username"]) && $_POST["username"] != ""){
        $check_user_query = $mysqli->prepare("SELECT userId FROM users WHERE username = ?");
        $check_user_query->bind_param("s",filter_data($_POST["username"]));
        if($check_user_query->execute()){
            $check_user_query->store_result();
            if($check_user_query->num_rows == 1){
                $results["Username Success"] = false;
                return
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
            $results["Email Success"] = true;
         }
    }else {
       $results["Email Success"] = false;
       return;
    }
    //validate password
    //-----------------
    if (isset($_POST["pass"]) && $_POST["pass"] != ""){
        $pass = hash('sha256', filter_data($_POST["pass"]));
        $results["Password Success"] = true;
    }else {
        $results["Password Success"] = false;
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
foreach($results as $key => $value){
    if(!$value){
        $response[$key] = $value;
        $flag = false;
    }
}
unset($value);


if (!$flag){
    $response["User Success"] = false;
}else {
    $query = $mysqli->prepare("INSERT INTO users (username, email, pass) VALUES (?,?,?)");
    $query->bind_param("sss", $username, $email, $password);
    if ($query->execute() == true){
        $response["User Success"] = true;
    }else {
        $response["User Success"] = false;
    }

}
echo json_encode($response);

?>