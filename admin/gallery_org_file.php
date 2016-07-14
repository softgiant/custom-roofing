<?PHP    error_reporting(0);
	include_once '../includes/functionClass.php';
	session_start();    error_reporting(0);

    $obj = new User();

	if (!$obj->get_session())
	{
	   header("location:index.php");
	}

/*===========  INSERT QUERY START ===========*/
	if(isset($_POST['btnSubmit']))
	{	
		$table = GALLERY;
			
			$upload_dir='../images/gallery_images/';
			if($_FILES['dfile']['name']!="")
			{
				$file_name=$_FILES['dfile']['name'];
				$explode = explode(".",$file_name);
				$file_name=time().".".$explode[count($explode)-1];
				$tmp_name=$_FILES['dfile']['tmp_name'];
				copy($tmp_name,$upload_dir.$file_name);				
			}		

		$fieldsValue .= "`gallery_title` = ".(($_POST['txtName'] == "")?"NULL":"'".realStrip($_POST['txtName'])."'").",
						`order_no` = ".(($_POST['order_no'] == "")?"NULL":"'".realStrip($_POST['order_no'])."'").",						
						`year` = ".(($_POST['year'] == "")?"NULL":"'".realStrip($_POST['year'])."'").",
						
						`dfile` = ".(($file_name == "")?"NULL":"'".realStrip($file_name)."'");
						
		$WhereClause = "";
		$obj->AddEditQuery($table,$fieldsValue,$WhereClause);
		//echo $insert_id; die();
		header("location:gallery.php");
	}
/*===========  INSERT QUERY END ===========*/

	if(isset($_GET['LinkID']) && $_GET['LinkID']!=''){
		$SlideVal=$obj->runSql("SELECT * FROM ".GALLERY." WHERE id = ".$_GET['LinkID']);
	}else{
		$rs = $obj->runSql("SELECT id FROM ".GALLERY." WHERE 1 order by id desc limit 1 ");
		$next_order_id = $rs['id']+1;
	}

/*===========  UPDATE QUERY START ===========*/
	if(isset($_POST['btnEdit']))
	{	
		$table = GALLERY;
		
			$finddfile = $obj->runSql("SELECT * FROM ".$table." WHERE id = '".realStrip($_GET['LinkID'])."'");
			$upload_dir='../images/gallery_images/';
			
			if($_FILES['dfile']['name']!="")
			{
				$file_name=$_FILES['dfile']['name'];
				$explode = explode(".",$file_name);
				$file_name=time().".".$explode[count($explode)-1];
				$tmp_name=$_FILES['dfile']['tmp_name'];
				$file_size=$_FILES['dfile']['size'];
				copy($tmp_name,$upload_dir.$file_name);				
				if($finddfile['dfile'] != '' && $finddfile['dfile'] != $file_name) unlink($upload_dir.$finddfile['dfile']);				
			}
			else if($finddfile) $file_name = $finddfile['dfile'];		

		$fieldsValue .= "`gallery_title` = ".(($_POST['txtName'] == "")?"NULL":"'".realStrip($_POST['txtName'])."'").",
						`order_no` = ".(($_POST['order_no'] == "")?"NULL":"'".realStrip($_POST['order_no'])."'").",
						`page_id` = ".(($_POST['page_id'] == "")?"NULL":"'".realStrip($_POST['page_id'])."'").",						
						`year` = ".(($_POST['year'] == "")?"NULL":"'".realStrip($_POST['year'])."'").",
						
						`dfile` = ".(($file_name == "")?"NULL":"'".realStrip($file_name)."'");

		$WhereClause = "`id` = ".$_GET['LinkID'];
		$obj->AddEditQuery($table,$fieldsValue,$WhereClause);
		header("location:gallery.php");
	}
/*===========  UPDATE QUERY START ===========*/

/*=========== STATUS CHANGE START ================*/
	if(isset($_GET['mode']) && ($_GET['mode'] == 'Y' || $_GET['mode'] == 'N'))
	{
		$table = GALLERY;
		$fieldsValue = "`status` = '".realStrip($_GET['mode'])."'";
		$WhereClause = "`id` = ".$_GET['staID'];
		$obj->AddEditQuery($table,$fieldsValue,$WhereClause);
		header("location:gallery.php?page=".$_GET['page']);
	}
/*=========== STATUS CHANGE END ================*/

/*=========== DELETE START ================*/
	if(isset($_GET['mode']) && $_GET['mode'] == 'del')
	{
		$del_content=$obj->runSql("SELECT `dfile` FROM ".GALLERY." WHERE id = ".$_GET['id']);
		$table = GALLERY;
		$WhereClause = "`id` = ".$_GET['id'];
		$obj->deleteQuery($table,$WhereClause);
		if($del_content['dfile'] != '') unlink('../images/gallery_images/'.$del_content['dfile']);		
		header("location:gallery.php?page=".$_GET['page']);		
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
		document.afrm.action='gallery.php?Show='+id;
		document.afrm.submit();
	}
	function del(uid,page)
	{
		if(confirm('Are you sure to delete the Gallery?'))
		{
		   document.afrm.action='gallery.php?mode=del&id='+uid+'&page='+page;
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
      <li>Gallery</li>
    </ol>
  </div>
  <div id="content">
    <section id="widget-grid" class="">
      <div class="row">
		  <article class="col-sm-12 col-md-12 col-lg-6">
			<div class="jarviswidget" id="wid-id-4" data-widget-editbutton="false" data-widget-custombutton="false">
			  <header> <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
				<h2><?PHP echo ($_GET['LinkID']!='' ? 'Edit' : 'Add'); ?> Gallery Name</h2>
			  </header>
			  <div>
				<div class="jarviswidget-editbox"></div>
				<div class="widget-body no-padding">
				  <form id="smart-form-register" class="smart-form" name="frm" method="POST" action="" enctype="multipart/form-data">
					<header><span style="font-size:11px;"><?php if(isset($msg) && $msg!=''){ echo $msg; } ;?></span></header>
					<fieldset>
					  <section>
						 <label class="label">Gallery Title</label>
						 <div class="input input-file"><input type="text" name="txtName" placeholder="Gallery Title" value="<?PHP echo $SlideVal['gallery_title']; ?>"></div>
					  </section>
					  <section>
						 <label class="label">Order No</label>
						 <div class="input input-file"><input type="text" name="order_no" placeholder="Order No" value="<?PHP echo !empty($SlideVal['order_no'])?$SlideVal['order_no']:$next_order_id; ?>"></div>
					  </section>
					  <section>
                      <label class="label">Gallery page</label>
                      <label class="select">
                        <select name="page_id" id="page_id">
                         <option disabled="" selected="" value="0"> Select Page Name </option>
                         <?PHP
						 $menu_Page=$obj->multipleSelect("SELECT * FROM ".CMS_MASTER." WHERE `template`='gallery.php' AND `status`='Y' ORDER BY `page_name` ASC");
						 while ($menu_PageVal = mysql_fetch_array($menu_Page=$obj->result, MYSQL_ASSOC)){
						 ?>
                          <option <?PHP echo($SlideVal['page_id']==$menu_PageVal['id'] ? 'selected=""' : ''); ?> value="<?PHP echo $menu_PageVal['id']; ?>"><?PHP echo $menu_PageVal['page_name']; ?> Page</option>
                          <?PHP
						 }
						 ?>
                        </select>
                        <i></i> <b class="tooltip tooltip-top-right"> <i class="fa fa-warning txt-color-teal"></i> Page Select for views this content.</b> </label>
                    </section>
                      
                      
                    <section>

						 <label class="label">Gallery Year</label>

						 <div class="input input-file">
							
							<label class="select state-success">
								<select id="year" name="year" class="valid">
								<option disabled="" selected="" value="0"> Select Page Name </option>
								<option value="2015" <?php if($SlideVal['year']=="2015"){ echo "selected"; } ?>  >2015</option>
								<option value="2014" <?php if($SlideVal['year']=="2014"){ echo "selected"; } ?> >2014</option>
								<option value="2013" <?php if($SlideVal['year']=="2013"){ echo "selected"; } ?>  >2013</option>
								<option value="2012" <?php if($SlideVal['year']=="2012"){ echo "selected"; } ?> >2012</option>
								
								</select>
								<i></i> <b class="tooltip tooltip-top-right"> <i class="fa fa-warning txt-color-teal"></i> Page Select for views this content.</b> 
						    </label>
						 </div>

					  </section>
                        <section>
                          <label class="label">Gallery File</label>
                          <div class="input input-file"> <span class="button">
                            <input type="file" id="file" name="dfile" onChange="this.parentNode.nextSibling.value = this.value">
                            Browse</span><input type="text" value="<?PHP echo $SlideVal['dfile']; ?>" readonly >                        
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

      
       <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <form name="afrm" method="post" action="" enctype="multipart/form-data">
          <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false">
            <header> <span class="widget-icon"> <i class="fa fa-table"></i> </span>
              <h2>Gallery List</h2>
            </header>
            <div>
              <div class="jarviswidget-editbox"></div>
              <div class="widget-body no-padding">
                <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
			<?PHP
                $where_clause = "WHERE 1 ";
                $selectQuery = "SELECT * FROM ".GALLERY." ".$where_clause." ORDER BY `id` ASC";
                $Slide=$obj->multipleSelect($selectQuery);
        
                if(mysql_num_rows($Slide=$obj->result) > 0)
                {
            ?>
                  <thead>
                    <tr>
                      <th data-hide="phone">SL. NO.</th>
                      <th data-class="expand"><i class="fa fa-fw text-muted hidden-md hidden-sm hidden-xs"></i>NAME</th>
					  <th data-class="expand"><i class="fa fa-fw text-muted hidden-md hidden-sm hidden-xs"></i>YEAR</th>
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
                      <td><?PHP echo $SlideVal['gallery_title']; ?></td>
					  <td><?PHP echo $SlideVal['year']; ?></td>
                      <td><?PHP echo $SlideVal['order_no']; ?></td>
                      <td>				  
						<?php
							if($SlideVal['status'] == 'Y')
							{
						?>
								<a href = "<?PHP echo ADMIN_SITE_URL; ?>gallery.php?staID=<?php echo($SlideVal['id']);?>&mode=N&page=<?PHP echo($_GET['page']!=''?$_GET['page']:'1'); ?>" title = "Click Here To Inactive"><i class="fa fa-active"></i></a>
						<?php
							}
							else
							{
						?>
								<a href = "<?PHP echo ADMIN_SITE_URL; ?>gallery.php?staID=<?php echo($SlideVal['id']);?>&mode=Y&page=<?PHP echo($_GET['page']!=''?$_GET['page']:'1'); ?>" title = "Click Here To Active"><i class="fa fa-inactive"></i></a>
						<?php
							}	
						?>
                        &nbsp;&nbsp;
                        <a href="<?PHP echo ADMIN_SITE_URL; ?>gallery.php?LinkID=<?php echo $SlideVal['id'];?>&page=<?PHP echo($_GET['page']!=''?$_GET['page']:'1'); ?>" title="Click Here To Edit"><i class="fa fa-pencil"></i></a>
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
				},
				page_id : {
					required : true
				},
				year : {
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