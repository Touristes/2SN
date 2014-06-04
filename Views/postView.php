<?php
//Affichage des Posts images
function affPostImages() {
$post = getPostsByCategory("Picture");
if ($post != false)
for ($i = 0; isset($post[1][$i]); $i++)
  {
      echo "<b>".$post[1][$i]."</b><br>";
      controlerPictureDisplay($post[0][$i]);
      echo "<br>";
      echo "| ".$post[3][$i]."<br>";
      //echo "Tags : ".$post[5][$i]."<br>";
      echo "<small>Publie le ".$post[7][$i]."</small><br>";
      echo profilLinkForm(getUserInfo("login", $post[2][$i]))."<br>";
      if (isChuckInThere($post[3][$i]))
	affChuck();
      else if ($post[6][$i] == 1)
	addTrollPic();
	  else if ($post[6][$i] == 0)
	addActuPic();
      echo "<br>";
    }
}

//Affichage des Posts Video
function affPostVideo() {
  $post = getPostsByCategory("Video");
if ($post != false)
  for ($i = 0; isset($post[1][$i]); $i++)
    {
	echo "<b>".$post[1][$i]."</b><br>";
	affVideo($post[0][$i]);
	echo "<br>";
	echo "| ".$post[3][$i]."<br>";
	//echo "Tags : ".$post[5][$i]."<br>";
	echo "<small>Publie le ".$post[7][$i]."</small><br>";
	echo profilLinkForm(getUserInfo("login", $post[2][$i]))."<br>";
	if (isChuckInThere($post[3][$i]))
	  affChuck();
	else if ($post[6][$i] == 1)
	  addTrollPic();
	else if ($post[6][$i] == 0)
		addActuPic();
	echo "<br>";
      }
}

//Affichage des Posts Texte
function affPostText() {
    $post = getPostsByCategory("Text");
if ($post != false)
for ($i = 0; isset($post[1][$i]); $i++)
  {
    echo "<b>".$post[1][$i]."</b><br>";
    echo "| ".$post[3][$i]."<br>";
    //echo "Tags : ".$post[5][$i]."<br>";
    echo "<small>Publie le ".$post[7][$i]."</small><br>";
    echo profilLinkForm(getUserInfo("login", $post[2][$i]))."<br>";
    if (isChuckInThere($post[3][$i]))
      affChuck();
    else if ($post[6][$i] == 1)
      addTrollPic();
	else if ($post[6][$i] == 0)
	  addActuPic();
    echo "<br>";
  }
}

//Affichage de tous les posts
function affAllPost() {
    echo "<div class=\"theribbon1\">Voici la liste de vos posts :</div><br>";
    $post = showPostByUser($id);
    for ($i = 0; isset($post[1][$i]); $i++)
    {
      if (getCategoryName($post[4][$i]) == "Video") {
        echo "<b>".$post[1][$i]."</b><br>";
		// echo "Catergorie ".getCategory($post[4][$i])."<br>";
        affVideo($post[0][$i]);
        echo "<br>";
        echo "| ".$post[3][$i]."<br>";
		//echo "Tags : ".$post[5][$i]."<br>";
        echo "<small>Publie le ".$post[7][$i]."</small><br>";
        if (isChuckInThere($post[3][$i]))
          affChuck();
        else if ($post[6][$i] == 1)
          addTrollPic();
		else if ($post[6][$i] == 0)
	  addActuPic();
        echo "<br>";
      }
      else if (getCategoryName($post[4][$i]) == "Picture") {
        echo "<b>".$post[1][$i]."</b><br>";
		// echo "Catergorie ".getCategory($post[4][$i])."<br>";
        controlerPictureDisplay($post[0][$i]);
        echo "<br>";
        echo "| ".$post[3][$i]."<br>";
		//echo "Tags : ".$post[5][$i]."<br>";
        echo "<small>Publie le ".$post[7][$i]."</small><br>";
        if (isChuckInThere($post[3][$i]))
          affChuck();
        else if ($post[6][$i] == 1)
          addTrollPic();
      	else if ($post[6][$i] == 0)
		  addActuPic();
		echo "<br>";
      }
      else if (getCategoryName($post[4][$i]) == "Text") {
       echo "<b>".$post[1][$i]."</b><br>";
		// echo "Catergorie ".getCategory($post[4][$i])."<br>";
       echo "| ".$post[3][$i]."<br>";
		//echo "Tags : ".$post[5][$i]."<br>";
       echo "<small>Publie le ".$post[7][$i]."</small><br>";
       if (isChuckInThere($post[3][$i]))
        affChuck();
      else if ($post[6][$i] == 1)
        addTrollPic();
	  else if ($post[6][$i] == 0)
		addActuPic();
      echo "<br>";
    }
  }
}


?>