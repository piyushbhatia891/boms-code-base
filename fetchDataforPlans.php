<?php 
	$mysqli = new mysqli('localhost', 'root', 'root', 'bos_local_store');

   if(mysqli_connect_errno()) {
     echo "Connection Failed: " . mysqli_connect_errno();
	  }
	  $selected_plan=$_POST['selected_plan'];
	  $selected_country=$_POST['selected_country'];
	


$counter=array();
	
$count="select * from bos_site_plan2 where country='$selected_country' and plan_site='$selected_plan' and plan_available NOT IN('Free') and plan_status='active' order by discount_price";
print($count);
$countsql=mysqli_query($mysqli,$count) or printf("Errormessage: %s\n", $mysqli->error);

while ($row = mysqli_fetch_array($countsql)) {

$counter[]=$row;
}
echo '{"users":'.json_encode($counter).'}';


?>