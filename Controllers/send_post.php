<?php

require_once "./Controllers/frontControler.php";
include "./Resources/sessionInit.php";

$post[2] = $_POST["posts"];
$post[0] = $_SESSION["login"];
$post[1] = $_POST["title"];
$post[3] = getCategoryID("Text"); //category;
$post[4] = 2; //type;
$post[5] = $_POST['troll'];
if ($_FILES['file']['tmp_name'] != '' && $_FILES['file']['size'] > 0 && $_FILES['file']['error'] != UPLOAD_ERR_NO_FILE) {
  $post[3] = getCategoryID("Picture");
}
addPost($post);
//exit;
?>
<META http-EQUIV="Refresh" CONTENT="0; url=accueil.php">
