<?php 
	$this->load->view('includes/header');
?>

<main>
	<div class="terms main-content mt-4">
		<div class="container">
			<!-- country & city filter Start -->
				<?php $this->load->view('home/topbar'); ?>
			<!-- country & city filter end -->

			<?php
				if(isset($terms_data[0]['content']) && !empty($terms_data[0]['content'])){
					echo $terms_data[0]['content'];
				} else {
					echo "Data not found.";
				}
			?>
		</div>
	</div>
</main>

<?php
	$this->load->view('includes/footer');
?>

<script src="<?php echo base_url(); ?>application/modules/home/scripts/topbar.js"></script>
