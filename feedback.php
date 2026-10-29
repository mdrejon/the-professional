<?php 
session_start();
$page="view_feed";
require_once('common/header.php');
	
?>
<style type="text/css">
/*shows the stars side by side, centered, and in reverse order than the HMTL*/
.rating {
  display: flex;
  flex-direction: row-reverse;
  justify-content: center;
}

/*hides the radio buttons*/
.rating > input{ display:none;}

/*style the empty stars, sets position:relative as base for pseudo-elements*/
.rating > label {
  position: relative;
  width: 1.1em;
  font-size: 15vw;
  color: #FFD700;
  cursor: pointer;
}

/* sets filled star pseudo-elements */
.rating > label::before{ 
  content: "\2605";
  position: absolute;
  opacity: 0;
}
/*overlays a filled start character to the hovered element and all previous siblings*/
/*.rating > label:hover:before,*/
/*.rating > label:hover ~ label:before {
  opacity: 1 !important;
}*/

/*overlays a filled start character on the selected element and all previous siblings*/
.rating > input:checked ~ label:before{
  opacity:1;
}

/*when an element is selected and pointer re-enters the rating container, selected rate and siblings get semi transparent, as reminder of current selection*/
/*.rating:hover > input:checked ~ label:before{ opacity: 0.4; }*/

/*just aesthetics*/
/*body{ background: #222225; color: white;}*/
/*h1, p{ text-align: center;}
p{ font-size: 1.2rem;}*/
@media only screen and (max-width: 600px) {
  h1{font-size: 14px;}
  p{font-size: 12px;}
}	
.feedback-section {
  /*height: 400px;*/
  width: 100%;
}
.feedback-section .d-table-cell {
  height: 100%;
  width: 100%;
  vertical-align: middle;
}
.feedback-section {
  color: #fff;
  position: relative;
  z-index: 1;
  background: rgb(42,89,146);
  background: radial-gradient(circle, rgba(42,89,146,1) 32%, rgba(38,72,78,1) 100%);
}
.feedback-section img {
    height: 80px;
    width: 80px !important;
    margin-bottom: 15px;
    border-radius: 50%;
    background-color: #ddd;
    margin: 0 auto;
}

.feedbac-after {
  position: absolute;
  top: 40%;
  font-size: 100px;
  width: 100%;
  text-align: center;
  z-index: -1;
  opacity: 0.4;
}

.feedback-section .section-title h5 {
  color: #fff;
}
.feedback-section .section-title h5:after {
  background-color: #fff !important;
  width: 100px;
  left: 44%;
}

.feedback-slider .owl-prev, .feedback-slider .owl-next {
  position: absolute;
  right: 0;
  bottom: 14px;
  height: 38px;
  width: 38px;
  display: inline-block;
  background-color: #fff !important;
  outline: none;
}
.feedback-slider .owl-prev span, .feedback-slider .owl-next span {
  font-size: 40px;
  color: #0C082D;
  line-height: 24px;
  display: inline-block;
}
.feedback-slider .owl-prev {
  right: 29px;
}

.write-feedback-cta {
  /*! background-color: #0C082D; */
}
.write-feedback-cta a {
  display: inline-block;
  padding: 14px 30px;
  background-color: #295687;
  color: #fff;
  text-transform: uppercase;
  text-decoration: none;
  font-weight: 700;
  transition: 0.4s;
  -webkit-box-shadow: 6px 34px 77px -21px rgba(42,89,146,1);
  -moz-box-shadow: 6px 34px 77px -21px rgba(42,89,146,1);
  box-shadow: 6px 34px 77px -21px rgba(42,89,146,1);
}
.write-feedback-cta a:hover {
  background-color: #0C082D;
}

.feedback-2 {
  position: relative;
}
.feedback-absulate-after {
  position: absolute;
  top: 20px;
  right: 35px;
}
.feedback-content h4 {
  font-size: 21px;
  color: #264950;
  font-weight: 700;
  margin-bottom: 0;
}
.feedback-content span {
  color: #0C092E;
  font-weight: 700;
  /*padding-bottom: 10px;*/
  display: inline-block;
}
.feedback-content {
}
.feedback-2 {
  border-radius: 25px;
  -webkit-box-shadow: 5px 23px 54px -19px rgba(255,255,255,1);
  -moz-box-shadow: 5px 23px 54px -19px rgba(255,255,255,1);
  box-shadow: 5px 23px 54px -19px rgba(255,255,255,1);
  transition: 0.4s;
  margin-bottom: 20px
}
.feedback-user img {
  padding: ;
}
.feedback-user {
  padding: 8px;
  border-radius: 50%;
  border: 2px solid #26484C;
  height: 100px;
  width: 100px;
  transition: 0.4s;
}
.feedback-section img {
  height: 100%;
  width: 100% !important;
}
.feedback-absulate-after {
  height: 50px;
  width: 50px;
  border: 2px solid #264952;
  text-align: center;
  border-radius: 50%;
  padding: 4px;
}
.feedback-absulate-after span {
  height: 100%;
  display: inline-block;
  width: 100%;
  padding-top: 8px;
  background-color: #26484E;
  color: #fff;
  border-radius: 50%;
  transition: 0.4s
}
.feedback-2:hover {
  background-color: #26484E;
  color: #fff;
}
.feedback-2:hover .feedback-user {
  background-color: ;
  border-color: #fff;
}
h4 {
}
.feedback-2:hover .feedback-content h4 {
  color: #fff;
}
.feedback-2:hover .feedback-absulate-after {
  color: #;
  border-color: #fff;
}

.feedback-2 {
  padding: 20px;
  background-color: #fff;
  color: #222;
}
.feedback-content p {
  text-align: justify;
  padding-left: ;
  padding-right: 16px;
}

.feedback-2:hover .feedback-absulate-after span {
  background-color: #fff;
  color: #26484E;
}

.rating {
    width: 107px;
}
.rating-section label {
  font-size: 20px;
}
</style>
<section class="feedback-section section-padding">
	<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-8">
					<div class="section-title">
						<h5>Some great words from our user</h5>
					</div>
				</div>
			</div>
			<div class="row">
				<?php 
				$categories_query = "SELECT * FROM ".$db_suffix."testimonial WHERE testimonial_status = '1' ORDER BY  	testimonial_order asc, testimonial_id desc";
				
				$categories = $db->select($categories_query);
				while ($row = mysqli_fetch_object($categories)): ?>

				<div class="col-lg-6">
					<div class="feedback-2">
						<div class="row">
							<div class="col-lg-3">
								<div class="feedback-user">
									<img src="<?php echo SITE_URL ?>member/images/male-avata.png">
								</div>
							</div>
							<div class="col-lg-9">
								<div class="feedback-content">
									<h4><?php echo $row->testimonial_name; ?></h4>
									<span><?php echo $row->testimonial_company_name ?></span>
									<!-- <span><?php echo $row->testimonial_rating ?></span> -->
									<div class="rating-section">
										<div class="rating">
							  <!--elements are in reversed order, to allow "previous sibling selectors" in CSS-->
									  <input type="radio"  <?php if ($row->testimonial_rating==5) {	echo 'checked';	}?> value="5" id="5" ><label for="5">☆</label>
									  <input type="radio"  <?php if ($row->testimonial_rating==4) {	echo 'checked';	}?> value="4" id="4"><label for="4">☆</label>
									  <input type="radio"  <?php if ($row->testimonial_rating==3) {	echo 'checked';	}?> value="3" id="3"><label for="3">☆</label>
									  <input type="radio"  <?php if ($row->testimonial_rating==2) {	echo 'checked';	}?> value="2" id="2"><label for="2">☆</label>
									  <input type="radio"  <?php if ($row->testimonial_rating==1) {	echo 'checked';	}?> value="1" id="1"><label for="1">☆</label>
									</div>
									</div>
									<p><?php echo $row->testimonial_message ?></p>
								</div>
							</div>
						</div>
						 

						<div class="feedback-absulate-after">
							<span><i class="fas fa-quote-right"></i></span>
						</div>
					</div>
				</div>
			<?php endwhile; ?>
				<!-- 
				<div class="col-lg-6">
					<div class="feedback-2">
						<div class="row">
							<div class="col-lg-3">
								<div class="feedback-user">
									<img src="">
								</div>
							</div>
							<div class="col-lg-9">
								<div class="feedback-content">
									<h4>Sydur Rahman</h4>
									<span>Web Developer</span>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
									tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
									quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
									consequat.</p>
								</div>
							</div>
						</div>
						 

						<div class="feedback-absulate-after">
							<span><i class="fas fa-quote-right"></i></span>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="feedback-2">
						<div class="row">
							<div class="col-lg-3">
								<div class="feedback-user">
									<img src="">
								</div>
							</div>
							<div class="col-lg-9">
								<div class="feedback-content">
									<h4>Sydur Rahman</h4>
									<span>Web Developer</span>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
									tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
									quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
									consequat.</p>
								</div>
							</div>
						</div>
						 

						<div class="feedback-absulate-after">
							<span><i class="fas fa-quote-right"></i></span>
						</div>
					</div>
				</div> -->
			</div>
			<!-- <div class="row justify-content-center">
				<div class="col-lg-8">
					<div class="feedback-slider owl-carousel">
						<div class="single-feedback-slider text-center">
							<img src="">

							<div class="feedback-comment">
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
								tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
								quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
								consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
								cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
								proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

							</div>
							<div class="feedback-user-info">
								<h3>David Villas</h3>
								<span>Designer, Company Name</span>
							</div>
						</div>
						<div class="single-feedback-slider text-center">
							<img src="">

							<div class="feedback-comment">
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
								tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
								quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
								consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
								cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
								proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

							</div>
							<div class="feedback-user-info">
								<h3>David Villas</h3>
								<span>Designer, Company Name</span>
							</div>
						</div>
						<div class="single-feedback-slider text-center">
							<img src="">

							<div class="feedback-comment">
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
								tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
								quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
								consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
								cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
								proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

							</div>
							<div class="feedback-user-info">
								<h3>David Villas</h3>
								<span>Designer, Company Name</span>
							</div>
						</div>
					</div>
				</div>
			</div> -->
		</div>
</section>
<section class="write-feedback-cta section-padding text-center">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-8">
				<a href="<?php echo SITE_URL ?>write-feedback">I want to Write A Feedback</a>
			</div>
		</div>
	</div>
</section>

<?php 
require_once('common/blog-section.php');
    
?>
<?php 
require_once('common/footer.php');
    
?>