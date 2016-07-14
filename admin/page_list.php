<?PHP
	include_once '../includes/functionClass.php';
	session_start();

    $obj = new User();

	if (!$obj->get_session())
	{
	   header("location:index.php");
	}

/*=========== STATUS CHANGE START ================*/
	if(isset($_GET['mode']) && ($_GET['mode'] == 'Y' || $_GET['mode'] == 'N'))
	{
		$table = CMS_MASTER;
		$fieldsValue = "`status` = '".realStrip($_GET['mode'])."'";
		$WhereClause = "`id` = ".$_GET['staID'];
		$obj->AddEditQuery($table,$fieldsValue,$WhereClause);
		header("location:page_list.php?page=".$_GET['page']);
	}
/*=========== STATUS CHANGE END ================*/

/*=========== DELETE START ================*/
	if(isset($_GET['mode']) && $_GET['mode'] == 'del')
	{
		$del_content=$obj->runSql("SELECT * FROM ".CMS_MASTER." WHERE id = ".$_GET['id']);
		$table = CMS_MASTER;
		$WhereClause = "`id` = ".$_GET['id'];
		$obj->deleteQuery($table,$WhereClause);
		
		if($del_content['dfile'] != '') unlink('../images/page_gallery/'.$del_content['dfile']);
				
		header("location:page_list.php?page=".$_GET['page']);
	}
/*=========== DELETE END ================*/	  
?>
<!DOCTYPE html>
<html lang="en-us" class="smart-style-3" lang="en-us">
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
	var GB_ROOT_DIR = "./greybox/";
</script>

<script type="text/javascript" src="greybox/AJS.js"></script>
<script type="text/javascript" src="greybox/AJS_fx.js"></script>
<script type="text/javascript" src="greybox/gb_scripts.js"></script>
<link href="greybox/gb_styles.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript">
<!--
	ShowCenterView = function(caption, url, height, width, callback_fn)
	{
		var options =
		{
			caption: caption,
			height: '350px',
			width: '',
			fullscreen: false,
			show_loading: true,
			center_win:true,
			callback_fn: callback_fn
		}
			var win = new GB_Window(options);
			return win.show(url);			
	}
	function show_you(id)
	{
		document.frm.action='member.php?Show='+id;
		document.frm.submit();
	}
	function del(uid,page)
	{
		if(confirm('Are you sure to delete the member?'))
		{
		   document.frm.action='member.php?mode=del&id='+uid+'&page='+page;
		   document.frm.submit();
		}
	}
//-->
</script>

<script type="text/javascript">
<!--
	function show_you(id)
	{
		document.frm.action='page_list.php?Show='+id;
		document.frm.submit();
	}
	function del(uid,page)
	{
		if(confirm('Are you sure to delete the Page name?'))
		{
		   document.frm.action='page_list.php?mode=del&id='+uid+'&page='+page;
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
      <li>Page List</li>
    </ol>
  </div>
  <form name="frm" method="post" action="">
  <div id="content">
    <section id="widget-grid" class="">
      <div class="row">

        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false">
            <header> <span class="widget-icon"> <i class="fa fa-table"></i> </span>
              <h2>Page List</h2>
            </header>
            <div>
              <div class="jarviswidget-editbox"></div>
              <div class="widget-body no-padding">
                <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
		<?PHP
			$where_clause = "WHERE `for_menu`!='C' ";
			$selectQuery = "SELECT * FROM ".CMS_MASTER." ".$where_clause." ORDER BY `page_name` ASC";
			$Slide=$obj->multipleSelect($selectQuery);

			if(mysql_num_rows($Slide=$obj->result) > 0)
			{
		?>
                  <thead>
                    <tr>
                      <th data-hide="phone">SL. NO.</th>
                      <th data-class="expand"><i class="fa fa-fw text-muted hidden-md hidden-sm hidden-xs"></i>Page Title</th> 
                      <th data-hide="phone,tablet">Type of Page</th>
                      <th data-hide="phone,tablet">Primary Page Name</th>
                      <th data-hide="phone,tablet">ACTION</th>
                    </tr>
                  </thead>
                  <tbody>
			<?php 
				$i = 1;
				while ($SlideVal = mysql_fetch_array($Slide=$obj->result, MYSQL_ASSOC))
				{
				$page_content=$obj->runSql("SELECT * FROM ".CMS_MASTER." WHERE `status`='Y' AND `id` = '".realStrip($SlideVal['page_under'])."'");
			?>
                    <tr>
                      <td><?PHP echo $i; ?></td>
                      <td><?PHP echo $SlideVal['page_name']; ?></td>
                      <td><?PHP 
					  			if($SlideVal['for_menu']=='P') echo 'Primary';
								elseif($SlideVal['for_menu']=='S')  echo 'Secondary';
								elseif ($SlideVal['for_menu']=='N') echo 'Not Menu';
								elseif ($SlideVal['for_menu']=='I') echo 'For Innerpage';
								else echo 'NULL'; ?></td>
                      <td><?PHP echo($page_content['page_name']!='' ? $page_content['page_name'] : 'NULL'); ?></td>
                      <td>				  
						<?php
							if($SlideVal['status'] == 'Y')
							{
						?>
								<a href = "<?PHP echo ADMIN_SITE_URL; ?>page_list.php?staID=<?php echo($SlideVal['id']);?>&mode=N&page=<?PHP echo($_GET['page']!=''?$_GET['page']:'1'); ?>" title = "Click Here To Inactive"><i class="fa fa-active"></i></a>
						<?php
							}
							else
							{
						?>
								<a href = "<?PHP echo ADMIN_SITE_URL; ?>page_list.php?staID=<?php echo($SlideVal['id']);?>&mode=Y&page=<?PHP echo($_GET['page']!=''?$_GET['page']:'1'); ?>" title = "Click Here To Active"><i class="fa fa-inactive"></i></a>
						<?php
							}	
						?>&nbsp;<a href="<?PHP echo ADMIN_SITE_URL; ?>page.php?PageID=<?php echo $SlideVal['id'];?>&page=<?PHP echo($_GET['page']!=''?$_GET['page']:'1'); ?>" title="Click Here To Edit"><i class="fa fa-pencil"></i></a>
                        <?PHP if($SlideVal['for_menu']!='P'){ ?>
                        &nbsp;&nbsp;<a href="javascript: del('<?php echo $SlideVal['id'];?>','<?PHP echo($_GET['page']!=''?$_GET['page']:'1'); ?>')" title="Click Here To Delete"><i class="fa fa-delete"></i></a>
                        <?PHP } ?>
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
        </article>
      </div>
    </section>
  </div>
  </form>
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
			"iDisplayLength": 25,			"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
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