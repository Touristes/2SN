<?php
  /**********************************************/
  chdir("../../");
  require_once('Controllers/dataControler.php');
  include "Resources/sessionInit.php"; 
  /**********************************************/

  $login      = $_SESSION['login'];
  $id_user    = getUserID($login);
    
  $db = dbConnect();
  $sql = $db->prepare('SELECT * FROM repository WHERE id_user like \''.$id_user.'\' ORDER BY created DESC;');
  $result = $sql->execute();
  
  echo "<select>";
  echo "<option value='Default'>Default</option>";  
  while ($row = $result->fetchArray())
  {
     echo "<option value=".$row[name].">".$row[name]."</option>";  
  }
  echo "</select>";




?>