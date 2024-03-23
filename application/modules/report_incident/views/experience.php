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
					<div class="text mx-auto shareIncident">
						<div class="custom-control custom-checkbox agreeConsent" style="padding-left:24px!important"><input type="checkbox" name="agreeConsent" class="custom-control-input" id="agreeConsent"><label class="custom-control-label" for="agreeConsent"><?php echo $this->lang->line('apply_to_agreeConsent'); ?></label></div>
						<!--<div class="mt-4"><a href="protection_policy" class="themeColor aLink"><?php echo $this->lang->line('apply_to_protection_policy'); ?></a></div>-->
						<div><button class="btn btn-primary safetyBtn consent_btn animated nextPage fadeInUp pull-right mt-3 nxt_btn" disabled="disabled" style="margin-left:0!important"><?php echo $this->lang->line('apply_to_next_btn'); ?></button></div>
					</div>
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

$(document).ready(function() {
		if($("#agreeConsent").is(':checked')) {
			$(".nxt_btn").removeAttr('disabled');
		} else {
			$(".nxt_btn").attr('disabled', 'disabled');
		}
	});

$(".safetyBtn").click(function(e){
	// window.location.href = baseUrl + "Experience";
});
</script>