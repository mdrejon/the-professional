<?php 
session_start();
require_once('common/header.php');
?>

<section class="v-center-home section-padding">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-12 col-12">
				<div class="single-side-profile v-hove-identity text-center">
					<h4> Why verify your identity? </h4>

					<span><i class="fas fa-address-card"></i></span>

					<p>Verifying your identity is crucial in establishing trust within the Freelancer.com Community. In addition, it is a legal requirement for us to perform "Know Your Customer (KYC)" checks under the Australian Money Laundering and Anti-Terrorism Financing Act. These requirements are similar to those presented by other regulatory regimes throughout North America and Europe.
					All data uploaded as part of this process will be kept strictly confidential, and is stored securely, separate from other Freelancer.com data, using best practice, industry standard encryption. For more information, please see our Privacy Policy
					. </p>
				</div>

			</div>

			<div class="col-lg-8 col-md-8 col-sm-12 col-12">
				<div class="single-side-profile">
					<h4> Things you need </h4>
					<div class="v-center-terms">
						<div class="v-center-terms-icon">
							<span><i class="fas fa-address-card"></i></span>
						</div>
						<div class="v-center-terms-text">
							<h5>Proof of Identity </h5>
							<p> You must provide any government issued ID such as: </p>
							<ul>
								<li>National ID Card </li>
								<li>Passport</li>
								<li> Driver's License </li>
								<li>Tax ID</li>
								<li>Govt. Issued Health Cards</li>
								<li>Others Govt. Issued</li>
							</ul>
						</div>
					</div>
					<!-- <div class="v-center-terms">
						<div class="v-center-terms-icon">
							<span><i class="fas fa-address-card"></i></span>
						</div>
						<div class="v-center-terms-text">
							<h5> Step 2 Proof Of Address </h5>
							<p> You must provide documents that include your full name and address, and must clearly display the issuing authority's name, address, and phone number. The following documents may be provided: </p>
							<ul>
								<li>Utility </li>
								<li>Gas Bill</li>
								<li> Electricity Bill</li>
								<li>Bank Statement</li>
							</ul>
						</div>
					</div> -->
				</div>

				<div class="v-center-btn text-right">
					<a class="border-btn" href="<?php echo SITE_URL ?>verification-center" > Verify my identity </a>
				</div>
			</div>
		</div>
	</div>
</section>
	
<?php 
require_once('common/footer.php');
?>
