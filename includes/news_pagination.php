<?php
session_start();
include_once 'functionClass.php';
$obj = new User();	

//code to create pagination links	
if (isset($_GET['query']) and isset($_GET['per_page'])){

$query = realStrip($_GET['query'])." WHERE `status`='Y' ORDER BY `posted_date` DESC";

$per_page = realStrip($_GET['per_page']);
$page = realStrip($_GET['page']);

echo  $obj->pagination($query, $per_page, $page);
}

$news_detailspage=$obj->runSql("SELECT * FROM ".CMS_MASTER." WHERE `template` = 'news.php'");

//code for retrieving the records
if(isset($_GET['startpoint']))
{
$records = '';
$statement = realStrip($_GET['query']);
$startpoint = realStrip($_GET['startpoint']);
$limit = realStrip($_GET['limit']);
//show records
$query = "SELECT * FROM ".$statement." WHERE `status`='Y' ORDER BY `posted_date` DESC LIMIT {$startpoint} , {$limit}";
$result = mysql_query($query);
if(mysql_num_rows($result) > 0){

	while ($NewsVal = mysql_fetch_array($result))
	{                   
	?>        
	<div class="blg-lst-box">
	<div class="blg-lst-pic"><img src="<?PHP echo DOMAIN_NAME; ?>images/news_gallery/<?PHP echo $NewsVal['dfile']; ?>" alt=""></div>
		<h3><a href="<?PHP echo DOMAIN_NAME.$news_detailspage['url_title'].'/'.$BlogVal['url_title']; ?>"><?PHP echo $NewsVal['page_name']; ?></a></h3>
		<p><span class="ddatte">Date posted :</span> <?php echo date('d-m-Y',strtotime($NewsVal['posted_date'])); ?></p>
			
			<p><?PHP echo $NewsVal['lead_in_description']; ?></p>
			<a href="<?PHP echo DOMAIN_NAME.$news_detailspage['url_title'].'/'.$NewsVal['url_title']; ?>" class="cta">READ MORE</a>
		
	</div>
   <?PHP             
    }            

}
else{
	
	$records = '<div class="workrow clearfix">
				  <h3>No News found for views</h3>
				</div>';
}
	
echo $records;
}
?>       