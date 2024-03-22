<main class="position-relative">
	<div class="main-content m-my-auto mt-4 mb-4">
		<div class="container">

			<div class="text mx-auto">

				<div class="leftTabs">
					<div class=""> <!--position-sticky -->
						<div class="col-md-12 col-sm-6 col-xs-12 m-parl">
							<div class="row"> 

								<div class="col-md-3 pl-0 m-dis-none">

									<?php $this->load->view('includes/sidebar'); ?>                 

								</div>
								<div class="col-md-1">
									
								</div>

								<div class="col-md-8 my-auto">
									<div class="mainContent width100" style="width: 90%">
										<div class="card3">
											<div class="row">
												<div class="col-md-12 my-auto">
													<?php
														if(isset($donate_data[0]['content']) && !empty($donate_data[0]['content'])){
															echo $donate_data[0]['content'];
														} else {
															echo "Data not found.";
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
		</div>
	</div>    
</main>
