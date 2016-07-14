<?PHP
	 
	if(isset($get_page[$pi]) && $get_page[$pi]!='') 	header("location:".DOMAIN_NAME.ERROR_PAGE);

	$page_content=$obj->runSql("SELECT * FROM ".CMS_MASTER." WHERE `status`='Y' AND `url_title` = '".realStrip($get_page[$pn])."'");
	if(!$page_content) header("location:".DOMAIN_NAME.ERROR_PAGE);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title><?PHP echo ($page_content['meta_title']!='' ?  $page_content['meta_title'] : FRONTEND_TITLE); ?></title>
<meta name="description" content="<?PHP echo $page_content['meta_description']; ?>">

<link rel="stylesheet" type="text/css" href="<?PHP echo DOMAIN_NAME; ?>css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="<?PHP echo DOMAIN_NAME; ?>css/bootstrap-theme.css">
<link rel="stylesheet" type="text/css" href="<?PHP echo DOMAIN_NAME; ?>css/style.css">
<link rel="stylesheet" type="text/css" href="<?PHP echo DOMAIN_NAME; ?>css/font-awesome.css">
<link href='http://fonts.googleapis.com/css?family=Oswald:400,300' rel='stylesheet' type='text/css'>

<link href="<?PHP echo DOMAIN_NAME; ?>css/custom.css" rel="stylesheet">

<link rel="stylesheet" href="<?PHP echo DOMAIN_NAME; ?>css/flexslider.css" type="text/css" media="screen" />  
<script src="<?PHP echo DOMAIN_NAME; ?>js/jquery.min.js" type="text/javascript"></script>
<link rel="shortcut icon" href="<?PHP echo DOMAIN_NAME; ?>images/favicon.ico" type="image/x-icon">
<link rel="icon" href="<?PHP echo DOMAIN_NAME; ?>images/favicon.ico" type="image/x-icon">

<script type="text/javascript">
var recarr = jQuery.noConflict();
recarr(document).ready(function() {
        // Tooltip only Text
        recarr('.masterTooltip').hover(function(){
                // Hover over code
                var title = recarr(this).attr('title');
                recarr(this).data('tipText', title).removeAttr('title');
                recarr('<p class="tooltip"></p>')
                .text(title)
                .appendTo('body')
                .fadeIn('slow');
        }, function() {
                // Hover out code
                recarr(this).attr('title', recarr(this).data('tipText'));
                recarr('.tooltip').remove();
        }).mousemove(function(e) {
                var mousex = e.pageX + 20; //Get X coordinates
                var mousey = e.pageY + 10; //Get Y coordinates
                recarr('.tooltip')
                .css({ top: mousey, left: mousex })
        });
});
</script>

<!--   pagination start -->

<script src="<?PHP echo DOMAIN_NAME; ?>js/jquery-1.7.1.min.js" ></script>
<!--  / pagination start -->

</head>
<body>
<div class="container">
     <div class="wrapper">
	 <!------------- wrapper --------------->
     
      <!----------------------- starting header ----------------------->
       <?PHP include('includes/frontHeader.php'); ?>
      <!----------------------- ending navigation ----------------------->
      
      <!----------------------- starting banner ----------------------->
	  <?PHP if($page_content['dfile']!= ''){ ?>
         <div class="baner_outer1">
           <div class="info_banner"><img src="<?PHP echo DOMAIN_NAME.'images/page_gallery/'.$page_content['dfile']; ?>" alt="<?PHP echo $page_content['dfile']; ?>"></div>
           <div class="banner_header"><span style="color:#454749;"> <?PHP echo $page_content['page_heading']; ?></span> </div>
         </div>
		 <?PHP } ?>
      <!----------------------- starting banner ----------------------->
      
      <!----------------------- starting section ----------------------->
         <div class="row">
           <div class="col-md-12 col-sm-12 col-xs-12">
             <section>
             
                <div class="col-md-9 col-sm-12 col-xs-12 padding_0">
                  <div class="leftber">
                  <!------------------ starting section_header ---------------------->
                     <div class="section_header">
					 
                        <div class="col-md-8 col-sm-9 col-xs-12 padding_0">
                          <h1><?PHP echo $page_content['page_heading']; ?></h1>
                          <h2></h2>
                        </div>
						
                        <div class="col-md-4 col-sm-3 col-xs-12 padding_0">
                          <div class="section_header_bg">
                            <img src="<?PHP echo DOMAIN_NAME; ?>images/secbg.png">
                          </div>
                        </div>
                     </div>
                 <!------------------ ending section_header ---------------------->
                 
                 <!------------------ starting section_content ---------------------->
                    <div class="section_content">
                       <div class="col-md-12 col-sm-12 col-xs-12">
                         <div class="row">
                            <div class="sec_left_info">
						<!--   pagination start -->
						<script>
						$(document).ready(function(){
						$(window).bind("load", function() {
						page = 1;
						limit = 10;
						startpoint = (page * limit) - limit;
						statement = 'event';
						query_string = 'query=' + statement + '&per_page=' + limit + '&page=' + page;
						$.get('<?PHP echo DOMAIN_NAME; ?>includes/event_pagination.php', query_string, function(data){
						var sHTML = data;
						$('#pagination_div').html(sHTML);
						});
						query_string = 'query=' + statement + '&startpoint=' + startpoint + '&limit=' + limit;
						$.get('<?PHP echo DOMAIN_NAME; ?>includes/event_pagination.php', query_string, function(data){
						var sHTML = data;
						$('.list_section').html(sHTML);
						});	
						}); //end load

						$(document).on("click", "ul.pagination li a", function(){ 	
						//alert($(this).attr('title')); 
						if ($(this).attr('title') != 'current')
						{
						page = $(this).attr('title');
						limit = 10;
						startpoint = (page * limit) - limit;
						statement = 'event';
						query_string = 'query=' + statement + '&per_page=' + limit + '&page=' + page;
						$.get('<?PHP echo DOMAIN_NAME; ?>includes/event_pagination.php', query_string, function(data){
						var sHTML = data;
						$('#pagination_div').html(sHTML);
						});
						query_string = 'query=' + statement + '&startpoint=' + startpoint + '&limit=' + limit;
						$.get('<?PHP echo DOMAIN_NAME; ?>includes/event_pagination.php', query_string, function(data){
						var sHTML = data;
						$('.list_section').html(sHTML);
						});	
						}
						return false;
						}); //end event
						}); //end document ready
						</script> 

						<div class="list_section"> </div>
						<div class="clr"></div>

						<!--  / pagination start -->        	
						<div id="pagination_div"  class="pagination"></div>
						<!--  / pagination end -->	   
                             
                           </div>
                        </div>
                      </div> 
                       
                    </div>
                 <!------------------ ending section_content ---------------------->
                 

                  </div>
                </div>
                
                <div class="col-md-3 col-sm-12 col-xs-12 padding_0">
                   <?PHP include('includes/frontRight.php'); ?>
                </div>
                
             </section>
           </div>
         </div>
      <!----------------------- ending section ----------------------->
        <?PHP include('includes/frontFooter.php'); ?>