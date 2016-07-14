<?PHP    error_reporting(0);
	include_once '../includes/functionClass.php';
	session_start();    error_reporting(0);

    $obj = new User();

	if (!$obj->get_session())
	{
	   header("location:index.php");
	}

/*===========  INSERT QUERY START ===========*/
	if(isset($_POST['btnSubmit']))
	{	
		$table = VIDEO;
		$fieldsValue .= "`video_title` = ".(($_POST['txtName'] == "")?"NULL":"'".realStrip($_POST['txtName'])."'").",
						`order_no` = ".(($_POST['order_no'] == "")?"NULL":"'".realStrip($_POST['order_no'])."'").",
						`description` = ".(($_POST['description'] == "")?"NULL":"'".realStrip($_POST['description'])."'").",
						`youtube` = ".(($_POST['youtube'] == "")?"NULL":"'".realStrip($_POST['youtube'])."'");
						
		$WhereClause = "";
		$obj->AddEditQuery($table,$fieldsValue,$WhereClause);
		header("location:video.php");
	}
/*===========  INSERT QUERY END ===========*/

	if(isset($_GET['LinkID']) && $_GET['LinkID']!='')
	{
		$SlideVal=$obj->runSql("SELECT * FROM ".VIDEO." WHERE id = ".$_GET['LinkID']);
	}

/*===========  UPDATE QUERY START ===========*/
	if(isset($_POST['btnEdit']))
	{	
		$table = VIDEO;
		
			$finddfile = $obj->runSql("SELECT * FROM ".$table." WHERE id = '".realStrip($_GET['LinkID'])."'");
		$fieldsValue .= "`video_title` = ".(($_POST['txtName'] == "")?"NULL":"'".realStrip($_POST['txtName'])."'").",
						`order_no` = ".(($_POST['order_no'] == "")?"NULL":"'".realStrip($_POST['order_no'])."'").",
						`description` = ".(($_POST['description'] == "")?"NULL":"'".realStrip($_POST['description'])."'").",
						`youtube` = ".(($_POST['youtube'] == "")?"NULL":"'".realStrip($_POST['youtube'])."'");

		$WhereClause = "`id` = ".$_GET['LinkID'];
		$obj->AddEditQuery($table,$fieldsValue,$WhereClause);
		header("location:video.php");
	}
/*===========  UPDATE QUERY START ===========*/

/*=========== STATUS CHANGE START ================*/
	if(isset($_GET['mode']) && ($_GET['mode'] == 'Y' || $_GET['mode'] == 'N'))
	{
		$table = VIDEO;
		$fieldsValue = "`status` = '".realStrip($_GET['mode'])."'";
		$WhereClause = "`id` = ".$_GET['staID'];
		$obj->AddEditQuery($table,$fieldsValue,$WhereClause);
		header("location:video.php?page=".$_GET['page']);
	}
/*=========== STATUS CHANGE END ================*/

/*=========== DELETE START ================*/
	if(isset($_GET['mode']) && $_GET['mode'] == 'del')
	{
		$del_content=$obj->runSql("SELECT `youtube` FROM ".VIDEO." WHERE id = ".$_GET['id']);
		$table = VIDEO;
		$WhereClause = "`id` = ".$_GET['id'];
		$obj->deleteQuery($table,$WhereClause);
		
		header("location:video.php?page=".$_GET['page']);		
	}
/*=========== DELETE END ================*/	
?>
<!DOCTYPE html>
<html class="smart-style-3" lang="en-us">
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
		document.afrm.action='video.php?Show='+id;
		document.afrm.submit();
	}
	function del(uid,page)
	{
		if(confirm('Are you sure to delete the video?'))
		{
		   document.afrm.action='video.php?mode=del&id='+uid+'&page='+page;
		   document.afrm.submit();
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
      <li>Video</li>
    </ol>
  </div>
  <div id="content">
    <section id="widget-grid" class="">
      <div class="row">
		  <article class="col-sm-12 col-md-12 col-lg-6">
			<div class="jarviswidget" id="wid-id-4" data-widget-editbutton="false" data-widget-custombutton="false">
			  <header> <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
				<h2><?PHP echo ($_GET['LinkID']!='' ? 'Edit' : 'Add'); ?> Video Name</h2>
			  </header>
			  <div>
				<div class="jarviswidget-editbox"></div>
				<div class="widget-body no-padding">
				  <form id="smart-form-register" class="smart-form" name="frm" method="POST" action="" enctype="multipart/form-data">
					<header><span style="font-size:11px;"><?php if(isset($msg) && $msg!=''){ echo $msg; } ;?></span></header>
					<fieldset>
					  <section>
						 <label class="label">Video Title</label>
						 <div class="input input-file"><input type="text" name="txtName" placeholder="Video Title" value="<?PHP echo $SlideVal['video_title']; ?>"></div>
					  </section>
					  <section>
						 <label class="label">Order No</label>
						 <div class="input input-file"><input type="text" name="order_no" placeholder="Order No" value="<?PHP echo($SlideVal['order_no']!='' ? $SlideVal['order_no'] : 1); ?>"></div>
					  </section>
                      <section>
                         <label class="label">Description</label>
                      <label class="textarea">
              		      <textarea rows="3" name="description" class="custom-scroll"><?PHP echo $SlideVal['description']; ?></textarea>
                      </label>                      
                      </section>
                        <section>
                          <label class="label">Video File</label>						  						 <div class="input input-file"><input type="text" name="youtube" placeholder="Youtube Link" value="<?PHP echo $SlideVal['youtube']; ?>"></div>
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

      
       <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <form name="afrm" method="post" action="" enctype="multipart/form-data">
          <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false">
            <header> <span class="widget-icon"> <i class="fa fa-table"></i> </span>
              <h2>Video List</h2>
            </header>
            <div>
              <div class="jarviswidget-editbox"></div>
              <div class="widget-body no-padding">
                <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
			<?PHP
                $where_clause = "WHERE 1 ";
                $selectQuery = "SELECT * FROM ".VIDEO." ".$where_clause." ORDER BY `id` ASC";
                $Slide=$obj->multipleSelect($selectQuery);
        
                if(mysql_num_rows($Slide=$obj->result) > 0)
                {
            ?>
                  <thead>
                    <tr>
                      <th data-hide="phone">SL. NO.</th>
                      <th data-class="expand"><i class="fa fa-fw text-muted hidden-md hidden-sm hidden-xs"></i>Video</th>
                      <th data-class="expand"><i class="fa fa-fw text-muted hidden-md hidden-sm hidden-xs"></i>Order No</th>
                      <th data-hide="phone,tablet">ACTION</th>
                    </tr>
                  </thead>
                  <tbody>
			<?php 
				$i = 1;
				while ($SlideVal = mysql_fetch_array($Slide=$obj->result, MYSQL_ASSOC))
				{
			?>
                    <tr>
                      <td><?PHP echo $i; ?></td>
                      <td><?PHP echo $SlideVal['video_title']; ?></td>
                      <td><?PHP echo $SlideVal['order_no']; ?></td>
                      <td>				  
						<?php
							if($SlideVal['status'] == 'Y')
							{
						?>
								<a href = "<?PHP echo ADMIN_SITE_URL; ?>video.php?staID=<?php echo($SlideVal['id']);?>&mode=N&page=<?PHP echo($_GET['page']!=''?$_GET['page']:'1'); ?>" title = "Click Here To Inactive"><i class="fa fa-active"></i></a>
						<?php
							}
							else
							{
						?>
								<a href = "<?PHP echo ADMIN_SITE_URL; ?>video.php?staID=<?php echo($SlideVal['id']);?>&mode=Y&page=<?PHP echo($_GET['page']!=''?$_GET['page']:'1'); ?>" title = "Click Here To Active"><i class="fa fa-inactive"></i></a>
						<?php
							}	
						?>
                        &nbsp;&nbsp;
                        <a href="<?PHP echo ADMIN_SITE_URL; ?>video.php?LinkID=<?php echo $SlideVal['id'];?>&page=<?PHP echo($_GET['page']!=''?$_GET['page']:'1'); ?>" title="Click Here To Edit"><i class="fa fa-pencil"></i></a>
                        &nbsp;&nbsp;
                        <a href="javascript: del('<?php echo $SlideVal['id'];?>','<?PHP echo($_GET['page']!=''?$_GET['page']:'1'); ?>')" title="Click Here To Delete"><i class="fa fa-delete"></i></a>
					  </td>
                    </tr>
			<?PHP
					$i++;
				}
			}
			else
			{
			?>
                    <tr>
                      <td height="25" align="center" colspan="4" class="tableText" style="color:red">No Record Found!!!</td>
					</tr>
		<?PHP
			}	
		?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </form>
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