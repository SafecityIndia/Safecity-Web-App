<?php 
	$this->load->view('includes/header');
?>

<main>
	<div class="main-content covering my-auto"> 
		<div class="container">
				<?php
				//echo $this->lang->line('menu_lang');
				if(isset($consent_data[0]['content']) && !empty($consent_data[0]['content'])){
					echo $consent_data[0]['content'];
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