<a href="#menu" class="menu-trigger">
	<span></span>
	<span></span>
	<span></span>
</a>

<nav id="menu" class="leftmenu-item left-mega-menu3">
	<span class="new-leftmenu-close"><i class="fas fa-times"></i></span>
    <ul>
        <li><a href="<?php echo SITE_URL ?>"><i class="fas fa-home"></i> Home</a></li>
<?php 
	 $ctg_parent = "SELECT * FROM ".$db_suffix."categories WHERE categories_parent = '0' order by categories_name asc";
	
	$ctg_parent_query = $db->select($ctg_parent);



	while ($ctg_parent_row = mysqli_fetch_object($ctg_parent_query) ):
	 $ctg_subparent = "SELECT * FROM ".$db_suffix."categories WHERE categories_parent = '$ctg_parent_row->categories_id'";
	
	$ctg_subparent_query = $db->select($ctg_subparent);
	  $row_cnt = $ctg_subparent_query->num_rows;
?>

        <li>
        	<?php if ($row_cnt > 0): ?>
            <span> <i class="<?php echo $ctg_parent_row->categories_icon; ?>" ></i> <?php echo $ctg_parent_row->categories_name; ?></span>
            
            <ul>
            	<?php while ($ctg_subparent_row = mysqli_fetch_object($ctg_subparent_query) ): ?>
                <li>
                    <!-- <span><?php echo $ctg_subparent_row->categories_name; ?></span> -->
                    <a href="<?php echo SITE_URL ?>listing/<?php echo $ctg_subparent_row->categories_slug ?>"><?php echo $ctg_subparent_row->categories_name; ?></a>
                  <!--   <ul>
                        <li>
                            <a href="#about/team/management">Management</a>
                        </li>
                        <li>
                            <a href="#about/team/sales">Sales</a>
                        </li>
                        <li>
                            <a href="#about/team/development">Development</a>
                        </li>
                    </ul> -->
                </li>
               <?php endwhile; ?>
               
            </ul>
            <?php else: ?>
            	<a href="<?php echo SITE_URL ?>listing/<?php echo $ctg_parent_row->categories_slug ?>"><i class="<?php echo $ctg_parent_row->categories_icon; ?>" ></i> <?php echo $ctg_parent_row->categories_name; ?></a>            <?php endif ?>
        </li>

 <?php endwhile ?>
        <!-- <li><a href="#contact">Contact</a>
        	<ul>
                <li><a href="#about/history">History</a></li>
                <li>
                    <span>The team</span>
                    <ul>
                        <li>
                            <a href="#about/team/management">Management</a>
                        </li>
                        <li>
                            <a href="#about/team/sales">Sales</a>
                        </li>
                        <li>
                            <a href="#about/team/development">Development</a>
                        </li>
                    </ul>
                </li>
                <li><a href="#about/address">Our address</a>
                	 
                        <ul>
                            <li>
                                <a href="#about/team/management">Management</a>
                            </li>
                            <li>
                                <a href="#about/team/sales">Sales</a>
                            </li>
                            <li>
                                <a href="#about/team/development">Development</a>
                            </li>
                        </ul>
                </li>

                <li><a href="#about/address">Our address</a></li>
            </ul>
        </li>

        <li class="Divider">Other demos</li>
        <li><a href="advanced.html">Advanced demo</a></li>
        <li><a href="onepage.html">One page demo</a></li> -->
    </ul>
</nav>