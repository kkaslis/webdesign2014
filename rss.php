<?php
	include 'server_conn.php';

	$query=mysqli_query($var,"SELECT uid, latitude, longitude, sxolia_xristi, catigoria FROM anafores WHERE ine_epilimeni='0'") or die ("Lathos sto mysqli_query");

	header("Content-type: text/html");

	echo '<?xml version="1.0" encoding="UTF-8" ?>
	<rss version="2.0">
	<channel>
	<title>2014 Web Project</title>
	<link>http://www.kaslis.com/web02431/main.html</link>
	<description>By Kyriakos Kaslis</description>';

	while($row=mysqli_fetch_array($query)){
	
	$unique_id=$row['uid'];
	$comment=$row['sxolia_xristi'];
	$type=$row['catigoria'];
	
	echo "<item>
	<title>$type</title>
	<link>http://www.kaslis.com/web02431/main.html</link>
	<description>Unique ID: $unique_id, Comment: $comment</description>
	</item>";
	}
	echo '</channel></rss>';
	
?>