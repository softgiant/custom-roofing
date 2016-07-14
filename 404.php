<?PHP
	
	$page_content=$obj->runSql("SELECT * FROM ".CMS_MASTER." WHERE `id`='1'");
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
                             <!-- 404 section -->
								<div class="financial-section">
								<h3>404 <span style="color: #426477;">Error page </span></h3>
									<p>Page not found for your entire Url</p>    
									<p>&nbsp;</p>    
									<p>&nbsp;</p>    
								</div>
                                   <!-- end 404 section -->
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
