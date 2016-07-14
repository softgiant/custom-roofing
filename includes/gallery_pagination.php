<?php
session_start();
include_once 'functionClass.php';
$obj = new User();	
$gallery_detailspage = $obj->runSql("SELECT * FROM ".CMS_MASTER." WHERE `template` = 'gallery.php'");

//code to create pagination links	
if (isset($_GET['query']) and isset($_GET['per_page'])){
	$query = realStrip($_GET['query'])." WHERE  `status`='Y' AND year='".$_GET['year']."' ORDER BY `id` DESC";
	$per_page = realStrip($_GET['per_page']);
	$page = realStrip($_GET['page']);
	echo  $obj->pagination($query, $per_page, $page);
}

//code for retrieving the records
if(isset($_GET['startpoint'])){
$records = '';
$statement = realStrip($_GET['query']);
$startpoint = realStrip($_GET['startpoint']);
$limit = realStrip($_GET['limit']);
//show records

$query = "SELECT * FROM ".$statement." WHERE `status`='Y' AND year='".$_GET['year']."' ORDER BY `order_no` ASC LIMIT {$startpoint} , {$limit}";
$result = mysql_query($query);
if(mysql_num_rows($result) > 0){

	while ($GalleryVal = mysql_fetch_array($result)){                   
	?>  	
	<div class="image-gride">
		  
	<div class="info-box"> 
	<img data-image="<?PHP echo DOMAIN_NAME.'images/gallery_images/large/'.$GalleryVal['dfile']; ?>" data-desc="<?php echo $GalleryVal['gallery_title']; ?>" data-gallery="gallery1" alt="<?php echo $GalleryVal['gallery_title']; ?>" class="img-responsive center-block" src="<?PHP echo DOMAIN_NAME;?>phpThumb/phpThumb.php?src=<?PHP echo DOMAIN_NAME.'images/gallery_images/'.$GalleryVal['dfile']; ?>&w=300&h=300&zc=1" style="cursor:pointer;">
	</div>
  </div>
   <?PHP             
    }            

}
else{
	
	$records = '<div class="workrow clearfix">
				  <h3>No Gallery Found</h3>
				</div>';
}
	
echo $records;
}
?>     