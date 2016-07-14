<?PHP
 
	if(isset($get_page[$pi]) && $get_page[$pi]!='' && !preg_match('/^[a-zA-Z0-9-]+$/', $get_page[$pi])) 	header("location:".DOMAIN_NAME.ERROR_PAGE);

	$page_content=$obj->runSql("SELECT * FROM ".NEWS." WHERE `status`='Y' AND `url_title` = '".realStrip($get_page[$pi])."'");
	
	if(!$page_content) header("location:".DOMAIN_NAME.ERROR_PAGE);


$page_content['template'] = 'news.php';
// For vievs right panel as a blog page.


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
</head>

<body>
   <div class="container">
     <div class="wrapper"><!------------- wrapper --------------->
     
      <!----------------------- starting header ----------------------->
       <?PHP include('includes/frontHeader.php'); ?>
      <!----------------------- ending navigation ----------------------->
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
                            <h1>
						   <?PHP 
							if($page_content['page_name']!=''){
							echo ucfirst($page_content['page_name']);
							}else{
								echo '<h1>LATEST NEWS</h2>';
							}
							?>
							</h1>
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
                    <div class="section_content odd">
                       <div class="col-md-12 col-sm-12 col-xs-12">
                         <div class="row">
                            <div class="sec_left_info">
                              
                             <!-- blog content open --> 
							 
                             <div class="blg-lst-box odd">
							 <?PHP if($page_content['dfile']!= ''){ ?>
                        <div class="blg-lst-pic">
						
						<a class="html5lightbox" data-group="set1" data-thumbnail="<?PHP echo DOMAIN_NAME.'images/news_gallery/large/'.$page_content['dfile']; ?>" href="<?PHP echo DOMAIN_NAME.'images/news_gallery/large/'.$page_content['dfile']; ?>"><img src="<?PHP echo DOMAIN_NAME; ?>images/news_gallery/large/<?PHP echo $page_content['dfile']; ?>" alt="" class="img-responsive center-block">
						</a></div>
						<?php } ?>
                        	<div class="text-left">
							<!-- <h3><?PHP //echo $page_content['page_name']; ?></h3> -->
							<div class="blg-lst-lk-area">
								<div id="social_icon">
								<span class="sharetxt">Share This</span>
								<span class='st_sharethis_large' displayText='ShareThis'></span>
								<span class='st_facebook_large' displayText='Facebook'></span>
								<span class='st_twitter_large' displayText='Tweet'></span>
								<span class='st_linkedin_large' displayText='LinkedIn'></span>
								<span class='st_pinterest_large' displayText='Pinterest'></span>
								<span class='st_email_large' displayText='Email'></span>

								<script type="text/javascript">var switchTo5x=true;</script>
								<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
								<script type="text/javascript">stLight.options({publisher: "6ad48664-3c45-42b5-b59d-7afa7d137fa7", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
								</div>
          
							</div>
                <div class="clearfix"></div>
                            <p><span class="ddatte">Date posted :</span> <?PHP echo date('d-m-Y',strtotime($page_content['posted_date'])); ?></p>
                          <p><?PHP echo $page_content['desc']; ?> </p></div>
                         </div>
						 
                             <!-- blog content closed -->
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