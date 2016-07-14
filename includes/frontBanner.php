<?PHP
 $selectBanner = "SELECT * FROM ".BANNER." WHERE `status`='Y' ORDER BY `order_no` ASC";
 $Banner=$obj->multipleSelect($selectBanner); 
 ?> 
<?php if(mysql_num_rows($Banner=$obj->result) > 0) { ?>
<ul class="slides">
<?php 
		    while($res = mysql_fetch_array($Banner)){
			$name = $res['dfile'];
			$title = $res['banner_title'];
			$description = $res['description'];
			$load_path = 'images/banner_gallery/'.$name;
		    ?>
           <li>
		   
           <img src="<?php echo $load_path; ?>" alt="<?php echo $alt; ?>" title="<?php echo $description; ?>">
           <div class="slide-container">
              <div class="slide-cont">
                <h2>All types of roofing work undertaken</h2>
                <h3>FAST, FRIENDLY AND RELIABLE SERVICE</h3>
                <a class="read-link" href="#">Read More &nbsp; <i class="fa fa-angle-double-right"></i></a>
              </div>
           </div>
           </li>
           <?php
		}
		?>
           
        </ul>
<?php
		}
		?>		
