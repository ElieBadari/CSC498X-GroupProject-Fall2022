<?php

include(connection.php);

$username = $email = $pass = "";

//retrieving and validating info
//------------------------------
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST["username"]) && $_POST["username"] != ""){
        $username = filter_data($_POST["username"]); 
    }else {
        echo "Name is required"; 
        return;
    }
    if (isset($_POST["email"]) && $_POST["email"] != ""){
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            echo "Invalid email format";
            return; 
         }else {
            $email = filter_data($_POST["email"]);
         }
    }else {
       echo "Email is required";
       return;
    }
    if (isset($_POST["pass"]) && $_POST["pass"] != ""){
        $pass = filter_data($_POST["pass"]); 
    }else {
        echo "Password is required";
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
$query = $mysqli->prepare("INSERT INTO users (username, email, pass) VALUES (?,?,?)");
$query->bind_param("sss", $username, $email, $password);
if ($query->execute() == true){
    echo "Sucessfully added user";
}else {
    echo "Unsuccessful query";
}



?>