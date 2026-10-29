<?php 
session_start();
require_once('common/header.php');
	 $ctg_slug = isset($_REQUEST['slug'])?$_REQUEST['slug']:'';
	 $categories_sql = "select * from ".$db_suffix."categories where categories_slug='$ctg_slug'";
	$categories_query = $db->select($categories_sql);
	$result = mysqli_fetch_object($categories_query);
	  $categories_id = $result->categories_id;
	  $categories_name = $result->categories_name;
// echo $ctg_slug ;
?>

<section class="ctg-page-hero section-padding">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-12 col-12">
				<div class="cat-p-hero">
					<div class="ctg-p-h-head">
						<?php if ($categories_id != ''): ?>
							<h5>categories</h5>
						<?php else: ?>
							<h5>categories</h5>
						<?php endif; ?>
						
					</div>

					<div class="cat-p-hero-slider owl-carousel">
						<?php 
							$sql1 = "SELECT * FROM ".$db_suffix."categories where categories_parent = '$categories_id' ORDER BY categories_name asc";
							 $categories_obj = $db->select($sql1);

							 $total_rows = $categories_obj->num_rows;
							 $content_data = '';

							if($total_rows >0){

								$content_data = '<div class="single-ctg-page-wrap">';
								$i=1;
								$div_start = 1;


								while($subcat_obj = mysqli_fetch_object($categories_obj))
								{

									$cat_id = $subcat_obj->categories_id;
									$cat_name = $subcat_obj->categories_name;
									$cat_slug = $subcat_obj->categories_slug;

									 $sql2 = "SELECT * FROM ".$db_suffix."categories where categories_parent = '$cat_id' ORDER BY categories_name asc";
									$categories_obj2 = $db->select($sql2);

									$total_rows2 = $categories_obj2->num_rows;
									$sub_content_datea ='';
									if ($total_rows2 > 0) {
										$sub_content_datea2  =	'<span><i class="fas fa-chevron-right"></i></span>';
									}
									
									$content_data .= '
									<div class="ctg-p-menu" id="menu_id-1">
										<a href="'.SITE_URL.'listing/'.$cat_slug.'">'.$cat_name.$sub_content_datea2.' </a> ';
									if ($total_rows2 > 0) {
									
									
									$sub_content_datea .='<div class="ctg-p-mega-menu">
											<ul>
											';
									while($subcat_obj2 = mysqli_fetch_object($categories_obj2))
									{
												$sub_content_datea .= 	'<li><a href="'.SITE_URL.'listing/'.$subcat_obj2->categories_slug.'"> '.$subcat_obj2->categories_name.' </a></li>';
									}
												
									
								$sub_content_datea .= '</ul>
										</div>';
									}
									$content_data .= $sub_content_datea.'</div>
									';
									$total=$total_rows-1;

									if($i==6)
									{
										$content_data .="</div>
										";
										$li_items='';
										$i=0;
										$div_start=0;
										if($total!=0){
											$content_data .='<div class="single-ctg-page-wrap">
											';
											$div_start=1;

										}
									}

									$i++;


									

								}
								if($div_start==1){
									$content_data .='</div>
									';
											$div_start=0;
								}


							}
							

							echo $content_data;


						 ?>
					<!-- 	<div class="single-ctg-page-wrap">
							
							<div class="ctg-p-menu" id="menu_id-1">
								<a href="#">Maintenance Worker</a>
							</div>
							<div class="ctg-p-menu">
								<a href="#">Maintenance Worker</a>
							</div>
							<div class="ctg-p-menu">
								<a href="#">Maintenance Worker</a>
							</div>
							<div class="ctg-p-menu">
								<a href="#">Maintenance Worker</a>
							</div>
							<div class="ctg-p-menu">
								<a href="#">Maintenance Worker</a>
							</div>
							<div class="ctg-p-menu">
								<a href="#">Maintenance Worker</a>
							</div>
							<div class="ctg-p-menu">
								<a href="#">Maintenance Worker</a>
							</div>
						</div> -->

						<!-- <div class="single-ctg-page-wrap">
							<div class="ctg-p-menu">
								<a href="#">Maintenance Worker</a>
								<div class="ctg-p-mega-menu">
									<ul>
										<li><a href="#">Maintenance Worke</a></li>
										<li><a href="#">Maintenance Worke</a></li>
										<li><a href="#">Maintenance Worke</a></li>
										<li><a href="#">Maintenance Worke</a></li>
									</ul>
								</div>
							</div>
							<div class="ctg-p-menu">
								<a href="#">Maintenance Worker</a>
							</div>
							<div class="ctg-p-menu">
								<a href="#">Maintenance Worker</a>
							</div>
							<div class="ctg-p-menu">
								<a href="#">Maintenance Worker</a>
							</div>
							<div class="ctg-p-menu">
								<a href="#">Maintenance Worker</a>
							</div>
							<div class="ctg-p-menu">
								<a href="#">Maintenance Worker</a>
							</div>
							<div class="ctg-p-menu">
								<a href="#">Maintenance Worker</a>
							</div>
							<div class="ctg-p-menu">
								<a href="#">Maintenance Worker</a>
							</div>
						</div> -->
					</div>
					<!-- <div class="card-hover-submenu">
						<div class="menu-sub-id-1">
							<ul>
								<li><a href="#">Maintenance Worker</a></li>
								<li><a href="#">Maintenance Worker</a></li>
								<li><a href="#">Maintenance Worker</a></li>
								<li><a href="#">Maintenance Worker</a></li>
							</ul>
						</div>
					</div> -->
				</div>
			</div>

			<div class="col-lg-9 col-md-9 col-sm-12 col-12">
				<div class="hero-slider owl-carousel">
					<div class="ctg-page-add" style="background-image: url('<?php echo SITE_URL ?>assets/img/recent-job-3.jpg');">
						
					</div>
					<div class="ctg-page-add" style="background-image: url('<?php echo SITE_URL ?>assets/img/recent-job-3.jpg');">
						
					</div>
					<div class="ctg-page-add" style="background-image: url('<?php echo SITE_URL ?>assets/img/recent-job-3.jpg');">
						
					</div>
				</div>
				
			</div>
		</div>
	</div>
</section>

<?php 
require_once('common/footer.php');
    
?>