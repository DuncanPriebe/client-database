<?php

session_start(); // Begin a session so that data can be temporarily stored and passed between pages

require_once "sql_protect.php"; // Provides protect function which guards against SQL injection
require_once "sql_connect.php"; // Provides connect function which connects to the database

$name = protect($_POST["name"]);
$sex = protect($_POST["sex"]);
$birth_date = protect($_POST["birth_date"]);
$check_in_date = protect($_POST["check_in_date"]);
$contact_name = protect($_POST["contact_name"]);
$contact_phone = protect($_POST["contact_phone"]);
$building = protect($_POST["building"]);
$floor = protect($_POST["floor"]);
$room = protect($_POST["room"]);
$bio = protect($_POST["bio"]);

$sql = "INSERT INTO residents
	(	name,		
		sex,
		birth_date,
		check_in_date,		
		contact_name,
		contact_phone,
		building,
		floor,
		room,
		bio
	) VALUES
	(	'$name', 
		'$sex',
		'$birth_date',
		'$check_in_date',		
		'$contact_name',
		'$contact_phone',
		'$building',
		'$floor',
		'$room',
		'$bio'
	)";

if (mysql_query($sql, connect()) === TRUE) {
	$message = "Resident has been successfully added.";
} else {
	$message = "Resident was not added. Please try again.";
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Menno Place - Add New Resident</title>
</head>
<body>
<p><?php echo $message;?></p>
<a href="add_resident.php">Add another resident</a>

</body>
</html>
