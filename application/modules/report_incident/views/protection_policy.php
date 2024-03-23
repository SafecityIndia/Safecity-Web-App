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
				?>
					
				<?php
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
<script>
var baseUrl    = '<?=base_url()?>';
$(".safetyBtn").click(function(e){
	window.location.href = baseUrl + "Experience";
});
</script>