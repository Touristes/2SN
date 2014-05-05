function profilLinkForm($login)
{
  $linkForm = "<form id=\"formProfilView\" method=\"POST\" action=\"profilView.php\">"
               ."<button class=\"formProfilView\" type=\"submit\" name=\"loginProfilView\" value=\"".$login."\">"
               .$login."</button></form>";
  return ($linkForm);
}

function profilLinkInForm($login)
{
  $linkForm = "<button class=\"formProfilView\" type=\"submit\" name=\"loginProfilView\" value=\""
	          .$login."\" onclick=\"this.form.action = \"profilView.php\"; this.form.submit();\" >"
              .$login."</button>";
  return ($linkForm);
}
