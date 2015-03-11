<!-- 
This script validates session data in order
to prevent error messages. It returns an empty
string if the data is not set.
-->

<?php
function s($property) {
	if (isset($property)) {
		return $property;
	} else {
		return "";
	}
}
?>