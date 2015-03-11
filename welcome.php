<?php

require_once("inc/functions.php");

render('welcome');

echo "<h1 style='color: red;'>Clearance level: " . $_SESSION['clearance'] . "</h1>";

?>