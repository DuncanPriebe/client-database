<!-- 
This script provides a function which guards
against SQL injection.
-->

<?php
function protect($i) {
	$i = trim($i);
	$i = stripslashes($i);
	$i = htmlentities($i);
	$i = mysql_real_escape_string($i);

	return $i;
}
?>