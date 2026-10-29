<div class="new-leftmenu">
	<span class="new-leftmenu-close"><i class="fas fa-times"></i></span>
	<h5>menu</h5>
	<ul class="leftmenu-item">
		<li><a href="<?php echo SITE_URL; ?>">home</a></li>


<?php
 $ctg_parent = "SELECT * FROM ".$db_suffix."categories WHERE categories_parent = '0'";
	
	$ctg_parent_query = $db->select($ctg_parent);
	while ($ctg_parent_row = mysqli_fetch_object($ctg_parent_query) ):

	 $ctg_sub_parent = "SELECT * FROM ".$db_suffix."categories WHERE categories_parent = '".$ctg_parent_row->categories_id."'";
	
	$ctg_sub_parent_query = $db->select($ctg_sub_parent);
 ?>
		<li><a href="#"><?php echo $ctg_parent_row->categories_name ?></a> <span>
			<?php if (mysqli_num_rows($ctg_sub_parent_query) > 0): ?>
				<i class="fas fa-chevron-down"></i>
			<?php endif ?>
		</span>
<?php 
	if (mysqli_num_rows($ctg_sub_parent_query) > 0):
 ?>
			<ul class="new-dropdown">
				<?php while ( $row = mysqli_fetch_object($ctg_sub_parent_query) ): ?>
				<li><a target="_blank"  href="<?php echo SITE_URL ?>listing/<?php echo  $row->categories_slug ?>"><?php  echo $row->categories_name ?></a></li>
				<?php endwhile ?>
				
			</ul>
<?php endif; ?>
		</li>
<?php endwhile; ?>
		<!-- <li><a href="#">Architecture</a> <span><i class="fas fa-chevron-down"></i></span>
			<ul class="new-dropdown">
				<li><a href="listing.html">GIS Specialist</a></li>
				<li><a href="listing.html">GIS Technician</a></li>
				<li><a href="listing.html">General Engineer</a></li>
				<li><a href="listing.html">Geographer</a></li>
				<li><a href="listing.html">Geologist</a></li>
			</ul>
		</li>
		<li><a href="#">Finance</a> <span><i class="fas fa-chevron-down"></i></span>
			<ul class="new-dropdown">
				<li><a href="listing.html">Director Of Finance</a></li>
				<li><a href="listing.html">Finance Manager</a></li>
				<li><a href="listing.html">Financial Advisor</a></li>
				<li><a href="listing.html">Financial Analyste</a></li>
				<li><a href="listing.html">Financial Associate </a></li>
				<li><a href="listing.html">Financial Reporting Manager</a></li>
			</ul>
		</li>
		<li><a href="#">Administrative</a> <span><i class="fas fa-chevron-down"></i></span>

				<ul class="new-dropdown">
					<li><a href="listing.html">Accounts Payable Clerk</a></li>
					<li><a href="listing.html">Accounts Receivable Clerk</a></li>
					<li><a href="listing.html">Administrative Assistant</a></li>
					<li><a href="listing.html">Assistant Manager</a></li>
					<li><a href="listing.html">Branch Manager</a></li>
					<li><a href="listing.html">Data Entry Operator</a></li>
					<li><a href="listing.html">Director of Operations</a></li>
					<li><a href="listing.html">Executive Assistant</a></li>
					<li><a href="listing.html">Executive Director</a></li>
					<li><a href="listing.html">File Clerk</a></li>
					<li><a href="listing.html">Medical Records Clerk</a></li>
					<li><a href="listing.html">Office Assistant</a></li>
					<li><a href="listing.html">Office Clerk</a></li>
				</ul>

		</li>
		<li><a href="#">Banking / Loans</a> <span><i class="fas fa-chevron-down"></i></span>

				<ul class="new-dropdown">
					<li><a href="listing.html">Analyst</a></li>
					<li><a href="listing.html">Bank Teller</a></li>
					<li><a href="listing.html">Banker</a></li>
					<li><a href="listing.html">Credit Analyst</a></li>
					<li><a href="listing.html">Escrow Assistant</a></li>
					<li><a href="listing.html">In Store Banker</a></li>
					<li><a href="listing.html">Investment Analyst</a></li>
					<li><a href="listing.html">Loan Consultant</a></li>
					<li><a href="listing.html">Loan Officer</a></li>
					<li><a href="listing.html">Loan Processor</a></li>
					<li><a href="listing.html">Mortgage Loan Officer</a></li>
					<li><a href="listing.html">Teller</a></li>
					<li><a href="listing.html">Underwriter</a></li>
					<li><a href="listing.html">Underwriter Trainee</a></li>
					<li><a href="listing.html">Underwriting Assistant</a></li>
					<li><a href="listing.html">PUniversal Banker</a></li>
				</ul>

		</li>
		<li><a href="#">Construction </a> <span><i class="fas fa-chevron-down"></i></span>

				<ul class="new-dropdown">
					<li><a href="listing.html">Carpenter</a></li>
					<li><a href="listing.html">Construction Manager</a></li>
					<li><a href="listing.html">Construction Superintendent</a></li>
					<li><a href="listing.html">Construction Worker</a></li>
					<li><a href="listing.html">Electrician</a></li>
					<li><a href="listing.html">Equipment Operator</a></li>
					<li><a href="listing.html">Groundskeeper</a></li>
					<li><a href="listing.html">Industrial Designer</a></li>
					<li><a href="listing.html">Industrial Electrician</a></li>
					<li><a href="listing.html">Installer</a></li>
					<li><a href="listing.html">Interior Designer</a></li>
					<li><a href="listing.html">Janitor</a></li>
					<li><a href="listing.html">Laborer</a></li>
					<li><a href="listing.html">Maintenance Manager</a></li>
					<li><a href="listing.html">Maintenance Supervisor</a></li>
					<li><a href="listing.html">Maintenance Technician</a></li>
					<li><a href="listing.html">Maintenance Worker</a></li>
				</ul>

		</li> -->
	</ul>

</div>