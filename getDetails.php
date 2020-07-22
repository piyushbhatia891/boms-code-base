<?php 
	$mysqli = new mysqli('localhost', 'root', 'root', 'bos_local_store');

   if(mysqli_connect_errno()) {
     echo "Connection Failed: " . mysqli_connect_errno();
	  }
	  $value=$_POST['value'];
  	  $plan=$_POST['plan'];
  	 // $token=$_POST['token'];	


$counter=array();
	
$count="select * from bos_site_plan where country='$value' and site_plan='$plan'";

$countsql=mysqli_query($mysqli,$count) or printf("Errormessage: %s\n", $mysqli->error);

while ($row = mysqli_fetch_array($countsql)) {

$counter[]=$row;
}
echo '{"users":'.json_encode($counter).'}';

$count="Insert into bos_store_creation_audit(user_page,user_plan_check_homepage,user_created_date)
	VALUES('homepage','yes',now())";
$countsql=mysqli_query($mysqli,$count) or printf("Errormessage: %s\n", $mysqli->error);


?>