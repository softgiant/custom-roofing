<?php
	include_once '../includes/functionClass.php';
	session_start();

	$obj = new User();
	if (!$obj->get_session())
	{
	   header("location:index.php");
	}
	
	/*if($_GET['mode'] == 'C' || $_GET['mode'] == 'O')
	{
		$table = CONTACT_US;
	}*/
	//elseif($_GET['mode'] == 't'){
	//	$table = CONTACT_TIRE;
	//}
	$table = CONTACT_US;
	
	$messDetails=$obj->runSql("SELECT * FROM ".$table." WHERE `id` = ".$_GET['MessID']);
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title><?PHP echo(ADMIN_TITLE);?></title>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<style type="text/css">
		.home_text {
			font-family:arial;
			color:#FFF;
			font-size:16px; 
			line-height:21px; 
			font-weight:bold; 
			font-style:normal;
		}
		.big_text {
			font-family:arial;
			color:#000;
			font-size:13px; 
			line-height:15px; 
			font-weight:bold; 
			font-style:normal;
		}
		.small_text {
			font-family:arial;
			color:#000;
			font-size:12px; 
			line-height:15px; 
			font-weight:normal; 
			font-style:normal;
		}
	</style>
</head>
<body style="margin:0px;background-color:#FFF">
  
	<table border="1" cellpadding="4" cellspacing="3" style="border-collapse: collapse;border:solid 1px #dddddd" bordercolor="#dddddd"  width="100%"  height="1">
		<tr>
		  <td width="100%" colspan="3" height="38" bgcolor="#404040" class="home_text">&nbsp;&nbsp; CONTACT MESSAGE DETAILS</td>
		</tr>
		<tr>
		  <td width="100%" colspan="3" class="home_text">&nbsp;</td>
		</tr>		
		<tr style="background-color: #f9f9f9;">
		  <td width="100%" align="left" class="big_text">Name: &nbsp;<span class="small_text"><?PHP echo $messDetails['name']; ?></span></td>
		</tr>
		<tr>
		  <td align="left" class="big_text">E-mail address: &nbsp;<span class="small_text"><?PHP echo $messDetails['email']; ?></span></td>
		</tr>
		<tr style="background-color: #f9f9f9;">
		  <td align="left" class="big_text">Phone Number: &nbsp;<span class="small_text"><?PHP echo $messDetails['phone']; ?></span></td>
		</tr>	
		<tr style="background-color: #f9f9f9;">
		  <td width="100%" align="left" class="big_text">Sender Website IP: &nbsp;<span class="small_text"><?PHP echo $messDetails['clint_ip']; ?></span></td>
		</tr>
		<tr>
		  <td align="left" class="big_text">Date: &nbsp;<span class="small_text"><?PHP echo $messDetails['post_date']; ?></span></td>
		</tr>
		<tr style="background-color: #f9f9f9;">
		  <td align="left" class="big_text">Message/Command: &nbsp;<span class="small_text"><?PHP echo nl2br($messDetails['message']); ?></span></td>
		</tr>
	  </table>
  
</body>
</html>
