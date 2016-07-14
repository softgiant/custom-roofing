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

/*===========  INSERT QUERY START ===========*/
	if(isset($_POST['btnSubmit']))
	{	
		$table = CARD;
			
			$large_upload_dir='../images/gallery_cards/large/';
			$upload_dir='../images/gallery_cards/';
			if($_FILES['dfile']['name']!="")
			{
				$file_name=$_FILES['dfile']['name'];
				$explode = explode(".",$file_name);
				$file_name=time().".".$explode[count($explode)-1];
				$tmp_name=$_FILES['dfile']['tmp_name'];
				copy($tmp_name,$large_upload_dir.$file_name);
				$thumbnail = resize($large_upload_dir.$file_name, 239, 160, $upload_dir.$file_name);			
			}		

		$fieldsValue .= "`gallery_title` = ".(($_POST['txtName'] == "")?"NULL":"'".realStrip($_POST['txtName'])."'").",						`order_no` = ".(($_POST['order_no'] == "")?"NULL":"'".realStrip($_POST['order_no'])."'").",
						`dfile` = ".(($file_name == "")?"NULL":"'".realStrip($file_name)."'");
						
		$WhereClause = "";
		$obj->AddEditQuery($table,$fieldsValue,$WhereClause);
		//header("location:review.php");
		echo '<script>location.href="'.ADMIN_SITE_URL.'card.php"</script>';
	}
/*===========  INSERT QUERY END ===========*/

	if(isset($_GET['LinkID']) && $_GET['LinkID']!='')
	{
		$SlideVal=$obj->runSql("SELECT * FROM ".CARD." WHERE id = ".$_GET['LinkID']);
	}

/*===========  UPDATE QUERY START ===========*/
	if(isset($_POST['btnEdit']))
	{	
		$table = CARD;
		
			$finddfile = $obj->runSql("SELECT * FROM ".$table." WHERE id = '".realStrip($_GET['LinkID'])."'");
			$large_upload_dir='../images/gallery_cards/large/';
			$upload_dir='../images/gallery_cards/';
			
			if($_FILES['dfile']['name']!="")
			{
				$file_name=$_FILES['dfile']['name'];
				$explode = explode(".",$file_name);
				$file_name=time().".".$explode[count($explode)-1];
				$tmp_name=$_FILES['dfile']['tmp_name'];
				copy($tmp_name,$large_upload_dir.$file_name);
				$thumbnail = resize($large_upload_dir.$file_name, 239, 160, $upload_dir.$file_name);				

				if($finddfile['dfile']!='' && $finddfile['dfile']!=$file_name){
					unlink($upload_dir.$finddfile['dfile']);
					unlink($large_upload_dir.$finddfile['dfile']);
				}	
			}
			else $file_name=$_POST['txtHidden'];		

		$fieldsValue .= "`gallery_title` = ".(($_POST['txtName'] == "")?"NULL":"'".realStrip($_POST['txtName'])."'").",						`order_no` = ".(($_POST['order_no'] == "")?"NULL":"'".realStrip($_POST['order_no'])."'").",						`dfile` = ".(($file_name == "")?"NULL":"'".realStrip($file_name)."'");
		$WhereClause = "`id` = ".$_GET['LinkID'];
		$obj->AddEditQuery($table,$fieldsValue,$WhereClause);
		//header("location:review.php");
		echo '<script>location.href="'.ADMIN_SITE_URL.'card.php"</script>';
	}
/*===========  UPDATE QUERY START ===========*/

?>
<!DOCTYPE html>
<html class="smart-style-3" lang="en-us" style="background-image: url('img/pattern/sneaker_mesh_fabric.png');">
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
  <div id="ribbon"> <span class="ribbon-button-alignment"> <span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true"> <i class="fa fa-refresh"></i> </span> </span>
    <ol class="breadcrumb">
      <li>Home</li>
      <li>Card</li>
    </ol>
  </div>
  <div id="content">
    <section id="widget-grid" class="">
      <div class="row">
		  <article class="col-sm-12 col-md-12 col-lg-6">
			<div class="jarviswidget" id="wid-id-4" data-widget-editbutton="false" data-widget-custombutton="false">
			  <header> <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
				<h2><?PHP echo ($_GET['LinkID']!='' ? 'Edit' : 'Add'); ?> Card</h2>
			  </header>
			  <div>
				<div class="jarviswidget-editbox"></div>
				<div class="widget-body no-padding">
				  <form id="smart-form-register" class="smart-form" name="frm" method="POST" action="" enctype="multipart/form-data">
					<header><span style="font-size:11px;"><?php if(isset($msg) && $msg!=''){ echo $msg; } ;?></span></header>
					<fieldset>
					  <section>
						 <label class="label">Card Title</label>
						 <div class="input input-file"><input type="text" name="txtName" placeholder="Card Title" value="<?PHP echo $SlideVal['gallery_title']; ?>"></div>
					  </section>
                      					  <section>						 <label class="label">Order No</label>						 <div class="input input-file"><input type="text" name="order_no" placeholder="Order No" value="<?PHP echo($SlideVal['order_no']!='' ? $SlideVal['order_no'] : 1); ?>"></div>					  </section>                    
                     
                        <section>
                          <label class="label">Card File</label>
                          <div class="input input-file"> <span class="button">
                            <input type="file" id="file" name="dfile" onChange="this.parentNode.nextSibling.value = this.value">
                            Browse</span><input type="text" name="txtHidden" value="<?PHP echo $SlideVal['dfile']; ?>" readonly >                        
                          </div>
                        </section>
					</fieldset>
					<footer>			
				<?PHP
					if(isset($_GET['LinkID']) && $_GET['LinkID']!='')
					{
				?>
						<input type="submit" name="btnEdit" value="SAVE" class="btn btn-danger">
				<?PHP
					}
					else
					{
				?>
						<input type="submit" name="btnSubmit" value="ADD" class="btn btn-danger">
				<?PHP
					}	
				?>
					</footer>
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
				txtName : {
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