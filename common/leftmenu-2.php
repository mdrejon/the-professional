<div class="new-leftmenu new-leftmenu-2">
	<span class="new-leftmenu-close"><i class="fas fa-times"></i></span>
	<h5><a href="<?php echo SITE_URL ?>">home</a></h5>
	<ul class="leftmenu-item">
		<!-- <li><a href="<?php echo SITE_URL ?>">home</a></li> -->

<?php 
	 $ctg_parent = "SELECT * FROM ".$db_suffix."categories WHERE categories_parent = '0'";
	
	$ctg_parent_query = $db->select($ctg_parent);



	while ($ctg_parent_row = mysqli_fetch_object($ctg_parent_query) ):
	 $ctg_subparent = "SELECT * FROM ".$db_suffix."categories WHERE categories_parent = '$ctg_parent_row->categories_id'";
	
	$ctg_subparent_query = $db->select($ctg_subparent);
	  $row_cnt = $ctg_subparent_query->num_rows;
?>
		<li>
			<a href="<?php echo SITE_URL ?>categories/<?php echo $ctg_parent_row->categories_slug ?>"> <strong class="menu-icon"><i class="<?php echo $ctg_parent_row->categories_icon; ?>" ></i></strong>   <?php echo $ctg_parent_row->categories_name;?> 
			<?php if ($row_cnt > 0): ?>
				<span><i class="fas fa-chevron-right"></i></span>
			<?php endif ?>
			
			</a> 
			<?php if ($row_cnt > 0): ?>
				
					<div class="new-mega-menu">
				<div class="row">
					<?php while ($ctg_subparent_row = mysqli_fetch_object($ctg_subparent_query) ): ?>
						<?php 
							 $ctg_main = "SELECT * FROM ".$db_suffix."categories WHERE categories_parent = '$ctg_subparent_row->categories_id'";
	
							$ctg_main_query = $db->select($ctg_main);
							  $row_cnt_ctg_main = $ctg_main_query->num_rows;
						 ?>
					<div class="col-lg-6 col-md-6 col-12 col-sm-12">
						<div class="mega-menu-wrap">
							
							<?php if ( $row_cnt_ctg_main > 0): ?>
							<h5><a href="<?php echo SITE_URL ?>categories/<?php echo $ctg_subparent_row->categories_slug ?>"><?php echo $ctg_subparent_row->categories_name ?></a></h5>
							
								<ul>
									<?php while ($row = mysqli_fetch_object($ctg_main_query) ): ?>
									<li><a href="categories-page.html"><?php echo $row->categories_name ?></a></li>
									<?php endwhile ?>
								</ul>
							<?php else: ?>
								<ul>
									
									<li><a href="<?php echo SITE_URL ?>categories/<?php echo $ctg_subparent_row->categories_slug ?>"><?php echo $ctg_subparent_row->categories_name ?></a></li>
									
								</ul>
							<?php endif ?>
							
						</div>
					</div>
				<?php endwhile; ?>
				</div>
			</div>
				
			<?php endif; ?>
			
		</li>
<?php endwhile; ?>
	
	</ul>

</div>