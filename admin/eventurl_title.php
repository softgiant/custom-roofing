<?PHP
	session_start();
	include_once '../includes/functionClass.php';
    $obj = new User();
	
	$title = realStrip($_GET['val']);

    
	$vowels = preg_replace('/[^a-zA-Z0-9]/', ' ', $title);
	$title = strtolower($vowels);
	$url_title = implode("-", explode(" ",trim($title)));
	
	echo $url_title = trim($url_title, ' ');
?>
  