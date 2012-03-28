<?php

require_once "config.php";

function DBConnect() {
	global $server, $username, $password, $database;
	$db_handle=mysql_connect($server, $username, $password) or die("fail");
	$db_found=mysql_select_db($database, $db_handle);
	if (!$db_found) {
		echo "failure";
	}
}

function DBQuery($query) {
	DBConnect();
	mysql_real_escape_string($query);
	$result = mysql_query($query) or die(mysql_error());
	return $result;
}
