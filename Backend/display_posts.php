<?php
include("connection.php");
$results = [];
$response = [];

$query = $mysqli->prepare("SELECT * FROM posts");
if ($query->execute()){
    $results["Display Success Query"] = true;
}else {
    $results["Display Success Query"] = false;
}
$result = $query->get_result();
while($posts = $result->fetch_assoc()){
    $response[] = $posts;
}
echo json_encode($response);

?>