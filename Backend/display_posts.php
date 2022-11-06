<?php
include("connection.php");

$response = [];

$query = $mysqli->prepare("SELECT * FROM `posts`");
if ($query->execute()){
    $posts = $query->get_result();
    while($post = $posts->fetch_assoc()){
        $response[] = $post;
    }   
}else {
    $response["Display Success Query"] = false;
}

echo json_encode($response);

?>