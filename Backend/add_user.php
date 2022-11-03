<?php

include(connection.php);

$username = $email = $password = "";
$username_err = $email_err = $password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (empty($_POST["username"])){
        $username_err = "Name is required";
    }else {
        
        $username = filter_data($_POST["username"]); 
    }
    if (empty($_POST["email"])){
        $email_err = "email is required";
    }else {
        
        $email = filter_data($_POST["email"]);

        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format"; 
         } 
    }
    if (empty($_POST["password"])){
        $password_err = "password is required";
    }else {
        
        $password = filter_data($_POST["password"]); 
    }
    function filter_data($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}



?>