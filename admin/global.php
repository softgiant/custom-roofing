<?PHP
	session_start();
	include_once '../includes/functionClass.php';
	include_once('../includes/imageresize.php');
    error_reporting(0);
    $obj = new User();

	if (!$obj->get_session())
	{
	   header("location:index.php");
	}

/*=========== UPDATE QUERY START ===========*/
	if(isset($_POST['btnSubmit']))
	{		
		$table = CMS_MASTER;
		$title = $_POST['txtTitle'];
		
		$vowels = preg_replace('/[^a-zA-Z0-9]/', ' ', $title);
		$title = strtolower($vowels);
		$url_title = implode("-", explode(" ",trim($title)));
	
	   $search_rows = mysql_query("SELECT * FROM ".$table." WHERE ((`page_name` = '".realStrip($_POST['txtTitle'])."' || `url_title` = '".realStrip($url_title)."') || `url_title` = '".realStrip($url_title)."') AND id != '".realStrip($_GET['PageID'])."'");
	  if(!mysql_num_rows($search_rows)>0){		

		$fieldsValue .= "`desc` = ".(($_POST['description'] == "")?"NULL":"'".realStrip($_POST['description'])."'").",
						`page_name` = ".(($_POST['txtTitle'] == "")?"NULL":"'".realStrip($_POST['txtTitle'])."'");

		if($_GET['PageID'] == '') $WhereClause = '';  
		else $WhereClause = "`id` = ".$_GET['PageID'];
		
		$obj->AddEditQuery($table,$fieldsValue,$WhereClause);
		
		$msg = "<font color='green'>Your record has been updated successfully.</font>";	
	 }
	 else{ $msg = "<font color='red'>This Page Title already Exist.</font>";	}
			
	}	
/*=========== UPDATE QUERY END ===========*/

/*=========== SELECT QUERY START ===========*/
	if($_GET['PageID']!='') $page_details=$obj->runSql("SELECT * FROM ".CMS_MASTER." WHERE id = ".realStrip($_GET['PageID']));
/*=========== SELECT QUERY END ===========*/

	if(!isset($_POST['txtTitle'])) { $_POST['txtTitle']=$page_details['page_name']; }
	if(!isset($_POST['meta_title'])) { $_POST['meta_title']=$page_details['meta_title']; }
	if(!isset($_POST['meta_description'])) { $_POST['meta_description']=$page_details['meta_description']; }
	if(!isset($_POST['template'])) { $_POST['template']=$page_details['template']; }
	if(!isset($_POST['for_menu'])) { $_POST['for_menu']=$page_details['for_menu']; }
	if(!isset($_POST['page_under'])) { $_POST['page_under']=$page_details['page_under']; }
	if(!isset($_POST['page_heading'])) { $_POST['page_heading']=$page_details['page_heading']; }
	if(!isset($_POST['order_id'])) { $_POST['order_id']=$page_details['order_id']; }
	if(!isset($_POST['txtHidden'])) { $_POST['txtHidden']=$page_details['dfile']; }
	if(!isset($_POST['description'])) { $_POST['description']=$page_details['desc']; }	
	
?> 
<!DOCTYPE html>
<html lang="en-us" class="smart-style-3" >
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
<script src="js/plugin/ckfinder/ckfinder.js" type="text/javascript"></script>
<script src="js/plugin/ckeditor/ckeditor.js" type="text/javascript"></script>
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
      <li>Manage CMS</li>
    </ol>
  </div>
  <div id="content">
    <!-- widget grid -->
    <section id="widget-grid" class="">
      <!-- START ROW -->
      <div class="row">
        <!-- NEW COL START -->
        <article class="col-sm-12 col-md-12">
          <!-- Widget ID (each widget will need unique ID)-->
          <div class="jarviswidget" id="wid-id-1" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false">
            <header> <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
              <h2><?PHP echo($page_details['page_name']!='' ? $page_details['page_name'] : 'Add New Page');?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php if(isset($msg) && $msg!=''){ echo $msg; } ;?> </h2>
            </header>
            <!-- widget div-->
            <div>
              <!-- widget edit box -->
              <div class="jarviswidget-editbox">
                <!-- This area used as dropdown edit box -->
              </div>
              <!-- end widget edit box -->
              <!-- widget content -->
              <div class="widget-body no-padding">
                <form id="smart-form-register" class="smart-form" name="frm" method="POST" action="" enctype="multipart/form-data">
                 <!-- <header> Standard Form Header </header>-->
                  <fieldset>
                    <section>
                      <label class="label">Page Name</label>
                      <label class="input">
                        <input type="text" class="input-sm" name="txtTitle" name="page_name" value="<?PHP echo $_POST['txtTitle']; ?>">
                      </label>
                    </section>
                  </fieldset>
                  <fieldset>                    
                    <section>
                      <label class="label">Page Content</label>
                      <label class="textarea">
                        <textarea id="description" name="description"><?PHP echo stripslashes($_POST['description']); ?></textarea>
						 <script type="text/javascript">
                          var editor = CKEDITOR.replace( 'description', {
                             filebrowserBrowseUrl : 'js/plugin/ckfinder/ckfinder.html',
                             filebrowserImageBrowseUrl : 'js/plugin/ckfinder/ckfinder.html?type=Images',
                             filebrowserFlashBrowseUrl : 'js/plugin/ckfinder/ckfinder.html?type=Flash',
                             filebrowserUploadUrl : 'js/plugin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                             filebrowserImageUploadUrl : 'js/plugin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                             filebrowserFlashUploadUrl : 'js/plugin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
                             });
                          
                          CKFinder.setupCKEditor( editor, '' );
                          </script>
                      </label>
                      <div class="note"> <strong>Note:</strong> height of the textarea depends on the rows attribute. </div>
                    </section>
                  </fieldset>
                  <footer>
                    <button type="submit" class="btn btn-primary" name="btnSubmit"> Submit </button>
                    <button type="button" class="btn btn-default" onClick="window.history.back();"> Back </button>
                  </footer>
                </form>
              </div>
              <!-- end widget content -->
            </div>
            <!-- end widget div -->
          </div>
          <!-- end widget -->
        </article>
        <!-- END COL -->
      </div>
      <!-- END ROW -->
    </section>
    <!-- end widget grid -->
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
<!-- ENHANCEMENT PLUGINS : NOT A REQUIREMENT -->
<!-- PAGE RELATED PLUGIN(S) -->
<!--
<script src="js/plugin/ckfinder/ckfinder.js" type="text/javascript"></script> 
<script src="js/plugin/ckeditor/ckeditor.js" type="text/javascript"></script>
<script type="text/javascript">
		
		// DO NOT REMOVE : GLOBAL FUNCTIONS!
		
		$(document).ready(function() {
			
			//CKEDITOR.replace( 'ckeditor', { height: '300px', startupFocus : true} );
			CKEDITOR.replace( 'description', { height: '300px', startupFocus : true} );
		
		})

		</script>
-->

<!-- PAGE RELATED PLUGIN(S) -->
<script src="js/plugin/jquery-form/jquery-form.min.js"></script>
<script type="text/javascript">		
	$(document).ready(function() {
		
		pageSetUp();					
		var $registerForm = $("#smart-form-register").validate({
			rules : {
				txtTitle : {
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

</body>
</html>