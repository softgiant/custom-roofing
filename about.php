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
    
  </head>
  <body>
 <?PHP include('includes/frontHeader.php'); ?>
<!--=== Nav Section End Here ===-->
<div class="top-heading">
  <h2><?PHP echo $page_content['page_name']; ?></h2>
  <div class="bread">
    <ul>
      <li><a href="index.html">Home</a></li>
      <li><span>/</span></li>
      <li> <?PHP echo $page_content['page_name']; ?></li>
    </ul>
  </div>
  <!--=== Bread End Here ===--> 
</div>
<div class="cont-sec clearfix">
   <?PHP echo $page_content['desc']; ?>
  <!--=== Cont Section Left End Here ===-->
  <div class="cont-sec-right">
    <div class="call-back">Request a call back</div>
    <div class="callback-form">
      <input placeholder="Name" type="text">
      <input placeholder="Email" type="text">
      <input placeholder="Phone" type="text">
      <textarea placeholder="Comments"></textarea>
      <label>Please enter the below characters</label>
      <input class="verify-txt" type="text">
      <img src="images/captcha.jpg" alt="" title="">
      <input type="submit" value="Send">
    </div>
    <!--=== Callback Form End Here ===-->
    <div class="testi"> <span class="quote"><i class="fa fa-quote-left"></i></span>
      <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
      <span class="quote odd"><i class="fa fa-quote-right"></i></span>
      <h2>CRISTINA</h2>
      <h3>Home Owner</h3>
      <a class="more" href="#">SEE All&nbsp; <i class="fa fa-angle-double-right"></i></a> </div>
    <!--=== Testimonial ===-->
    <div class="find-us">
      <p>Find us on <span>RatedPeople.com</span></p>
      <img src="images/rated.png" alt="" title=""> </div>
    <!--=== Find Us ===--> 
  </div>
  <!--=== Content Section Right End Here ===--> 
</div>
<!--=== Content Section End Here ===-->
<?PHP include('includes/frontFooter.php'); ?>