<?PHP
	if(isset($get_page[$pj]) && $get_page[$pj]!='') 	header("location:".DOMAIN_NAME.ERROR_PAGE);
	
	if(isset($get_page[$pi]) && $get_page[$pi]!='' && preg_match('/^[a-zA-Z0-9-]+$/', $get_page[$pi])){
		$page_content=$obj->runSql("SELECT * FROM ".CMS_MASTER." WHERE `status`='Y' AND `url_title` = '".realStrip($get_page[$pi])."'");
	}else{
		$page_content=$obj->runSql("SELECT * FROM ".CMS_MASTER." WHERE `status`='Y' AND `url_title` = '".realStrip($get_page[$pn])."'");
	}
	if(!$page_content) header("location:".DOMAIN_NAME.ERROR_PAGE);
	
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['captcha'] == $_SESSION['cap_code']) {
		
        // Captcha verification is Correct. Do something here!
		function get_client_ip() {
			$ipaddress = '';
			if ($_SERVER['HTTP_CLIENT_IP'])
				$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
			else if($_SERVER['HTTP_X_FORWARDED_FOR'])
				$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
			else if($_SERVER['HTTP_X_FORWARDED'])
				$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
			else if($_SERVER['HTTP_FORWARDED_FOR'])
				$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
			else if($_SERVER['HTTP_FORWARDED'])
				$ipaddress = $_SERVER['HTTP_FORWARDED'];
			else if($_SERVER['REMOTE_ADDR'])
				$ipaddress = $_SERVER['REMOTE_ADDR'];
			else
				$ipaddress = 'UNKNOWN';
			return $ipaddress;
		}

		$table = CONTACT_US;
		$fieldsValue = "`name` = ".(($_POST['txtName'] == "")?"NULL":"'".realStrip($_POST['txtName'])."'").",
						`email` = ".(($_POST['txtemail'] == "")?"NULL":"'".realStrip($_POST['txtemail'])."'").",
						`phone` = ".(($_POST['txtPhone'] == "")?"NULL":"'".realStrip($_POST['txtPhone'])."'").",
						`clint_ip` = ".(($ipaddress == "")?"NULL":"'".realStrip($ipaddress)."'").",
						`message` = ".(($_POST['txtmessage'] == "")?"NULL":"'".realStrip($_POST['txtmessage'])."'");
		
		$WhereClause = "";
		$add_member = $obj->AddEditQuery($table,$fieldsValue,$WhereClause);
		
			
			$Admin_imail=$obj->runSql("SELECT * FROM ".ADMIN_MASTER." WHERE `id`='1'");
			
			$mail_subject = "Contact-us information from Andy T. Young Builders";
			$mailBody = '<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="border: solid 1px #01909F">					
							<tr>
							  <td align="left" valign="middle" width="100%" style="background-color:#FFFFFF;padding:0px; border-bottom: solid 5px #01909F"><img src="'.DOMAIN_NAME.'images/logo-main.png" style="margin-bottom:5px;"></td>
							</tr>
							<tr>
							  <td align="center" height="10" width="100%">&nbsp;</td>
							</tr>
							<tr>
							  <td align="center">
							   <table width="90%" border="0" align="center" cellpadding="0" cellspacing="4">
								 <tr>
								   <td align="left" colspan="2" width="100%" height="25" style="font-family: Arial;font-size:13px;color:#000000;"><b>Dear Administrator</b>,</td>
								 </tr>
								 <tr>
								   <td align="right" width="25%">Name: &nbsp; </td>
								   <td align="left" width="74%" style="font-family: Arial;font-size:13px;color:#69676A;">'.$_POST['txtName'].'</td>
								 </tr>
								 <tr>
								   <td align="right" width="25%">E-mail Address: &nbsp; </td>
								   <td align="left" width="74%" style="font-family: Arial;font-size:13px;color:#69676A;">'.$_POST['txtemail'].'</td>
								 </tr>
								 <tr>
								   <td align="right" width="25%">Phone Number: &nbsp; </td>
								   <td align="left" width="74%" style="font-family: Arial;font-size:13px;color:#69676A;">'.$_POST['txtPhone'].'</td>
								 </tr>
								 
								 <tr>
								   <td align="right" width="25%">Comments/description: &nbsp; </td>
								   <td align="left" width="74%" style="font-family: Arial;font-size:13px;color:#69676A;">'.$_POST['txtmessage'].'</td>
								 </tr>
								 <tr>
								   <td align="left" colspan="2" width="100%" height="25" style="font-family: Arial;font-size:13px;color:#000000;"><b>Thanks,<br/>'.$_POST['txtName'].'</b></td>
								 </tr>
							   </table>
							  </td>
							</tr>
							<tr>
							  <td align="center" height="10" width="100%">&nbsp;</td>
							</tr>
							<tr>
							  <td align="center" width="100%" height="25" style="background-color:#01909F;font-family:arial;font-size:11px;color:#FFFFFF">Bolton Cancer Voices &copy; '.date('Y').'</td>
							</tr>
						  </table>';
	
			$mail_to = $Admin_imail['email'];
	
			$headers  = "MIME-Version: 1.0\r\n";
			$headers.= "Content-type: text/html; charset=UTF-8\r\n";
			$headers.= "From: Andy<russel.crow100@gmail.com <russel.crow100@gmail.com>\r\n";
			$headers.= "X-Sender: <http://192.168.1.12/teamD/rajiv/andy/> \n";
	
			/*echo "Mail To: ".$mail_to.'<br/>';
			echo "Mail Subject: ".$mail_subject.'<br/>';
			echo "Mail Body: ".$mailBody.'<br/>';*/
			
			@mail($mail_to,$mail_subject,$mailBody,$headers);		
		
		
		$msg = '<span style="color:green;"><b>Thank you, we have received your enquiry.</b></span>';	
		
    } else {
        // Captcha verification is wrong. Take other action		
		$name = $_POST['txtName'];
		$email = $_POST['txtemail'];
		$phone = $_POST['txtPhone'];
		$description = $_POST['txtmessage'];
		//$enquery = $_POST['txtEnquery'];
        $msg = '<span style="color:red;"><b>Captcha verification is wrong. Take other action</b></span>';	
    }
}
?>