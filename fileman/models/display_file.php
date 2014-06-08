<?php
  chdir("../../");
  require_once('Controllers/dataControler.php');

  $db = dbConnect();
  $sql = $db->prepare('SELECT * FROM file ORDER BY created DESC;');
  $result = $sql->execute();
  
  echo "<div>";
  while ($row = $result->fetchArray())
  {
     //echo "<form action='models/deleteFileUser.php' method='POST'>";
     echo "<table><tr>";
     echo "<td width='250'; height='36';><a href=".$row[url].">".$row[name]."&nbsp</a></td>";  
     echo '<td><a type="submit" id="button-delete" value="Delete" class="btn btn-danger" role="button" name="delete">Delete</a></td>';
     echo  "</tr></table>"; 
     //echo "</form>";  
  }
  echo "</div>"

?>