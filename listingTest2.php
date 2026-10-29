<?php 
session_start();
require_once('common/header.php');
?>
<!-- New Header section end -->
<section class="section-padding bredcumb" style="background-image: url('<?php echo SITE_URL ?>assets/img/bannar-4.jpg');">
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
<?


 $member_slug = isset($_REQUEST['slug'])?$_REQUEST['slug']:'';
 $categories_slug = isset($_REQUEST['slug'])?$_REQUEST['slug']:'';
 if ($categories_slug !='') {
 	 $categories_query = "select * from ".$db_suffix."categories where categories_slug='$categories_slug'";
 }else if(isset($_SESSION['search'])){
 	 $categories_query = "select * from ".$db_suffix."categories where categories_name='".$_SESSION['search']."'";
 }

$categories_sql = $db->select($categories_query);
$result = mysqli_fetch_object($categories_sql);
   $categories_id = $result->categories_id;
  $categories_parent = $result->categories_parent;

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
	  	 	$_SESSION['lat'] = $member->member_location_latitude;
	  }
	  if ($lat == '') {
	  		$_SESSION['lng'] = $member->member_location_longitude;
	  }
	  $lat;

}
?>

<section class="listing section-padding">
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-3 col-md-4">
			<div class="filter">
				<div class="single-filter">
					<h5 class="filter-title">Categories</h5>
					<div class="filter-item">
						<ul >
							<?php 
							$categories_query = "SELECT * FROM ".$db_suffix."categories WHERE categories_parent > '0'  ORDER BY categories_name asc, categories_order asc";
								$categories = $db->select($categories_query);
								while ($row = mysqli_fetch_object($categories)): 
							?>
							<!-- <li><input type="checkbox" class="form-check-input" name="">   Accountant <span>20</span></li> -->

							<?php if ($categories_id == $row->categories_id): ?>
								<li><input type="checkbox" checked class="product_check" value="<?php echo $row->categories_id ?>" id="categories" name="">  <?php echo $row->categories_name ?>
							<?php else: ?>
								<li><input type="checkbox" class="product_check" value="<?php echo $row->categories_id ?>" id="categories" name="">  <?php echo $row->categories_name ?>
							<?php endif ?>
							  

							<span><?php echo $row->categories_total_member; ?></span></li>

							<?php endwhile; ?>
						</ul>

					</div>
					<div class="mobile-filter-button">
						<button>filter</button>
					</div>
				</div>

				<div class="single-filter">
					<h5 class="filter-title">Countries</h5>
					<div class="filter-item">
						<ul >
							
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
					<div class="mobile-filter-button">
						<button>filter</button>
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
				<!-- <div id="member_mail_send_status"></div> -->
				<ul class="nav nav-tabs member-tabs" id="myTab" role="tablist">
				 <!--  <li class="nav-item">
				    <a class="nav-link" href="">All</a>
				  </li> -->
				  <li class="nav-item">

				    <a class="nav-link" id="verified-tab"><input type="checkbox" class="product_check  d-none " value="verified" id="verified" name="verified"> <label for="verified">Verified</label></a>
				  </li>
				  <li class="nav-item">
				    <a class="nav-link" id="unverified-tab"><input  type="checkbox" class="product_check d-none " value="unverified" id="unverified" name="unverified">  <label for="unverified">unverified</label></a>
				  </li>
				  <li class="nav-item" id="filter-mobile">
				    <a class="nav-link"  ><button>Filter</button></a>
				  </li>
				</ul>
				<div class="tab-content" id="myTabContent">
				  <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
				  	<div class="text-center">
				  		<img src="<?php echo SITE_URL ?>assets/img/loader.gif" id="loader" style="display: none;" >
				  		
				  	</div>
				  	<div id="load_data"></div>
				  	<div id="load_data_message" class="text-center"></div>
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
	$(document).ready(function(){
		$('body').delegate('.contact_with_member', 'click', function () {
					var $this = $(this);
					// alert("allah Mohan");
					// var username = $("#id").val();
					var member_id = $(this).parent().parent().find(".member_id").val();
					var name = $(this).parent().parent().find(".name").val();
					var email = $(this).parent().parent().find(".email").val();
					var phone = $(this).parent().parent().find(".phone").val();
					var message = $(this).parent().parent().find(".messages").val();
					var submit = 'submit';
					// var number=document.getElementById("id").value;

					// alert(name);
				$.ajax({
				url:'<?php echo SITE_URL ?>inc/send_member_mail.php',
				method:'POST',
				data:{member_id:member_id, name:name, email:email, phone:phone, message:message, submit: submit},
				success:function(response){
					$this.parent().parent().parent().parent().parent().find(".member_mail_send_status").html(response);
					// alert('hello');
					// $("#loader").hide();
				}
			})
      });
	});
</script>

<script>

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
   url:"<?php echo SITE_URL ?>inc/load_member3.php",
   method:"POST",
   data:{limit:limit,start:start,categories:categories,country:country,verified:verified,unverified:unverified},
   cache:false,
   success:function(res)
   {
    $('#load_data').append(res);
    $("#loader").hide();
    if(res.trim() == '')
    {
     if(start==0){
		 $('#load_data_message').html("<button type='button' class='btn btn-info'>No professioinals found in this search.</button>");
	 }
	 else {
	 $('#load_data_message').html("<button type='button' class='btn btn-info'>End of this search.</button>");
	 }
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




