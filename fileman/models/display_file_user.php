<?php
  /**********************************************/
  chdir("../../");
  require_once('Controllers/dataControler.php');
  include "Resources/sessionInit.php"; 
  /**********************************************/

  $login      = $_SESSION['login'];
  $id_user    = getUserID($login);

  $db = dbConnect();
  $sql = $db->prepare('SELECT * FROM file WHERE id_user like \''.$id_user.'\' ORDER BY created DESC;');
  $result = $sql->execute();
  
  echo "<div>";
  while ($row = $result->fetchArray())
  {
     echo "<table><tr>";
     echo "<td width='250'; height='36';><a href=".$row[url].">".$row[name]."&nbsp</a></td>";  
     echo '<td><a type="submit" id="button-delete" value="Delete" class="btn btn-danger" role="button" name="delete">Delete</a></td>';
     echo  "</tr></table>"; 
  }
  echo "</div>"

?>