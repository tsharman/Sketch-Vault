<?php

session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/fetch_posts.php';

$type = $_GET["type"];
$page = $_GET["page"];
$count = $_GET["count"];

$user = $_SESSION["userData"];

switch($type) {
	case "new":
		$posts = fetchNewPosts($page, $count);
		break;
	case "favorites":
		if(!$user) {
			header("HTTP/1.0 500 Internal Server Error");
			exit();
		}
		$posts = fetchFavoritePosts($user["ID"], $page, $count);
		break;
	case "popular":
		$filter = $_GET["filter"];
		$posts = fetchPopularPosts($page, $count, $filter);
		break;
	default:
		$posts = fetchNewPosts($page, $count);
		break;
}

foreach($posts as $post) {
	echo $post;
}
