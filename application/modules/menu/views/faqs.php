
<main>
	<div class="main-content mt-4 mb-4">
		<div class="container">

			<div class="text mx-auto">

				<div class="leftTabs">
					<div class=""> <!--position-sticky -->
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="row"> 

								<div class="col-md-3 pl-0 m-dis-none">
 
									<?php $this->load->view('includes/sidebar'); ?>                 

								</div>
								<div class="col-md-1"></div>

								<div class="col-md-8 my-auto">
									<div class="mainContent width100" style="width: 90%">
									<h5 class="mb-3 faqsTitle"><?php echo $title; ?></h5>
									<hr>
										<div class="accordion" id="faqAccordion">
											
											<?php
												if(isset($faq_list) && !empty($faq_list)){
													foreach ($faq_list as $key => $value) {
											?>

													<div class="card mb-4">
														<div class="card-header collapsed" id="<?php echo $value['id']; ?>" type="button" data-toggle="collapse" data-target="#collapse_<?php echo $value['id']; ?>" aria-expanded="false" aria-controls="collapse_<?php echo $value['id']; ?>">
															<h5 class="mb-0">
																<?php echo $value['title']; ?>
															</h5>
														</div>

														<div id="collapse_<?php echo $value['id']; ?>" class="collapse" aria-labelledby="<?php echo $value['id']; ?>" data-parent="#faqAccordion">
															<div class="card-body">
																<?php echo $value['content']; ?>
															</div>
														</div>
													</div>

											<?php
													}
												} else {
													echo "<h5>No data found</h5>";
												}
											?>
											
										</div>
									</div>
								</div>


							</div>
						</div>
					</div>

				</div>

			</div>
		</div>
	</div>    
</main>
