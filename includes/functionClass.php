<?PHP
include('connectionClass.php');

class User 
{
	function __construct() 
	{
		$db = new DB_Class();
	}	
	// Database connecton function. Comes to connectionClass.php page.
	
	function adminLogin($username, $password) 
	{
        $loginrec = mysql_query("SELECT * FROM ".ADMIN_MASTER." WHERE `username` = '".mysql_real_escape_string(stripslashes($username))."' AND `password` = '".mysql_real_escape_string(stripslashes($password))."'");
		$loginrecVal = mysql_fetch_array($loginrec);

		if($loginrecVal['id']!='')
		{
			$_SESSION['USER_ID'] = $loginrecVal['id'];
            return TRUE;
        }
        else
		{
		    return FALSE;
		}
    }	// Admin login function.

	function frontLogin($username, $password) 
	{
        $loginrec = mysql_query("SELECT * FROM ".MEMBER." WHERE `email` = '".mysql_real_escape_string(stripslashes($username))."' AND `password` = '".mysql_real_escape_string(stripslashes($password))."' AND `status` = 'Y'");
		$loginrecVal = mysql_fetch_array($loginrec);

		if($loginrecVal['id']!='')
		{
			$_SESSION['FRONT_USER_ID'] = $loginrecVal['id'];
			$_SESSION['FRONT_USER_TYPE'] = $loginrecVal['buy_sell'];
            return TRUE;
        }
        else
		{
		    return FALSE;
		}
    }	// Front login function.

	function frontLoginPay($username, $password) 
	{
        $loginrec = mysql_query("SELECT * FROM ".MEMBER." WHERE `email` = '".mysql_real_escape_string(stripslashes($username))."' AND `password` = '".mysql_real_escape_string(stripslashes($password))."' AND `status` = 'Y' AND `payment_status` = 'Y' ");
		$loginrecVal = mysql_fetch_array($loginrec);

		if($loginrecVal['id']!='')
		{
			$_SESSION['FRONT_USER_ID'] = $loginrecVal['id'];
            return TRUE;
        }
        else
		{
		    return FALSE;
		}
    }	// Front login function.

	function runSql($query)
	{
		$runQuery=mysql_query($query);
		if(mysql_num_rows($runQuery)>0){
		$result=mysql_fetch_array($runQuery);
		return($result);
		} //else "not found";
		return false;
	}	// Select query.

	function multipleSelect($selectQuery) 
	{		
		$this->selectQuery = $selectQuery;
		$this->result = mysql_query($this->selectQuery);		
		if ($this->result)
		{ 
			return true; 
		}		
		return false;		
	}	

	function AddEditQuery($table,$fieldsValue,$WhereClause)
	{
		if(empty($WhereClause))
		{
			$query="INSERT INTO ".$table." SET ".$fieldsValue."";
		//	echo $query."====<br/>";
			mysql_query($query) or die(mysql_error()."Error in insertQry()");
			return mysql_insert_id();
		}
		else
		{
			$query="UPDATE ".$table." SET ".$fieldsValue." WHERE ".$WhereClause."";
		//	echo $query."===";
			mysql_query($query) or die(mysql_error()."Error in updateQry()");
			return true;
		}
	}	//Insert and Update query.

	function deleteQuery($table,$WhereClause)
	{
		$query="DELETE FROM ".$table."  WHERE ".$WhereClause."";
	//	echo $query."===";
		mysql_query($query) or die(mysql_error()."Error in deleteQry()");
		return true;
	}	//Insert and Update query.

	function get_session() 
	{	    
        return $_SESSION['USER_ID'];
    }  // Session store function.

	function adminLogout()
	{
        $_SESSION['USER_ID'] = FALSE;
        session_destroy();
    }  // Admin logout function.	

	function frontLogout()
	{
        $_SESSION['FRONT_USER_ID'] = FALSE;
        session_destroy();
		return true;
    }  // Admin logout function.

	
	function pagination($query, $per_page = 10,$page = 1, $url = '?'){ 
		
		$query = "SELECT COUNT(*) as name FROM {$query}";
		$result = mysql_query($query);
		
		if (!$result)
		{
				echo 'Error ' . mysqli_error($link);
				exit();
		}
		
		while ($row = mysql_fetch_array($result))
		{
			$total = $row['name'];
		}
		
		
		$adjacents = "2"; 
		
		$page = ($page == 0 ? 1 : $page);  
		$start = ($page - 1) * $per_page;								
		
		$firstPage = 1;
		
		
		
		$prev = $page - 1;							
		$next = $page + 1;
		$lastpage = ceil($total/$per_page);
		$lpm1 = $lastpage - 1;
		
		$pagination = "";
		if($lastpage > 1)
		{	
			$pagination .= "<ul class='pagination'>";
					$pagination .= "<li class='details'>Page $page of $lastpage</li>";
			$prev = ($page == 1)?1:$page - 1;
			//$pagination = '';
			if ($page == 1)
			{
			$pagination.= "<li><a class='current' title='current'>First</a></li>";
			$pagination.= "<li><a class='current' title='current'>Prev</a></li>";
			}
			else
			{
			$pagination.= "<li><a href='{$url}page=$firstPage' title='$firstPage'>First</a></li>";
			$pagination.= "<li><a href='{$url}page=$prev' title='$prev'>Prev</a></li>";
			}	
			if ($lastpage < 7 + ($adjacents * 2))
			{	
				for ($counter = 1; $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<li><a class='current' title='current'>$counter</a></li>";
					else
						$pagination.= "<li><a href='{$url}page=$counter' title='$counter'>$counter</a></li>";					
				}
			}
			elseif($lastpage > 5 + ($adjacents * 2))
			{
				if($page < 1 + ($adjacents * 2))		
				{
					for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
					{
						if ($counter == $page)
							$pagination.= "<li><a class='current' title='current'>$counter</a></li>";
						else
							$pagination.= "<li><a href='{$url}page=$counter' title='$counter'>$counter</a></li>";					
					}
					$pagination.= "<li class='dot'>...</li>";
					$pagination.= "<li><a href='{$url}page=$lpm1'  title='$lpm1'>$lpm1</a></li>";
					$pagination.= "<li><a href='{$url}page=$lastpage' title='$lastpage'>$lastpage</a></li>";		
				}
				elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
				{
					$pagination.= "<li><a href='{$url}page=1' title='1'>1</a></li>";
					$pagination.= "<li><a href='{$url}page=2' title='2'>2</a></li>";
					$pagination.= "<li class='dot'>...</li>";
					for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
					{
						if ($counter == $page)
							$pagination.= "<li><a class='current' title='current'>$counter</a></li>";
						else
							$pagination.= "<li><a href='{$url}page=$counter' title='$counter'>$counter</a></li>";					
					}
					$pagination.= "<li class='dot'>..</li>";
					$pagination.= "<li><a href='{$url}page=$lpm1'  title='$lpm1'>$lpm1</a></li>";
					$pagination.= "<li><a href='{$url}page=$lastpage' title='$lastpage'>$lastpage</a></li>";		
				}
				else
				{
					$pagination.= "<li><a href='{$url}page=1' title='1'>1</a></li>";
					$pagination.= "<li><a href='{$url}page=2' title='2'>2</a></li>";
					$pagination.= "<li class='dot'>..</li>";
					for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
					{
						if ($counter == $page)
							$pagination.= "<li><a class='current' title='current'>$counter</a></li>";
						else
							$pagination.= "<li><a href='{$url}page=$counter' title='$counter'>$counter</a></li>";					
					}
				}
			}
			
			if ($page < $counter - 1){ 
				$pagination.= "<li><a href='{$url}page=$next' title='$next'>Next</a></li>";
				$pagination.= "<li><a href='{$url}page=$lastpage' title='$lastpage'>Last</a></li>";
			}else{
				$pagination.= "<li><a class='current' title='current'>Next</a></li>";
				$pagination.= "<li><a class='current' title='current'>Last</a></li>";
			}
			$pagination.= "</ul>\n";		
		}
		
	return $pagination;
	} 
	
	function FrontPages($tbl_name,$limit,$path,$where_clause,$PageID)
	{
		$query = "SELECT COUNT(*) as num FROM $tbl_name ".$where_clause;
		$row = mysql_fetch_array(mysql_query($query));
		$total_pages = $row['num'];

		$adjacents = "2";

		$page = (int) (!isset($PageID) ? 1 : $PageID);
		$page = ($page == 0 ? 1 : $page);

		if($page)
		$start = ($page - 1) * $limit;
		else
		$start = 0;

	$sql = "SELECT id FROM $tbl_name ".$where_clause." LIMIT $start, $limit";
	$result = mysql_query($sql);

		$prev = $page - 1;
		$next = $page + 1;
		$lastpage = ceil($total_pages/$limit);
		$lpm1 = $lastpage - 1;

		$pagination = "";
	if($lastpage > 1)
	{   
		$pagination .= "<div class='pagination'>";
	if ($page > 1)
		$pagination.= "<a href='".$path."$prev'><b>&lt;</b></a>";
	else
		$pagination.= "";   

	if ($lastpage < 7 + ($adjacents * 2))
	{   
	for ($counter = 1; $counter <= $lastpage; $counter++)
	{
	if ($counter == $page)
		$pagination.= "<span class='current'>$counter</span>";
	else
		$pagination.= "<a href='".$path."$counter'>$counter</a>";                   
	}
	}
	elseif($lastpage > 5 + ($adjacents * 2))
	{
	if($page < 1 + ($adjacents * 2))       
	{
	for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
	{
	if ($counter == $page)
		$pagination.= "<span class='current'>$counter</span>";
	else
		$pagination.= "<a href='".$path."$counter'>$counter</a>";                   
	}
		$pagination.= "<span class='doted'>...</span>";
		$pagination.= "<a href='".$path."$lpm1'>$lpm1</a>";
		$pagination.= "<a href='".$path."$lastpage'>$lastpage</a>";       
	}
	elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
	{
		$pagination.= "<a href='".$path."1'>1</a>";
		$pagination.= "<a href='".$path."2'>2</a>";
		$pagination.= "<span class='doted'>...</span>";
	for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
	{
	if ($counter == $page)
		$pagination.= "<span class='current'>$counter</span>";
	else
		$pagination.= "<a href='".$path."page=$counter'>$counter</a>";                   
	}
		$pagination.= "<span class='doted'>...</span>";
		$pagination.= "<a href='".$path."$lpm1'>$lpm1</a>";
		$pagination.= "<a href='".$path."$lastpage'>$lastpage</a>";       
	}
	else
	{
		$pagination.= "<a href='".$path."1'>1</a>";
		$pagination.= "<a href='".$path."2'>2</a>";
		$pagination.= "<span class='doted'>...</span>";
	for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
	{
	if ($counter == $page)
		$pagination.= "<span class='current'>$counter</span>";
	else
		$pagination.= "<a href='".$path."$counter'>$counter</a>";                   
	}
	}
	}

	if ($page < $counter - 1)
		$pagination.= "<a href='".$path."$next'><b>&gt;</b></a>";
	else
		$pagination.= "";
		$pagination.= "</div>\n";       
	}


	return $pagination;
	}
	

}


	
function request_uri()
{
    if($_SERVER['REQUEST_URI'])
    {
        return $_SERVER['REQUEST_URI'];
    }   
    if($_SERVER['HTTP_X_REWRITE_URL'])
    {
        return;
    }
    $P=$_SERVER['SCRIPT_NAME'];
    if($_SERVER['QUERY_STRING'])
    {
        $P.='?'.$_SERVER['QUERY_STRING'];
        return $P;
    }
}
//preg_match('`/(.*)(.*)$`',request_uri(),$matches);
preg_match('`/oxbrush/(.*)(.*)$`',request_uri(),$matches);
$tabletype=(!empty($matches[1])?($matches[1]):'');
$url_array=explode('/',$tabletype);
//print_r($url_array);



//exit;
?>