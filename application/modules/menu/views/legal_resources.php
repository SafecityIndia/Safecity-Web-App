<?php 
	$this->load->view('includes/header');
?>

<main class="position-relative legalResources">
	<div class="main-content mt-4 mb-4">
		<div class="container">

			<!-- country & city filter Start -->
				<?php $this->load->view('home/topbar'); ?>
			<!-- country & city filter end -->

			<div class="text mx-auto pt-4">

				<div class="leftTabs">
					<div class=""> <!--position-sticky -->
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="row"> 

								<div class="col-md-3 pl-0 sidebarmenu">
									
									<?php $this->load->view('sidebar'); ?>

								</div>
								<div class="col-md-1"></div> 

								<div class="col-md-8 my-auto">
									<!-- <div class="mainContent"> -->

										<div class="mainContent width100" style="width: 90%">
											<h5 class="mb-2 faqsTitle"><?php echo $title; ?></h5>
											<hr>
											<div class="accordion text1" id="faqAccordion">

												<?php
													if(isset($legalData) && !empty($legalData)){
														foreach ($legalData as $key => $value) {
												?>

														<div class="card mb-4">
															<div class="card-header collapsed" id="heading<?php echo $value['id']; ?>" type="button" data-toggle="collapse" data-target="#collapse<?php echo $value['id']; ?>" aria-expanded="false" aria-controls="collapse<?php echo $value['id']; ?>">
																<h5 class="mb-0">
																	<?php echo $value['title']; ?>
																</h5>
															</div>
															<div id="collapse<?php echo $value['id']; ?>" class="collapse" aria-labelledby="heading<?php echo $value['id']; ?>" data-parent="#faqAccordion">
																<div class="card-body">
																	<?php echo $value['content']; ?>
																</div>
															</div>
														</div>

												<?php
														}
													} else {
												?>

													<h5>No data found</h5>

												<?php
													}
												?>

											</div>
										</div> 
										
									<!-- </div> -->
								</div>


							</div>
						</div>
					</div>

				</div>

			</div>
		</div>
	</div>    
</main>


<?php
	if(isset($_COOKIE['fir_menu']) && $_COOKIE['fir_menu'] != 'yes'){
		$this->load->view('popup'); 
	}
	$this->load->view('includes/footer');
?>


<script src="<?php echo base_url(); ?>application/modules/home/scripts/topbar.js"></script>
