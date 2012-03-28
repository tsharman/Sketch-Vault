<?php
require_once '../util/DBUtil.php';

$contents = file_get_contents("http://www.dumbingofage.com/feed/");

try {
	$rss = new SimpleXMLElement($contents);
} catch(Exception $e) {
	echo $e->getMessage();
	return;
}

foreach($rss->channel->item as $item) {
	$series = "Dumbing of Age";
	$name = $item->title;
	$permalink = $item->link;

	if($item->category == "Blog")
		continue;

	// grab img url from the src in the description tag
	$page = file_get_contents($permalink);
	$start = strpos($page, "comicpane");
	$start = strpos($page, "img", $start);
	$start = strpos($page, "src", $start);
	$start = strpos($page, "\"", $start) + 1;
	$end = strpos($page, "\"", $start) - $start;
	$img_url = substr($page, $start, $end);

	$query = "INSERT INTO posts (series, name, permalink, img_url, time_added) VALUES ('$series', '$name', '$permalink', '$img_url', NOW());";

	try {
		DBQuery($query);
	} catch(Exception $e) {
		break;
	}
}

