<?php	
	$user_email=$_POST['user_email'];
	$user_pass=$_POST['user_pass'];
	$user_name=$_POST['user_name'];
	$user_surname=$_POST['user_surname'];
	$user_tilefono=$_POST['user_tilefono'];
	

	include 'server_conn.php';

	$ine_xristis=mysqli_query($var,"SELECT * FROM xristes WHERE email='$user_email'") or die ("Lathos sot query2");

	while($result = mysqli_fetch_array($ine_xristis)){

	$sql_email=$result['email'];}

	if ($sql_email!=NULL){
	echo "This email already exists. Please select an other one.";
	echo "<br><br>";
	echo "You will be redirected to the previous page in 10 seconds.";
	echo '<META HTTP-EQUIV="Refresh" Content="5; URL=http://www.kaslis.com/web02431/main.html">';}
	else {
	mysqli_query($var,"INSERT INTO xristes (
	email,
	password,
	onoma,
	eponimo,
	tilefono,
	ine_admin) VALUES(
	'$user_email',
	'$user_pass',
	'$user_name',
	'$user_surname',
	'$user_tilefono',
	0)") or die ("malaria sot query");

	echo "Successful Registration!";
	echo "<br><br>";
	echo "You will be redirected to the previous page in 10 seconds.";
	echo '<META HTTP-EQUIV="Refresh" Content="5; URL=http://www.kaslis.com/web02431/main.html">';
}

?>