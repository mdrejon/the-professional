<?php 
$page = 'about';
require_once('common/header.php');
	
?>
<!-- New Header section end -->
<?php 
 	$about_query = "SELECT * FROM ".$db_suffix."content WHERE content_id='22'";
	
	$about_sql = $db->select($about_query);
	$result = mysqli_fetch_object($about_sql) ;
	$about_id = $result->content_id;
	$about_title = $result->content_title;
	$about_subtitle = $result->content_subtitle;
	$about_desc = $result->content_desc;
	$about_meta_title = $result->content_meta_title;
	$about_meta_desc = $result->content_meta_desc;
	$about_meta_keyword = $result->content_meta_keyword;
	$about_img = SITE_URL.'data/images/content/'.$result->content_img;

?>

<section class="section-padding bredcumb" style="background-image: url('<?php echo $about_img; ?>');">
	<div class="container">
		<div class="row text-center">
			<div class="col-lg-12">
			<?php require_once('common/banner-search.php'); ?>
				<!-- <h4 class="bredcumb-title">Listing</h4> -->
				<p><a href="<?php echo SITE_URL; ?>"><i class="fas fa-home"></i> Home <span></a><i class="fas fa-arrow-circle-right"></i></span>  About </p>	
			</div>
		</div>
	</div>
</section>


<section class="welcome-section section-padding">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="section-title">
					<h5><?php echo $about_title; ?></h5>
					<!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, </p> -->
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6">
				<div class="welcome-img">
					<img src="<?php echo $about_img; ?>">
				</div>
			</div>
			<div class="col-lg-6">
				<div class="welcome-wrap d-table">
					<div class="d-table-cell">
						<h2><?php echo $about_subtitle; ?></h2>

						<p><?php echo $about_desc; ?></p>

						<a href="<?php echo SITE_URL ?>listing" class="boxed-btn bg">See All Expart Listings <span><i class="fas fa-arrow-circle-right"></i></span></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="counter section-padding">
	<div class="container">
		<div class="row">

			<div class="col-lg-3">
				<div class="single-counter">
					<h2 class="counter">985</h2>
					<span>Happy Coustomers</span>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="single-counter">
					<h2 class="counter">796</h2>
					<span>Listing page</span>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="single-counter">
					<h2 class="counter">3890</h2>
					<span>Best Followers</span>
				</div>
			</div> 
			<div class="col-lg-3">
				<div class="single-counter">
					<h2 class="counter">80</h2>
					<span>Team Members</span>
				</div>
			</div>
		</div>
		
	</div>
</section>

<?php 
require_once('common/it-works.php');
    
?>

<?php 
require_once('common/footer.php');
    
?>