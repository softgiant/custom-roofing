<?PHP
	include_once '../includes/functionClass.php';
	session_start();	error_reporting(0);

    $obj = new User();

	if (!$obj->get_session())
	{
	   header("location:index.php");
	}

/*=========== UPDATE QUERY START ===========*/
	if(isset($_POST['btnSubmit']))
	{	
		$table = SOCIAL_MEDIA;
		$fieldsValue = "`facebook` = '".realStrip($_POST['txtFacebook'])."',		`twitter` = '".realStrip($_POST['txtTwitter'])."',			`google` = '".realStrip($_POST['txtGoogle'])."',		`pinterest` = '".realStrip($_POST['txtPinterest'])."', 		`phone` = '".realStrip($_POST['phone'])."', 		`mobile` = '".realStrip($_POST['mobile'])."', 		`email` = '".realStrip($_POST['email'])."', 		`youtube` = '".realStrip($_POST['txtYoutube'])."'";

		$WhereClause = "`id` = 1";

		$obj->AddEditQuery($table,$fieldsValue,$WhereClause);

		$msg = "<font color='green'>Your profile has been updated successfully.</font>";
	}
/*=========== UPDATE QUERY END ===========*/

/*=========== SELECT QUERY START ===========*/
	$adminVal=$obj->runSql("SELECT * FROM ".SOCIAL_MEDIA." WHERE id = 1");
/*=========== SELECT QUERY END ===========*/
?>
<!DOCTYPE html>
<html lang="en-us" class="smart-style-3">
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

<script type="text/javascript">
<!--
	function show_you(id)
	{
		document.frm.action='slideShow.php?Show='+id;
		document.frm.submit();
	}
	function del(uid,page)
	{
		if(confirm('Are you sure to delete the slide show image?'))
		{
		   document.frm.action='slideShow.php?mode=del&id='+uid+'&page='+page;
		   document.frm.submit();
		}
	}
//-->
</script>
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
  <div id="ribbon"> <span class="ribbon-button-alignment"> <span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true"> <i class="fa fa-refresh"></i> </span> </span>
    <ol class="breadcrumb">
      <li>Home</li>
      <li>Social Media</li>
    </ol>
  </div>
  <div id="content">
    <section id="widget-grid" class="">
      <div class="row">
		  <article class="col-sm-12 col-md-12 col-lg-6">
			<div class="jarviswidget" id="wid-id-4" data-widget-editbutton="false" data-widget-custombutton="false">
			  <header> <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
				<h2>Social Media Link</h2>
			  </header>
			  <div>
				<div class="jarviswidget-editbox"></div>
				<div class="widget-body no-padding">
				  <form id="smart-form-register" class="smart-form" name="frm" method="POST" action="" enctype="multipart/form-data">
					<header><span style="font-size:11px;"><?php if(isset($msg) && $msg!=''){ echo $msg; } ;?></span></header>
					<fieldset>
                  
					  <section>
						<label class="input"> <i class="icon-append fa fa-facebook"></i>
						  <input type="text" name="txtFacebook" value="<?php echo $adminVal['facebook']; ?>" placeholder="Facebook">
						  <b class="tooltip tooltip-bottom-right">Needed to enter the facebook URL</b> </label>
					  </section>
					  <section>
						<label class="input"> <i class="icon-append fa fa-twitter"></i>
						  <input type="text" name="txtTwitter" value="<?php echo $adminVal['twitter']; ?>" placeholder="Twitter">
						  <b class="tooltip tooltip-bottom-right">Needed to enter the twitter URL</b> </label>
					  </section>					  					  <section>						<label class="input"> <i class="icon-append fa fa-youtube"></i>						  <input type="text" name="txtYoutube" value="<?php echo $adminVal['youtube']; ?>" placeholder="Youtube">						  <b class="tooltip tooltip-bottom-right">Needed to enter the youtube URL</b> </label>					  </section>						<section>						<label class="input"> <i class="icon-append fa fa-phone"></i>						  <input type="text" name="phone" value="<?php echo $adminVal['phone']; ?>" placeholder="Phone">						  <b class="tooltip tooltip-bottom-right">Phone</b> </label>					  </section>					  <section>						<label class="input"> <i class="icon-append fa fa-mobile"></i>						  <input type="text" name="mobile" value="<?php echo $adminVal['mobile']; ?>" placeholder="Mobile">						  <b class="tooltip tooltip-bottom-right">Mobile</b> </label>					  </section>					  <section>						<label class="input"> <i class="icon-append fa fa-envelope"></i>						  <input type="email" name="email" value="<?php echo $adminVal['email']; ?>" placeholder="Email">						  <b class="tooltip tooltip-bottom-right">Email</b> </label>					  </section>
					  <!--<section>
						<label class="input"> <i class="icon-append fa fa-print"></i>
						  <input type="text" name="txtPinterest" value="<?php #echo $adminVal['pinterest']; ?>" placeholder="Pinterest">
						  <b class="tooltip tooltip-bottom-right">Needed to enter the pinterest URL</b> </label>
					  </section>
                      <section>
						<label class="input"> <i class="icon-append fa fa-google"></i>
						  <input type="text" name="txtGoogle" value="<?php #echo $adminVal['google']; ?>" placeholder="Google">
						  <b class="tooltip tooltip-bottom-right">Needed to enter the google URL</b> </label>
					  </section>-->					  

					</fieldset>
					<footer><input type="submit" name="btnSubmit" value="SAVE" class="btn btn-danger"></footer>
				  </form>
				</div>
			  </div>
			</div>
		  </article>

      </div>
    </section>
  </div>
</div>
<!-- ######### BODY END ############### -->

<!-- ######### FOOTER START ############### -->
	<?PHP include_once("../includes/adminFooter.php"); ?>
<!-- ######### FOOTER END ############### -->

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

<!-- PAGE RELATED PLUGIN(S) -->
<script src="js/plugin/jquery-form/jquery-form.min.js"></script>
<script type="text/javascript">		
	$(document).ready(function() {
		
		pageSetUp();					
		var $registerForm = $("#smart-form-register").validate({
			rules : {
				txtFacebook : {
					required : true
				},
				txtTwitter : {
					required : true
				},
				txtGoogle : {
					required : true
				},
				txtPinterest : {
					required : true
				}
			},
			errorPlacement : function(error, element) {
				error.insertAfter(element.parent());
			}
		});		
	})
</script>

<!-- PAGE RELATED PLUGIN(S) -->
<script src="js/plugin/datatables/jquery.dataTables.min.js"></script>
<script src="js/plugin/datatables/dataTables.colVis.min.js"></script>
<script src="js/plugin/datatables/dataTables.tableTools.min.js"></script>
<script src="js/plugin/datatables/dataTables.bootstrap.min.js"></script>
<script src="js/plugin/datatable-responsive/datatables.responsive.min.js"></script>
<script type="text/javascript">				
	$(document).ready(function() {
		
		pageSetUp();
		var responsiveHelper_dt_basic = undefined;
		
		var breakpointDefinition = {
			tablet : 1024,
			phone : 480
		};

		$('#dt_basic').dataTable({
			"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
				"t"+
				"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
			"autoWidth" : true,
			"preDrawCallback" : function() {
				// Initialize the responsive datatables helper once.
				if (!responsiveHelper_dt_basic) {
					responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dt_basic'), breakpointDefinition);
				}
			},
			"rowCallback" : function(nRow) {
				responsiveHelper_dt_basic.createExpandIcon(nRow);
			},
			"drawCallback" : function(oSettings) {
				responsiveHelper_dt_basic.respond();
			}
		});			
	})
</script>
</body>
</html>