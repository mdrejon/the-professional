<div class="new-right-menu lesft-menu">
	<ul>
		<li class="border"><a href="javascript:void(0);">
			<div class="menu-trigger">
				<span></span>
				<span></span>
				<span></span>
			</div>
			</a>
			<ul class="dropdown">
				<li><a href="<?php echo SITE_URL; ?>">home</a></li>
				<?php if ($page=="about"): ?>
					<li><a href="<?php echo SITE_URL; ?>about">About Us</a></li>
				<?php else: ?>
					<li><a href="<?php echo SITE_URL; ?>about" target="_blank">About Us</a></li>
				<?php endif ?>
				<?php if ($page == "blog"): ?>
					<li><a href="<?php echo SITE_URL; ?>blog">Blog</a></li>
				<?php else: ?>
					<li><a href="<?php echo SITE_URL; ?>blog" target="_blank">Blog</a></li>
				<?php endif ?>
				
				<li><a href="javascript:void(0);">Feedback <span><i class="fas fa-caret-right"></i></span></a>
					<ul class="">
						<?php if ($page == "view_feed"): ?>
							<li><a href="<?php echo SITE_URL; ?>view-feedback">Reviews</a></li>
						<?php else: ?>
							<li><a href="<?php echo SITE_URL; ?>view-feedback" target="_blank">Reviews</a></li>
						<?php endif ?>
						
						<?php if ($page == "write_feed"): ?>
							<li><a href="<?php echo SITE_URL; ?>write-feedback">Write Reviews </a></li>
						<?php else: ?>
							<li><a href="<?php echo SITE_URL; ?>write-feedback" target="_blank">Write Reviews </a></li>
						<?php endif ?>
						
						
					</ul>
				</li>
				<?php if ($page == "contact"): ?>
					<li><a href="<?php echo SITE_URL; ?>contact#contact_page_section">Contact Us</a></li>
				<?php else: ?>
					<li><a href="<?php echo SITE_URL; ?>contact#contact_page_section" target="_blank">Contact Us</a></li>
				<?php endif ?>
				
					</ul>
				</li>
	</ul>
</div>
