<?PHP    error_reporting(0);	
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
						`phone` = ".(($_POST['txtPhone'] == "")?"NULL":"'".realStrip($_POST['txtPhone'])."'").",						`joblocation` = ".(($_POST['txtlocation'] == "")?"NULL":"'".realStrip($_POST['txtlocation'])."'").",						
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
								 </tr>								 								 <tr>								   <td align="right" width="25%">Job Location: &nbsp; </td>								   <td align="left" width="74%" style="font-family: Arial;font-size:13px;color:#69676A;">'.$_POST['txtlocation'].'</td>								 </tr>
								 
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
		$phone = $_POST['txtPhone'];		$joblocation = $_POST['txtlocation'];
		$description = $_POST['txtmessage'];
		//$enquery = $_POST['txtEnquery'];
        $msg = '<span style="color:red;"><b>Captcha verification is wrong. Take other action</b></span>';	
    }
}
?><?php $Ouraddress = $obj->runSql("SELECT * FROM ".CMS_MASTER." WHERE `id`='14'"); ?><!doctype html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1" /><title><?PHP echo ($page_content['meta_title']!='' ?  $page_content['meta_title'] : FRONTEND_TITLE); ?></title><meta name="description" content="<?PHP echo $page_content['meta_description']; ?>"><!--====== JS File ======--><script type="text/javascript" src="<?PHP echo DOMAIN_NAME; ?>js/jquery.1.11.2.min.js"></script><script type="text/javascript" src="<?PHP echo DOMAIN_NAME; ?>js/jquery.flexslider-min.js"></script><script type="text/javascript" src="<?PHP echo DOMAIN_NAME; ?>js/html5shiv.js"></script><script type="text/javascript" src="<?PHP echo DOMAIN_NAME; ?>js/respond.min.js"></script><script>      $(window).load(function() {		$('.flexslider').flexslider({		  animation: "slide",		  controlNav: false		});	  });	  $(document).ready(function() {		 $('.mob-nav').click(function(){		   $('.nav').slideToggle();			  		 });		 		 //====== Roofing Services Image Modal ======// 		 $('a.imgModal').click(function(){			 var imgSrc = $(this).children('img').attr('src'); //console.log(imgSrc);			 $('.customModal').css({display:'block'});			 $('.customModal').animate({opacity:1},400);			 setTimeout(function(){				 $('.customModal').children('.modalContainer').children('img').attr('src', imgSrc);				 $('.customModal').children('.modalContainer').css('transform','scale(1)');			 },300);			 $('.crossBtn').click(function(){				  $('.customModal').children('.modalContainer').css('transform','scale(0)');				 setTimeout(function(){					 $('.customModal').animate({opacity:0},320);					 setTimeout(function(){					 	$('.customModal').css({display:'none'});				 	 },380);				 },280);			 });		 });	  });</script><!--====== CSS File ======--><link href="<?PHP echo DOMAIN_NAME; ?>css/font-awesome.css" rel="stylesheet"><link href="<?PHP echo DOMAIN_NAME; ?>css/style.css" rel="stylesheet"><link href="<?PHP echo DOMAIN_NAME; ?>css/responsive.css" rel="stylesheet"><link rel="shortcut icon" href="<?PHP echo DOMAIN_NAME; ?>images/favicon.ico" type="image/x-icon"><link rel="icon" href="<?PHP echo DOMAIN_NAME; ?>images/favicon.ico" type="image/x-icon"><script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script><script type="text/javascript">    $(document).ready(function(){        $('#submit').click(function(){												var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;            var name = $('#txtName').val();            var email = $('#txtemail').val();            var captcha = $('#captcha').val();                        if( name.length == 0){                $('#txtName').addClass('error');            }            else{                $('#txtName').removeClass('error');            }						if( email.length == 0){                $('#txtemail').addClass('error');            }            else{                $('#txtemail').removeClass('error');            }            if( captcha.length == 0){                $('#captcha').addClass('error');            }            else{                $('#captcha').removeClass('error');            }                        if(name.length != 0 && email.length != 0 && msg.length != 0 && captcha.length != 0){                return true;            }            return false;        });           });		function checkcontact_Email() {    var email = document.getElementById('txtemail');    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;    if (!filter.test(email.value)) {    alert('Please provide a valid email address');	email.value = '';    email.focus;    return false;    }}</script><style>#contactform .error{	border: 1px solid red !important;}</style></head><body> <?PHP include('includes/frontHeader.php'); ?><!--=== Nav Section End Here ===--><div class="top-heading">  <h2><?php echo $page_content['page_name'];?></h2>  <div class="bread">    <ul>      <li><a href="<?PHP echo DOMAIN_NAME; ?>">Home</a></li>      <li><span>/</span></li>      <li><?php echo $page_content['page_name'];?></li>    </ul>  </div>  <!--=== Bread End Here ===--> </div><div class="cont-sec clearfix">  <div class="contactMap">    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1184.7062290483184!2d-2.43429441884256!3d53.56825507564713!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x487ba7b300e87d1b%3A0x5cd1c0c40ed6c33a!2sThe+Trinity%2C+Bridgeman+St%2C+Bolton+BL3+6RS%2C+UK!5e0!3m2!1sen!2sin!4v1447399310617" width="100%" height="330" frameborder="0" style="border:0" allowfullscreen></iframe>  </div>  <div class="cont-sec-left inner">    <h3>Contact Form</h3>    <p>To request a free no-obligation quotation please complete the short enquiry form below and we will respond as quickly as possible</p>    <form name="contactform" id="contactform" method="post" action="" enctype="multipart/form-data" class="contactForm">  <?PHP echo($msg!='' ? '<h4>'.$msg.'</h4>' : ''); ?>  <div class="formField">        <input type="text" name="txtName" id="txtName" class="inputBox" placeholder="Name" value="<?PHP echo $name; ?>" required>	  </div>  <div class="formField">        <input type="text" name="txtemail" id="txtemail" class="inputBox" placeholder="Email" value="<?PHP echo $email; ?>" required>  </div>   <div class="formField">        <input name="txtPhone" type="text" value="<?PHP echo $phone; ?>" class="inputBox" placeholder="Phone">  </div>  <div class="formField">        <textarea name="txtlocation" class="inputTextarea" placeholder="Job Location"><?PHP echo $joblocation; ?></textarea>	  </div>  <div class="formField">        <textarea name="txtmessage" class="inputTextarea" placeholder="Description"><?PHP echo $description; ?></textarea>  </div>  <div class="contct_fld_area">                          <div class="fldd_rgt">                            <label>Please type the characters from the image below into the text field</label>                            <input type="text" name="captcha" id="captcha" required  placeholder="Enter the below characters">                            <div class="captcha"><img src="<?PHP echo DOMAIN_NAME; ?>captcha.php" width="144" height="49" alt=""></div>                          </div>                        </div>  <button type="submit" class="sendMessageBtn" id="submit">Send Message</button>  </form>              </div>  <!--=== Cont Section Left End Here ===-->  <div class="cont-sec-right">    <h2>Contact Information</h2>     <?php echo $Ouraddress['desc']; ?>  </div>  <!--=== Content Section Right End Here ===--> </div><!--=== Content Section End Here ===--><?PHP include('includes/frontFooter.php'); ?>              