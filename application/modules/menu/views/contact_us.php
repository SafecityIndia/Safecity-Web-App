<main>
	<div class="main-content m-my-auto mt-4 mb-4">
		<div class="container">

			<div class="text mx-auto">

				<div class="leftTabs">
					<div class=""> <!--position-sticky -->
						<div class="col-md-12 col-sm-12 col-xs-12 m-parl">
							<div class="row">

								<div class="col-md-3 pl-0 m-dis-none"> 

									<?php $this->load->view('includes/sidebar'); ?>               

								</div>
								<div class="col-md-1"></div>

								<div class="col-md-8 my-auto">
									<div class="mainContent">
									<?php
										if(isset($contact_data[0]['content']) && !empty($contact_data[0]['content'])){
											echo $contact_data[0]['content'];
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
</main>
