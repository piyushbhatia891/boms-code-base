<?php
require_once('class.phpmailer.php');

$name = $_POST['fname'];
$mail = $_POST['email'];
$subject = $_POST['subj'];
$message = $_POST['mssg'];

	

	$mysqli = new mysqli('localhost', 'root', 'root', 'bos_local_store');

   if(mysqli_connect_errno()) {
     echo "Connection Failed: " . mysqli_connect_errno();
	  }
$counter=array();
	
$count="Insert into bos_contact_us(name,email,subject,message) VALUES('$name','$mail','$subject','$message')";
//print($count);
$countsql=mysqli_query($mysqli,$count) or printf("Errormessage: %s\n", $mysqli->error);
echo "1";

?>