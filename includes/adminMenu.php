<?PHP
    error_reporting(0);
	$page = basename($_SERVER["PHP_SELF"]);

?>

<aside id="left-panel">
  <div class="login-info"><span><a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut"><img src="img/avatars/sunny.png" alt="me" class="online" /><span>Administrator</span></a></span></div>
  <nav>
    <ul>
      <li <?php if($page=='my_account.php') { echo ('class="active"');}?>> <a href="my_account.php" title="Dashboard"><i class="fa fa-lg fa-fw fa-home"></i><span class="menu-item-parent">Dashboard</span></a></li>
      <li <?php if($page=='page.php' || $page == 'page_list.php') { echo ('class="active"');}?>> <a href="#"><i class="fa fa-lg fa-fw fa-cms"></i> <span class="menu-item-parent">Manage CMS</span></a>
        <ul>
          <li <?php echo($page == 'page.php' ? 'class="active"' : ''); ?>> <a href="page.php">Add Page</a> </li>
          <li <?php echo($page == 'page_list.php' ? 'class="active"' : ''); ?>> <a href="page_list.php">Page List</a> </li>
        </ul>
      </li>
      <li <?php if($page=='global.php') { echo ('class="active"');}?>> <a href="#"><i class="fa fa-lg fa-fw fa-globe"></i> <span class="menu-item-parent">Global Content</span></a>
        <ul>
          <?PHP   				

        $contQuery = mysql_query("SELECT * FROM ".CMS_MASTER."  WHERE `for_menu`='C' ORDER BY `id` DESC");

        if(mysql_num_rows($contQuery) > 0)

        {

            while ($ContVal = mysql_fetch_array($contQuery))

            {                   

        ?>
          <li <?php echo(($page == 'global.php' && $_GET['PageID'] == $ContVal['id']) ? 'class="active"' : '');?>> <a href="global.php?PageID=<?PHP echo $ContVal['id']; ?>"><?PHP echo $ContVal['page_name']; ?></a></li>
          <?PHP             

            }            

        }            

        ?>
        </ul>
      </li>
      <li <?php if($page=='followUs.php') { echo ('class="active"');}?>> <a title="Social Media" href="followUs.php"><i class="fa fa-lg fa-fw fa-follow-us"></i><span class="menu-item-parent">Social Media</span></a></li>
      <li <?php if($page=='banner.php') { echo ('class="active"');}?>> <a href="#"><i class="fa fa-lg fa-fw fa-picture-o"></i> <span class="menu-item-parent">Manage Banner</span></a>
        <ul>
          <li <?php echo($_GET['PageID'] == $menu_ContactVal['id'] && $page=='banner.php' ? 'class="active"' : ''); ?>> <a href="banner.php">Manage Banner</a> </li>
        </ul>
      </li>
	  
	  
	   <li <?php if($page=='card.php') { echo ('class="active"');}?>> <a href="#"><i class="fa fa-lg fa-fw fa-picture-o"></i> <span class="menu-item-parent">Manage Card</span></a>
        <ul>
		<li <?php echo($page == 'edit_card.php' ? 'class="active"' : ''); ?>> <a href="edit_card.php">Add Card</a> </li>
         
		  <li <?php echo($page == 'card.php' ? 'class="active"' : ''); ?>> <a href="card.php">Card List</a> </li>
        </ul>
      </li>
	  
	  
	  <li <?php if(($page=='testimonial.php') || ($page=='edit_testimonial.php')) { echo ('class="active"');}?>> <a href="#" title="Slide Show"><i class="fa fa-lg fa-fw fa-pencil-square-o"></i><span class="menu-item-parent">Testimonial</span></a>
        <ul>
          <li <?php if($page=='edit_testimonial.php') { echo ('class="active"');} ?>> <a href="edit_testimonial.php">Add Testimonial</a> </li>
          <li <?php if($page=='testimonial.php') { echo ('class="active"');} ?>> <a href="testimonial.php">Testimonial List</a> </li>
        </ul>
      </li>
      
	  <!--<li <?php if($page=='faq.php' || $page == 'edit_faq.php') { echo ('class="active"');}?>> <a href="#"><i class="fa fa-lg fa-fw fa-clipboard"></i> <span class="menu-item-parent">Manage Events</span></a>
        <ul>
          <li <?php echo($page == 'edit_event.php' ? 'class="active"' : ''); ?>> <a href="edit_event.php">Add Events</a> </li>
          <li <?php echo($page == 'event.php' ? 'class="active"' : ''); ?>> <a href="event.php">Events List</a> </li>
        </ul>
      </li>
	  <li <?php if($page=='news.php' || $page == 'edit_news.php') { echo ('class="active"');}?>> <a href="#"><i class="fa fa-lg fa-fw fa-clipboard"></i> <span class="menu-item-parent">Manage News</span></a>
        <ul>
		  <li <?php echo($page == 'edit_news.php' ? 'class="active"' : ''); ?>> <a href="edit_news.php">Add News</a> </li> 
          <li <?php echo($page == 'news.php' ? 'class="active"' : ''); ?>> <a href="news.php">News List</a> </li>         
        </ul>
      </li>-->
      <li <?php if($page=='contactUs.php') { echo ('class="active"');}?>> <a href="contactUs.php" title="Contact Us"><i class="fa fa-lg fa-fw fa-contact"></i><span class="menu-item-parent">Contact Us</span></a></li>
	  
	  <li <?php if($page=='roofing.php') { echo ('class="active"');}?>> <a href="#"><i class="fa fa-lg fa-fw fa-picture-o"></i> <span class="menu-item-parent">Manage Roofing</span></a>
        <ul>		  
          <li <?php echo($page == 'roofing.php' ? 'class="active"' : ''); ?>> <a href="roofing.php">Manage Roofing</a> </li> 
        </ul>
      </li>
	  <li <?php if($page=='callBack.php') { echo ('class="active"');}?>> <a href="callBack.php" title="Call Back"><i class="fa fa-lg fa-fw fa-contact"></i><span class="menu-item-parent">Call Back</span></a></li>
    </ul>
  </nav>
  <span class="minifyme" data-action="minifyMenu"> <i class="fa fa-arrow-circle-left hit"></i> </span> </aside>
