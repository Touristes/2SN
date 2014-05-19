<?php
 function videoView($url) {
 echo "<object type=\"application/x-shockwave-flash\" width=\"560\" height=\"315\"data=\"".$url."\"><param name=\"video\" value=\"".$url."\""
	." /><param name=\"allowfullscreen\" value=\"true\" /></object>";
}
?>