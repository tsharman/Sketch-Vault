<?php
require_once '../util/DBUtil.php';

$contents = file_get_contents("http://www.rsspect.com/rss/qwantz.xml");

try {
	$rss = new SimpleXMLElement($contents);
} catch(Exception $e) {
	echo $e->getMessage();
	return;
}

$series = $rss->channel->title;
$i = 0;
foreach($rss->channel->item as $item) {
	if($i>5)
		return;
	$i++;
	$name = addslashes($item->title);
	$permalink = $item->link;

	// grab img url from the src in the description tag
	$desc = $item->description;
	$start = strpos($desc, "img src");
	$start = strpos($desc, "\"", $start) + 1;
	$end = strpos($desc, "\"", $start) - $start;
	$img_url = substr($desc, $start, $end);

	$query = "INSERT INTO posts (series, name, permalink, img_url, time_added) VALUES ('$series', '$name', '$permalink', '$img_url', NOW());";

	try {
		DBQuery($query);
	} catch(Exception $e) {
		break;
	}
}

