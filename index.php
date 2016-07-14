<?PHP
    session_start();
	error_reporting(0);
	include_once 'includes/functionClass.php';
    $obj = new User();	

if($get_page[$pn] == 'home' || $get_page[$pn] == '' && $get_page[$pi] == ''){	
	include_once('home.php');
}

else if($get_page[$pn] != 'home' && $get_page[$pn] !=''){		

	$primary_page = $obj->runSql("SELECT * FROM ".CMS_MASTER." WHERE `status`='Y' AND `url_title` = '".realStrip($get_page[$pn])."'");

	if($primary_page){		

		if(isset($get_page[$pi]) && $primary_page['template']=='news.php' && $get_page[$pi]!='' && preg_match('/^[0-9-]+$/', $get_page[$pi])){
			
			include_once('news.php');
			
		}else if(isset($get_page[$pi]) && $primary_page['template']=='news.php' && $get_page[$pi]!='' && preg_match('/^[a-zA-Z0-9-]+$/', $get_page[$pi])){
			
			include_once('news_details.php');
			
		}
		else if(isset($get_page[$pi]) && $primary_page['template']=='event.php' && $get_page[$pi]!='' && preg_match('/^[a-zA-Z0-9-]+$/', $get_page[$pi]))
		{
			include_once('event_details.php');	
		}		
		else{			
			if(isset($get_page[$pi]) && $get_page[$pi]!='' && preg_match('/^[a-zA-Z0-9-]+$/', $get_page[$pi])){
				
				$secondery_page = $obj->runSql("SELECT * FROM ".CMS_MASTER." WHERE `status`='Y' AND `page_under`='".$primary_page['id']."' AND `url_title`='".realStrip($get_page[$pi])."'");		
				
				if($secondery_page){
					
					include_once($secondery_page['template']);
					
				}else{
					
					include_once('404.php');
					
				}
			}
			else
			{
				include_once($primary_page['template']);

			}
		}		

	}
	else{
		include_once('404.php');

	}
}







?>
