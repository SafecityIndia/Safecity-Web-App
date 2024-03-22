<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	$this->load->view('includes/header');
?>
 
<main class="helpPage">
	<div class="main-content"> 
		<div class="container my-auto">
			
			<!-- country & city filter Start -->
				<?php $this->load->view('home/topbar'); ?>
			<!-- country & city filter end -->

			<div class="text mx-auto pt-4 width100" style="width: 62%;">        
				<div class="mb-0 mx-auto width100" style="width: 58%;">
					<?php if(isset($number_list) && !empty($number_list)){ ?>
						<div style="font-weight: 500;margin-bottom: 10px;">
							<?php echo $this->lang->line('emergency_number'); ?>
						</div>
						<div class="cardCustom">
							<div class="text">
								<ul class="resultNumbers">
									<?php
											foreach ($number_list as $key => $value) {
									?>
											<li>
												<?php echo $value['emergency_title'].' : '; ?> 
												<span class="themeColor">
													<?php echo $value['emergency_no']; ?>
												</span>
											</li>
									<?php
											}
									?>
								</ul>
							</div>
						</div>
						<?php }
						?>

						<div class="cardCustom">
							<div class="text pb-25">
								<a href="hospital_loc">
									<span class="float-left">
										<?php echo $this->lang->line('view_hospital'); ?>
									</span>
									<span class="float-right"><img src="assets/images/arrow-right.svg" class="img-fluid leftIcon"></span>
								</a>
								
							</div>
						</div>

						<div class="cardCustom">
							<div class="text pb-25">
								<a href="policestation_loc">
									<span class="float-left">
										<?php echo $this->lang->line('view_police_station'); ?>
									</span>
									<span class="float-right"><img src="assets/images/arrow-right.svg" class="img-fluid leftIcon"></span>
								</a>
								
							</div>
						</div>

						<div class="cardCustom">
							<div class="text pb-25">
								<a href="legal_resources">
									<span class="float-left">
										<?php echo $this->lang->line('more_legal_resources'); ?>
									</span>
									<span class="float-right"><img src="assets/images/arrow-right.svg" class="img-fluid leftIcon"></span>
								</a>
								
							</div>
						</div>
						
				</div>

			</div>
		</div>
	</div>
</main>


<?php
	$this->load->view('includes/footer');
?>
<script type="text/javascript">
	
</script>
<script src="<?php echo base_url(); ?>application/modules/home/scripts/topbar.js"></script>
