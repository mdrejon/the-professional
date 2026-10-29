<?php 
require_once('common/header.php');
	
?>
<!-- New Header section end -->
<section class="section-padding bredcumb" style="background-image: url('assets/img/bannar-4.jpg');">
	<div class="container">
		<div class="row text-center">
			<div class="col-lg-12">
			<?php require_once('common/banner-search.php'); ?>
				<!-- <h4 class="bredcumb-title">Listing</h4> -->
				<p><a href="<?php echo SITE_URL; ?>"><i class="fas fa-home"></i> Home <span></a><i class="fas fa-arrow-circle-right"></i></span>  Services </p>	
			</div>
		</div>
	</div>
</section>
<section class="listing section-padding">
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-3 col-md-4">
			<div class="filter">
				<div class="single-filter">
					<h5 class="filter-title">Categories</h5>
					<div class="filter-item">
						<ul>
							<!-- <li class="highlite"> All categories</li> -->
							<?php //echo  
								$categories_query = "SELECT * FROM ".$db_suffix."categories WHERE categories_status = '1' ORDER BY categories_id desc, categories_order asc";
								$categories = $db->select($categories_query);
								while ($row = mysqli_fetch_object($categories)): 
							?>
							<!-- <li><input type="checkbox" class="form-check-input" name="">   Accountant <span>20</span></li> -->
							<li><input type="checkbox" class="product_check" value="<?php echo $row->categories_id ?>" id="categories" name="">  <?php echo $row->categories_name ?> 
							 <!-- <span>20</span> -->
							</li>
							<?php endwhile; ?>
						</ul>
					</div>
				</div>

				<div class="single-filter">
					<h5 class="filter-title">Countries</h5>
					<div class="filter-item">
						<ul>
							<!-- <li class="highlite"> All Country</li> -->
							<?php //echo  
								 $country_query = "SELECT * FROM countries";
								$country = $db->select($country_query);
								while ($row = mysqli_fetch_object($country)): 
							?>
							<!-- <li><input type="checkbox" class="form-check-input" name="">   Accountant <span>20</span></li> -->
							<li><input type="checkbox" class="product_check" value="<?php echo $row->country_id ?>" id="country" name="">  <?php echo $row->country_name ?>  
								<!-- <span>20</span> -->
							</li>
							<?php endwhile; ?>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<div class="col-lg-9 col-md-8">
			<div class="member-list job-section">
				<!-- <div class="search-bar">
					<input type="text" name="search" placeholder="Search Here">
					<button type="submit"><i class="fas fa-search"></i></button>
				</div> -->
				<ul class="nav nav-tabs member-tabs" id="myTab" role="tablist">
				   <li class="nav-item">
				   	 <a class="nav-link" id="verified-tab"><input type="checkbox" class="product_check d-none" value="verified" id="re_added" name="verified"> <label for="re_added">Recently Added</label></a>
				   
				  </li>
				  <li class="nav-item">
				  	 <a class="nav-link" id="verified-tab"><input type="checkbox" class="product_check d-none" value="verified" id="all_job" name="verified"> <label for="re_added">All Services</label></a>

				    <!-- <a class="nav-link" id="unverified-tab"><input type="checkbox" class="product_check" value="unverified" id="unverified" name="all_job"> All Job</a> -->
				  </li>
				</ul>
				<div class="tab-content" id="myTabContent">
				  <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
				  	<div class="text-center">
				  		<img src="<?php echo SITE_URL ?>assets/img/loader.gif" id="loader" style="display: none;" >
				  		
				  	</div>
				  	
				  	<div id="load_data"></div>
				  	<div id="load_data_message" class="text-center"></div>
				  	
				  </div>
				 <!--  <div class="tab-pane fade show " id="verified" role="tabpanel" aria-labelledby="verified-tab">
				  	<div class="text-center">
				  		<img src="<?php echo SITE_URL ?>assets/img/loader.gif" id="loader" style="display: none;" >
				  		
				  	</div>
				  		<div id="load-job">

						</div>
						<div id="load-job-massage">
							
						</div>
				  </div> -->
				</div>
			
			</div>
		</div>
	</div>
</div>


</section>

<script type="text/javascript">
$(document).ready(function(){
  var limit = 10;
 var start = 0;
 var action = 'inactive';
// alert(country);
$(".product_check").click(function(){
	  limit = 10;
	  start = 0;
	  action = 'inactive';
	 $('#load_data').html('');
	$("#loader").show();
	load_country_data(limit, start)

	// var action = 'data';
	// var categories = get_filter_text('categories')
	
	// var country = get_filter_text('country')
	// var verified = get_filter_text('verified')
	// var unverified = get_filter_text('unverified')
	// var search = get_filter_text('search')
	// // alert (search);
	
	
	// $.ajax({
	// 	url:'<?php echo SITE_URL ?>inc/ajax_filter_list.php',
	// 	method:'POST',
	// 	data:{action:action,categories:categories,country:country,verified:verified,unverified:unverified},
	// 	success:function(response){
	// 		$("#result").html(response);
	// 		$("#loader").hide();
	// 	}
	// })
});

 function get_filter_text(text_id){
	var filterData = [];
	$('#'+text_id+':checked').each(function(){
		filterData.push($(this).val());
	});
	return filterData;
}
 function load_country_data(limit, start)
 {
 var categories = get_filter_text('categories')		
 var country = get_filter_text('country')
 var verified = get_filter_text('verified')
 var unverified = get_filter_text('unverified')
 var search = get_filter_text('search')
  $.ajax({
   url:"<?php echo SITE_URL ?>inc/load_services.php",
   method:"POST",
   data:{limit:limit,start:start,categories:categories,country:country,verified:verified,unverified:unverified},
   cache:false,
   success:function(res)
   {
    $('#load_data').append(res);
    $("#loader").hide();
    if(res.trim() == '')
    {
     $('#load_data_message').html("<button type='button' class='btn btn-info'>All Services showing in this search</button>");
     action = 'active';
    }
    else
    {
     $('#load_data_message').html("<button type='button' class='btn btn-warning'>Please Wait....</button>");
     action = "inactive";
    }
   }
  });
 }
 if(action == 'inactive')
 {
  action = 'active';
  load_country_data(limit, start);
 }
 $(window).scroll(function(){
  if($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive')
  {
   action = 'active';
   start = start + limit;
   setTimeout(function(){
    load_country_data(limit, start);
   }, 3000);
  }
 });
 
});
</script>


<?php 
require_once('common/footer.php');
?>