<html>

<head>
	<title>Reports</title>
</head>

<body>

	<table border="1" width="50%" align="center">

<?php

	$table_data=array();
	$big_data;
	$i=1;
	
	include 'server_conn.php';

	$user_data=mysqli_query($var,"SELECT * FROM anafores") or die ("Lathos sto query2");

	while($result=mysqli_fetch_array($user_data)){
	echo '<tr><th><h1>'; echo "Report: "; echo $i++; echo '</h1></th></tr>';
	
	echo '<tr><th>'; echo "Latitude"; echo '</th></tr>'; 
	echo '<tr><td align="center">'; echo $result['latitude']; echo'</td></tr>';

	echo '<tr><th>'; echo "Longitude"; echo '</th></tr>'; 
	echo '<tr><td align="center">'; echo $result['longitude']; echo'</td></tr>';

	echo '<tr><th>'; echo "Solved"; echo '</th></tr>'; 
	echo '<tr><td align="center">'; 
	if ($result['ine_epilimeni']==0){
		echo "NO";} else {
		echo "YES";}
	 echo'</td></tr>';

	echo '<tr><th>'; echo "User comment"; echo '</th></tr>'; 
	echo '<tr><td align="center">'; echo $result['sxolia_xristi']; echo'</td></tr>';

	echo '<tr><th>'; echo "Admin comment"; echo '</th></tr>'; 
	echo '<tr><td align="center">'; echo $result['sxolia_admin']; echo'</td></tr>';

	echo '<tr><th>'; echo "Reported on"; echo '</th></tr>'; 
	echo '<tr><td align="center">'; echo $result['imerominia_anigmatos']; echo'</td></tr>';

	echo '<tr><th>'; echo "Solven on"; echo '</th></tr>'; 
	echo '<tr><td align="center">'; echo $result['imerominia_klisimatos']; echo'</td></tr>';

	echo '<tr><th>'; echo "Solved by"; echo '</th></tr>'; 
	echo '<tr><td align="center">'; echo $result['epilitis']; echo'</td></tr>';

	echo '<tr><th>'; echo "Category"; echo '</th></tr>'; 
	echo '<tr><td align="center">'; echo $result['catigoria']; echo'</td></tr>';

	echo '<tr><th>'; echo "Photo 1"; echo '</th></tr>'; 
	echo '<tr><td align="center">'; 

	echo '<img src="http://www.kaslis.com/web02431/imagez/'.$result['photo1'].'" width="50%" height="50%" alt="No photo">';

 echo'</td></tr>';

	echo '<tr><th>'; echo "Photo 2"; echo '</th></tr>'; 
	echo '<tr><td align="center">'; 

	echo '<img src="http://www.kaslis.com/web02431/imagez/'.$result['photo2'].'" width="50%" height="50%" alt="No photo">';

 echo'</td></tr>';

	echo '<tr><th>'; echo "Photo 3"; echo '</th></tr>'; 
	echo '<tr><td align="center">'; 

	echo '<img src="http://www.kaslis.com/web02431/imagez/'.$result['photo3'].'" width="50%" height="50%"  alt="No photo">';

 echo'</td></tr>';

	echo '<tr><th>'; echo "Photo 4"; echo '</th></tr>'; 
	echo '<tr><td align="center">'; 

	echo '<img src="http://www.kaslis.com/web02431/imagez/'.$result['photo4'].'" width="50%" height="50%" alt="No photo">';

 echo'</td></tr>';

	

	
	}
	

?>

</table>
</body>
</html>