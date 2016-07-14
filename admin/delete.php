<?php
    session_start();
	include_once '../includes/functionClass.php';
    $obj = new User();

 $del = $_REQUEST['del'];
  
   $id = $_REQUEST['PageID'];

  $page = $_GET['page'];

mysql_query("update news set dfile='' where dfile='$del'");

unlink("http://61.16.241.116/matrix/project/boltoncancervoices/images/news_gallery/$del");
unlink("http://61.16.241.116/matrix/project/boltoncancervoices/images/news_gallery/large/$del");
header("Location:edit_news.php?PageID=$id&page=$page");
 
?>