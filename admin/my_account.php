<?PHP
	include_once '../includes/functionClass.php';
	session_start();

    $obj = new User();

	if (!$obj->get_session())
	{
	   header("location:index.php");
	}

/*=========== UPDATE QUERY START ===========*/
	if(isset($_POST['btnSubmit']))
	{	
		if($_POST['txtUsername']!='')
		{
			if($_POST['txtNewPassword']==$_POST['txtConfirmPassword'])
			{
				$password=isset($_POST['txtNewPassword']) && $_POST['txtNewPassword'] != "" ? stripslashes(trim($_POST['txtNewPassword'])) : $_POST['hidPassword']; 

				$table = ADMIN_MASTER; 
				$fieldsValue = "`username` = '".realStrip($_POST['txtUsername'])."',	
								`paypal` = '".realStrip($_POST['txtPaypal'])."',
								`password` = '".realStrip($password)."',
								`email` = '".realStrip($_POST['txtEmail'])."'";

				$WhereClause = "`id` = 1";

				$obj->AddEditQuery($table,$fieldsValue,$WhereClause);

				$msg = "<font color='green'>Your Profile Has Been Updated Successfully.</font>";
			}
			else
			{
				$msg = "<font color='#ff0000'>Confirm Password Does Not Match With New Password.</font>";
			}
		}
		else
		{
			$msg = "<font color='#ff0000'>Please Enter Username.</font>";
		}
	}
/*=========== UPDATE QUERY END ===========*/

/*=========== SELECT QUERY START ===========*/
	$adminVal=$obj->runSql("SELECT * FROM ".ADMIN_MASTER." WHERE id = ".$_SESSION['USER_ID']);
/*=========== SELECT QUERY END ===========*/
?>
<!DOCTYPE html>
<html lang="en-us" class="smart-style-3" lang="en-us" >
<head>
<meta charset="utf-8">
<title><?PHP echo ADMIN_TITLE; ?></title>
<meta name="description" content="">
<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/smartadmin-production.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/smartadmin-skins.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/demo.min.css">
<link rel="shortcut icon" href="img/favicon/favicon.ico" type="image/x-icon">
<link rel="icon" href="img/favicon/favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

</head>
<body>

<!-- ######### HEADER START ############### -->
	<?PHP include_once("../includes/adminHeader.php"); ?>
<!-- ######### HEADER END ############### -->

<!-- ######### HEADER START ############### -->
	<?PHP include_once("../includes/adminMenu.php"); ?>
<!-- ######### HEADER END ############### -->

<!-- ######### BODY START ############### -->
<div id="main" role="main">
  <div id="ribbon"><span class="ribbon-button-alignment"> <span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true"> <i class="fa fa-refresh"></i></span></span>
    <ol class="breadcrumb">
      <li>Home</li>
      <li>Dashboard</li>
    </ol>
  </div>
  <div id="content">
    <div class="row">
      <article class="col-sm-12 col-md-12 col-lg-6">
        <div class="jarviswidget" id="wid-id-4" data-widget-editbutton="false" data-widget-custombutton="false">
          <header> <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
            <h2>Manage Your Account Settings</h2>
          </header>
          <div>
            <div class="jarviswidget-editbox"></div>
            <div class="widget-body no-padding">
              <form id="smart-form-register" class="smart-form" method="post">
                <header> My Profile  &nbsp;&nbsp;&nbsp;<span style="font-size:11px;"><?php if(isset($msg) && $msg!=''){ echo $msg; } ;?></span></header>
                <fieldset>
                  <section>
                    <label class="input"> <i class="icon-append fa fa-user"></i>
                      <input type="text" name="txtUsername" value="<?php echo(isset($_POST['txtUsername']) && $_POST['txtUsername']!='' ? $_POST['txtUsername'] : $adminVal['username']);?>" placeholder="Username">
                      <b class="tooltip tooltip-bottom-right">Needed to enter the username</b> </label>
                  </section>
                  <section>
                    <label class="input"> <i class="icon-append fa fa-envelope-o"></i>
                      <input type="email" name="txtEmail" value="<?PHP echo($adminVal['email']); ?>" placeholder="Email address">
                      <b class="tooltip tooltip-bottom-right">Needed to verify your email address</b> </label>
                  </section>
                  <section>
                    <label class="input"> <i class="icon-append fa fa-envelope-o"></i>
                      <input type="email" name="txtPaypal" value="<?PHP echo($adminVal['paypal']); ?>" placeholder="Email address">
                      <b class="tooltip tooltip-bottom-right">Needed to verify your Paypal email address</b> </label>
                  </section>
                  <section>
                    <label class="input"> <i class="icon-append fa fa-lock"></i>
                      <input type="password" name="txtNewPassword" placeholder="New Password" id="password"><input type="hidden" name="hidPassword" value="<?PHP echo($adminVal['password']); ?>">
                      <b class="tooltip tooltip-bottom-right">Don't forget your password</b> </label>
                  </section>
                  <section>
                    <label class="input"> <i class="icon-append fa fa-lock"></i>
                      <input type="password" name="txtConfirmPassword" placeholder="Confirm Password">
                      <b class="tooltip tooltip-bottom-right">Don't forget your password</b> </label>
                  </section>
                </fieldset>
                <footer>
                  <input type="submit" name="btnSubmit" value="SAVE" class="btn btn-danger" onClick="return docheck();">
                </footer>
              </form>
            </div>
          </div>
        </div>
      </article>
    </div>
  </div>
</div>
<!-- ######### BODY END ############### -->

<!-- ######### FOOTER START ############### -->
	<?PHP include_once("../includes/adminFooter.php"); ?>
<!-- ######### FOOTER END ############### -->

<!-- END PAGE FOOTER -->
<!-- END SHORTCUT AREA -->
<!--================================================== -->
<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
<script data-pace-options='{ "restartOnRequestAfter": true }' src="js/plugin/pace/pace.min.js"></script>
<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<script>
			if (!window.jQuery) {
				document.write('<script src="js/libs/jquery-2.0.2.min.js"><\/script>');
			}
		</script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script>
			if (!window.jQuery.ui) {
				document.write('<script src="js/libs/jquery-ui-1.10.3.min.js"><\/script>');
			}
		</script>
<!-- IMPORTANT: APP CONFIG -->
<script src="js/app.config.js"></script>
<!-- CUSTOM NOTIFICATION -->
<script src="js/notification/SmartNotification.min.js"></script>
<!-- BOOTSTRAP JS -->
<script src="js/bootstrap/bootstrap.min.js"></script>
<!-- JQUERY VALIDATE -->
<script src="js/plugin/jquery-validate/jquery.validate.min.js"></script>
<!-- JQUERY MASKED INPUT -->
<script src="js/plugin/masked-input/jquery.maskedinput.min.js"></script>
<!-- JQUERY SELECT2 INPUT -->
<script src="js/plugin/select2/select2.min.js"></script>
<!-- JQUERY UI + Bootstrap Slider -->
<script src="js/plugin/bootstrap-slider/bootstrap-slider.min.js"></script>
<!-- browser msie issue fix -->
<script src="js/plugin/msie-fix/jquery.mb.browser.min.js"></script>
<!-- FastClick: For mobile devices -->
<script src="js/plugin/fastclick/fastclick.min.js"></script>
<!-- MAIN APP JS FILE -->
<script src="js/app.min.js"></script>
<!-- ENHANCEMENT PLUGINS : NOT A REQUIREMENT -->
<!-- PAGE RELATED PLUGIN(S) -->
<script src="js/plugin/jquery-form/jquery-form.min.js"></script>
<script type="text/javascript">
		
		// DO NOT REMOVE : GLOBAL FUNCTIONS!
		
		$(document).ready(function() {
			
			pageSetUp();
					
			var $registerForm = $("#smart-form-register").validate({
	
				// Rules for form validation
				rules : {
					txtUsername : {
						required : true
					},
					txtEmail : {
						required : true,
						email : true
					},
					txtPaypal : {
						required : true,
						email : true
					},
					txtNewPassword : {
						required : true,
						minlength : 3,
						maxlength : 20
					},
					txtConfirmPassword : {
						required : true,
						minlength : 3,
						maxlength : 20,
						equalTo : '#password'
					}
				},
	
				// Messages for form validation
				messages : {
					email : {
						required : 'Please enter your email address',
						email : 'Please enter a VALID email address'
					},
					txtPaypal : {
						required : 'Please enter your Paypal Account ID',
						email : 'Please enter a VALID email address'
					},
					password : {
						required : 'Please enter your password'
					},
					passwordConfirm : {
						required : 'Please enter your password one more time',
						equalTo : 'Please enter the same password as above'
					}
				},
	
				// Do not change code below
				errorPlacement : function(error, element) {
					error.insertAfter(element.parent());
				}
			});		
		})

		</script>
</body>
</html>