<?php

	$category=$_POST['category'];
	$lat=$_POST['lat'];
	$lng=$_POST['lng'];
	$text=$_POST['text'];
	$dimiourgos=$_POST['dimiourgos'];
	$photo1;
	$photo2;
	$photo3;
	$photo4;

	if ($_FILES["photo1"]["error"]>0){
	}else{
	$photo1=$_FILES["photo1"]["name"];
	move_uploaded_file($_FILES["photo1"]["tmp_name"],
		"imagez/" . $_FILES["photo1"]["name"]);}

	if ($_FILES["photo2"]["error"]>0){
	}else{
	$photo2=$_FILES["photo2"]["name"];
	move_uploaded_file($_FILES["photo2"]["tmp_name"],
		"imagez/" . $_FILES["photo2"]["name"]);}

	if ($_FILES["photo3"]["error"]>0){
	}else{
	$photo3=$_FILES["photo3"]["name"];
	move_uploaded_file($_FILES["photo3"]["tmp_name"],
		"imagez/" . $_FILES["photo3"]["name"]);}

	if ($_FILES["photo4"]["error"]>0){
	}else{
	$photo4=$_FILES["photo4"]["name"];
	move_uploaded_file($_FILES["photo4"]["tmp_name"],
		"imagez/" . $_FILES["photo4"]["name"]);}

	include 'server_conn.php';

	$upload_info=mysqli_query($var,"INSERT INTO anafores (latitude, longitude, dimiourgos, sxolia_xristi, imerominia_anigmatos, catigoria, photo1, photo2, photo3, photo4)
	VALUES('$lat', '$lng', '$dimiourgos', '$text', CURRENT_TIMESTAMP, '$category','$photo1','$photo2','$photo3','$photo4')") or die ("malaria sot query2");

	echo "Thank you for your report!"; echo '<br>';
	echo "The details are visible below:"; echo '<br>';
	echo "Category: ";
	echo $category; echo '<br>';
	echo "Latitude: ";
	echo $lat; echo '<br>';
	echo "Longitude: ";
	echo $lng; echo '<br>';
	echo "Additional Information: ";
	echo $text;

	if(is_null($photo1)==FALSE){
		echo '<br>'; echo "Photo 1"; 
		echo '<img src="http://www.kaslis.com/web02431/imagez/'.$_FILES["photo1"]["name"].'">';}

	if(is_null($photo2)==FALSE){
		echo '<br>'; echo "Photo 2";
		echo '<img src="http://www.kaslis.com/web02431/imagez/'.$_FILES["photo2"]["name"].'">';}

	if(is_null($photo3)==FALSE){
		echo '<br>'; echo "Photo 3";
		echo '<img src="http://www.kaslis.com/web02431/imagez/'.$_FILES["photo3"]["name"].'">';}

	if(is_null($photo4)==FALSE){
		echo '<br>'; echo "Photo 4";
		echo '<img src="http://www.kaslis.com/web02431/imagez/'.$_FILES["photo4"]["name"].'">';}
	
?>