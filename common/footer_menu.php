<!-- Start Footer Section -->

  <footer>
    <div class="container">
      <div class="row">

        <div class="col-md-3">
          <div class="footer-item">
            <img src="<?php echo SITE_URL;?>/img/logo.jpeg" alt="logo" class="f-logo">
            <ul class="contact-info">
                <li>
                    <i class="fas fa-map-marker-alt"></i> <?php echo SITE_ADDRESS;?>
                </li>
				<?php if(SITE_EMAIL !=""){ ?>
                <li>
                    <i class="far fa-envelope"></i> <a href="mailto:<?php echo SITE_EMAIL;?>"><?php echo SITE_EMAIL;?></a>
                </li>
				<?php } ?>
				<?php if(SITE_PHONE !=""){ ?>
                <li>
                    <i class="fas fa-mobile-alt"></i><a href="tel:<?php echo SITE_PHONE;?>"><?php echo SITE_PHONE;?></a>
                </li>
				<?php } ?>
            </ul>
          </div>
        </div>
        <div class="col-md-2">
          <div class="footer-item">
              <h4>About Us</h4>
              <ul class="links">
                  <li><a href="<?php echo SITE_URL;?>/content/about-us">About Us</a></li>
                  <li><a href="<?php echo SITE_URL;?>/career">Career</a></li>
                  <li><a href="<?php echo SITE_URL;?>/content/our-partners">Our Partners</a></li>
                  <li><a href="<?php echo SITE_URL;?>/contact-us">Contact Us</a></li>
                  <li><a href="<?php echo SITE_URL;?>/press">Press</a></li>
              </ul>
          </div>
        </div>
        <div class="col-md-2">
          <div class="footer-item">
              <h4>Jobs by Role</h4>
              <ul class="links"> 
			  <?php 
				$slug ='';
				$sql1 = "SELECT * FROM `ah_category` ".$where_common." order by category_order limit 5";

				$db_categorylist= mysqli_query($db,$sql1);
				while ($category_row=mysqli_fetch_assoc($db_categorylist)) {
					$slug =trim($category_row['category_slug']);
					$url = SITE_URL.'/jobs/'.$slug;
					?>
					<li><a href="<?php echo $url;?>"><?php echo $category_row['category_title'] ?></a></li>
				<?php
				}
				?>
              </ul>
          </div> 
        </div>
        <div class="col-md-2">
          <div class="footer-item">
              <h4>Institution Jobs</h4>
              <ul class="links">
                  <?php
                  $slug ='';
                  $db_org_cat_list= mysqli_query($db,"SELECT * FROM `ah_org_category` limit 10");
                  while ($org_cat_row=mysqli_fetch_assoc($db_org_cat_list)) {
                    $slug =trim($org_cat_row['category_slug']);
                    $url = SITE_URL.'/jobs/'.$slug;
                     ?>
                  <li><a href="<?php echo $url;?>"><?php echo $org_cat_row['category_title'] ?></a></li>
                  <?php
                  }
                   ?>
              </ul>
          </div>
        </div>
        <div class="col-md-3">
			<div class="footer-item">
              <h4>Career Advancement</h4>
              <ul class="links">
			<?php
			  $cat_qry = "SELECT * FROM `ah_article_category` WHERE category_status = 1";
			  $run_cat = mysqli_query($db,$cat_qry);
			  while ($cat_row= mysqli_fetch_assoc($run_cat)) { ?>
				<li><a href="article_list.php?category=<?php echo $cat_row['category_slug'];?>"><i class="fas fa-angle-right"></i> <?php echo $cat_row['category_title']; ?> </a></li>
			<?php } ?>
		
		<?php /*
          <div class="footer-item">
                    <h4>Newsletter</h4>
                    <div class="Subscribe-box">
                        <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit.</p>
                        <form class="form-inline" action="#" method="GET">
                            <input type="text" class="form-control mb-sm-0 subscription-btn" id="inlineFormInputName3" placeholder="Email Address">
                            <button type="submit" class="btn"><i class="fa fa-paper-plane"></i></button>
                        </form>
                    </div>
                </div>*/ ?>
			</ul>
          </div>
		</div>


      </div>


	</div>
	<div class="copryright-main">
		<div class="container">
			<div class="row">
				<div class="col-md-12 copyright">
					<p class="copy">© 2020 Academic Hub.Design & Development by <a href="#">Smart Framework.</a>.</p>
				</div>
			</div>
		</div>
	</div>

  </footer>
  
 <!-- End FooterSection -->