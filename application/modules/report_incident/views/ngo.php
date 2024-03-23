	<?php 
	$this->load->view('includes/header');
	// if($_COOKIE['language']!='Kiswahili'){
		// unset($ngo_data[6]);
	// }
	
	// if($_COOKIE['language']!='Romanian'){
		// unset($ngo_data[7]);
	// }
?>
<style type="text/css">
.w-45{
	width:98px;
}
.w-160{ max-width: 160px }
.w-180{ max-width: 156px; }
.partnerwith {
	display: inline-block;
	position: relative;
	top: 10px;
	left: 10px;
}

@media only screen and (max-width: 550px) {
	.w-180,.w-160 {
		display: block;
		margin: auto;
		padding: 0 0px 
	}
	.w-45 {
		display: block;
		margin: auto;
		padding: 0 0px;
		width:98px !important;
	}
	.m-d-block{ display: block !important; }
	.partnerwith {
		top: 0px;
		left: 0px;
	}
}

@media all and (max-width: 992px) {
	.w-45 {
		width:auto;
	}
}
</style>
<main>
	<div class="main-content covering my-auto"> 
		<div class="container">
					<div class="text mx-auto shareIncident text-center" style="width:100% !important">
						<img src="<?=base_url()?>assets/images/safecity-logo.png" class="w-160"><span class="partnerwith"> partners with</span>
						<input type="hidden" id="country_id" name="country_id" value="<?=$_COOKIE['country_id']?>">
						<div class="d-flex justify-content-center mt-4 mb-5 m-d-block">
						<?php foreach ($ngo_data as $key => $value) {
						if(@$value['name']=='Embassy Of Switzerland In Jordan'){
						?>
							<div class="p-3 w-25"><img src="<?=$value['logo']?>" alt="NGO" class="img-fluid"></div>
						<?php
						}else if(@$value['name']=='Dhanwantri'){
						?>
							<div class="p-3 w-45"><img src="<?=$value['logo']?>" alt="NGO" class="img-fluid"></div>
						<?php
						}else{
						?>
							<div class="p-3 w-180"><img src="<?=$value['logo']?>" alt="NGO" class="img-fluid"></div>
						<?php
						}
						?>
							
						
				<!-- 		<hr> -->
					   <?php } ?>
					   </div>
						<div><button class="btn btn-primary safetyBtn consent_btn animated nextPage fadeInUp pull-right mt-3 nxt_btn"  style="margin-left:0!important"><?php echo $this->lang->line('apply_to_next_btn'); ?></button></div>
					</div>
		</div>		
	</div>
</main>

<?php
	$this->load->view('includes/footer');
?>
<script>
	var baseUrl    = '<?=base_url()?>';
	var country_id = $("#country_id").val();	
	$(document).ready(function() {
		$(".nxt_btn").click(function (event) {
			if(country_id=='111'){
				window.location.href = baseUrl + "Welcome";
			}else{
				window.location.href = baseUrl + "shareIncident";
			}
		// window.location.href = baseUrl + "shareIncident";
	  })
	});
</script>

