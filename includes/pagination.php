<?php 

echo $_GET["page"];
echo "fffffff"; 
$limit = 2;  
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
$start_from = ($page-1) * $limit;  
  
$sql = "SELECT * FROM news ORDER BY title ASC LIMIT $start_from, $limit";  
$rs_result = mysql_query ($sql);  
?> 

<?php

$newpage = $obj->runSql("SELECT * FROM ".CMS_MASTER." WHERE `template` = 'news.php'");
//$selectnew = "SELECT * FROM ".NEWS."  WHERE `status`='Y' ORDER BY `posted_date` ASC" ;
$selectnew = "SELECT * FROM ".NEWS." WHERE `status`='Y' ORDER BY `posted_date` ASC LIMIT {$start_from} , {$limit}";
$Leftnew=$obj->multipleSelect($selectnew); 

?>    
<?php if(mysql_num_rows($Leftnew=$obj->result) > 0) { 
		
		 while($news = mysql_fetch_array($Leftnew=$obj->result, MYSQL_ASSOC)){
		
		 ?>   
	<div class="blg-lst-box">
	<div class="blg-lst-pic"><img src="<?PHP echo DOMAIN_NAME; ?>images/news_gallery/<?PHP echo $news['dfile']; ?>" alt=""></div>
		<h3><a href="<?PHP echo DOMAIN_NAME.$newpage['url_title'].'/'.$news['url_title']; ?>"><?PHP echo $news['page_name']; ?></a></h3>
		<p><span class="ddatte">Date posted:</span><?php echo date('d-m-Y',strtotime($news['posted_date'])); ?></p>
			
			<p><?PHP echo $news['lead_in_description']; ?></p>
			<a href="<?PHP echo DOMAIN_NAME.$newpage['url_title'].'/'.$news['url_title']; ?>" class="cta">READ MORE</a>
		
	</div>
   <?PHP             
    }            

}
?>

<?php  
$sql = "SELECT COUNT(id) FROM news";  
$rs_result = mysql_query($sql);  
$row = mysql_fetch_row($rs_result);  
$total_records = $row[0];  
$total_pages = ceil($total_records / $limit);  
$pagLink = "<div class='pagination'>";  
for ($i=1; $i<=$total_pages; $i++) {  
             $pagLink .= "<a href='latest-news.php?page=".$i."'>".$i."</a>";  
};  
echo $pagLink . "</div>";  
?>    