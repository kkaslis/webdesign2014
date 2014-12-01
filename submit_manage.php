<?php	
	$uid=$_POST['to_be_solved'];
	$small_comment=$_POST['small_comment'];
	$admin_user=$_POST['admin_user'];

	include 'server_conn.php';

	$query1=mysqli_query($var,"UPDATE anafores SET ine_epilimeni='1', epilitis='$admin_user', imerominia_klisimatos=CURRENT_TIMESTAMP, sxolia_admin='$small_comment' WHERE uid='$uid'") or die ("Lathos sto mysqli_query");
	

	echo "Case Solved!";
	echo "<br><br>";
	echo "Click the button to go back.<br>";
	echo '<button onclick="goback()">Back</button>
	<script>
	function goback(){
	<!--
history.go(-1);
-->
	}
	</script>';

?>