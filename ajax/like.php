<?php

session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/util/DBUtil.php';

if(!isset($_SESSION["userData"])) {
	header("HTTP/1.0 500 Internal Server Error");
	exit();
}

$userid = $_SESSION["userData"]["ID"];
$postid = $_POST['postid'];

DBQuery("INSERT INTO likes (postid, userid) VALUES (".$postid.", ".$userid.")");
