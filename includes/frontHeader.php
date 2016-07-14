<?PHP
//   $page = basename($_SERVER["PHP_SELF"]);
$social_url=$obj->runSql("SELECT * FROM ".SOCIAL_MEDIA." WHERE `id`='1'");
$FiveImage = $obj->runSql("SELECT * FROM ".CMS_MASTER." WHERE `id`='14'");
?>
<div class="top-sec">
        <ul>
          <li class="divide"><span><i class="fa fa-phone"></i></span><?PHP echo $social_url['phone']; ?></li>
          <li><span><i class="fa fa-mobile"></i></span><?PHP echo $social_url['mobile']; ?></li>
          <li><a href="<?PHP echo $social_url['facebook']; ?>" target="_blank"><i class="fa fa-facebook-square"></i></a></li>
        </ul>
     </div> <!--top-sec end here-->
     
     <div class="nav-sec">
        <div class="nav-wrapper clearfix">
           <div class="logo"><a href="<?PHP echo DOMAIN_NAME; ?>"><img src="<?PHP echo DOMAIN_NAME; ?>images/logo.png" alt="" title=""></a></div>
           <div class="mob-nav"><i class="fa fa-bars"></i></div>
           <div class="nav">
              <!-- <ul id="menu-primary-navigation" >
                <li><a href="#">Home</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Roofing Services</a></li>
                <li><a href="#">Pointing Services</a></li>
                <li><a href="#">Happy Customers</a></li>
                <li><a href="#">Contact Us</a></li>
              </ul> -->
			  <ul id="menu-primary-navigation">
					<li><a href="<?PHP echo DOMAIN_NAME; ?>" <?PHP echo($page_content['template']=='home.php' ? 'class="active"':'');?> >Home</a></li>
					<?PHP
						 $menu_Content=$obj->multipleSelect("SELECT * FROM ".CMS_MASTER." WHERE `for_menu`='P' AND `status`='Y' AND `id`!=1 AND `is_category`='N' ORDER BY `order_id` ASC");
						 while ($menu_ContentVal = mysql_fetch_array($menu_Content=$obj->result, MYSQL_ASSOC)){
					  ?>
						
					<?php
					 $secondery_menu_Content=mysql_query("SELECT * FROM ".CMS_MASTER." WHERE `for_menu`='S' AND `status`='Y' AND `is_category`='N' AND `page_under`='".$menu_ContentVal['id']."' ORDER BY `order_id` ASC");
					 if(mysql_num_rows($secondery_menu_Content)>0){
					?>
					<li class="dropdown"><a href="<?PHP echo DOMAIN_NAME.$menu_ContentVal['url_title']; ?>" <?PHP echo(($menu_ContentVal['url_title']==$get_page[$pn] || $menu_ContentVal['id']==$page_content['page_under']) ? 'class="active"':'');?> ><?PHP echo $menu_ContentVal['page_name']; ?><i class="fa fa-angle-down"></i></a>
					 
					 <?php } else {   ?>
					 <li class="dropdown"><a href="<?PHP echo DOMAIN_NAME.$menu_ContentVal['url_title']; ?>" <?PHP echo(($menu_ContentVal['url_title']==$get_page[$pn] || $menu_ContentVal['id']==$page_content['page_under']) ? 'class="active"':'');?> ><?PHP echo $menu_ContentVal['page_name']; ?></a>
					 
					 <?php } ?>
					 
					 
					<?php
					 $secondery_menu_Content=mysql_query("SELECT * FROM ".CMS_MASTER." WHERE `for_menu`='S' AND `status`='Y' AND `is_category`='N' AND `page_under`='".$menu_ContentVal['id']."' ORDER BY `order_id` ASC");
					 if(mysql_num_rows($secondery_menu_Content)>0){
					?>
				   <ul class="dropdown-menu bold">
				   <?php
					
					while ($secondery_menu_Val = mysql_fetch_array($secondery_menu_Content)){
					?>
					<li><a href="<?PHP echo DOMAIN_NAME.$menu_ContentVal['url_title'].'/'.$secondery_menu_Val['url_title']; ?>" <?PHP echo($secondery_menu_Val['url_title']==$get_page[$pn] ? 'class="active"':'');?>><?PHP echo $secondery_menu_Val['page_name']; ?></a></li> 
					<?php			
					}
					?>
					</ul>
					<?php
					}
					?>
					</li>
					<?php			
					}
					
					?> 
				</ul>
           </div> <!--nav end here-->
        </div> <!--nav-wrapper end here-->
     </div> <!--nav-sec end here-->
