<?php
echo "<center><font size=\"15\">Rejoins [Why] aujourd'hui !</font></center></br></br>
<form id=\"signup\" name=\"monform\" method=\"post\" action=\"\">
    <input type=\"email\" placeholder=\"john.doe@email.com\" name=\"mail\" value=\"".$_POST['mail']."\" required></br></br>
    <input type=\"text\" placeholder=\"Choisis ton pseudo !\" name=\"pseudo1\" value=\"".$_POST['pseudo']."\"required></br></br>        
    <input type=\"password\" placeholder=\"Choisis ton mot de passe !\" name=\"pass\" value=\"".$_POST['pass']."\" required></br></br>
    <input type=\"password\" placeholder=\"Confirme ton mot de passe !\" name=\"pass1\" required></br></br>
	<input type=\"checkbox\" name=\"conditions\" value=\"ok\"/> J'accepte les conditions.
    <button type=\"button\" onClick=\"ValiderMail(this.form)\">Créer mon compte</button>
</form>";
?>