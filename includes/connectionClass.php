<?PHP

class DB_Class 
{




// FOR SURVER START 

	function Connection()
	{
		$this->dbHost = 'localhost';
		$this->dbUser = 'root';
		$this->dbName = 'andy_admin';
		$this->dbPass = '';
	}
	
// FOR SURVER END 



	function __construct()
	{
		$this->Connection();
		$dbLink = mysql_connect($this->dbHost, $this->dbUser, $this->dbPass);
		if(!$dbLink) die("Could not connect to database. " . mysql_error());

		mysql_select_db($this->dbName);
	}
} 

function realStrip($input)
{
	return mysql_real_escape_string(stripslashes(trim($input)));
}



// FOR LOCALHOST START

define("DOMAIN_NAME", "http://192.168.1.12/teamD/rajiv/andy/");
define("ADMIN_SITE_URL", "http://192.168.1.12/teamD/rajiv/andy/admin/");

//define("DOMAIN_NAME", "http://203.200.180.180/matrix/project/boltoncancervoices/");
//define("ADMIN_SITE_URL", "http://203.200.180.180/matrix/project/boltoncancervoices/admin/");

//define("DOMAIN_NAME", "http://www.pro-tecuk.com/new-site/");
//define("ADMIN_SITE_URL", "http://www.pro-tecuk.com/new-site/admin/");


// FOR LOCALHOST END

define("SITE_HOME", "index.php");

define("ADMIN_TITLE", "Andy T. Young Builders");
define("FRONTEND_TITLE", "Andy T. Young Builders Admin panel");

define("ADMIN_MASTER", "admin");
define("CMS_MASTER", "cms");
define("SOCIAL_MEDIA", "social_media");

define("CONTACT_US", "contact_us");
define("CALL_BACK", "call_back");
define("TESTIMONIAL", "testimonial");
define("BANNER", "banner");
define("ROOFING", "roofing");
//define("REVIEW", "review");
//define("FAQ", "faq");
//define("GALLERY", "gallery");
//define("VIDEO", "video");
define("EVENT", "event");
define("NEWS", "news");
define("CARD", "card");
define("VENDERFILE", "images/vender/");
define("ADMINVENDERFILE", "../images/vender/");


/*  For htaccess page */

define("ERROR_PAGE", "404.php");

$pageURL = $_SERVER["REQUEST_URI"];

$get_page = explode("/", $pageURL);

$pn=4;
$pi=5;
$pj=6;
$pk=7;

/*  For htaccess page */

?>