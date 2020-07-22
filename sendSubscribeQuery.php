<?php 
//include phpmailer
require_once('class.phpmailer.php');


	$mysqli = new mysqli('localhost', 'root', 'root', 'bos_local_store');

   if(mysqli_connect_errno()) {
     echo "Connection Failed: " . mysqli_connect_errno();
	  }
	  $subEmail=$_POST['subEmail'];
$counter=array();
	
$count="Insert into  bos_subscribed_users(username) VALUES('$subEmail')";
//print($count);
$countsql=mysqli_query($mysqli,$count) or printf("Errormessage: %s\n", $mysqli->error);
?>