<?PHP
	if(isset($get_page[$pj]) && $get_page[$pj]!='') 	header("location:".DOMAIN_NAME.ERROR_PAGE);
	
	if(isset($get_page[$pi]) && $get_page[$pi]!='' && preg_match('/^[a-zA-Z0-9-]+$/', $get_page[$pi])){
		$page_content=$obj->runSql("SELECT * FROM ".CMS_MASTER." WHERE `status`='Y' AND `url_title` = '".realStrip($get_page[$pi])."'");
	}else{
		$page_content=$obj->runSql("SELECT * FROM ".CMS_MASTER." WHERE `status`='Y' AND `url_title` = '".realStrip($get_page[$pn])."'");
	}
	if(!$page_content) header("location:".DOMAIN_NAME.ERROR_PAGE);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title><?PHP echo ($page_content['meta_title']!='' ?  $page_content['meta_title'] : FRONTEND_TITLE); ?></title>
<meta name="description" content="<?PHP echo $page_content['meta_description']; ?>">

<!--====== JS File ======-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="<?PHP echo DOMAIN_NAME; ?>js/jquery.flexslider-min.js"></script>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<script>
      $(window).load(function() {
		$('.flexslider').flexslider({
		  animation: "slide",
		  controlNav: false
		});
	  });
	  $(document).ready(function() {
		 $('.mob-nav').click(function(){
		   $('.nav').slideToggle();	 
		 });
	  });
</script>
<!--====== CSS File ======-->
<link href="<?PHP echo DOMAIN_NAME; ?>css/font-awesome.css" rel="stylesheet">
<link href="<?PHP echo DOMAIN_NAME; ?>css/style.css" rel="stylesheet">
<link href="<?PHP echo DOMAIN_NAME; ?>css/responsive.css" rel="stylesheet">
<link href="<?PHP echo DOMAIN_NAME; ?>css/pagination.css" rel="stylesheet">

<link rel="shortcut icon" href="<?PHP echo DOMAIN_NAME; ?>images/favicon.ico" type="image/x-icon">
<link rel="icon" href="<?PHP echo DOMAIN_NAME; ?>images/favicon.ico" type="image/x-icon">


<!--   pagination start -->

<script src="<?PHP echo DOMAIN_NAME; ?>js/jquery-1.7.1.min.js" ></script>
<!--  / pagination start -->

</head>
<body>
<body>
 <?PHP include('includes/frontHeader.php'); ?>
<!--=== Nav Section End Here ===-->
<div class="top-heading">
  <h2><?php echo $page_content['page_name']; ?></h2>
  <div class="bread">
    <ul>
      <li><a href="<?PHP echo DOMAIN_NAME; ?>">Home</a></li>
      <li><span>/</span></li>
      <li><?php echo $page_content['page_name']; ?></li>
    </ul>
  </div>
  <!--=== Bread End Here ===--> 
</div>
<div class="cont-sec clearfix">
  <div class="cont-sec-left inner">
	
   <script>
        $(document).ready(function(){
            $(window).bind("load", function() {
                page = 1;
                limit = 2;
                startpoint = (page * limit) - limit;
                statement = 'testimonial';
                query_string = 'query=' + statement + '&per_page=' + limit + '&page=' + page;
                $.get('<?PHP echo DOMAIN_NAME; ?>includes/testimonial_pagination.php', query_string, function(data){
                    var sHTML = data;
                    $('#pagination_div').html(sHTML);
                });
                query_string = 'query=' + statement + '&startpoint=' + startpoint + '&limit=' + limit;
                $.get('<?PHP echo DOMAIN_NAME; ?>includes/testimonial_pagination.php', query_string, function(data){
                    var sHTML = data;
                    $('.list_section').html(sHTML);
                });	
            }); //end load
            
            $(document).on("click", "ul.pagination li a", function(){ 	
                //alert($(this).attr('title')); 
                if ($(this).attr('title') != 'current')
                {
                    page = $(this).attr('title');
                    limit = 2;
                    startpoint = (page * limit) - limit;
					statement = 'testimonial';
                    query_string = 'query=' + statement + '&per_page=' + limit + '&page=' + page;
                    $.get('<?PHP echo DOMAIN_NAME; ?>includes/testimonial_pagination.php', query_string, function(data){
                        var sHTML = data;
                        $('#pagination_div').html(sHTML);
                    });
                    query_string = 'query=' + statement + '&startpoint=' + startpoint + '&limit=' + limit;
                    $.get('<?PHP echo DOMAIN_NAME; ?>includes/testimonial_pagination.php', query_string, function(data){
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
    
  </div>
  <!--=== Cont Section Left End Here ===-->
  <div class="cont-sec-right">
    <?PHP include('includes/frontRight.php'); ?>
  </div>
  <!--=== Content Section Right End Here ===--> 
</div>
<!--=== Content Section End Here ===-->
<?PHP include('includes/frontFooter.php'); ?>