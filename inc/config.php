<?php

$default_page = "index"; // Set default page

defined("DS")
	|| define("DS", DIRECTORY_SEPARATOR);

defined("ROOT_PATH")
	|| define("ROOT_PATH", realpath(__FILE__) . DS . ".." . DS));

defined("MOD_DIR")
	|| define("MOD_DIR", "mod");

defined("INC_DIR")
	|| define("INC_DIR", "inc");

defined("TEMPLATE_DIR")
	|| define("TEMPLATE_DIR", "template");

set_include_path(
	implode(PATH_SEPARATOR, array(
	realpath(ROOT_PATH.DS.MOD_DIR),
	realpath(ROOT_PATH.DS.INC_DIR),
	realpath(ROOT_PATH.DS.TEMPLATE_DIR),
	get_include_path(),)));
?>