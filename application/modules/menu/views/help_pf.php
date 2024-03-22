<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	$this->load->view('includes/header');
	$catData = [];
	$cateFData = '';
	$to_user_id = 0;
?>

<main class="helpForm">
	<div class="main-content mt-4">
		<div class="container my-auto">
			<div class="text mx-auto mwidth100" style="width: 62%;">

				<h4 class="text-center mb-4">
					<?php echo $this->lang->line('help_desc'); ?>
					<br>
					<?php if (!empty($category_names)) {
						echo $this->lang->line('help_useful_desc'); ?>
						<span class="showCat"><?=$category_names?></span> :
					<?php } ?>
				</h4>
				<div class="mb-0 mx-auto mwidth100" style="width: 58%;">
					<?php if((isset($CategoryVal) && !empty($CategoryVal)) || (isset($helpline) && !empty($helpline))):?>
					<div class="cardCustom">
						<div class="text">
							<ul>
								<?php
									if(isset($CategoryVal) && !empty($CategoryVal)){
										echo "<li> <b>IPC Code:</b></li>";
										foreach ($CategoryVal as $key => $value) {
											$catData[] = $value['title'];
											if(!empty($value['ipc_sections']))
											echo "<li>".$value['title'].' : '.$value['ipc_sections']."<br></li>";
										}
										echo "<br>";
									}
									if(!empty($catData)){
										$cateFData = implode(', ', $catData);
									}
								?>


								<?php
									if(isset($helpline) && !empty($helpline)){
										echo "<li><b>Helpline:</b></li>";
										foreach ($helpline as $key => $value) {
											if(!empty($value['emergency_no']))
											echo "<li>".$value['emergency_title'].' : '.$value['emergency_no']. "<br></li>";
										}
									}
								?>
							</ul>
						</div>
					</div>
					<?php endif; ?>
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
					<div class="moreInfo text-center mb-4">
						<div class="noteColor">
							<?php echo $this->lang->line('help_chat_desc'); ?>
						</div>
					</div>
					<div class="text-center w-100">

						<!-- <a id="startchat" class="btn w-85 btn_p_white mb-4" style="cursor: pointer;" data-touserid="<?php echo $to_user_id ?>" data-tousername="user1"><?php echo $this->lang->line('button_start_chat'); ?></a> -->

						<button type="button" class="btn w-85 btn_p_white mb-4" style="cursor: pointer;" data-toggle="modal" data-target="#shareAppModal"><?php echo $this->lang->line('share_app'); ?></button>

						<a href="home" class="btn w-85 btn_purple mb-4">
							<?php echo $this->lang->line('button_go_home'); ?>
						</a>

					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- chart box start -->
	<div id="chatbox_div">
	</div>
	<!-- chart box end -->

</main>

<!-- Modal -->
<div class="modal fade" id="shareAppModal" tabindex="-1" role="dialog" aria-labelledby="shareAppModalTitle" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
		    <div class="modal-header">
		        <h5 class="modal-title" id="shareAppModalTitle"><?php echo $this->lang->line('share_app'); ?></h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		     </div>
	      	<div class="modal-body">
	       		<div id="jssocial"></div>
	      	</div>
	    </div>
  	</div>
</div>

<?php
	$this->load->view('includes/footer');
?>

<style type="text/css">
	a.disabled {
	    pointer-events: none;
	    color: #ccc;
	}
</style>
<!-- Share App CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha512-+L4yy6FRcDGbXJ9mPG8MT/3UCDzwR9gPeyFNMCtInsol++5m3bk2bXWKdZjvybmohrAsn3Ua5x8gfLnbE1YkOg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.css" />
<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials-theme-flat.css" />
<!-- Share App CSS END -->

<!-- Share APP JS -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.min.js"></script>
<!-- Share APP JS END -->
<script type="text/javascript">
	var baseURL = "<?php echo base_url() ?>";
	var CatD = '<?php echo $cateFData; ?>';
	var to_user_id = '<?php echo $to_user_id;?>';
	var from_user_id = '<?php echo $_GET['inc']; ?>';
	var incident_id = '<?php echo $_GET['inc']; ?>';
	var client_id = $.cookie('client_id');
	var interval = null;
	var interval_sync = null;
	var guest_login_details_id = null;
	var chat_default_msg = `<?php echo $this->lang->line('chat_default_msg'); ?>`;

	$(document).ready(function() {
		// chat with us end
        $('#startchat').click(function() {
        	make_chat_dialog_box(to_user_id);
			//console.log("start chat to_user_id: ", to_user_id);
			interval = setInterval(function() {
				update_last_activity();
			}, 2000);
		});
		// chat with us end

		// Share App
		$("#jssocial").jsSocials({
            shares: ["email", "twitter", "facebook", "googleplus", "linkedin", "pinterest", "stumbleupon", "whatsapp"],
            url: baseURL+"onboarding",
            text: "Hey! Checkout this cool app that helps you stay safe.",
        });

	});
</script>
<script src="<?php base_url()?>application/modules/chat/scripts/chatbox_actions.js"></script>