<?php
session_start();
include_once 'functionClass.php';
$obj = new User();	

//code to create pagination links	
if (isset($_GET['query']) and isset($_GET['per_page'])){
	
		$query = realStrip($_GET['query'])." WHERE `status`='Y'";

$per_page = realStrip($_GET['per_page']);
$page = realStrip($_GET['page']);

echo  $obj->pagination($query, $per_page, $page);
}

$blog_detailspage=$obj->runSql("SELECT * FROM ".CMS_MASTER." WHERE `template` = 'blog.php'");

//code for retrieving the records
if(isset($_GET['startpoint']))
{

$records = '';
$statement = realStrip($_GET['query']);
$startpoint = realStrip($_GET['startpoint']);
$limit = realStrip($_GET['limit']);
//show records
	
		$query = "SELECT * FROM ".$statement." WHERE `status`='Y' ORDER BY `order_id` ASC, `id` DESC LIMIT {$startpoint} , {$limit}";	

$result = mysql_query($query);
if(mysql_num_rows($result) > 0){

	while ($TestimonialVal = mysql_fetch_array($result))
	{                   
	?>        
       <div class="testimonialBox">
     <?PHP echo $TestimonialVal['desc']; ?>
      <h6>-<?PHP echo $TestimonialVal['page_name']; ?></h6>
      <h5><?PHP echo $TestimonialVal['posted_by']; ?></h5>
    </div>
	
	
   <?PHP             
    }            

}
else{
	
	$records = '<div class="testi-blocks">              
				  <h4>No Testimonial Found to display</h4>
				</div>';
}
	
echo $records;
}
?>