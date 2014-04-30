<?php

include "dataRef.php";

$post[2] = $_POST["posts"];
$post[0] = $_SESSION["login"];
$post[1] = $_POST["title"];
$post[3] = 1; //category;
$post[4] = 2; //type;

echo "Il est vivant !!";
addPost($post);


?>