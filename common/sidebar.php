<div class="col-lg-4">
				<div class="sidebar">
					<div class="single-side-content">
						<form method="POST" action="">
							<input type="text" name="search" placeholder="Blog Search">
							<button type="submit" name="blog-search"> <i class="fas fa-search"></i></button>
						</form>
						
					</div>
					<div class="single-side-content">
						<h5>Categories</h5>
						<?php 
						 	$blog_ctg = "SELECT * FROM ".$db_suffix."blog_categories ORDER BY  	blog_categories_id desc, blog_categories_order asc limit 10 ";
							
							$blog_ctg_sql = $db->select($blog_ctg);
						?>
						
						<ul>
							<?php while ($row = mysqli_fetch_object($blog_ctg_sql)):  ?>
								<?php if (!empty($row->blog_categories_slug)): ?>
									<li><span><i></i></span> <a href="<?php echo SITE_URL ?>blog/categories/<?php echo $row->blog_categories_slug  ?>"><?php echo $row->blog_categories_name ?></a></li>
								<?php endif ?>
							
							<?php endwhile; ?>
						</ul>
					</div>
					<div class="single-side-content">
						<h5>Featured</h5>
						<?php 
						 	$blog_featured  = "SELECT * FROM ".$db_suffix."blog WHERE blog_featured ='1' ORDER BY blog_id desc, blog_order asc limit 6 ";							
							$blog_featured_sql = $db->select($blog_featured);
						?>
						<ul>
							<?php while ($row = mysqli_fetch_object($blog_featured_sql)):  ?>
							<li>
								<img style="height: 60px"  src="<?php echo SITE_URL?>data/images/blog/<?php echo $row->blog_img ?>">
								<div class="feature-info">
									<h6><a href="<?php echo SITE_URL ?>blog/<?php echo $row->blog_slug ?>"><?php echo $row->blog_title ?></a></h6>
									<p><?php echo substr($row->blog_desc, 0, 50);  ?>.. </p>
								</div>
							</li>
							<?php endwhile; ?>
							<!-- <li>
								<img src="assets/img/blog-img.jpg">
								<div class="feature-info">
									<h6><a href="#">Hello World</a></h6>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,</p>
								</div>
							</li> -->
						</ul>
					</div>
					<div class="single-side-content">
						<h5>Recent Posts</h5>
						<?php 
						 	$blog_recent  = "SELECT * FROM ".$db_suffix."blog ORDER BY blog_id desc limit 6 ";							
							$blog_recent_sql = $db->select($blog_recent);
						?>
						<ul>
							<?php while ($row = mysqli_fetch_object($blog_recent_sql)):  ?>
							<li><span><i></i></span> <a href="<?php echo SITE_URL ?>blog/<?php echo $row->blog_slug ?>"><?php echo $row->blog_title ?></a></li>
							<?php endwhile; ?>
							<!-- <li><span><i></i></span> <a href="#">Allah Mohan</a></li> -->
						</ul>
					</div>
					<!-- 
					<div class="single-side-content">
						<h5>Recent Comments</h5>
						<ul>
							<li><span><i></i></span> <a href="#">Uncategorized</a></li>
						</ul>
					</div> -->
				</div>
			</div>