<main>
	<div class="main-content mt-4 mb-4">
		<div class="container">

			<div class="text mx-auto">
 
				<div class="leftTabs">
					<div class=""> <!--position-sticky -->
						<div class="col-md-12 col-sm-12 col-xs-12 m-parl">
							<div class="row">

								<div class="col-md-3 pl-0 m-dis-none">

									<?php $this->load->view('includes/sidebar'); ?>                  

								</div>

								<?php
									if(isset($about_data[0]['content']) && !empty($about_data[0]['content'])){
										echo html_entity_decode($about_data[0]['content']);
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
</main>
