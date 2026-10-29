<?php 

session_start();

require_once('common/header.php');

	 $ctg_slug = isset($_REQUEST['slug'])?$_REQUEST['slug']:'';

	 $categories_sql = "select * from ".$db_suffix."categories where categories_slug='$ctg_slug'";

	$categories_query = $db->select($categories_sql);

	$result = mysqli_fetch_object($categories_query);

	  $categories_id = $result->categories_id;
	  $categories_parent = $result->categories_parent;

	  $categories_name = $result->categories_name;

// echo $ctg_slug ;
?>
<style type="text/css">

	.cat-p-hero {}
	.cat-p-hero nav#menu {

	    /*display: block;

	    visibility: visible;

	    opacity: 1;

*/	    z-index: 10;

	    background-color: #fff;

	    left: 0 !important;

	    position: absolute;

	    width: 100% !important;

	}



	.cat-p-hero .new-leftmenu-close {

	    display: none;

	    visibility: hidden;

	    opacity: 0;

	}



.selected-ctg a {

  font-size: 9px !important;

  font-weight: 700;

  color: #26484D !important;

}

.selected-ctg a svg {

  font-size: 11px !important;

}

.cat-p-hero #menu ul li a {

  font-size: 11px;

}

.mm-listitem::after {

    left: 0 !important;

}

.mm-navbar__title span {

	font-size: 9px

}

</style>
<!-- <section class="bredcumb3">
	<div class="container">
		
	</div>
</section> -->

<section id="ctg-page_id" class="ctg-page-hero section-padding">

	<div class="container">
		<div class="row">
			<div class="col-md-12 col-lg-12">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb">
				    <li class="breadcrumb-item"><a href="<?php echo SITE_URL ?>">Home</a></li>
				    <li class="breadcrumb-item"><a href="<?php echo SITE_URL ?>categories">Categories</a></li>
				    <?php if ($categories_parent !='0' || $categories_parent !='' ): 
				    	$categories_p_query = "select * from ".$db_suffix."categories where categories_id='$categories_parent'";
								$categories__P_sql = $db->select($categories_p_query);
								$result_p = mysqli_fetch_object($categories__P_sql);
				    	?>
				    	<?php if ($result_p->categories_slug !=''): ?>
				    		<li class="breadcrumb-item"><a href="<?php echo SITE_URL ?>categories/<?php echo $result_p->categories_slug ?>"><?php  echo $result_p->categories_name ?></a></li>
				    	<?php endif ?>
				    	<?php if ($categories_name != ''): ?>
				    		<li class="breadcrumb-item active" aria-current="page"><?php echo $categories_name  ?></li>
				    	<?php endif ?>
				    	
				    <?php endif ?>
				    
				  </ol>
				</nav>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-12 col-12">
				<div class="cat-p-hero">
					<div class="ctg-p-h-head">
						<?php if ($categories_id != ''): ?>
							<h5>Categories</h5>
						<?php else: ?>
							<h5>Categories</h5>
						<?php endif; ?>
					</div>
					<div class="cat-p-hero-slider">
						<?php 
						if ($categories_id != '') {

							 $sql1 = "SELECT * FROM ".$db_suffix."categories where categories_parent = '$categories_id' ORDER BY categories_name asc";

						}else {

							 $sql1 = "SELECT * FROM ".$db_suffix."categories where categories_parent = '0' ORDER BY categories_name asc";

						}

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

									$sub_content_datea2  ='';

									if ($total_rows2 > 0) {

										$sub_content_datea2  =	'<span><i class="fas fa-chevron-right"></i></span>';

									}

									if ($total_rows2 > 0) {

										$content_data .= '

									<div class="ctg-p-menu" id="menu_id-1">

										<a href="javascript:void(0);">'.trim($cat_name).$sub_content_datea2.' </a> ';

									}else{

										$content_data .= ' 

									<div class="ctg-p-menu" id="menu_id-1">

										<a href="'.SITE_URL.'listing/'.$cat_slug.'">'.trim($cat_name).$sub_content_datea2.' </a> ';

									}

									

									if ($total_rows2 > 0) {

									

									

									$sub_content_datea .='<div class="ctg-p-mega-menu">

											<ul>

											';

									while($subcat_obj2 = mysqli_fetch_object($categories_obj2))

									{
										$cat_id2 = $subcat_obj2->categories_id;

									$cat_name2 = $subcat_obj2->categories_name;

									$cat_slug2 = $subcat_obj2->categories_slug;
									$total_rows3 = $categories_obj2->num_rows;
									 $sql3 = "SELECT * FROM ".$db_suffix."categories where categories_parent = '$cat_id2' ORDER BY categories_name asc";

									$categories_obj3 = $db->select($sql3);
									$total_rows4 = $categories_obj3->num_rows;
									if ($total_rows4 > 0) {
												$sub_content_datea .= 	'<li><a href="'.SITE_URL.'categories/'.$subcat_obj2->categories_slug.'"> '.$subcat_obj2->categories_name.' </a></li>';
											}else{
												$sub_content_datea .= 	'<li><a href="'.SITE_URL.'listing/'.$subcat_obj2->categories_slug.'"> '.$subcat_obj2->categories_name.' </a></li>';
											}

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

				

					</div>

				

					<nav id="menu" class="leftmenu-item left-mega-menu3">

						<span class="new-leftmenu-close"><i class="fas fa-times"></i></span>

					    <ul>

					    	<?php if ($ctg_slug !=''): ?>

					    		<li class="selected-ctg"><a href="<?php echo SITE_URL ?>categories#ctg-page_id"><i class="fas fa-chevron-left"></i> <?php echo $categories_name ?></a></li>

					    	<?php endif ?>

					        <!-- <li><a href="<?php echo SITE_URL ?>"><i class="fas fa-home"></i> Home</a></li> -->

					<?php 

					if ($ctg_slug !='') {

						 $ctg_parent = "SELECT * FROM ".$db_suffix."categories WHERE categories_parent = '".$categories_id."' order by categories_name asc";

					}else{

						 $ctg_parent = "SELECT * FROM ".$db_suffix."categories WHERE categories_parent = '0' order by categories_name asc";

					}

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

					    </ul>

</nav>

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



			<div class="col-lg-8 col-md-8 col-sm-12 col-12">

				<div class="top-header-search">

					<form  method="POST" class="range-field my-4 w-100" action="<?php echo SITE_URL ?>listing">

						<div class="row">

							<div class="col-lg-5 col-md-5 col-sm-12 from-group">

								  <div class="head-search-form-input">

				                    <input type="text" autocomplete="off" value="<?php echo $_SESSION['search'] ?>" placeholder="Type keywords to find experts" id="txtCountry2" class="form-control typeahead"  name="search">

				                  </div>



							</div>

							<div class="col-lg-5 col-md-5 col-sm-12 from-group">

								<div class="abs-search-icon">

                              <!-- <label class="active" for="SignupCurrentLocation">Locate Your Location</label> -->

	                              <input type="text" id="SignupCurrentLocation" c placeholder="Type your desired location" name="location" class="form-control box" >

	                                    <input id="slat" name="lat" value="" type="hidden">

	                                    <input id="slng" name="lng" value="" type="hidden">

	                                    <input id="sCountry" name="Country" value="" type="hidden">

	                                    <input name="from_page" value="home" type="hidden">

	                                    <div class="range">

	                                      <input id="slider11" class="border-0" type="range" min="0" max="180"  />

	                                      <div class="">

	                                        <span class="distance"> KM</span>  <span class="font-weight-bold text-primary ml-2 mt-1 valueSpan"></span>

	                                      </div>

	                                    </div>

	                                    <span><i class="fas fa-map-marker-alt location-track-icon"></i></span>

	                                    <span class="search-location "><i class="fas fa-globe location-track-icon"></i></span>

	                               <!--  <div class="">

	                                  </div> -->

	                        

	                            </div>

								

							</div>

							

							<div class="col-lg-2 col-md-2 col-sm-12 from-group">

								<input type="submit" class="search_submit" name="search_submit" placeholder="" value="Search">

							</div>

						</div>

					</form>

				</div> 

				<div class="hero-slider owl-carousel">

					<?php 

						 $banner_parent = "SELECT * FROM ".$db_suffix."banner WHERE banner_iscategory = '1' and category_ids = '".$categories_id."' order by banner_order asc";
						$banner_parent_query = $db->select($banner_parent);
						  $count_ctg_p = count($banner_parent_query);
						 if($count_ctg_p > 0):
						while ($row = mysqli_fetch_object($banner_parent_query) ):

						?>
						<?php  $row->banner_img ?>
						<div class="ctg-page-add" style="background-image: url('<?php echo SITE_URL ?><?php echo $row->banner_image ?>');">
						</div>

					<?php endwhile; else:
						$banner_parent_p = "SELECT * FROM ".$db_suffix."banner WHERE banner_iscategory = '1' and category_ids = '".$$categories_parent."' order by banner_order asc";
						$banner_parent_p_query = $db->select($banner_parent_p);

						while ($row_2 = mysqli_fetch_object($banner_parent_query) ):
					 ?>
					 <div class="ctg-page-add" style="background-image: url('<?php echo SITE_URL ?><?php echo $row_2->banner_image ?>');">
						</div>
					<?php endwhile; endif; ?>
					<!-- <div class="ctg-page-add" style="background-image: url('<?php echo SITE_URL ?>assets/img/recent-job-3.jpg');">

						

					</div>

					<div class="ctg-page-add" style="background-image: url('<?php echo SITE_URL ?>assets/img/recent-job-3.jpg');">

						

					</div> -->

				</div>

				

			</div>

		</div>

	</div>

</section>



<?php 

require_once('common/footer.php');

    

?>