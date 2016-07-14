<?PHP
	if(isset($get_page[$pj]) && $get_page[$pj]!='') 	header("location:".DOMAIN_NAME.ERROR_PAGE);
	
	if(isset($get_page[$pi]) && $get_page[$pi]!='' && preg_match('/^[a-zA-Z0-9-]+$/', $get_page[$pi])){
		$page_content=$obj->runSql("SELECT * FROM ".CMS_MASTER." WHERE `status`='Y' AND `page_under`='".$primary_page['id']."' AND `url_title` = '".realStrip($get_page[$pi])."'");
	}else{
		$page_content=$obj->runSql("SELECT * FROM ".CMS_MASTER." WHERE `status`='Y' AND `url_title` = '".realStrip($get_page[$pn])."'");
	}
	if(!$page_content) header("location:".DOMAIN_NAME.ERROR_PAGE);
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Welcome | Roofing Services</title>
<!--====== JS File ======-->
<script type="text/javascript" src="<?PHP echo DOMAIN_NAME; ?>js/jquery.1.11.2.min.js"></script>
<script type="text/javascript" src="<?PHP echo DOMAIN_NAME; ?>js/jquery.flexslider-min.js"></script>
<script type="text/javascript" src="<?PHP echo DOMAIN_NAME; ?>js/html5shiv.js"></script>
<script type="text/javascript" src="<?PHP echo DOMAIN_NAME; ?>js/respond.min.js"></script>
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
		 
		 // ----------- 
		 $('a.imgModal').click(function(){
			 var imgSrc = $(this).children('img').attr('src'); //console.log(imgSrc);
			 $('.customModal').css({display:'block'});
			 $('.customModal').animate({opacity:1},400);
			 setTimeout(function(){
				 $('.customModal').children('.modalContainer').children('img').attr('src', imgSrc);
				 $('.customModal').children('.modalContainer').css('transform','scale(1)');
			 },300);
			 $('.crossBtn').click(function(){
				  $('.customModal').children('.modalContainer').css('transform','scale(0)');
				 setTimeout(function(){
					 $('.customModal').animate({opacity:0},320);
					 setTimeout(function(){
					 	$('.customModal').css({display:'none'});
				 	 },380);
				 },280);
			 });
		 });
	  });
</script>
<!--====== CSS File ======-->
<link href="<?PHP echo DOMAIN_NAME; ?>css/font-awesome.css" rel="stylesheet">
<link href="<?PHP echo DOMAIN_NAME; ?>css/style.css" rel="stylesheet">
<link href="<?PHP echo DOMAIN_NAME; ?>css/responsive.css" rel="stylesheet">
</head>
<body>
<?PHP include('includes/frontHeader.php'); ?>
<?PHP include('includes/generel_functions.php'); ?>
<?php
	$get_all_roofing_list = get_all_roofing_list();	
  ?>
<!--=== Nav Section End Here ===-->
<div class="top-heading">
  <h2><?PHP echo $page_content['page_name']; ?></span></h2>
  <div class="bread">
    <ul>
      <li><a href="index.html">Home</a></li>
      <li><span>/</span></li>
      <li><?PHP echo $page_content['page_name']; ?></li>
    </ul>
  </div>
  <!--=== Bread End Here ===--> 
</div>
<!-- From admin -->
<div class="cont-sec clearfix">
  <h5>We offer a whole range of roofing services from slated/tiles roofs to guttering, fascia &amp; soffits and chimney building/repairs.  We can also provide a roof &amp; guttering cleaning service at a very competitive price. </h5>
  
  <!--=== Services Thumbnail Start Here ===-->
  <div class="servicesContainer">
    
    <?php echo $get_all_roofing_list; ?>
    <div class="clearfix"></div>
    <div class="customModal">
      <div id="thumbImg1" class="modalContainer"> <img src="images/services-img1-lg.jpg" alt="services-img1-lg">
        <div class="crossBtn"><img src="images/cross-circle.png"></div>
      </div>
     
    </div>
  </div>
  
  <!--=== Content Section End Here ===--> 
</div>
<!--=== Content Section End Here ===-->
<?PHP include('includes/frontFooter.php'); ?>