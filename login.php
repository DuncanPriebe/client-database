<?php

require_once("inc/functions.php");

//$username = (isset($_POST['username'])) ? $_POST['username'] : null;
//$password = (isset($_POST['password'])) ? $_POST['password'] : null;
$_SESSION['username'] = (isset($_POST['username'])) ? $_POST['username'] : null;
$_SESSION['password'] = (isset($_POST['password'])) ? $_POST['password'] : null;

if ($_SESSION['username'] != null || $_SESSION['password'] != null) {
	$temp = fetch_record('caregivers', 'first_name', $_SESSION['username'], 'password');	
	if ($temp == $_SESSION['password']) {
		$temp = fetch_record('caregivers', 'first_name', $_SESSION['username'], 'role');
		switch ($temp) {
			case 'care aide':
				$_SESSION['clearance'] = 2; break;
			case 'nurse':
				$_SESSION['clearance'] = 3; break;
			case 'recreation':
				$_SESSION['clearance'] = 3; break;
			case 'supervisor':
				$_SESSION['clearance'] = 4; break;
			case 'other':
				$_SESSION['clearance'] = 1; break;
			default:
				$_SESSION['clearance'] = 1;
		} include('welcome.php');
	} else {
		render('error');
	} 
} else {
	render('error');
}

?>