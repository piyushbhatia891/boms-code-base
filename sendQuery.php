<?php 
//include phpmailer
require_once('class.phpmailer.php');
	$mysqli = new mysqli('localhost', 'root', 'root', 'bos_local_store');

   if(mysqli_connect_errno()) {
     echo "Connection Failed: " . mysqli_connect_errno();
	  }
	  $name=$_POST['fname'];
	  $email=$_POST['email'];
	  $msg=$_POST['mssg'];
	  $sub=$_POST['subj'];
	  
	

$counter=array();
	
$count="Insert into bos_contact_us(name,email,subject,message) VALUES('$name','$email','$sub','$msg')";
//print($count);
$countsql=mysqli_query($mysqli,$count) or printf("Errormessage: %s\n", $mysqli->error);

//SMTP Settings
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth   = true; 
$mail->SMTPSecure = "tls"; 
$mail->Host       = "email-smtp.us-east-1.amazonaws.com";
$mail->Username   = "AKIAIKYQNITGYEXY77LQ";
$mail->Password   = "AhJiwg9rYV2A3RD7SgclEUH65rCnwcO7B6cBOAzrZv0R";
//

$mail->SetFrom('support@beonmyshop.com', 'BeOnMyShop Team'); //from (verified email address)
$mail->Subject = "Query From user"; //subject

//message
$body = "Hello Friend,<br /><br />"
	." Following is the query from  $name. <br />"
	." $msg<br /><br />"
	." Please respond  $email at earliest";
$mail->MsgHTML($body);
//

//recipient
$mail->AddAddress("piyushbhatia89@gmail.com", "Admin1"); 
 



//Success
if ($mail->Send()) { 
	echo "Message sent!"; 
}

//Error
if(!$mail->Send()) { 
	echo "Mailer Error: " . $mail->ErrorInfo; 
} 


?>