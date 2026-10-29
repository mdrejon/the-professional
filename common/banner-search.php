<?php

session_start();

// if (isset($_POST['search_submit'])) {

// 	if ($_POST['search'] !='') {

// 		$_SESSION['search'] = $_POST['search'];

// 	}else{

// 		unset($_SESSION["search"]);

// 	}

// 	if ($_POST['lat'] !='') {

// 	 	$_SESSION['lat'] = $_POST['lat'];

// 	}

// 	if ($_POST['lng'] !='') {

// 		 $_SESSION['lng'] = $_POST['lng'];

// 	}

// 	if ($_POST['location'] !='') {

// 		 $_SESSION['location'] = $_POST['location'];

// 	}

// 	if ($_POST['Country'] !='') {

// 		 $_SESSION['Country'] = $_POST['Country'];

// 	}

	

// }





 ?>

<div class="banner-search">

	<form  method="POST" class="range-field my-4 w-100" action="<?php echo SITE_URL ?>listing" target="_blank">

		<div class="row">

			<div class="col-lg-6 col-md-5 col-sm-12 from-group">

				<!-- <input type="text" class="typeahead" autocomplete="off"  id="txtCountry" name="search" placeholder="Professionals Are you looking for"> -->

				<!-- <input type="text" name="search" id="searchtypo" class="form-control input-lg typeahead" autocomplete="off" placeholder="Professionals Are you looking for" /> -->

				  <div class="head-search-form-input">

                    <input type="text" autocomplete="off" value="<?php echo $_SESSION['search'] ?>" placeholder="Type keywords to find experts" id="txtCountry2" class="form-control typeahead"  name="search">

                      <!-- <input type="text" name="txtCountry" id="txtCountry" class="typeahead"/> -->

                  </div>

				 <!-- <div id="scrollable-dropdown-menu">

                    <input class="typeahead form-control" name="states" type="text" placeholder="Countries">

                </div> -->



			</div>

			<div class="col-lg-4 col-md-5 col-sm-12 from-group">

				<!-- <div style="position:relative;" class="head-search-form-input">

				  

					

					

				</div> -->

				<div class="form-group form-label abs-search-icon">

                              <!-- <label class="active" for="SignupCurrentLocation">Locate Your Location</label> -->

                              <input type="text" id="SignupCurrentLocation" c placeholder="Type your desired location" name="location" class="form-control box" value="<?php echo $_SESSION['location'] ?>" >

                                    <input id="slat" name="lat" value="<?php echo $_SESSION['lat'] ?>" type="hidden">

                                    <input id="slng" name="lng" value="<?php echo $_SESSION['lng'] ?>" type="hidden">

                                    <input id="sCountry" name="Country" value="" type="hidden">

                                    <input name="from_page" value="home" type="hidden">

                                    <div class="range range2">

                                      <input id="slider12" class="border-0" type="range" value="<?php echo $_SESSION['range'] ?>" name="range" min="0" max="180"  />

                                      <div class="">

                                        <span class="distance"> KM</span>  <span class="font-weight-bold text-primary ml-2 mt-1 valueSpan2"></span>

                                      </div>

                                    </div>

                                    <span class="location-track-icon"><i class="fas fa-map-marker-alt location-track-icon"></i></span>

                                    <span class="search-location  search-location2"><i class="fas fa-globe location-track-icon"></i></span>

                               <!--  <div class="">

                                  </div> -->

                        

                            </div>

				

			</div>

<!-- 			<div class="col-lg-3 col-md-3 col-sm-12 from-group">

				<select name="expart" placeholder="Experience" required class="select2 banner-search-select form-control" >

						<option hidden="">Select Category</option>

<?php 

 $ctg_parent = "SELECT * FROM ".$db_suffix."categories WHERE categories_parent = '0'";

	

	$ctg_parent_query = $db->select($ctg_parent);

	while ($ctg_parent_row = mysqli_fetch_object($ctg_parent_query) ):

 ?>

						<optgroup label="<?php echo $ctg_parent_row->categories_name ?>">

							<?php $ctg_sql = "SELECT * FROM ".$db_suffix."categories WHERE categories_parent = '".$ctg_parent_row->categories_id."'"; 

							$ctg_query = $db->select($ctg_sql);

							while ($row = mysqli_fetch_object($ctg_query) ):

							?>

	                        <option value="<?php echo $row->categories_id ?>"><?php echo $row->categories_name ?></option>

	                    <?php endwhile; ?>





	                    </optgroup>

<?php endwhile; ?>	               

					</select>

				<div class="abs-search-icon">

					

				</div>

			</div> -->

			

			<div class="col-lg-2 col-md-2 col-sm-12 from-group">

				<input type="submit" name="search_submit" placeholder="" value="Search">

			</div>

		</div>

	</form>

</div>

