<?php 
require_once('common/header.php');
	
?>
<!-- New Header section end -->
<?php 
 	$content_query = "SELECT * FROM ".$db_suffix."content WHERE content_id='6'";
	
	$content_sql = $db->select($content_query);
	$result = mysqli_fetch_object($content_sql) ;
	$content_id = $result->content_id;
	$content_title = $result->content_title;
	$content_subtitle = $result->content_subtitle;
	$content_desc = $result->content_desc;
	$content_meta_title = $result->content_meta_title;
	$content_meta_desc = $result->content_meta_desc;
	$content_meta_keyword = $result->content_meta_keyword;
	$content_img = SITE_URL.'data/images/content/'.$result->content_img;

?>

<section class="section-padding bredcumb" style="background-image: url('assets/img/bannar-4.jpg');">
	<div class="container">
		
		<div class="row text-center">
			<div class="col-lg-12">
			<?php require_once('common/banner-search.php'); ?>
				<!-- <h4 class="bredcumb-title">Listing</h4> -->
				<p><a href="<?php echo SITE_URL; ?>"><i class="fas fa-home"></i> Home <span></a><i class="fas fa-arrow-circle-right"></i></span>  <?php echo $content_title; ?> </p>	
			</div>
		</div>
	</div>
</section>


<section class="page trems section-padding">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="section-title">
					<h5><?php echo $content_title; ?></h5>
					<!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, </p> -->
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<?php echo $content_desc ?>
			</div>
		</div>
	</div>
</section>

<?php 
require_once('common/footer.php');
    
?>