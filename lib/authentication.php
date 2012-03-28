<?php

session_start();
require_once 'facebook.php';
require_once 'config.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/util/DBUtil.php';

$facebook = new Facebook(array(
	'appId' => $appId,
	'secret' => $appSecret
));
$user = $facebook->getUser();

if($user) {
	try {
		$user_profile = $facebook->api('/me');
	} catch(FacebookApiException $e) {
		error_log($e);
		$user = null;
	}
} else {
	$params = array('redirect_uri' => $baseSite);
	$loginUrl = $facebook->getLoginUrl($params);

}

if($user) {
	$userData = DBQuery("SELECT * FROM users WHERE fbid=".$user);

	//if this is the user's first time, inserting into user table
	if(mysql_num_rows($userData) ==  0) {
		DBQuery("INSERT INTO users(fbid) VALUES (".$user.")");
		// create session vars
		$_SESSION['userData'] = array("fbid" => $user, "ID" => mysql_insert_id());
	} else {
		$_SESSION['userData'] = mysql_fetch_assoc($userData);
	}
}

?>
