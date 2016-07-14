<?php
session_start();
include_once 'functionClass.php';
$obj = new User();	

//code to create pagination links	
if (isset($_GET['query']) and isset($_GET['per_page'])){

$query = realStrip($_GET['query'])." WHERE `status`='Y' ORDER BY `id` DESC";

$per_page = realStrip($_GET['per_page']);
$page = realStrip($_GET['page']);

echo  $obj->pagination($query, $per_page, $page);
}

$event_detailspage=$obj->runSql("SELECT * FROM ".CMS_MASTER." WHERE `template` = 'event.php'");

//code for retrieving the records
if(isset($_GET['startpoint']))
{
$records = '';
$statement = realStrip($_GET['query']);
$startpoint = realStrip($_GET['startpoint']);
$limit = realStrip($_GET['limit']);
//show records
$query = "SELECT * FROM ".$statement." WHERE `status`='Y' ORDER BY `posted_date` ASC LIMIT {$startpoint} , {$limit}";
$result = mysql_query($query);
if(mysql_num_rows($result) > 0){

	while ($EventVal = mysql_fetch_array($result))
	{                   
	?>        
	<div class="blg-lst-box">
	<div class="blg-lst-pic"><a href="<?PHP echo DOMAIN_NAME.$event_detailspage['url_title'].'/'.$EventVal['url_title']; ?>"><img src="<?PHP echo DOMAIN_NAME; ?>images/event_gallery/large/<?PHP echo $EventVal['dfile']; ?>" alt=""></a></div>
		<h3><a href="<?PHP echo DOMAIN_NAME.$event_detailspage['url_title'].'/'.$EventVal['url_title']; ?>"><?PHP echo $EventVal['page_name']; ?></a></h3>
		<p><span class="ddatte">Event Date : </span><?php echo date('j F Y',strtotime($EventVal['posted_date'])); ?> <?php echo date('g:i A',strtotime($EventVal['event_time'])); ?> </p>
		
			
			<p><?php echo $EventVal['lead_in_description']; ?>..</p>
			<a href="<?PHP echo DOMAIN_NAME.$event_detailspage['url_title'].'/'.$EventVal['url_title']; ?>" class="cta">READ MORE</a>
		
	</div>
   <?PHP             
    }            

}
else{
	
	$records = '<div class="workrow clearfix">
				  <h3>No Event found for views</h3>
				</div>';
}
	
echo $records;
}
?>       