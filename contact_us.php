<?php
//include phpmailer
require_once('class.phpmailer.php');

//setting connection parameters
$user = "root";
$password = "root";
$database_name = "bos_local_store";
$hostname = "localhost";
//$time = now();
$date = date('Y-m-d-H:i:s');
//SMTP Settings
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth   = true; 
$mail->SMTPSecure = "tls"; 
$mail->Host       = "email-smtp.us-east-1.amazonaws.com";
$mail->Username   = "AKIAIKYQNITGYEXY77LQ";
$mail->Password   = "AhJiwg9rYV2A3RD7SgclEUH65rCnwcO7B6cBOAzrZv0R";


$dsn = 'mysql:dbname=' . $database_name . ';host=' . $hostname;
$conn = new PDO($dsn, $user, $password);

$sqlSelect = 'select "store_id","store_first_name","store_last_name","store_email","store_city","store_country","store_org_name",
"store_domain_flag","store_category","store_step","store_user_id","store_password","store_name","store_database","store_domain",
"store_buying_flag" ,"store_plan","store_created_date","store_updated_date","store_url","store_currency",
"store_domain_buying_flag","store_status","store_password_decrypted" from bos_local_store_form UNION select store_id,store_first_name,
store_last_name,store_email,store_city, store_country,store_org_name,store_domain_flag,store_category,store_step,store_user_id,
store_password,store_name,store_database,store_domain,store_buying_flag,store_plan,store_created_date,store_updated_date,
store_url,store_currency,store_domain_buying_flag, store_status,store_password_decrypted from bos_local_store_form INTO 
OUTFILE "/var/www/html/testing/scheduled/new_'.$date.'.csv" FIELDS TERMINATED BY ","';
print($sqlSelect);

$sqlSelect2 = 'select "user_country","user_website","user_business_name","user_email","user_business","user_store_name","user_domain_name_check",
"user_domain_buying_flag","user_domain_flag","user_plan_selection","user_domain","user_created_date","user_page","user_plan_check_homepage","user_token"
from bos_store_creation_audit UNION select user_country,user_website,user_business_name,user_email,user_business,user_store_name,user_domain_name_check,user_domain_buying_flag,user_domain_flag,user_plan_selection,user_domain,user_created_date,user_page,user_plan_check_homepage,user_token
 from bos_store_creation_audit INTO 
OUTFILE "/var/www/html/testing/scheduled/audit_'.$date.'.csv" FIELDS TERMINATED BY ","';
print($sqlSelect);

$sqlSelect3 = 'select "BuyerName","BuyerEmail","TransactionID","ItemName","ItemAmount","ItemNumber","ItemQTY",
"User_Acc_email","Transaction_Status","Transaction_Fail_Reason","Transaction_Api_Step","transaction_updated_time" from BOS_store_form_payments UNION select BuyerName,BuyerEmail,TransactionID,ItemName,ItemAmount,ItemNumber,ItemQTY,User_Acc_email,Transaction_Status,Transaction_Fail_Reason,Transaction_Api_Step,transaction_updated_time from BOS_store_form_payments INTO 
OUTFILE "/var/www/html/testing/scheduled/paypal_'.$date.'.csv" FIELDS TERMINATED BY ","';
print($sqlSelect);

//preparing the statement
$sth = $conn->prepare($sqlSelect);
//execute the statement with different values
$sth->execute();

$sth = $conn->prepare($sqlSelect2);
//execute the statement with different values
$sth->execute();

$sth = $conn->prepare($sqlSelect3);
//execute the statement with different values

$sth->execute();


//$result = mysql_query('select "store_id","store_first_name","store_last_name","store_email","store_city","store_country","store_org_name","store_domain_flag","store_category","store_step","store_user_id","store_password","store_name","store_database","store_domain","store_buying_flag" ,"store_plan","store_created_date","store_updated_date","store_url","store_currency","store_domain_buying_flag","store_status","store_password_decrypted" from bos_local_store_form UNION select store_id,store_first_name,store_last_name,store_email,store_city, store_country,store_org_name,store_domain_flag,store_category,store_step,store_user_id,store_password,store_name,store_database,store_domain,store_buying_flag,store_plan,store_created_date,store_updated_date,store_url,store_currency,store_domain_buying_flag, store_status,store_password_decrypted from bos_local_store_form INTO OUTFILE "/var/www/html/scheduled/now().csv" FIELDS TERMINATED BY ','') or die(mysql_error());
//

$mail->SetFrom('support@beonmyshop.com', 'BeOnMyShop Team'); //from (verified email address)
$mail->Subject = "Daily Stores Audit Data"; //subject

//message
$body ="<!DOCTYPE html>
<html>
<head>
<title>Email Template</title>
<!-- Custom Theme files -->
<meta name='viewport' content='width=device-width, initial-scale=1'>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<meta name='keywords' content='Innovative Newsletter templates, Email Templates, Newsletters, Marketing  templates, 
	Advertising templates, free Newsletter' />
<!-- //Custom Theme files -->
<!-- Responsive Styles and Valid Styles -->
	<style type='text/css'>
    	
	    body{
            width: 100%;  
            margin:0; 
            padding:0; 
            -webkit-font-smoothing: antialiased;	
        }
        html{
            width: 100%; 
        }
        
        table{
            font-size: 14px;
            border: 0;
        }
		 /* ----------- responsivity ----------- */
		 @media only screen and (max-width: 800px){
				table.container.top-header-left {
					width: 726px;
				}
		 }
		 @media only screen and (max-width: 736px){
			 table.container.top-header-left {
				width: 684px;
			}
			}
		@media only screen and (max-width: 667px){
			table.container.top-header-left {
				width: 600px;
			}
			table.container-middle {
				width: 565px;
			}
			a.logo-text img {
				width: 100%;
				height: inherit;
			}
			table.logo {
				width: 40%;
			}
			table.mail_left {
				width: 200px;
			}
			td.mail_gd,td.mail_gd a {
				text-align: center !important;
			}
			td.ban_pad {
				height: 48px;
			}
			td.future {
				font-size: 2em !important;
			}
			td.ban_tex {
				height: 18px;
			}
			table.ban-hei {
				height: 315px !important;
			}
			td.ser_pad {
				height: 50px;
			}
			td.wel_text {
				font-size: 2.1em !important;
			}
			td.ser_text {
				line-height: 2em !important;
				font-size: 1em !important;
			}
			table.twelve_one {
				width: 316px;
			}
			table.twelve_two {
				width: 229px;
			}
			td.pic_one img {
				width: 100%;
				height: inherit;
			}
			table.ser_left_two {
				width: 100px;
			}
			table.ser_left_one {
				width: 200px;
			}
			img.full {
				width: 100%;
			}
			table.twelve_three {
				width: 272px;
			}
			td.ser_text2 {
				font-size: 1.5em !important;
			}
			table.cir_left {
				width: 276px;
			}
			table.twelve_four {
				width: 200px;
			}
			table.twelve_five {
				width: 337px;
			}
			td.ser_one {
				height: 45px;
			}
			table.foo {
				width: 370px;
			}
		}
        @media only screen and (max-width: 640px){
			td.ser_one {
				height: 60px;
			}
            .top-bottom-bg{width: 420px !important; height: auto !important;}
			
			table.container-middle.navi-grid {
				width: 360px !important;
			}
			table.logo {
				width: 45%;
			}
        }
		@media only screen and (max-width: 600px){
			table.container.top-header-left {
				width: 535px;
			}
			table.container-middle{
				width: 485px;
			}
			table.ban-hei {
				height: 288px !important;
			}
			table.ser_left_one {
				width: 151px;
			}
			table.ser_left_two {
				width: 86px;
			}
			table.twelve_one {
				width: 239px;
			}
			table.twelve_two {
				width: 221px;
			}
			table.twelve_three {
				width: 100%;
			}
			img.full {
				width: inherit;
			}
			table.cir_left {
				width: 230px;
			}
			table.cir_left img {
				width: 54%;
				height: inherit;
			}
			img.full.team_img {
				width: 100% !important;
				height:inherit;
			}
			table.twelve_four {
				width: 160px;
			}
			table.twelve_five {
				width: 298px;
			}
			td.team_pad {
				height: 0;
			}
			table.foo {
				width: 100%;
			}
			td.ser_text.editable {
				text-align: center;
			}
			table.foo1 {
				width: 100%;
			}
		}
		@media only screen and (max-width: 568px){
			/*-- w3layouts --*/
			table.container.top-header-left {
				width: 495px !important;
			}
			table.ban_info {
				width: 400px;
			}
			
			td.future {
				font-size: 1.8em !important;
			}
			table.ban-hei {
				height: 258px !important;
			}
			table.container-middle {
				width: 449px;
			}
			table.twelve_two {
				width: 190px;
			}
			td.ser_one {
				height: 34px;
			}
			td.ser_two {
				height: 21px;
			}
			table.cir_left {
				width: 100%;
			}
			table.cir_left img {
				width: 30%;
				height: inherit;
			}
			table.twelve_four {
				width: 100%;
			}
			img.full.team_img {
				width: 45% !important;
				height: inherit;
			}
			table.twelve_five {
				width: 100%;
			}
			td.text_team {
				text-align: center;
			}
			td.twel_pad {
				height: 25px;
			}
		}
		/*-- agileits --*/
        @media only screen and (max-width: 480px){
            .container{width: 290px !important;}
            .container-middle {
				width: 85% !important;
			}
            .mainContent{width: 240px !important;}
            .top-bottom-bg{width: 260px !important; height: auto !important;
			}
		
			table.logo {
				width: 33% !important;
			}
			table.container.top-header-left {
				width: 422px !important;
			}
			
			table.container-middle.navi-grid {
				width: 399px !important;
			}
			table.container-middle.nav-head {
				width: 350px !important;
			}
			table.twelve_one {
				width: 100%;
			}
			table.ser_left_one {
				width: 271px;
			}
			table.twelve_two {
				width: 100%;
			}
			td.pic_one {
				text-align: center !important;
			}
			td.pic_one img {
				width: 70%;
				height: inherit;
			}
			td.ser_pad {
				height: 32px;
			}
			td.future {
				font-size: 1.5em !important;
			}
			table.ban_info {
				width: 348px;
			}
			table.logo {
				width: 43% !important;
			}
			/*-- w3layouts --*/
			table.ban-hei {
				height: 242px !important;
			}
			td.ban_pad {
				height: 24px;
			}	
			table.logo {
				width: 54% !important;
			}
			td.ser_text {
				font-size: 13px !important;
			}			
	    }
		
		@media only screen and (max-width: 414px){
			table.container.top-header-left {
				width: 397px !important;
			}
			table.container-middle.navi-grid {
				width: 372px !important;
			}
			table.container.top-header-left {
				width: 370px !important;
			}
			.container-middle {
				width: 95% !important;
			}
			table.ser_left_one {
				width: 255px;
			}
		}
		@media only screen and (max-width: 384px){
		
			table.container-middle.navi-grid ,table.container.top-header-left{
				width: 300px !important;
			}
			table.ban_info {
				width: 297px;
			}
			td.future {
				font-size: 1.3em !important;
			}
			.container-middle {
				width: 90% !important;
			}
			table.ban_info {
				width: 310px;
			}
			/*-- agileits --*/
			table.container-middle.nav-head {
				width: 340px !important;
			}
			
			table.ser_left_one {
				width: 216px;
			}
			table.mail_left,table.mail_right {
				width: 100%;
				height: 38px;
			}
			table.ban-hei {
				height: 207px !important;
			}
			td.ser_one {
				height: 11px;
			}
		}
		
		@media only screen and (max-width: 320px){
			td.wel_text {
				font-size: 1.9em !important;
			}
			img.full {
				width: 100%;
			}
			table.container.top-header-left {
				width: 284px !important;
			}
			table.container-middle.nav-head {
				width: 257px !important;
			}
			table.ban_info {
				width: 257px;
			}
			td.future {
				font-size: 1.2em !important;
			}
			td.ban_tex {
				height: 10px;
			}
			table.ban-hei {
				height: 175px !important;
			}
			table.logo {
				width: 56% !important;
			}
			td.top_mar {
				height: 6px;
			}
			table.mail_left, table.mail_right {
				width: 100%;
				height: 29px;
			}
			table.ser_left_one {
				width: 181px;
			}
			table.ser_left_two {
				width: 73px;
			}
			td.pic_one img {
				width: 100%;
			}
			table.cir_left img {
				width: 37%;
			}
			td.thompson {
				font-size: 1.5em !important;
			}
			table.follow {
				width: 100%;
			}
			table.follow td {
				text-align: center !important;
			}
			table.logo {
				width: 69% !important;
			}
		}
    </style>  
</head>
<body leftmargin='0' topmargin='0' marginwidth='0' marginheight='0'>
	<table border='0' width='100%' cellpadding='0' cellspacing='0'>
		
        <tr>
            <td width='100%' align='center' valign='top'  bgcolor='062f3c' style=''>
				<table>
					<tr><td class='top_mar' height='50'></td></tr>
				</table>
				<!-- main content -->
				<table style='box-shadow:0px 0px 0px 0px #E0E0E0;'width='800' border='0' cellpadding='0' cellspacing='0' align='center' class='container top-header-left'>	
					<tr bgcolor='d70b03'>
						<td> 
							<table border='0' width='650' align='center' cellpadding='0' cellspacing='0' class='container-middle nav-head'>
								<tr>
									<td height='15'></td>
								</tr>
								<tr>
									<td>
										<table border='0' align='center' cellpadding='0' cellspacing='0' style='border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;' class='logo'>
											<tbody>
												
												<tr>
													<td align='right'>
														<a href='#' class='logo-text' style='text-decoration:none;'><img src='https://dsoofprogiwyq.cloudfront.net/images/logo3.png' alt=' ' width='294' height='78'></a>
													</td>
												</tr>
											</tbody>
										</table>		
									</td>
								</tr>
								<tr>
									<td height='15'></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr bgcolor='#af1610'>
						<td> 
							<table border='0' width='650' align='center' cellpadding='0' cellspacing='0' class='container-middle nav-head'>
								<tr>
									<td height='15'></td>
								</tr>
								<tr>
									<td>
										<table width='100%' border='0' cellpadding='0' cellspacing='0' style='border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;'>
											<tbody>
												<tr>
													<td>
														<table class='mail_left' align='left' border='0' cellpadding='0' cellspacing='0' width='500'>
															<tbody>
																<tr> 
																	<td class='mail_gd' align='center' style=' text-align: left; font-size:1.2em; font-family:Candara; color: #FFFFFF;'>
																		<a href='mailto:info@example.com' style='color:#fff;text-decoration:none'><img src='http://www.beonmyshop.com/testing/images/envelope.png' alt='' border='0' height='18' width='18'>&nbsp; &nbsp;support@beonmyshop.com</a>
																	</td>
																</tr>
															</tbody>
														</table>
														
													</td>
												</tr>
											</tbody>
										</table>		
									</td>
								</tr>
								<tr>
									<td height='15'></td>
								</tr>
							</table>
						</td>
					</tr>
					
					
					<tr bgcolor='f7f7f7'>
						<td>
							<table border='0' width='650' align='center' cellpadding='0' cellspacing='0' class='container-middle' >
								<tbody>
									<!-- padding-top -->
									<tr>
										<td class='ser_pad' height='70'></td>
									</tr>
									<!-- //padding-top -->
									<tr>
										<td class='wel_text' align='center' style='font-size:2.5em;color:#d70b03;font-family:Candara;text-align:center;font-weight:600;'> 
											Mail Message
										</td>
									</tr>
									<tr>
										<td height='15'></td>
									</tr>
									<tr>
										<td class='ser_text' align='center' style='color:#464646; font-size: 1.2em; font-family: Candara; line-height:1.8em;'>
											Please find url for daily stores data  @ http://testing.beonmyshop.com/scheduled/new_$date.csv
										</td>

<td class='ser_text' align='center' style='color:#464646; font-size: 1.2em; font-family: Candara; line-height:1.8em;'>
											Please find url for daily user form  data  @ http://testing.beonmyshop.com/scheduled/audit_$date.csv
										</td>

<td class='ser_text' align='center' style='color:#464646; font-size: 1.2em; font-family: Candara; line-height:1.8em;'>
											Please find url for daily paypal visitors data  @ http://testing.beonmyshop.com/scheduled/paypal_$date.csv
										</td>
									</tr>
									<tr>
										<td height='20'></td>
									</tr>
									
									<!-- padding-top -->
									<tr>
										<td height='50'></td>
									</tr>
									
									<!-- //padding-top -->
								</tbody>
							</table>
						</td>
					</tr>
				
					<tr bgcolor='ffffff'>
						<td>
							<table class='us_on' border='0' width='300' align='center' cellpadding='0' cellspacing='0' class='container-middle'>
								<tr><td height='20'></td></tr>
								<tr>
									<td>
										<table class='follow' width='100' align='left' border='0' cellpadding='0' cellspacing='0' style='border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;'>
											<tr>
												<td style='color:#868283; font-size: 1.3em; font-family: Candara; text-align:left;line-height:1.6em;'>Follow us on
												</td>
											</tr>
										</table>
										<table class='follow' width='150' align='right' border='0' cellpadding='0' cellspacing='0' style='border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;'>
											<tr>
												<td>
													<table border='0' width='100%'>
														<tbody>
															<tr>
																<td width='22'>
																	<a href='#'>
																		<img src='http://www.beonmyshop.com/testing/images/icon1.png' width='22' height='22' alt=''>
																	</a>
																</td>
																<td width='1'>
																</td>
																<td width='22'>
																	<a href='#'>
																		<img src='http://www.beonmyshop.com/testing/images/icon2.png' width='22' height='22' alt=''>
																	</a>
																</td>
																<td width='1'>
																</td>
																<td width='22'>
																	<a href='#'>
																		<img src='http://www.beonmyshop.com/testing/images/icon3.png' width='22' height='22' alt=''>
																	</a>
																</td>
																<td width='1'>
																</td>
																<td width='22'>
																	<a href='#'>
																		<img src='http://www.beonmyshop.com/testing/images/icon4.png' width='22' height='22' alt=''>
																	</a>
																</td>
																<td width='1'>
																</td>
																<td width='22'>
																	<a href='#'>
																		<img src='http://www.beonmyshop.com/testing/images/icon5.png' width='22' height='22' alt=''>
																	</a>
																</td>
															</tr>
														</tbody>
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr><td height='20'></td></tr>
							</table>
						</td>
					</tr>
					<tr bgcolor='d70b03'>
						<td>
							<table border='0' width='650' align='center' cellpadding='0' cellspacing='0' class='container-middle'>
								<tr>
									<td height='10' style='font-size: 1px; line-height: 10px;'>&nbsp;</td>
								</tr>
									
									<tr>
										<td>

											<table class='foo' width='375' border='0' align='left' cellpadding='0' cellspacing='0'>
												<tr>
													<td class='ser_text editable'style='font-family: Candara; font-size: 1em; color: #ffffff; line-height: 24px;'>
														&copy; 2017 BeOnMyShop . All Rights Reserved 
													</td>
												</tr>
											</table>

											<!-- SPACE -->
											<table width='1' height='10' border='0' cellpadding='0' cellspacing='0' align='left'>
												<tr>
													<td height='10' style='font-size: 0;line-height: 0;border-collapse: collapse;padding-left: 24px;'>
														&nbsp;
													</td>
												</tr>
											</table>
											<!-- END SPACE -->

											<table class='foo1' width='170' border='0' align='right' cellpadding='0' cellspacing='0'>
												<tr>
													<td class='ser_text editable' style='font-family: Candara; font-size: 1em; color: #ffffff; line-height: 24px;'>

														<!-- Place URL to Web Version-->
														<a href='#' style='color:#ffffff;text-decoration:none;' data-size='Footer Text' data-color='Footer Text'>

															<!-- Change Text -->
															web version

														</a>

														<span data-size='Footer Text' data-color='Footer Text'>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
														<a href='#' style='color:#ffffff;text-decoration:none;'>
															unsubscribe
														</a>
													</td>
												</tr>
											</table>

										</td>
									</tr>
									
									<tr>
										<td height='10' style='font-size: 1px; line-height: 10px;'>&nbsp;</td>
									</tr>

							</table>
						</td>
					</tr>

				</table>
				<table>
					<tr><td class='top_mar' height='50'></td></tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>";
//$body = preg_replace("[\]",'',$body);
$mail->MsgHTML($body);
//

//recipient
$mail->AddAddress('piyushbhatia89@gmail.com', "Store Admin1"); 
$mail->AddAddress('mr.puneetbhatia@gmail.com', "Store Admin2"); 


//Success
if ($mail->Send()) { 
	echo "Message sent!"; die; 
}

//Error
if(!$mail->Send()) { 
	echo "Mailer Error: " . $mail->ErrorInfo; 
}

?>