<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <style type="text/css">
	.form-field {
		
		display:block;
		clear:both;
		width:25px;}
	h1 {font-family: Comic Sans MS, cursive, sans-serif; position:absolute; top: 48%; left: 32%}
	fieldset1 {display:block; position:absolute; top: 60%; left: 30%}
	fieldset2 {display:block; position:absolute; top: 70%; left: 30%}

	@media all and (max-device-width:720px){
	h1 {font-size:18px; font-family: Comic Sans MS, cursive, sans-serif; position: absolute; top: 48%; left: 32%}
	fieldset1 {display:block; position:absolute; top: 60%; left: 5%}
	fieldset2 {display:block; position:absolute; top: 70%; left: 5%}
}
      html { height: 100% }
      body { height: 100%; margin: 0; padding: 0 }
      #map-canvas { height: 50%; width: 100%; margin-left:auto; margin-right:auto }
    </style>
    <script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDbn6iooYFv0-SFrUHjtX1eNioMpV3mNgk&sensor=TRUE">
    </script>
    <script type="text/javascript">
	var map;
	var lat;
	var lng;
	var diktes;

	var customIcons={
	"Mild": {
	icon: 'http://labs.google.com/ridefinder/images/mm_20_green.png'
	},
	"Potentially Hazardous": {
	icon: 'http://labs.google.com/ridefinder/images/mm_20_orange.png'
	},
	"Urgent Situation": {
	icon: 'http://labs.google.com/ridefinder/images/mm_20_red.png'
	}
	};

      function initialize() {
	diktes=0;
        var mapOptions = {
          center: new google.maps.LatLng(38.286097, 21.783471),
          zoom: 14
        };
        map = new google.maps.Map(document.getElementById("map-canvas"),
            mapOptions);
	  google.maps.event.addListener(map, 'click', function(event) {
    placeMarker(event.latLng);
  });
      
	function placeMarker(location) {
	if (diktes==0){
	diktes=diktes+1;
	  var marker = new google.maps.Marker({
	    position: location,
	    map: map,
	draggable:true,
	  });

	google.maps.event.addListener(marker, 'drag', function(event){
	lat=event.latLng.lat();
	lng=event.latLng.lng();});

	google.maps.event.addListener(marker, 'dragend', function(event){
	lat=event.latLng.lat();
	lng=event.latLng.lng();});

	} else{alert("Only one marker is allowed");}}

	var infoWindow=new google.maps.InfoWindow;

	getURL("php_sql_ajax.php", function(data){
	var xml=data.responseXML;
	var markers=xml.documentElement.getElementsByTagName("marker");
	for (var i=0; i<markers.length; i++){
		var unique_id=markers[i].getAttribute("unique_id");
		var point=new google.maps.LatLng(
			parseFloat(markers[i].getAttribute("lat")),
			parseFloat(markers[i].getAttribute("lng")));
		var type=markers[i].getAttribute("type");
		var icon=customIcons[type] || {};
		var marker=new google.maps.Marker({
		map: map,
		position: point,
		icon: icon.icon
		});
		bindInfoWindow(marker, map, infoWindow, unique_id);
	}
	});
	
      }

	function bindInfoWindow(marker, map, infoWindow, unique_id){
	google.maps.event.addListener(marker, 'click', function(){
	infoWindow.setContent(unique_id);
	infoWindow.open(map,marker);
	});
	}

	function getURL(url, callback){
	if (window.XMLHttpRequest) {
		xmlhttp=new XMLHttpRequest();}
	else {
	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}

	xmlhttp.onreadystatechange=function(){
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		xmlhttp.onreadystatechange=doNothing;
		callback(xmlhttp, xmlhttp.status);
		}
	};
	xmlhttp.open('GET',url, true);
	xmlhttp.send(null);
	}

	function doNothing() {}

		

	function submit_form(){
	document.form_submit.lat.value=lat;
	document.form_submit.lng.value=lng;
	if(diktes==0){
		alert("Please place a marker by touching the map");
		return false;}
	document.forms["form_submit"].submit();
	}

	function deleteField(){
	document.getElementById('photo1').value='';
	document.getElementById('photo2').value='';
	document.getElementById('photo3').value='';
	document.getElementById('photo4').value='';}

      google.maps.event.addDomListener(window, 'load', initialize);
	

    </script>

</head>
<body>

<?php

	include 'server_conn.php';

	$user_email=$_POST['user_email'];
	$user_pass=$_POST['user_pass'];
	$ine_admin=0;

	

	$ine_xristis=mysqli_query($var,"SELECT * FROM xristes WHERE email='$user_email' AND password='$user_pass'") or die ("Lathos sot mysql_query");


	while($result = mysqli_fetch_array($ine_xristis)){

	$sql_email=$result['email'];
	$ine_admin=$result['ine_admin'];}

	if ($sql_email==NULL){
	echo "<fieldset1>Wrong Username/Password</fieldset1>";
	echo "<fieldset2>You will be redirected to the previous page in 10 seconds.</fieldset2>";
	echo '<META HTTP-EQUIV="Refresh" Content="10; URL=http://www.kaslis.com/web02431/main.html">';}
	else {
	echo "<fieldset1>";
	echo ' <form action="report_submit.php" method="post" name="form_submit" enctype="multipart/form-data" onsubmit="return submit_form()">
		<legend>File a Report</legend><br>
		<div>
		<label for="category">Category:</label>
		<select id="category" name="category">
		<option value="Mild">Mild</option>
		<option value="Potentially Hazardous">Potentially Hazardous</option>
		<option value="Urgent Situation">Urgent Situation</option>
		</select>
		</div>
		<input type="hidden" name="lat" id="lat" value="">
		<input type="hidden" name="lng" id="lng" value="">
		<input type="hidden" name="dimiourgos" id="dimiourgos" value="'.$user_email.'">

		<label for="photo1">Photo 1:</label>
		<input type="file" name="photo1" id="photo1"><br>
		<label for="photo2">Photo 2:</label>
		<input type="file" name="photo2" id="photo2"><br>
		<label for="photo3">Photo 3:</label>
		<input type="file" name="photo3" id="photo3"><br>
		<label for="photo4">Photo 4:</label>
		<input type="file" name="photo4" id="photo4"><br>

		<input type="button" onclick="deleteField();" value="Delete Upload Fields"/> 
		<br>
		<label for="ai">Additional Information</label>
		<textarea name="text" id="text" rows=3 cols=20></textarea><br>
		<input type="submit" name="submit" value="Submit Report">
		</form>

		<form action="user_profile.php" method="post" name ="user_profile" onusubmit="return true;">
		<br><legend>Change Your Information</legend><br>
		<label for="user">New username:</label>
		<input type="text" name="n_user" id="n_user"><br>
		<label for="n_pass">New password:</label>
		<input type="password" name="n_pass" id="n_pass"><br>
		<label for="n_name">New name:</label>
		<input type="text" name="n_name" id="n_name"><br>
		<label for="n_surname">New surname:</label>
		<input type="text" name="n_surname" id="n_surname"><br>
		<label for="n_telephone">New telephone:</label>
		<input type="text" name="n_telephone" id="n_telephone"><br>
		<input type="hidden" name="user" id="user" value="'.$user_email.'">
		<input type="submit" name="submit" value="Change">
		</form>

		<form action="user_reports.php" method="post" name ="user_post" onusubmit="return true;">
		<br><legend>Click the button below to check the status of your reports</legend>
		<input type="hidden" name="user" id="user" value="'.$user_email.'">
		<input type="submit" name="submit" value="Your Reports">
		</form>';
		if($ine_admin==1){
	
			echo '<br><form action="user_profile.php" method="post" name ="modify_user" onusubmit="return true;">
			<legend>Modify User Information</legend><br>
			<label for="user">Username:</label>
			<input type="text" name="user" id="user"><br>
			<label for="user">New username:</label>
			<input type="text" name="n_user" id="n_user"><br>
			<label for="n_pass">New password:</label>
			<input type="password" name="n_pass" id="n_pass"><br>
			<label for="n_name">New name:</label>
			<input type="text" name="n_name" id="n_name"><br>
			<label for="n_surname">New surname:</label>
			<input type="text" name="n_surname" id="n_surname"><br>
			<label for="n_telephone">New telephone:</label>
			<input type="text" name="n_telephone" id="n_telephone"><br>
			<input type="checkbox" name="promote" id="promote" value="1">Promote User to Administrator<br>
			<input type="checkbox" name="demote" id="demote" value="1">Demote Administrator to User<br>
			<input type="checkbox" name="delete_user" id="delete_user" value="1">Delete User<br>
			<input type="submit" name="submit" value="Modify">
			</form>';

			echo '<br><form action="manage_open_reports.php" method="post" name ="manage_open_reports" onusubmit="return true;">
			<input type="submit" name="submit" value="Manage Open Reports">
			<input type="hidden" name="user" id="user" value="'.$user_email.'">
			</form>';

			echo '<br><form action="resolved_reports.php" method="post" name ="resolved_reports" onusubmit="return true;">
			<input type="submit" name="submit" value="Resolved Reports">
			</form>';

			echo '<br><form action="all_reports.php" method="post" name ="all_reports" onusubmit="return true;">
			<input type="submit" name="submit" value="All the Reports">
			</form>';

			}
	echo "</fieldset1>";}

	
?>


<div id="map-canvas"/>
</body>
</html>