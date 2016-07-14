<?php
	include_once '../includes/functionClass.php';
	session_start();

	$obj = new User();
	if (!$obj->get_session())
	{
	   header("location:index.php");
	}
	if(!isset($msg)){$msg = '';}

	/*if($_GET['mode'] == 'C' || $_GET['mode'] == 'O')
	{*/
		$table = CONTACT_US;
		$Sub = 'Reply Message for Contact Us';
		$messDetails=$obj->runSql("SELECT * FROM ".$table." WHERE `id` = ".$_GET['MessID']);
		$name = $messDetails['name'];
	/*}
	else if($_GET['mode'] == 't')
	{
		$table = CONTACT_TIRE;
		$Sub = 'Reply Message for Find the Tires thats Right for you ';
		$messDetails=$obj->runSql("SELECT * FROM ".$table." WHERE `id` = ".$_GET['MessID']);
		$name = $messDetails['tname'];
	}*/

	if(isset($_POST['btnReply']))
	{
		$mail_subject = $Sub;
		$mailBody = '<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="border: solid 1px #1C1C1C">					
						<tr>
						  <td align="left" valign="middle" width="100%" style="background-color:#FFFFFF;padding:0px; border-bottom: solid 5px #633A14"><img src="'.ADMIN_SITE_URL.'img/logo.png"></td>
						</tr>
						<tr>
						  <td align="center" height="10" width="100%">&nbsp;</td>
						</tr>
						<tr>
						  <td align="center">
						   <table width="90%" border="0" align="center" cellpadding="0" cellspacing="4">
							 <tr>
							   <td align="left" colspan="2" width="100%" height="25" style="font-family: Arial;font-size:13px;color:#000000;"><b>Hi '.ucfirst($name).'</b>,</td>
							 </tr>
							 <tr>
							   <td align="right" width="5%">&nbsp;</td>
							   <td align="left" width="95%" style="font-family: Arial;font-size:13px;color:#69676A;">'.nl2br($_POST['txtMessage']).'</td>
							 </tr>
							 <tr>
							   <td align="left" colspan="2" width="100%" height="25" style="font-family: Arial;font-size:13px;color:#000000;"><b>Thanks,<br/>Administrator</b></td>
							 </tr>
						   </table>
						  </td>
						</tr>
						<tr>
						  <td align="center" height="10" width="100%">&nbsp;</td>
						</tr>
						<tr>
						  <td align="center" width="100%" height="25" style="background-color:#4E4E4E;font-family:arial;font-size:11px;color:#FFFFFF">Douglas Brown Associates &copy; '.date('Y').'</td>
						</tr>
					  </table>';

		$mail_to = $messDetails['email'];

		$headers  = "MIME-Version: 1.0\r\n";
		$headers.= "Content-type: text/html; charset=UTF-8\r\n";
		$headers.= "From: Douglas Brown Associates<info@douglasbrownassociates.co.uk>\r\n";
		$headers.= "X-Sender: <www.douglasbrownassociates.co.uk> \n";

		/*echo "Mail To: ".$mail_to.'<br/>';
		echo "Mail Subject: ".$mail_subject.'<br/>';
		echo "Mail Body: ".$mailBody.'<br/>';*/
		
		@mail($mail_to,$mail_subject,$mailBody,$headers);

		$msg = "<font color='#267D07'><img src='img/ok.png'>&nbsp;Your e-mail sent successfully.</font>";
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title><?PHP echo(ADMIN_TITLE);?></title>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<link type="text/css" rel="stylesheet" href="css/style.css">
<style type="text/css">	
.button{
	border: solid 0px #69CCEB; 
	font-family:Arial, Helvetica, sans-serif;
	font-size:13px;
	font-weight:bold;
	color:#FFFFFF;
	width:60px;
	height:30px;
	background-color:#F10F24;
	cursor:pointer;
}
.button:hover{
	border: solid 0px #69CCEB; 
	font-family:Arial, Helvetica, sans-serif;
	font-size:13px;
	font-weight:bold;
	color:#fff;
	width:60px;
	height:30px;
	background-color:#F10F24;
	cursor:pointer;
}	
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
<script type="text/javascript">
<!--
	function doCheck()
	{
		if(document.frm.txtMessage.value=="")
		{
			alert("Please Enter Your Message.");
			document.frm.txtMessage.focus();
			return false;
		}
		else
		{
			return true;
		}
	}
//-->
</script>
</head>
<body style="margin:0px;background-color:#FFF">
  <form name="frm" method="post" action="">
	 <table border="1" cellpadding="4" cellspacing="3" style="border-collapse: collapse;border:solid 1px #dddddd" bordercolor="#dddddd"  width="100%"  height="1">
		<tr>
		  <td width="100%" height="38" bgcolor="#404040" class="home_text">&nbsp;&nbsp;&nbsp;REPLY MESSAGE</td>
		</tr>
		<tr>
		  <td width="100%" class="big_text" align="center" style="font-family:arial;font-weight:normal;font-size:15px;color:#267D07;padding-left:5px;"><?php if(isset($msg) && $msg!=''){ echo $msg; } ;?></td>
		</tr>
		<tr style="background-color: #f9f9f9;">
		  <td align="left" class="big_text">Name: &nbsp;<span class="small_text"><?PHP echo $name; ?></span></td>
		</tr>
		<tr>
		  <td align="left" class="big_text">Email Address: &nbsp;<span class="small_text"><?PHP echo $messDetails['email']; ?></span></td>
		</tr>
		<tr style="background-color: #f9f9f9;">
		  <td align="left" class="big_text">Message:<br/><textarea name="txtMessage" rows="7" cols="20" style="width: 90%;border: solid 1px #dddddd;"><?PHP echo $_POST['txtMessage']; ?></textarea></td>
		</tr>
		<tr>
		  <td align="left"><input type="submit" value="SEND" name="btnReply" class="button" onclick="return doCheck();"></td>
		</tr>
	  </table>
  </form>
</body>
</html>
