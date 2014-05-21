<?php

include "dataRef.php";
include "sessionInit.php";

$post[2] = $_POST["posts"];
$post[0] = $_SESSION["login"];
$post[1] = $_POST["title"];
$post[3] = getCategoryID("Text"); //category;
$post[4] = 2; //type;
if ($_FILES['file']['tmp_name'] != '' && $_FILES['file']['size'] > 0 && $_FILES['file']['error'] != UPLOAD_ERR_NO_FILE) {
  $post[3] = getCategoryID("Picture");
}
addPost($post);
?>
<META http-EQUIV="Refresh" CONTENT="0; url=accueil.php">
