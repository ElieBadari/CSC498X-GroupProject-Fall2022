<?php
include("connection.php");
$results = [];
$response = [];

$query = $mysqli->prepare("SELECT * FROM `posts`");
if ($query->execute()){
    $results["Display Success Query"] = true;
    $posts = $query->get_result();
    while($post = $posts->fetch_assoc()){
        $response[] = $post;
    }   
}else {
    $results["Display Success Query"] = false;
}

echo json_encode($response);

?>