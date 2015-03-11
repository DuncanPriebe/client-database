<!-- 
This script provides a function which connects
to a remote MySQL database using the username
and password parameters.
-->

<?php
//error_reporting(E_ERROR); // Don't report errors to the user

require_once "sql_protect.php"; // Provides protect function, which guards against SQL injection

function connect() {
	$host = "localhost"; // Set the database server location
	$database = "menno"; // Set the database name
	$username = $_SESSION['username'];
	$password = $_SESSION['password'];
	
	$connection = mysql_connect("$host", "$username", "$password"); // Connect to the server
	if ($connection) { // Check if the connection is valid
		mysql_select_db("$database", $connection); // Select the database
		return $connection; // Return the connection
	} else {
		return "";
	}
}
?>