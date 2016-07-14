<?PHP
	include_once '../includes/functionClass.php';
	session_start();

	$obj = new User();
    $obj->adminLogout();
    header("location:index.php");
?>