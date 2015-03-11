<?php
require_once("config.php");
require_once("database.php");
include_once("start_session.php");

// Remove special characters from a string for use in SQL
function sql_escape($value) {
	if(PHP_VERSION < 6) {
		$value = get_magic_quotes_gpc() ? stripslashes($value) : trim($value);
	}
	if(function_exists("mysql_real_escape_string")) {
		$value = mysql_real_escape_string($value);
	} else {
		$value = mysql_escape_string($value);
	}
	return $value;
}

// Exectute SQL statement
function execute_sql($sql) {
	global $db_connection;
	mysql_select_db(DB_NAME, $db_connection);
	$records = mysql_query($sql, $db_connection) or die("Database query error.<br/>" . mysql_error()); // Get records that match $sql query	
	if(mysql_num_rows($records) > 0) { // If there are any rows returned...
		$record_array = mysql_fetch_assoc($records); // Store the data from the records in an array
	}
	mysql_free_result($records); // Clear the query result
	return (!empty($record_array)) ? $record_array : null;
}

// Get a row value from a record
function get_row($record, $row) {
	return (!empty($record[$row])) ? $record[$row] : null; // If the row of the record isn't empty, return it	
}

// Fetch a single record from a given table with a given key matching a given value
function fetch_one($table, $key, $value) {	
	$sql = "SELECT * FROM `" .sql_escape($table). "` WHERE `" .sql_escape($key). "` = '" .sql_escape($value). "' LIMIT 1";
	$record = execute_sql($sql);
	return (!empty($record)) ? $record : null; // If the record isn't empty, return it	
}

// Fetch all records from a given table with a given key matching a given value
function fetch_many($table, $key, $value, $limit) {
	$sql = "SELECT * FROM `" .sql_escape($table). "` WHERE `" .sql_escape($key). "` = '" .sql_escape($value). "' LIMIT '" .sql_escape($limit). "'";
	$record = execute_sql($sql);
	return (!empty($record)) ? $record : null; // If the records aren't empty, return them
}	

// Fetch all records from a given table with a given key matching a given value
function fetch_all($table, $key, $value) {
	$sql = "SELECT * FROM `" .sql_escape($table). "` WHERE `" .sql_escape($key). "` = '" .sql_escape($value). "'";
	$record = execute_sql($sql);
	return (!empty($record)) ? $record : null; // If the records aren't empty, return them
}	

// Fetch a single record from a given table with a given key matching a given value
function fetch_record($table, $key, $value, $row) {
	$sql = "SELECT * FROM `" .sql_escape($table). "` WHERE `" .sql_escape($key). "` = '" .sql_escape($value). "' LIMIT 1";
	$record = execute_sql($sql);
	return (!empty($record[$row])) ? $record[$row] : null; // If the row of the record isn't empty, return it	
}	

// Fetch all records from a given table with a given key matching a given value
function fetch_records($table, $key, $value, $row) {
	$sql = "SELECT * FROM `" .sql_escape($table). "` WHERE `" .sql_escape($key). "` = '" .sql_escape($value). "'";
	$record = execute_sql($sql);
	return (!empty($record[$row])) ? $record[$row] : null; // If the row of the record isn't empty, return it	
}	

// Check session data to determine clearance level
function check_clearance($page, $user_clearance) {
	$required_clearance = fetch_record('pages', 'name', $page, 'clearance'); // Fetch required clearance level from database
	if ($required_clearance = 0) { // If the required clearance is 0, load the page without comparing it 
		return true;
	}
	if (($user_clearance < $required_clearance) || $user_clearance = null) { // Check if the current clearance level is inadequate or null
		return false;
	} else {
		return true;
	}
}

// Get menu links based on page name and user clearance
function get_menu($page, $user_clearance) {


echo "<div id='menu'>";

echo "</div>";
echo "</body>";
echo "</html>";
}

// Display page content
function push_layout($content) {
	require_once("template/header.php"); // Display the header
	echo $content; // Display the content
	require_once("template/footer.php"); // Display the footer
}

// Render page content
function render($page) {
	if (empty($page)) { // If an empty string is passed...
		global $default_page; // Access the variable $default_page
		$page = $default_page; // Use the default page	
	} 
	if (isset($_SESSION['clearance'])) { // Check if the session variable is set
		$clearance = $_SESSION['clearance']; // If it is, store it for later evaluation
	} else {
		$clearance = 0; // If it isn't, use default clearance
	}
	if (check_clearance($page, $clearance)) { // Check the session clearance level against the required clearance level of the page	
		$content = fetch_record("pages", "name", $page, 'content');	 // Get error page
	} else {
		$content = fetch_record("pages", "name", 'access_denied', 'content'); // Get requested page
	}	
	push_layout($content); // Call function to display page
}

?>