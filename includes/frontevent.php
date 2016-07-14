<?php
$Eventspage = $obj->runSql("SELECT * FROM ".CMS_MASTER." WHERE `template` = 'event.php'");

$selectEvents = "SELECT * FROM ".EVENT."  WHERE `status`='Y' ORDER BY `posted_date` ASC LIMIT 0,2";
$LeftEvents=$obj->multipleSelect($selectEvents); 
?>

<div class="event_wrap">
		<div class="aside_header">
		  <div class="aside_icon">
			<img src="<?PHP echo DOMAIN_NAME; ?>images/events.png">
		  </div>
		  Forthcoming Events
		</div>
		<div class="aside_content">
		<!-------------- event ----------------->
		<?php

		if(mysql_num_rows($LeftEvents=$obj->result) > 0) { ?>
		<?php 
		 while($events = mysql_fetch_array($LeftEvents=$obj->result, MYSQL_ASSOC)){
		
		 ?>
		 <div class="event">
			 <div class="col-md-3 col-xs-3 col-sm-1">
			  <div class="date_bg">
			   <div class="date"><?php echo date('jS',strtotime($events['posted_date'])); ?></div>
			   <div class="month"><?php echo strtoupper(date('M,Y ',strtotime($events['posted_date']))); ?></div>
			  </div>
			 </div>
			 <div class="col-md-9 col-xs-9 col-sm-11">
			  <div class="event_content">
				<h5 class="event_heading"><?php echo $events['page_name']; ?></h5>
				<div class="event_text"><?php echo strip_tags(substr($events['desc'],0,50)); ?>..</div>
				
				<a href="<?PHP echo DOMAIN_NAME.$Eventspage['url_title'].'/'.$events['url_title']; ?>">more>></a>
			  </div>
			  </div>
		   </div>
			<?php } } ?>
		   <!-------------- event ----------------->
		</div>
	    </div> <!-------------- ending event_wrap ----------------->