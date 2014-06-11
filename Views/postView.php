<?php
//Affichage du formulaire de votes
function affVoteForm($id_post, $id_user) {
  if (verPost($id_post, $id_user) == true)
    echo "<form id=\"formVotes\" name=\"formVotes\" method=\"POST\" action=\"../Controllers/voteController.php\">
  <button type=\"submit\" name=\"good\"><img src=\"./Views/Images/Icons/goodArrow.png\"></button>
  <input type=\"hidden\" name=post value=\"".$id_post."\">
  <input type=\"hidden\" name=user value=\"".$id_user."\">
  <br><button type=\"submit\" name=\"bad\"><img src=\"./Views/Images/Icons/badArrow.png\"></button></form>";
  else
    echo "<form id=\"formVotes\" name=\"formVotes\" method=\"POST\" action=\"\">
  <button type=\"submit\" name=\"good\" disabled=\"true\" ><img src=\"./Views/Images/Icons/goodArrow.png\"></button>
  <br><button type=\"submit\" name=\"bad\" disabled=\"true\" ><img src=\"./Views/Images/Icons/badArrow.png\"></button></form>";
}


//Affichage des Posts images
function affPostImages() {
$post = getPostsByCategory("Picture");
if ($post != false)
for ($i = 0; isset($post[1][$i]); $i++)
  {
      echo "<div class=\"posts\"><b>".$post[1][$i]."</b><br>";
      affVoteForm($id_post, $id_user);
      controlerPictureDisplay($post[0][$i]);
      echo "<br>";
      echo "<br><br><div class=\"content\">".$post[3][$i]."</div><br>";
      //echo "Tags : ".$post[5][$i]."<br>";
      echo "<small>Publie le ".$post[7][$i]."</small><br>";
      echo profilLinkForm(getUserInfo("login", $post[2][$i]))."<br>";
      if (isChuckInThere($post[3][$i]))
        affChuck();
      else if ($post[6][$i] == 1)
        addTrollPic();
          else if ($post[6][$i] == 0)
        addActuPic();
      echo "<br></div>";
    }
}

//Affichage des Posts Video

function affPostVideo() {
  $post = getPostsByCategory("Video");
if ($post != false)
  for ($i = 0; isset($post[1][$i]); $i++)
    {
        echo "<div class=\"posts\"><b>".$post[1][$i]."</b><br>";
        affVoteForm($id_post, $id_user);
        affVideo($post[0][$i]);
        echo "<br>";
        echo "<br><br><div class=\"content\">".$post[3][$i]."</div><br>";
        //echo "Tags : ".$post[5][$i]."<br>";                                                                                                                                                         
        echo "<small>Publie le ".$post[7][$i]."</small><br>";
        echo profilLinkForm(getUserInfo("login", $post[2][$i]))."<br>";                                                                                                                               
        if (isChuckInThere($post[3][$i]))
          affChuck();
        else if ($post[6][$i] == 1)
          addTrollPic();
        else if ($post[6][$i] == 0)
                addActuPic();
        echo "</div><br>";
      }
}

//Affichage des Posts Texte                                                                                                                                                                           
function affPostText() {
    $post = getPostsByCategory("Text");
if ($post != false)
for ($i = 0; isset($post[1][$i]); $i++)
  {
    echo "<div class=\"posts\"><b>".$post[1][$i]."</b><br>";
    affVoteForm($id_post, $id_user);
    echo "<div class=\"content\">".$post[3][$i]."</div><br>";
    //echo "Tags : ".$post[5][$i]."<br>";                                                                                                                                                             
    echo "<small>Publie le ".$post[7][$i]."</small><br>";
    echo profilLinkForm(getUserInfo("login", $post[2][$i]))."<br>";
    if (isChuckInThere($post[3][$i]))
      affChuck();
    else if ($post[6][$i] == 1)
      addTrollPic();                                                                                                                                                                                  
        else if ($post[6][$i] == 0)
          addActuPic();
    echo "</div><br>";
  }
}

//Affichage de tous les posts
 function affAllPost($id) {
  echo "<div class=\"theribbon1\">Voici la liste de vos posts :</div><br>";
  $post = showPostByUser($id);
  for ($i = 0; isset($post[1][$i]); $i++)
  {
    if (getCategoryName($post[4][$i]) == "Video") {
      echo "<b>".$post[1][$i]."</b><br>";
		// echo "Catergorie ".getCategory($post[4][$i])."<br>";
      affVideo($post[0][$i]);
      echo "<br>";
      echo $post[3][$i]."<br>";
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
    echo $post[3][$i]."<br>";
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
   echo $post[1][$i]."</b><br>";
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
