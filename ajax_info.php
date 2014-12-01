<?php

include 'server_conn.php';

$sinolikes_anafores=0;

$aniktes_anafores=0;

$mesos_xronos=0;

$result=mysqli_query($var,"SELECT * FROM anafores");

while($row=mysqli_fetch_array($result)){

	$sinolikes_anafores=$sinolikes_anafores+1;
	
	if($row['ine_epilimeni']==0){
	$aniktes_anafores=$aniktes_anafores+1;}
	else {
	$mesos_xronos=$mesos_xronos+strtotime($row['imerominia_klisimatos'])-strtotime($row['imerominia_anigmatos']);}

}

$epilimenes_anafores=$sinolikes_anafores-$aniktes_anafores;

if($epilimenes_anafores > 0){
$mesos_xronos=$mesos_xronos/$epilimenes_anafores;
$mesos_xronos=1+$mesos_xronos/(60*60*24);}

echo "Total Reports: ";
echo $sinolikes_anafores;
echo "<br><br>";

echo "Open Reports: ";
echo $aniktes_anafores;
echo "<br><br>";

echo "Resolved Reports: ";
echo $epilimenes_anafores;
echo "<br><br>";

echo "Average resolve time (days): ";
echo $mesos_xronos;
echo "<br><br>";
?>