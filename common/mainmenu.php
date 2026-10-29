<div class="menu-bar shadow">
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-4">
        <div class="logo-section">
          <a href="<?php echo SITE_URL;?>"><img src="<?php echo SITE_URL;?>/img/logo.jpeg" />
              <p>Your Way to Academic Opportunities</p>
          </a>
        </div>
      </div>
      <div class="col-md-9 col-8">
        <div class="menu-section">
          <nav class="stellarnav">
            <ul>
              <li class="mega" data-column="3"><a href="">Jobs</a>
                <ul>
                  <li><a href="job-list.php">Jobs by Regions</a>
                    <ul>
                      <?php
                      $slug ='';
                      $db_statelist= mysqli_query($db,"SELECT * FROM `ah_state` WHERE country_id = 83 LIMIT 10");
                      while ($state_row=mysqli_fetch_assoc($db_statelist)) {
                        $slug =trim($state_row['state_slug_name']);
                        $url = SITE_URL.'/jobs/'.$slug;?>
                      <li><a href="<?php echo $url;?>"><i class="fas fa-angle-right"></i> <?php echo $state_row['state_name'] ?></a></li>


                      <?php
                      }
                       ?>
                         <li><a href="<?php echo SITE_URL;?>/browse-jobs/#all-state" class="viewAll">View All Regions</a></li>
                    </ul>
                  </li>
                  <li><a href="#">Jobs by City</a>
                    <ul>
                      <?php
                      $slug ='';
                      $db_citylist= mysqli_query($db,"SELECT * FROM ah_country c JOIN ah_state s on c.country_id= s.country_id JOIN ah_city ci on s.state_id = ci.state_id WHERE c.country_id=83 limit 10");
                      while ($city_row=mysqli_fetch_assoc($db_citylist)) {
                        $slug =trim($city_row['city_slug_name']);
                        $url = SITE_URL.'/jobs/'.$slug;?>
                      <li><a href="<?php echo $url;?>"><i class="fas fa-angle-right"></i> <?php echo $city_row['city_name'] ?></a></li>

                      <?php
                      }
                       ?>
                      <li><a href="<?php echo SITE_URL;?>/browse-jobs/#all-city" class="viewAll">View All City</a></li>
                    </ul>
                  </li>
                  <li><a href="#">Jobs by Role</a>
                    <ul>
                      <?php
					  $where_common ="";
					  $where_advance ="";
					 // echo ADVANCED_JOB_CATEGORY_PARENT_ID;
					  if(ADVANCED_JOB_CATEGORY_PARENT_ID !=0){
						  $ADVANCED_JOB_CATEGORY_PARENT_ID = (int)ADVANCED_JOB_CATEGORY_PARENT_ID;
						  $where_common = " where parent_id !='".$ADVANCED_JOB_CATEGORY_PARENT_ID."' and category_id !='".$ADVANCED_JOB_CATEGORY_PARENT_ID."'";
						  $where_advance = " where parent_id ='".$ADVANCED_JOB_CATEGORY_PARENT_ID."'";
						   $selectsql = "SELECT * FROM ah_category where category_id ='".$ADVANCED_JOB_CATEGORY_PARENT_ID."' order by category_order limit 1";

						   $advjobres= mysqli_query($db,$selectsql);
						   $adv = mysqli_fetch_object($advjobres);
						   $advance_job_title = $adv->category_title;

					  }


                      $slug ='';
					 $sql1 = "SELECT * FROM `ah_category` ".$where_common." order by category_order limit 10";

                      $db_categorylist= mysqli_query($db,$sql1);
                      while ($category_row=mysqli_fetch_assoc($db_categorylist)) {
                        $slug =trim($category_row['category_slug']);
                        $url = SITE_URL.'/jobs/'.$slug;
                        ?>
                      <li><a href="<?php echo $url;?>"><i class="fas fa-angle-right"></i> <?php echo $category_row['category_title'] ?></a></li>

                      <?php
                      }
                       ?>
                      <li><a href="<?php echo SITE_URL;?>/browse-jobs/#all-role" class="viewAll">View All Role</a></li>

                    </ul>
                  </li>
                </ul>
              </li>
              <li class="mega" data-column="2"><a href="">Advance Teaching Jobs</a>
                <ul class="litcol">
                  <?php
				  if(FEATURED_COUNTRIES_MENU_ENABLE !=0){
				  ?>
				  <li><a href="job-list.php">Feature Countries</a>
                    <ul>
                      <?php
                      $slug ='';
                      $db_statelist2= mysqli_query($db,"SELECT * FROM `ah_country` WHERE featured_country = 1 LIMIT 10");
                      while ($state_row2=mysqli_fetch_assoc($db_statelist2)) {
                        $slug =trim($state_row2['country_slug_name']);
                        $url = SITE_URL.'/jobs/'.$slug;?>
                      <li><a href="<?php echo $url;?>"><i class="fas fa-angle-right"></i> <?php echo $state_row2['country_name']; ?></a></li>


                      <?php
                      }
                       ?>
                         <li><a href="<?php echo SITE_URL;?>/browse-jobs/#featured-country" class="viewAll">View All</a></li>
                    </ul>
                  </li>
				  <?php } ?>
                  <li>

				  <a href="#"><?php echo $advance_job_title;?></a>
                    <ul>
					<?php
					$slug ='';
					$sql = "SELECT * FROM `ah_category` ".$where_advance." order by category_order limit 10";
                      $db_categorylist= mysqli_query($db,$sql);
                      while ($category_row=mysqli_fetch_assoc($db_categorylist)) {
                        $slug =trim($category_row['category_slug']);
                        $url = SITE_URL.'/jobs/'.$slug;
                        ?>
                      <li><a href="<?php echo $url;?>"><i class="fas fa-angle-right"></i> <?php echo $category_row['category_title']; ?></a></li>

                      <?php
					  $slug ='';
                      }
                       ?>
                      <li><a href="<?php echo SITE_URL;?>/browse-jobs/#advance-job" class="viewAll">View All</a></li>
                    </ul>
                  </li>

                </ul>
              </li>


              <li><a href="">Institution Jobs</a>
                <ul>
                  <?php
                  $slug ='';
                  $db_org_cat_list= mysqli_query($db,"SELECT * FROM `ah_org_category` limit 10");
                  while ($org_cat_row=mysqli_fetch_assoc($db_org_cat_list)) {
                    $slug =trim($org_cat_row['category_slug']);
                    $url = SITE_URL.'/jobs/'.$slug;
                     ?>
                  <li><a href="<?php echo $url;?>"><i class="fas fa-angle-right"></i> <?php echo $org_cat_row['category_title'] ?></a></li>
                  <?php
                  }
                   ?>
                  <li><a href="<?php echo SITE_URL;?>/browse-jobs/#all-institution" class="viewAll">All Institution Type</a></li>
                </ul>
              </li>
              <li><a href="#">Career Advancement</a>
                <ul>
                  <?php
                  $cat_qry = "SELECT * FROM `ah_article_category` WHERE category_status = 1";
                  $run_cat = mysqli_query($db,$cat_qry);
                  while ($cat_row= mysqli_fetch_assoc($run_cat)) { ?>
                    <li><a href="article_list.php?category=<?php echo $cat_row['category_slug'];?>"><i class="fas fa-angle-right"></i> <?php echo $cat_row['category_title']; ?> </a></li>
                <?php } ?>


                </ul>
              </li>
              <li><a href="#">Contact</a>
                <ul>
                  <li><a href="<?php echo SITE_URL;?>/content/about-us"><i class="fas fa-angle-right"></i> About Us</a></li>
                  <li><a href="<?php echo SITE_URL;?>/career"><i class="fas fa-angle-right"></i> Career</a></li>
                  <li><a href="<?php echo SITE_URL;?>/content/our-partners"><i class="fas fa-angle-right"></i> Our Partners</a></li>

				  <li><a href="<?php echo SITE_URL;?>/content/terms-and-conditions"><i class="fas fa-angle-right"></i> Terms & Conditions</a></li>

				  <li><a href="<?php echo SITE_URL;?>/content/privacy-policy"><i class="fas fa-angle-right"></i> Privacy Policy</a></li>

                  <li><a href="<?php echo SITE_URL;?>/contact-us"><i class="fas fa-angle-right"></i> Contact Us</a></li>
				  
				  <?php 
					$content_sql = "select * from ".$db_suffix."content where custom_link='press' and content_published='1'";
					$content_res = mysqli_query($db,$content_sql);
					$content_object = mysqli_fetch_object($content_res);

					//print_r($content_object);
					$content_id = $content_object->content_id;
					$press_title = $content_object->content_title;
					unset($content_object);
					if(trim($press_title)!="")
					{
				?>
				  
				  
                  <li><a href="<?php echo SITE_URL;?>/press"><i class="fas fa-angle-right"></i> <?php echo $press_title;?></a></li>
				  <?php 
				  }
				  ?>
                  <li><a href="<?php echo SITE_URL;?>/article_list.php"><i class="fas fa-angle-right"></i> All Blogs</a></li>

                </ul>
              </li>

              <li><a href="./org_login.php"> <span class="btn btn-danger submit-job-btn">Submit Job</span></a></li>
              <li><a href="<?php echo SITE_URL;?>/create-resume"><span class="btn btn-primary submit-resume-btn">Create Resume</span></a></a></li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <div style="text-align: center;color:white; background:red;" id="noscriptmsg">
    JavaScript seems to be disabled in your browser. For the best experience on our site, be sure to turn on Javascript.

  </div>

</div>
