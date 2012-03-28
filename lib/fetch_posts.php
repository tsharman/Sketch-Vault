<?php

session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/util/DBUtil.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/UI/post.php';

function fetchNewPosts($page, $num_per_page) {

	// grab data from db
	$query = "SELECT * FROM posts";
	$query.=" ORDER BY time_added 
						DESC LIMIT ".($page * $num_per_page).", ".$num_per_page.";";

	$results = DBQuery($query);
	
	// grab likes from user
	$user = $_SESSION['userData'];
	$likes = array();
	if($user) {
		$sql_likes = DBQuery("SELECT postid FROM likes WHERE userid=".$user['ID']);
		while($row = mysql_fetch_assoc($sql_likes))
			array_push($likes, $row['postid']);
	}

	// create array of xhp objects
	$posts = array();
	
	while($row = mysql_fetch_assoc($results)) {
		$like = in_array($row["ID"], $likes);
		$post = 
			<hc:post
				post_id={$row["ID"]}
				permalink={$row["permalink"]}
				series={$row["series"]}
				name={$row["name"]}
				img_url={$row["img_url"]}
				favorited={$like}
			/>;
		array_push($posts, $post);
	}

	return $posts;
}

function fetchFavoritePosts($user, $page, $num_per_page) {
	if(!$user)
		return array();

	// grab data from db
	$query = 
		"SELECT posts.ID, posts.permalink, posts.series, posts.name, posts.img_url
		 FROM posts INNER JOIN likes ON posts.ID = likes.postid
		 WHERE likes.userid = ".$user." ORDER BY likes.timestamp DESC
		 LIMIT ".($page * $num_per_page).", ".$num_per_page.";";

	$results = DBQuery($query);

	// create array of xhp objects
	$posts = array();

	while($row = mysql_fetch_assoc($results)) {
		$post =
			<hc:post
				post_id={$row["ID"]}
				permalink={$row["permalink"]}
				series={$row["series"]}
				name={$row["name"]}
				img_url={$row["img_url"]}
				favorited={true}
			/>;
		array_push($posts, $post);
	}

	return $posts;
}

function fetchPopularPosts($page, $num_per_page, $duration) {
	// grab most liked posts from db
	$query = "SELECT P.ID, P.permalink, P.series, P.name, P.img_url
						FROM posts P, 
						(SELECT postid, COUNT(userid) as likecount FROM likes 
						GROUP BY postid 
						ORDER BY likecount DESC) S
						WHERE P.ID = S.postid";
	switch($duration) {
		case "day":		$query.=" AND P.time_added > NOW() - INTERVAL 1 DAY";
									break;
		case "week":	$query.=" AND P.time_added > NOW() - INTERVAL 1 WEEK";
									break;
	}
	$query.= " ORDER BY S.likecount DESC, P.time_added DESC
						LIMIT ".($page * $num_per_page).", ".$num_per_page.";";

	$results = DBQuery($query);

	// grab likes from user
	$user = $_SESSION['userData'];
	$likes = array();
	if($user) {
		$sql_likes = DBQuery("SELECT postid FROM likes WHERE userid=".$user['ID']);
		while($row = mysql_fetch_assoc($sql_likes))
			array_push($likes, $row['postid']);
	}

	// create array of xhp objects
	$posts = array();
	
	while($row = mysql_fetch_assoc($results)) {
		$like = in_array($row["ID"], $likes);
		$post = 
			<hc:post
				post_id={$row["ID"]}
				permalink={$row["permalink"]}
				series={$row["series"]}
				name={$row["name"]}
				img_url={$row["img_url"]}
				favorited={$like}
			/>;
		array_push($posts, $post);
	}

	return $posts;
}
