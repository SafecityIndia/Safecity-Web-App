<?php $this->load->view('includes/header'); ?>
<main class="contentCenter">
	<div class="main-content mt-5">
		<div class="container-fluid">
			<div class="container">
				<div class="text mx-auto shareIncidentHome onbarding">
					<form>
						<h1><?php echo $this->lang->line('select_location'); ?></h1>
						<div class="fix-height">
							<!--  	location  start -->
							<div class="form-group">
								<label><?php echo $this->lang->line('select_country'); ?></label>
								<input type="text" class="form-control js-states" id="autocomplete-country" value="<?=$country_name?>" autocomplete="country_id">
								<input type="hidden" id="country_id" name="country_id" value="<?=$country_id?>">
								
								<input type="hidden" id="ngo_id" name="ngo_id" value="<?=$ngo_id!=0?$ngo_id:0?>">
							   
							</div>
							<!--  	location  end -->
							<!--  	city  start -->
							<div class="form-group" id="cityblock">
								<label for="exampleInputPassword1">
									<?php echo $this->lang->line('select_city'); ?>
								</label>
								<input type="text" class="form-control js-states" id="autocomplete-city" value="<?=$city_name?>" autocomplete="city_id">
								<input type="hidden" id="city_id" name="city_id" value="<?=$city_id?>">
							</div>
							<!--  	city  end -->
							<!--  	organization radio btn start -->
							<div class="form-group" id="organizationradioblock">
								<label><?php echo $this->lang->line('reporting_orgnization'); ?></label>
								<div class="clearfix"></div>
								<div class="custom-control custom-radio custom-control-inline">
									<input type="radio" class="custom-control-input" id="customRadio" name="is_organization" value="1">
									<label class="custom-control-label" for="customRadio">
										<?php echo $this->lang->line('org_yes'); ?>
									</label>
								</div>
								<div class="custom-control custom-radio custom-control-inline">
									<input type="radio" class="custom-control-input" id="customRadio2" name="is_organization" value="0">
									<label class="custom-control-label" for="customRadio2">
										<?php echo $this->lang->line('org_no'); ?>
									</label>
								</div>
							</div>
							<!--  	organizationradio btn end -->
							<!--  	organization start -->
							<div class="form-group" id="oraganisationblock">
								<label><?php echo $this->lang->line('select_organization'); ?></label>
								<input type="text" class="form-control js-state" id="autocomplete-organization">
								<input type="hidden" id="organization_id">
							</div>
							<!--  	organization end -->
								<!--  	language start -->
							<!-- <div class="form-group" id="languageblock">
								<label><?php echo $this->lang->line('select_language'); ?></label>
								<input type="text" class="form-control js-state" id="autocomplete-language" autocomplete="off">
								<input type="hidden" id="language_id">
							</div> -->
							<div class="form-group" id="languageblock">
								<label><?php echo $this->lang->line('select_language'); ?></label>
								<select id="autocomplete-language-id" class="form-control js-state">
								<?php
								if($country_id==111){ 
								?>
									<option value="">اختار اللغة</option>
								<?php
								}else{
								?>
									<option value="">Select Language</option>
								<?php
								}
								?>
								</select>
								<input type="hidden" id="language_id">
							</div>
							<!--  	language end -->
						</div>
						<!--  	Proceed btn start -->
						<div class="text-left">
							<button disabled id="proceed_btn" class="btn btn-primary safetyBtn animated nextPage fadeInUp pull-right mt-3 nxt_btn" style="margin-left: 0!important">
								<?php echo $this->lang->line('button_proceed'); ?>
							</button>
						</div>
						<!--  	Proceed btn end -->
						<div class="mt-5"></div>
					</form>
					
				</div>
			</div>
		</div>
	</div>
</div>
</main>
<div class="modal fade org_varification" id="org_varification" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-dialog-centered mt-0" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<div class="form-group">
					<label><?php echo $this->lang->line('organization_code'); ?></label>
					<input type="text" name="varification_code" id="varification_code" class="form-control">
					<div class="text-danger"></div>
				</div>
				<div class="text-center">
					<button type="button" id="org_done" class="btn w-85 btn_purple mb-0 mt-3 w-100">
						<?php echo $this->lang->line('button_done'); ?>
					</button>
				</div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php $this->load->view('includes/footer'); ?>
<style type="text/css">
	.typeahead>li.active {
      text-decoration: none;
      background-color: #EBE2F4;
    }
</style>
<script>
	var baseUrl    = '<?=base_url()?>';
	var country_id = <?=$country_id?>;
	var city_id    = <?=$city_id?>;
	var client_id  = <?=$client_id?>;
	var organization_id = language_id = 0;

	// language changes 29-10-2020 start - sonam
	var code_error = '<?php echo $this->lang->line('correct_code'); ?>';
	// language changes 29-10-2020 end - sonam
</script>
<script src="application/modules/report_incident/scripts/kuwaitonboarding.js"></script>