<html>
<?php

	$user=$_POST['user'];
	$n_user=$_POST['n_user'];
	$n_pass=$_POST['n_pass'];
	$n_name=$_POST['n_name'];
	$n_surname=$_POST['n_surname'];
	$n_telephone=$_POST['n_telephone'];

	$user_exists=0;

	include 'server_conn.php';

	$query7=mysqli_query($var,"SELECT 1 FROM xristes WHERE email='$user' LIMIT 1") or die ("Lathos sto mysqli_query");
	if(mysqli_fetch_array($query7)){
	$user_exists=1;}

	if(empty($n_pass)==FALSE){
	$quer2=mysqli_query($var,"UPDATE xristes SET password='$n_pass' WHERE email='$user'") or die ("Lathos sto mysqli_query");}

	if(empty($n_name)==FALSE){
	$query3=mysqli_query($var,"UPDATE xristes SET onoma='$n_name' WHERE email='$user'") or die ("Lathos sto mysqli_query");}

	if(empty($n_surname)==FALSE){
	$query4=mysqli_query($var,"UPDATE xristes SET eponimo='$n_surname' WHERE email='$user'") or die ("Lathos sto mysqli_query");}

	if(empty($n_telephone)==FALSE){
	$query5=mysqli_query($var,"UPDATE xristes SET tilefono='$n_telephone' WHERE email='$user'") or die ("Lathos sto mysqli_query");}

	if(empty($n_user)==FALSE){
	$query6=mysqli_query($var,"UPDATE anafores SET dimiourgos='$n_user' WHERE dimiourgos='$user'") or die ("Lathos sto mysqli_query2");
	$query1=mysqli_query($var,"UPDATE xristes SET email='$n_user' WHERE email='$user'") or die ("Lathos sto mysqli_query");}

	if(isset($_POST['delete_user'])){
	$query8=mysqli_query($var,"DELETE FROM xristes WHERE email='$user'") or die ("Lathos sto mysqli_query");
	
	}

	if(isset($_POST['promote'])){
	$query9=mysqli_query($var,"UPDATE xristes SET ine_admin='1' WHERE email='$user'") or die ("Lathos sto mysqli_query");
	
	}

	if(isset($_POST['demote'])){
	$query10=mysqli_query($var,"UPDATE xristes SET ine_admin='0' WHERE email='$user'") or die ("Lathos sto mysqli_query");
	
	}

	if($user_exists==1){

	echo "Successful Update!";
	echo "<br><br>";
	echo "Click the button to go back.<br>";
	echo '<button onclick="goback()">Back</button>
	<script>
	function goback(){
	<!--
history.go(-1);
-->
	}
	</script>';}
	else {

	echo "User could not be found!";
	echo "<br><br>";
	echo "Click the button to go back.<br>";
	echo '<button onclick="goback()">Back</button>
	<script>
	function goback(){
	<!--
history.go(-1);
-->
	}
	</script>';}
?>
</html>