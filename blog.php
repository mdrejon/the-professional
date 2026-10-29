<?php
$page = 'blog';
require_once('common/header.php');
	
?>
<!-- New Header section end -->
<section class="section-padding bredcumb" style="background-image: url('assets/img/bannar-4.jpg');">
	<div class="container">
		
		<div class="row text-center">
			<div class="col-lg-12">
			<?php require_once('common/banner-search.php'); ?>
				<!-- <h4 class="bredcumb-title">Listing</h4> -->
				<p><a href="<?php echo SITE_URL; ?>"><i class="fas fa-home"></i> Home <span></a><i class="fas fa-arrow-circle-right"></i></span>  Blog </p>	
			</div>
		</div>
	</div>
</section>

<section class="new-blog section-padding">
	<div class="container">
		<div class="row">
			<?php 
			 	$blog_query = "SELECT * FROM ".$db_suffix."blog b left join ".$db_suffix."blog_categories bc on b.categories_id = bc.blog_categories_id  WHERE blog_status = '1' ORDER BY blog_id desc, blog_order asc";
				
				$blog_sql = $db->select($blog_query);
				while ($row = mysqli_fetch_object($blog_sql)): 
					$blog_update_date = strtotime($row->blog_update_date);
								$blog_update_date = date('d F, Y', $blog_update_date);
					?>
			<div class="col-lg-4">
				<div class="single-blog-slider">
					<a href="<?php echo SITE_URL ?>blog/<?php echo $row->blog_slug ?>" class="blog-img" style="background-image: url('<?php echo SITE_URL ?>data/images/blog/<?php echo $row->blog_img ?>');">
						<div class="blog-img-wrap ">
							<!-- <span><a href="#"><i class="fas fa-image"></i></a></span>
							<span><a href="<?php echo SITE_URL ?>blog/<?php echo $row->blog_slug ?>"><i class="fas fa-link"></i></a></span> -->
						</div>

						
					</a>
					<div class="blog-text">
						<span class="blog-ctg"><?php echo $row->blog_categories_name ?></span>
							<h5><a href="<?php echo SITE_URL ?>blog/<?php echo $row->blog_slug ?>"><?php echo $row->blog_title ?></a></h5>
						<div class="blog-meta">
							<span class="date"><?php echo $blog_update_date;  ?></span> 
							<?php if(!empty($row->blog_author)): ?>
							By <span class="author"><?php echo $row->blog_author; ?></span>
							<?php endif; ?>
						</div>
						 <p><?php echo substr($row->blog_desc, 0, 201);  ?>.. </p>

					</div>
					
				</div>
			</div>
			<?php endwhile; ?>
			<!-- <div class="col-lg-4">
				<div class="single-blog-slider">
					<div class="blog-img" style="background-image: url(assets/img/bannar-2.jpg);">
						<div class="blog-img-wrap ">
							<span><a href="#"><i class="fas fa-image"></i></a></span>
							<span><a href="blog-details.html"><i class="fas fa-link"></i></a></span>
						</div>

						
					</div>
					<div class="blog-text">
						<span class="blog-ctg">Work</span>
						<h5>Lorem ipsum dolor sit amet,</h5>
						<div class="blog-meta">
							<span class="date">January 26, 2017,</span> By <span class="author">Admin</span>
						</div>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua.</p>

					</div>
					<div class="blog-btn">
						<div class="left">
							<a href=""></a>
						</div>
					</div>
				</div>
			</div> -->
		</div>

	</div>

	<div class="row text-center">
		<div class="col-lg-12">
			<a class="boxed-btn" href="">View More</a>
		</div>
	</div>
</section>

<?php 
require_once('common/footer.php');
    
?>