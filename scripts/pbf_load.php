<?php
require_once '../util/DBUtil.php';

$contents = file_get_contents("http://pbfcomics.com/feed/feed.xml");

try {
	$rss = new SimpleXMLElement($contents);
} catch(Exception $e) {
	echo $e->getMessage();
	return;
}

foreach($rss->entry as $item) {
	$series = "The Perry Bible Fellowship";
	$name = $item->title;
	$permalink = $item->id;

	// grab img url from the src in the description tag
	$desc = $item->summary;
	$start = strpos($desc, "src");
	$start = strpos($desc, "\"", $start) + 1;
	$end = strpos($desc, "\"", $start) - $start;
	$img_url = substr($desc, $start, $end);

	if(strpos($img_url, "archive_b") === false) {
		continue;
	}

	$query = "INSERT INTO posts (series, name, permalink, img_url, time_added) VALUES ('$series', '$name', '$permalink', '$img_url', NOW());";

	try {
		DBQuery($query);
		return;
	} catch(Exception $e) {
		break;
	}

}

