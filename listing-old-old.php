<?php 
session_start();
require_once('common/header.php');

 $member_slug = isset($_REQUEST['slug'])?$_REQUEST['slug']:'';
 $categories_slug = isset($_REQUEST['slug'])?$_REQUEST['slug']:'';
$categories_query = "select * from ".$db_suffix."categories where categories_slug='$categories_slug'";
$categories_sql = $db->select($categories_query);
$result = mysqli_fetch_object($categories_sql);
  $categories_id = $result->categories_id;

$member_id = $_SESSION['member_id'];
// $member_id = $_SESSION['member_email'];
$member_s = "select * from ".$db_suffix."member where member_id='$member_id'";
$member_q = $db->select($member_s);
$member = mysqli_fetch_object($member_q);
 $member_username = $member->member_username;

if (isset($_POST['search_submit'])) {
	  $location = $_POST['location'];
	 $search = $_POST['search'];
	  $expart = $_POST['expart'];
	   $range = $_POST['range'];
	   $location = $_POST['location'];
	   $lat = $_POST['lat'];
	   $lng = $_POST['lng'];
	  if ($range == 0 ) {
	  		$range = 10;
	  }
	  if ($lat == '') {
	  	 	$lat = $_SESSION['lat'];
	  }
	  if ($lat == '') {
	  		$lng = $_SESSION['lng'];
	  }
	  $lat;

}
?>
<!-- New Header section end -->
<section class="section-padding bredcumb" style="background-image: url('assets/img/bannar-4.jpg');">
	<div class="container">
		
		<div class="row text-center">
			<div class="col-lg-12">
			<?php require_once('common/banner-search.php'); ?>
				<!-- <h4 class="bredcumb-title">Listing</h4> -->
				<p><a href="<?php echo SITE_URL; ?>"><i class="fas fa-home"></i> Home <span></a><i class="fas fa-arrow-circle-right"></i></span>  Listing </p>	
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
					<h5 class="filter-title">Category</h5>
					<div class="filter-item">
						<ul >
							
							<li class="highlite"> All categories</li>
							<?php //echo 
							// if ($categories_id !='') {
							//  	$categories_query = "SELECT * FROM ".$db_suffix."categories WHERE categories_parent = '$categories_id'  ORDER BY categories_id desc, categories_order asc";
							//  }else{
							//  	$categories_query = "SELECT * FROM ".$db_suffix."categories WHERE categories_parent > '0'  ORDER BY categories_id desc, categories_order asc";
							//  }
								$categories_query = "SELECT * FROM ".$db_suffix."categories WHERE categories_parent > '0'  ORDER BY categories_id desc, categories_order asc";
				
								$categories = $db->select($categories_query);
								while ($row = mysqli_fetch_object($categories)): 
							?>
							<!-- <li><input type="checkbox" class="form-check-input" name="">   Accountant <span>20</span></li> -->
							<li><input type="checkbox" class="product_check" value="<?php echo $row->categories_id ?>" id="categories" name="">  <?php echo $row->categories_name ?>  

							<span><?php echo $row->categories_total_member; ?></span></li>

							<?php endwhile; ?>
						</ul>
					</div>

				</div>

				<div class="single-filter">
					<h5 class="filter-title">Country</h5>
					<div class="filter-item">
						<ul >
							
							<li class="highlite"> All Country</li>
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
			<div class="member-list">
				<!-- <div class="search-bar">
					<input type="text" name="text_search" id="text_search" placeholder="Search Here">
					<button class="product_check" type="submit" name="text_search_submit" value="search">search</button>
				</div> -->
				<ul class="nav nav-tabs member-tabs" id="myTab" role="tablist">
				 <!--  <li class="nav-item">
				    <a class="nav-link" href="">All</a>
				  </li> -->
				  <li class="nav-item">

				    <a class="nav-link" id="verified-tab"><input type="checkbox" class="product_check verify-chk" value="verified" id="verified" name="verified"> <label for="verified">Verified</label></a>
				  </li>
				  <li class="nav-item">
				    <a class="nav-link" id="unverified-tab"><input  type="checkbox" class="product_check verify-chk" value="unverified" id="unverified" name="unverified">  <label for="unverified">unverified</label></a>
				  </li>
				</ul>
				<div class="tab-content" id="myTabContent">
				  <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
				  	<div class="text-center">
				  		<img src="<?php echo SITE_URL ?>assets/img/loader.gif" id="loader" style="display: none;" >
				  		
				  	</div>

				  	<div id="result">
				  	<div id="load_data">
				  		<?php 
					  	if (!empty($member_slug)) {
					  		$member_query =  "SELECT * FROM ".$db_suffix."member where categories_id = '".$categories_id."' AND member_email_verification = 'yes'";
					  	}elseif($location !='' ){
					  	  $sql_distance = $having = ''; 
					  	  $radius_km = $range; 
						   $sql_distance = " ,(((acos(sin((".$lat."*pi()/180)) * sin((`p`.`member_location_latitude`*pi()/180))+cos((".$lat."*pi()/180)) * cos((`p`.`member_location_latitude`*pi()/180)) * cos(((".$lng."-`p`.`member_location_longitude`)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance "; 
						     
						    $having = " HAVING (distance <= $radius_km) "; 
						     
						    $order_by = ' distance ASC '; 
					  		
						// Fetch places from the database 
						 $member_query = "SELECT p.*".$sql_distance." FROM ".$db_suffix."member p left join ".$db_suffix."categories ca on p.categories_id = ca.categories_id  where p.member_email_verification = 'yes' AND p.categories_id = '".$expart."' or p.member_email_verification = 'yes' AND ca.categories_name = '".$search."' $having  ORDER BY $order_by"; 
					  	}
					  	// elseif($location != '' ||  $search !='' || $expart !=''){
					  	// echo   $member_query =  "SELECT * FROM ".$db_suffix."member where categories_id = '".$expart."' or categories_id = '".$search."' ";
					  	// }
					  	else{
					  		$member_query =  "SELECT * FROM ".$db_suffix."member where member_email_verification = 'yes'   LIMIT 2";
					  	}
					  		
							$member_sql = $db->select($member_query);

							if ($member_sql->num_rows > 0) {
							while($row = mysqli_fetch_object($member_sql)):
								$member_img = $row->member_img;
								if ($member_img == '') {
									if ($row->member_gender == 'male') {
										$member_img = 'male-avata.png';
									}elseif ($row->member_gender == 'female'){
										$member_img = 'female-avata.png';
									}
								}
								
								// if (!empty($row->member_desc)):
					  	 ?>
					  		<div class="single-list">
								<div class="row">
									<div class="col-lg-3 col-md-4">
										<div class="single-member-img">
											<img src="<?php echo SITE_URL ?>member/images/<?php echo $member_img ?>">
										</div>
									</div>
									<div class="col-lg-6 col-md-8">
										<div class="single-member-text">
											<h4 class="single-member-name"><?php echo $row->member_first_name ?> <?php echo $row->member_last_name ?></h4>
											<?php if ($row->categories_id != '0'): ?>
												<h6 class="member-name-title"><span><?php echo $row->categories_name; ?></span></h6>
											<?php endif ?>
											
											<?php if ($row->member_desc != ''): ?>
												<p><?php echo substr($row->member_desc, 0, 201);  ?>..</p>
											<?php endif ?>
											

											<div class="date">
												<!-- <span>Last Update: <b>5 Jan 21</b></span> -->
												
											</div>
											<div class="skill">
												<?php if ( 	$row->member_experience_year != '' || $row->member_experience_year != 0  ): ?>
													<b>Year Experiance : </b>
													<span><?php echo  $row->member_experience_year ?> Year</span>
												<?php endif ?>
												
												<?php if ($row->member_document_verification_status == '1'): ?>
													<span class="verify"><i class="fas fa-user-check"></i></span>
												<?php endif ?>
												
											</div>
										</div>
									</div>
									<div class="col-lg-3 col-md-12">
										<div class="member-button">
											<!-- <button type="button" href="#popup_contact<?php echo $row->member_id ?>" class="contact popup-inline ">Contact</button> -->
											<button type="button" class="contact" data-toggle="modal" data-target="#contact-popup<?php echo $row->member_id ?>">Contact</button>
											<a href="<?php echo SITE_URL ?>members/<?php echo $row->member_username ?>" class="view-profile">View Profile</a>
										</div>
										<!-- <div class="social-link">
											<span><a href="https://www.facebook.com/engrsmc/"><i class="fab fa-facebook"></i></a></span>
												<span><a href="#"><i class="fab fa-twitter"></i></a></span>
												<span><a href="#"><i class="fab fa-linkedin"></i></a></span>
										</div> -->

										<div class="modal fade popup-contact" id="contact-popup<?php echo $row->member_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
										  <div class="modal-dialog" role="document">
										    <div class="modal-content">
										    	<div id="member_mail_send_status"></div>
										      <div class="modal-header">
										        <h5 class="modal-title" id="exampleModalLabel"><h4 class="single-member-name"><?php echo $row->member_first_name ?> <?php echo $row->member_last_name ?></h4></h5>
										        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
										          <span aria-hidden="true">&times;</span>
										        </button>
										      </div>
										      <div class="modal-body">
										        <div class="row">
										        	<?php if ($row->member_contact_phone == 1): ?>
										        		<div class="col-lg-6">
										        		<h6><b>Phone:</b> + <?php echo $row->country_code ?> <?php echo $row->member_phone ?></h6>
										        	</div>
										        	<?php endif ?>
										       
										        	<?php if ($row->member_contact_email == 1): ?>
										        		<div class="col-lg-6">
										        		<h6><b>Email:</b><?php echo $row->member_email ?></h6>
										        	</div>
										        	<?php endif ?>
										       
										   		</div>    
										       	<div class="row">
										       		<form method="POST" action="#">
										       		<div class="col-lg-12">
										       			<input type="text" name="name" class="name" placeholder="Name">
										       			<input type="hidden" readonly name="id" class="member_id" placeholder="Name" value="<?php echo $row->member_id ?> ">
										       			<input type="email" name="email" class="email" placeholder="Email">
										       			<input type="text" name="phone" class="phone" placeholder="Phone">
										       			<textarea name="Messages" class="messages"></textarea>
										       		</div>
										       		<div class="col-lg-12">
										       			<button type="button" class="Contact-submit" >Submit</button>
										       		</div>
										       		</form>
										       	</div>
										       
										      </div>
										    </div>
										  </div>
										</div>
										<div id="popup_contact<?php echo $row->member_id ?>" class=" mfp-hide popup-contact white-popup">
											<div class="container">

												<div class="row">
													<h5 class="modal-title" id="exampleModalLabel"><h4 class="single-member-name"><?php echo $row->member_first_name ?> <?php echo $row->member_last_name ?></h4></h5>
												</div>
												 <div class="row">
											        	<?php if ( 	$row->member_contact_phone == 1): ?>
											        	<div class="col-lg-6">
											        		
											        			<h6><b>Phone:</b>+ <?php echo $row->country_code ?> <?php echo $row->member_phone ?></h6>
											        		
											        		
											        	</div>
											        	<?php endif ?>
											        	<?php if ( 	$row->member_contact_email == '1' && !empty($member_id) ): ?>
											        	<div class="col-lg-6">
											        		
											        			<h6><b>Email:</b> <?php echo $row->member_email ?></h6>
											        		
											        		
											        	</div>
											        	<?php endif ?>
											        </div>
											       	<div class="row">
											       		<form method="POST" action="#">
											       			<div id="member_mail_send_status"></div>
												       		<div class="col-lg-12">
												       			<input type="text" required name="name" class="name" placeholder="Name">
												       			<input type="text" readonly name="id" class="member_id" placeholder="Name" value="<?php echo $row->member_id ?>">
												       			<input type="email" required name="email" class="email" placeholder="Email">
												       			<input type="text" required name="phone" class="phone" placeholder="Phone">
												       			<textarea required name="message" class="message">
												       				
												       			</textarea>
												       		</div>
												       		<div class="col-lg-12">
												       			<?php if (!empty($member_id)): ?>
												       				<button type="submit" name="submit-<?php echo $row->member_username ?>" id= "submit-<?php echo $row->member_username ?>"class="Contact-submit">Submit</button>
												       			<?php else: ?>
												       				<!-- <button type="submit" name="submit-<?php echo $row->member_username ?>" class="Contact-submit">Submit</button> -->
												       				<a href="<?php echo SITE_URL ?>/sign-in" class="Contact-submit">Submit</a>
												       			<?php endif ?>
												       			
												       			
												       		</div>
											       		</form>
											       	</div>

											</div>
										       
										</div>
									

									</div>
								</div>
							</div>
						<?php
					endwhile ?>
					<?php }else{ echo "<span class='no-data'>There is no profession found in this search</span>"; } ?>
				  	</div>
				  	<div id="load_data"></div>
				  	<div id="load_data_message"></div>
				  </div><!-- 
				  <div class="tab-pane fade show " id="verified" role="tabpanel" aria-labelledby="verified-tab">
				  </div> -->
				</div>
			
			</div>
		</div>
	</div>
</div>
</section>
<script type="text/javascript">
	$('input.verify-chk').on('change', function() {
    $('input.verify-chk').not(this).prop('checked', false);  
});
</script>
<script type="text/javascript">
	// $('body').delegate('.Contact-submit', 'click', function () {
	// 	$(".Contact-submit").click(function(){
	// 				alert("allah Mohan");
	// 				// var username = $("#id").val();
	// 				var username = $(this).parent().parent().find(".member_username").val();
	// 				// var number=document.getElementById("id").value;

	// 				alert(username);
	// 			});     
 //      });  
	$(document).ready(function(){
		$('body').delegate('.Contact-submit', 'click', function () {
		
					alert("allah Mohan");
					// var username = $("#id").val();
					var member_id = $(this).parent().parent().find(".member_id").val();
					var name = $(this).parent().parent().find(".name").val();
					var email = $(this).parent().parent().find(".email").val();
					var phone = $(this).parent().parent().find(".phone").val();
					var message = $(this).parent().parent().find(".messages").val();
					// var number=document.getElementById("id").value;

					alert(name);
				$.ajax({
				url:'<?php echo SITE_URL ?>inc/send_member_mail.php',
				method:'POST',
				data:{member_id:member_id,name:name,email:email,phone:phone,message:message},
				success:function(response){
					$("#member_mail_send_status").html(response);
					// $("#loader").hide();
				}
			})
      });
		// $(".Contact-submit").click(function(){
		// 	alert("allah Mohan");
		// 	// var username = $("#id").val();
		// 	var username = $(this).parent().parent().find(".member_username").val();
		// 	// var number=document.getElementById("id").value;

		// 	alert(username);
		// });

		

	});
</script>

<!-- <script type="text/javascript">
	$(document).ready(function(){
		$(".product_check").click(function(){
			$("#loader").show();
			var action = 'data';
			var categories = get_filter_text('categories')
			
			var country = get_filter_text('country')
			var verified = get_filter_text('verified')
			var unverified = get_filter_text('unverified')
			var search = get_filter_text('search')
			// alert (search);
			
			
			$.ajax({
				url:'<?php echo SITE_URL ?>inc/ajax_filter_list.php',
				method:'POST',
				data:{action:action,categories:categories,country:country,verified:verified,unverified:unverified},
				success:function(response){
					$("#result").html(response);
					$("#loader").hide();
				}
			})
		});

		function get_filter_text(text_id){
			var filterData = [];
			$('#'+text_id+':checked').each(function(){
				filterData.push($(this).val());
			});
			return filterData;
			
		}


	});
</script> -->
<script>

$(document).ready(function(){
  var limit = 2;
 var start = 0;
 var action = 'inactive';
// alert(country);
$(".product_check").click(function(){
	  limit = 2;
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
   url:"<?php echo SITE_URL ?>inc/load_member.php",
   method:"POST",
   data:{limit:limit,start:start,categories:categories,country:country,verified:verified,unverified:unverified},
   cache:false,
   success:function(res)
   {
    $('#load_data').append(res);
    $("#loader").hide();
    if(res.trim() == '')
    {
     $('#load_data_message').html("<button type='button' class='btn btn-info'>No Data Found</button>");
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
   }, 5000);
  }
 });
 
});
</script>


<!-- <script type="text/javascript">
	$(document).ready(function()
		{
		var limit = 2;
		var start = 0;
		var action = 'inactive';
		// alert(start);
		function load_jobs(limit, start){
			$.ajax({
				url:"inc/load_list.php",
				method:"POST",
				data:{
					limit:limit,
					start:start
				},
				cache:false,
				success:function(data){
					$('#load-job').append(data);
					// alert(data);
					if ( data =='' ) {
						// alert(data);
						$('#load-job-massage').html("No Data Found");
						
						action ="active";
						
						
					}else{
						$('#load-job-massage').html("Please Wait");
						action ="inactive";
					}

				}
			});
		}
		if (action == 'inactive') {
			action ='active';
			load_jobs(limit, start);
		}
		$(window).scroll(function(){
			if ($(window).scrollTop() + $(window).height() > $("#load-job").height() && action =='inactive') {
				action ='active';
				start = start + limit;
				// alert(start);
				setTimeout(function(){load_jobs(limit, start) }, 1000);
			}
		});
	});

</script>
 -->

<?php 
require_once('common/footer.php');


?>




