<?php 
require_once('common/header.php');

$blog_slug = isset($_REQUEST['slug'])?$_REQUEST['slug']:'';
$blog_query = "select * from ".$db_suffix."blog where blog_slug='$blog_slug'";
$blog_sql = $db->select($blog_query);
$result = mysqli_fetch_object($blog_sql);
$blog_id = $result->blog_id;

 $blog_query_ctg =  "SELECT * FROM ".$db_suffix."blog b left join ".$db_suffix."blog_categories bc on  b.categories_id = bc.blog_categories_id WHERE b.blog_id=".$blog_id."";
$blog_sql_ctg = $db->select($blog_query_ctg);
$blog = mysqli_fetch_object($blog_sql_ctg);
$blog_title = $blog->blog_title;
$blog_desc = $blog->blog_desc;
$blog_categories_name = $blog->blog_categories_name;
$blog_meta_title = $blog->blog_meta_title;
$blog_meta_desc = $blog->blog_meta_desc;
$blog_meta_keyword = $blog->blog_meta_title;
$blog_author = $blog->blog_author;
$blog_featured = $blog->blog_featured;
$blog_tag = $blog->blog_tag;
// $blog_update_date = $blog->blog_update_date;
$blog_img = SITE_URL.'data/images/blog/'.$blog->blog_img;
$blog_update_date = strtotime($blog->blog_update_date);
								$blog_update_date = date('d F, Y', $blog_update_date);

?>
<!-- New Header section end -->
<section class="section-padding bredcumb" style="background-image: url('<?php echo $blog_img; ?>');">
	<div class="container">
		
		<div class="row text-center">
			<div class="col-lg-12">
			<?php require_once('common/banner-search.php'); ?>
				<!-- <h4 class="bredcumb-title">Listing</h4> -->
				<p><a href="<?php echo SITE_URL; ?>"><i class="fas fa-home"></i> Home <span></a><i class="fas fa-arrow-circle-right"></i></span>  <?php echo $blog_title ?> </p>	
			</div>
		</div>
	</div>
</section>


<section class="blog-details section-padding">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-8">
				<div class="blog-desc">
					<h2 class="blog-title"><?php echo $blog_title; ?></h2>
					<div class="blog-meta">
						<span class="date"><?php echo $blog_categories_name ?>, By</span>
						<span class="author">By admin</span>
						<span class="date">, <?php echo $blog_update_date; ?> </span>
					</div>
					<img src="<?php echo $blog_img; ?>">

					<?php echo $blog_desc; ?>
				</div>

				<div class="blog-tag">
					Tags: 
					<span><?php echo $blog_tag ?> </span>
					
				</div>
				<div class="blog-share">
					<a href="" class="facebook"><span><i class="fab fa-facebook"></i></span> Facebook</a>
					<a href="" class="twitter"><span><i class="fab fa-twitter"></i></span> Twitter</a>
					<a href="" class="pinterest"><span><i class="fab fa-pinterest"></i></span> Pinterest</a>
				</div>

		<!-- 		<div class="comment">
					<h4>comments (3)</h4>
					<ul class="new-comment">
						<li>
							<div class="single-ceomment">
								<div class="author-img">
									<img src="">
								</div>
								<div class="comment-desc">
									<h6 class="author-title">Sydur</h6>
									<div class="commet-meta"> <span>15 Dec, 2020</span> <a href="#">Replay</a></div>

									<div class="comment-text">
										Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
										tempor incididunt ut labore et dolore magna aliqua.
									</div>
								</div>
							</div>
							<ul class="#">
								<li>
									<div class="single-ceomment replay">
										<div class="author-img">
											<img src="">
										</div>
										<div class="comment-desc">
											<h6 class="author-title">Sydur</h6>
											<div class="commet-meta"> <span>15 Dec, 2020</span> <a href="#">Replay</a></div>

											<div class="comment-text">
												Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
												tempor incididunt ut labore et dolore magna aliqua.
											</div>
										</div>
									</div>
								</li>
							</ul>
						</li>
						<li>
							<div class="single-ceomment">
								<div class="author-img">
									<img src="">
								</div>
								<div class="comment-desc">
									<h6 class="author-title">Sydur</h6>
									<div class="commet-meta"> <span>15 Dec, 2020</span> <a href="#">Replay</a></div>

									<div class="comment-text">
										Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
										tempor incididunt ut labore et dolore magna aliqua.
									</div>
								</div>
							</div>
							<ul class="#">
								<li>
									<div class="single-ceomment replay">
										<div class="author-img">
											<img src="">
										</div>
										<div class="comment-desc">
											<h6 class="author-title">Sydur</h6>
											<div class="commet-meta"> <span>15 Dec, 2020</span> <a href="#">Replay</a></div>

											<div class="comment-text">
												Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
												tempor incididunt ut labore et dolore magna aliqua.
											</div>
										</div>
									</div>
								</li>
							</ul>
						</li>
					</ul>

				</div>
 -->
	<!-- 			<div class="leave-comment">
					<h4>Leave A Comment</h4>
					<p>Your email address will not be published. Required fields are marked (required)</p>
					<form>
						<div class="row">
							<div class="col-lg-4 col-md-4">
								<label>Name*</label>
								<input type="text" name="name" placeholder="Enter your name" required="required">
							</div>
							<div class="col-lg-4 col-md-4">
								<label>email</label>
								<input type="email" name="email" placeholder="Enter your Email Address">
							</div>
							<div class="col-lg-4 col-md-4">
								<label>website</label>
								<input type="text" name="webiste" placeholder="Enter your Website If any">
							</div>
							<div class="col-lg-12">
								<label>Comment</label>
								<textarea name="comment"></textarea>
							</div>
							<div class="col-lg-12">
								<button type="submit boxed-btn">Submit</button>
							</div>
						</div>
					</form>
				</div> -->
			</div> 
			
<?php 
require_once('common/sidebar.php');
    
?>
		</div>
	</div>
</section>



<?php 
require_once('common/footer.php');
    
?>