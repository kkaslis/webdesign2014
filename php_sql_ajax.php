<?

$dom= new DOMDocument("1.0");
$node=$dom->createElement("markers");
$parnode=$dom->appendChild($node);

include 'server_conn.php';

$result=mysqli_query($var,"SELECT * FROM anafores");

header("Content-type: text/xml");

while($row=mysqli_fetch_array($result)){

	if($row['ine_epilimeni']==0){

	$node=$dom->createElement("marker");
	$newnode=$parnode->appendChild($node);
	
	$newnode->setAttribute("unique_id", $row['uid']);
	$newnode->setAttribute("lat", $row['latitude']);
	$newnode->setAttribute("lng", $row['longitude']);
	$newnode->setAttribute("type", $row['catigoria']);}

}

echo $dom->saveXML();
?>