<?PHP
	$page_content=$obj->runSql("SELECT * FROM ".CMS_MASTER." WHERE `id`='1'");
	if(!$page_content) header("location:".DOMAIN_NAME.ERROR_PAGE);
?>
<?php
$ourservices = $obj->runSql("SELECT * FROM ".CMS_MASTER." WHERE `id`='11'");
$compitative_rates = $obj->runSql("SELECT * FROM ".CMS_MASTER." WHERE `id`='10'");
$aboutus = $obj->runSql("SELECT * FROM ".CMS_MASTER." WHERE `id`='2'");
$heading = $obj->runSql("SELECT * FROM ".CMS_MASTER." WHERE `id`='12'");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?PHP echo ($page_content['meta_title']!='' ?  $page_content['meta_title'] : FRONTEND_TITLE); ?></title>
<meta name="description" content="<?PHP echo $page_content['meta_description']; ?>">
    
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript" src="<?PHP echo DOMAIN_NAME; ?>js/jquery.flexslider-min.js"></script>
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
    
    <link href="<?PHP echo DOMAIN_NAME; ?>css/font-awesome.css" rel="stylesheet">
    <link href="<?PHP echo DOMAIN_NAME; ?>css/style.css" rel="stylesheet">
    <link href="<?PHP echo DOMAIN_NAME; ?>css/responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
  </head>
  <body>
  
    <?PHP include('includes/frontHeader.php'); ?>
     
     <div class="flexslider">
        <?PHP include('includes/frontBanner.php'); ?>
     </div> <!--flexslider end here-->
     
     <div class="shadow-div">
        <div class="shadow-div-main">
           <div class="shadow-left">
              <h2>Please contact us today to arrange your <br>free no obligation quotation.</h2>
           </div>
           <div class="shadow-right">
              <h2><?PHP echo $social_url['phone']; ?></h2>
           </div>
        </div> <!--shadow-div-main end here-->
     </div> <!--shadow-div end here-->
     
     <div class="cont-sec clearfix">
        <div class="cont-sec-left">
		<h2>THE NORTH WEST’S NUMBER ONE <br>
      <span>Roofing and Pointing SPECIALISTS</span></h2>
           <?php echo $heading['desc']; ?>
		   <p><a class="read-link" href="about-us">Read More &nbsp; </a></p>
           
           <hr>
           <h2 class="competitive">Competitive <span>rates</span></h2>
           <?php echo $compitative_rates['desc']; ?>
           <hr>
           
           <div class="services">
           
           <h2 class="servicestxt">Our <span>services</span></h2>
           <?php echo $ourservices['desc']; ?>
              
           </div> <!--services end here-->
           
           <hr>
           <h2 class="gurantee">Fully <span>guaranteed</span></h2>
            <?php echo $page_content['desc']; ?>
		   
           <!-- <a class="read-link" href="#">Read More &nbsp; <i class="fa fa-angle-double-right"></i></a> -->
           
        </div> <!--cont-sec-left end here-->
        
        
        <div class="cont-sec-right">
           <?PHP include('includes/frontRight.php'); ?>
        
     </div> <!--cont-sec end here-->
     
<?PHP include('includes/frontFooter.php'); ?>