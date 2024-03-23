<?php 
	$this->load->view('includes/header');
?>

<main>
	<div class="terms main-content mt-4">
		<div class="container">
			<!-- country & city filter Start -->
				<?php $this->load->view('home/topbar'); ?>
			<!-- country & city filter end -->

			<div class="text linkText mx-auto pt-4" style="width: 70%;">
				<?php
					if(isset($privacy_data[0]['content']) && !empty($privacy_data[0]['content'])){
						echo $privacy_data[0]['content'];
					} else {
						echo "Data not found.";
					}
				?>
			</div>
		</div>
	</div>
</main>

<?php
	$this->load->view('includes/footer');
?>

<script src="<?php echo base_url(); ?>application/modules/home/scripts/topbar.js"></script>
