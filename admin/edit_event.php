<?PHP
	session_start();
	error_reporting(0);
	include_once '../includes/functionClass.php';
	include_once('../includes/imageresize.php');
    $obj = new User();

	if (!$obj->get_session())
	{
	   header("location:index.php");
	}

/*=========== UPDATE QUERY START ===========*/

	if(isset($_POST['btnSubmit']))
	{		
		$table = EVENT;
		//$title = $_POST['txtTitle'];	

		if(realStrip($_POST['url_title'])=='') $title = realStrip($_POST['txtTitle']);
		else $title = realStrip($_POST['url_title']);


		$vowels = preg_replace('/[^a-zA-Z0-9]/', ' ', $title);
		$title = strtolower($vowels);
		$url_title = implode("-", explode(" ",trim($title)));	

	   if($_POST['page_under']==''){
		   $search_rows = mysql_query("SELECT * FROM ".$table." WHERE ((`page_name` = '".realStrip($_POST['txtTitle'])."' || `url_title` = '".realStrip($url_title)."') || `url_title` = '".realStrip($url_title)."') AND id != '".realStrip($_GET['PageID'])."'");
	   }
	   else{
		   $search_rows = mysql_query("SELECT * FROM ".$table." WHERE ((`page_name` = '".realStrip($_POST['txtTitle'])."' || `url_title` = '".realStrip($url_title)."') || `url_title` = '".realStrip($url_title)."') AND `page_under`='".realStrip($_POST['page_under'])."' AND id != '".realStrip($_GET['PageID'])."'");
	   }

	  if(!mysql_num_rows($search_rows)>0){			  

			$finddfile = $obj->runSql("SELECT * FROM ".$table." WHERE id = '".realStrip($_GET['LinkID'])."'");			

			$large_upload_dir='../images/event_gallery/large/';
			$upload_dir='../images/event_gallery/';
			if($_FILES['file']['name']!="")
			{
				$file_name=$_FILES['file']['name'];
				$explode = explode(".",$file_name);
				$file_name=time().".".$explode[count($explode)-1];
				$tmp_name=$_FILES['file']['tmp_name'];
				copy($tmp_name,$large_upload_dir.$file_name);
				$thumbnail = resize($large_upload_dir.$file_name, 239, 160, $upload_dir.$file_name);
				$large_upload_dir.$file_name;

				if($finddfile['dfile']!='' && $finddfile['dfile']!=$file_name){
					unlink($upload_dir.$finddfile['dfile']);
				}	
			}
			else $file_name=$_POST['txtHidden'];	


		$fieldsValue .= "`desc` = ".(($_POST['description'] == "")?"NULL":"'".realStrip($_POST['description'])."'").",
						`page_name` = ".(($_POST['txtTitle'] == "")?"NULL":"'".realStrip($_POST['txtTitle'])."'").",
						`meta_title` = ".(($_POST['meta_title'] == "")?"NULL":"'".realStrip($_POST['meta_title'])."'").",
						`meta_description` = ".(($_POST['meta_description'] == "")?"NULL":"'".realStrip($_POST['meta_description'])."'").",
						`dfile` = ".(($file_name == "")?"NULL":"'".realStrip($file_name)."'").",
						`url_title` = ".(($url_title == "")?"NULL":"'".realStrip($url_title)."'").",
						`lead_in_description` = ".(($_POST['lead_in_description'] == "")?"NULL":"'".realStrip($_POST['lead_in_description'])."'").",
						`event_time` = ".(($_POST['event_time'] == "")?"NULL":"'".realStrip($_POST['event_time'])."'").",
						`posted_date` = ".(($_POST['startdate'] == "")?"NULL":"'".realStrip($_POST['startdate'])."'");

		if($_GET['PageID'] == '') $WhereClause = '';  
		else $WhereClause = "`id` = ".$_GET['PageID'];

		$obj->AddEditQuery($table,$fieldsValue,$WhereClause);

		$msg = "<font color='green'>Event has been updated successfully.</font>";	
		//header("location:page_list.php?page=".$_GET['page']);	 1430296826.jpg

		echo '<script>location.href="event.php";</script>';
	 }

	 else{ $msg = "<font color='red'>This Page Title or URl Title already Exist for same menu.</font>";	}

	}	

/*=========== UPDATE QUERY END ===========*/

/*=========== SELECT QUERY START ===========*/
	if($_GET['PageID']!='') $page_details=$obj->runSql("SELECT * FROM ".EVENT." WHERE id = ".realStrip($_GET['PageID']));
/*=========== SELECT QUERY END ===========*/

	if(!isset($_POST['txtTitle'])) { $_POST['txtTitle']=$page_details['page_name']; }
	if(!isset($_POST['url_title'])) { $_POST['url_title']=$page_details['url_title']; }
	if(!isset($_POST['meta_title'])) { $_POST['meta_title']=$page_details['meta_title']; }
	if(!isset($_POST['meta_description'])) { $_POST['meta_description']=$page_details['meta_description']; }
	if(!isset($_POST['lead_in_description'])) { $_POST['lead_in_description']=$page_details['lead_in_description']; }
	if(!isset($_POST['startdate'])) { $_POST['startdate']=$page_details['posted_date']; }
	if(!isset($_POST['event_time'])) { $_POST['event_time']=$page_details['event_time']; }
	if(!isset($_POST['txtHidden'])) { $_POST['txtHidden']=$page_details['dfile']; }
	if(!isset($_POST['description'])) { $_POST['description']=$page_details['desc']; }	
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
<script src="js/plugin/ckfinder/ckfinder.js" type="text/javascript"></script>
<script src="js/plugin/ckeditor/ckeditor.js" type="text/javascript"></script>

<script type="text/javascript" src="js/u.ajax.js"></script><!-- Ajax Page -->
<script type="text/javascript" language="javascript">
function change_url(){
	
	 var VAL = document.getElementById('txtTitle').value;
		elementId = 'url_title';	
		url="eventurl_title.php?val="+VAL;
		changeUrl(url,elementId);
		
		//alert(url);
}
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
  <div id="ribbon"><span class="ribbon-button-alignment"> <span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true"> <i class="fa fa-refresh"></i></span></span>
    <ol class="breadcrumb">
      <li>Home</li>
      <li>>Manage Event</li>
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
              <h2><?PHP echo($page_details['page_name']!='' ? $page_details['page_name'] : 'Add New Event');?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <?php if(isset($msg) && $msg!=''){ echo $msg; } ;?>
              </h2>
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
                      <label class="label">Event Name</label>
                      <label class="input">
                        <input type="text" class="input-sm" name="txtTitle" id="txtTitle" value="<?PHP echo $_POST['txtTitle']; ?>" onkeyup="change_url()" >
                      </label>
                    </section>
                    <?PHP //if($_GET['PageID']!=''){ ?>
                    <section>
                      <label class="label">The URL name being generated as you type?</label>
                      <label class="input">
                        <input type="text" class="input-sm" name="url_title" id="url_title" value="<?PHP echo $_POST['url_title']; ?>">
                      </label>
                    </section>
                    <?PHP //} ?>
                    <section>
                      <label class="label">Meta Title</label>
                      <label class="input">
                        <input type="text" class="input-sm" name="meta_title" value="<?PHP echo $_POST['meta_title']; ?>">
                      </label>
                    </section>
                    <section>
                      <label class="label">Meta description</label>
                      <label class="textarea">
                        <textarea class="custom-scroll" name="meta_description" rows="3"><?PHP echo $_POST['meta_description']; ?></textarea>
                      </label>
                    </section>
                  </fieldset>
                 <fieldset>                    
                                         
                    
                        <div class="row">
                            <section class="col col-6">
                                <label class="label">Event Date</label>
                                <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                    <input type="text" name="startdate" id="startdate" placeholder="Expected start date" value="<?PHP echo($_POST['startdate'] == '' ? date("Y-m-d") : $_POST['startdate']);?>">
                                </label>
                            </section>
                        </div>
						<div class="row">
                            <section class="col col-6">
                                <label class="label">Event Time</label>
                                <label class="input"> <i class="icon-append fa fa-time"></i>
								
                                    <input type="text" name="event_time" id="event_time" placeholder="HH:MM PM" value="<?PHP echo $_POST['event_time']; ?>">
                                </label>
                            </section>
                        </div>
						 
                  </fieldset>
                  
                  <fieldset>
					<section>
                      <label class="label">Lead In Description</label>
                      <label class="textarea">
                        <textarea id="lead_in_description" name="lead_in_description"><?PHP echo stripslashes($_POST['lead_in_description']); ?></textarea>
                      </label>
                      <div class="note"> <strong>Note:</strong> Maximum number of characters to 255. </div>
                    </section>
                    
                    <section>
                      <label class="label">File</label>
                      <div class="input input-file"> <span class="button">
                        <input type="file" name="file" id="file"  onchange="this.parentNode.nextSibling.value = this.value">
                        Browse</span>
                        <input type="text" name="txtHidden" onClick="javascript:document.getElementById('file').click();" placeholder="Photos for Event" value="<?PHP echo $_POST['txtHidden']; ?>" readonly>
                       
											
						</div>
                    </section>
                    
                    
                    <section>
                      <label class="label">Event Content</label>
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

// START AND FINISH DATE
			$('#startdate').datepicker({
				dateFormat : 'yy-mm-dd',
				prevText : '<i class="fa fa-chevron-left"></i>',
				nextText : '<i class="fa fa-chevron-right"></i>',
				onSelect : function(selectedDate) {
					$('#finishdate').datepicker('option', 'minDate', selectedDate);
				}
			});
			
			$('#finishdate').datepicker({
				dateFormat : 'yy-mm-dd',
				prevText : '<i class="fa fa-chevron-left"></i>',
				nextText : '<i class="fa fa-chevron-right"></i>',
				onSelect : function(selectedDate) {
					$('#startdate').datepicker('option', 'maxDate', selectedDate);
				}
			});		

	})

</script>
<!-- PAGE RELATED PLUGIN(S) -->
</body>
</html>