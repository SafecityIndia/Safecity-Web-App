<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	$this->load->view('includes/header');
	$catData = [];
?>

<main class="helpForm">
	<div class="main-content mt-4">
		<div class="container my-auto">
			<div class="text mx-auto mwidth100" style="width: 62%;">

				<h4 class="text-center mb-4">Thank you for sharing more about your experience with us!
				<br>Here's some useful information regarding <span class="showCat"></span> :</h4>
				<div class="mb-0 mx-auto mwidth100" style="width: 58%;">
					<div class="cardCustom">
						<div class="text">
							<ul>
								<li> <b>IPC Code:</b></li>
								<?php
									if(isset($CategoryVal) && !empty($CategoryVal)){
										foreach ($CategoryVal as $key => $value) {
											$catData[] = $value['title'];
											if(!empty($value['ipc_sections']))
											echo "<li>".$value['title'].' : '.$value['ipc_sections']."<br></li>";
										}
									}
									if(!empty($catData)){
										$cateFData = implode(', ', $catData);
									}
								?>

								<br>

								<li><b>Helpline:</b></li>
								<?php
									if(isset($helpline) && !empty($helpline)){
										foreach ($helpline as $key => $value) {
											if(!empty($value['emergency_no']))
											echo "<li>".$value['emergency_title'].' : '.$value['emergency_no']. "<br></li>";
										}
									}
								?>
							</ul>
						</div>
					</div>
					<div class="cardCustom">
						<div class="text pb-25">
							<a href="hospital_loc">
								<span class="float-left">View Hospitals near me</span>
								<span class="float-right"><img src="assets/images/arrow-right.svg" class="img-fluid leftIcon"></span>
							</a>
							
						</div>
					</div>
					<div class="cardCustom">
						<div class="text pb-25">
							<a href="policestation_loc">
								<span class="float-left">View Police Stations near me</span>
								<span class="float-right"><img src="assets/images/arrow-right.svg" class="img-fluid leftIcon"></span>
							</a>
							
						</div>
					</div>
					<div class="cardCustom">
						<div class="text pb-25">
							<a href="legal_resources">
								<span class="float-left">More Legal resources</span>
								<span class="float-right"><img src="assets/images/arrow-right.svg" class="img-fluid leftIcon"></span>
							</a>
							
						</div>
					</div>
					<div class="moreInfo text-center mb-4">
						<div class="noteColor">
							If you would like to share more information or need guidance, you can chat with us here.
						</div>
					</div>
					<div class="text-center w-100">
						<a id="startchat" class="btn w-85 btn_p_white mb-4" style="cursor: pointer;">START CHAT</a>
						<a href="home" class="btn w-85 btn_purple mb-4">GO TO HOME</a>
						
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- chart box start -->
	<div class="chatbox-holder">
		<div class="chatbox">
			<div class="chatbox-top">
				<div class="chat-partner-name">
					Chat with Us
				</div>
				<div class="chatbox-icons">
					<a href="javascript:void(0);"><i class="fa fa-minus"></i></a>
					<a href="javascript:void(0);"><i class="fa close-icon"><img src="assets/images/close_white.svg" class="img-fluid" /></i></a>
				</div>
			</div>
			
			<div class="chat-messages custom-scrolbar">
				
				<div class="message-box-holder">
					<div class="message-box message-partner">
						Lorem Ipsum is simply dummy text of the printing and typesetting
					</div>
				</div>
				
				
				<div class="message-box-holder">
					<div class="message-box message-partner">
						Sure!
					</div>
				</div>
				
				<div class="message-box-holder">
					<div class="message-box">
						Can you tell me about ABC?
					</div>
				</div>
				
				<div class="message-box-holder">
					<div class="message-box  message-partner">
						what can you assist you with?
					</div>
				</div>
				
				<div class="message-box-holder">
					<div class="message-box  message-partner">
						Hi
					</div>
				</div>
				
			</div>
			
			<div class="chat-input-holder">
				<textarea class="chat-input" placeholder="Type a message"></textarea>
				<a href="#"><img src="assets/images/send.svg" class="img-fluid message-send" ></a>
			</div>
		</div>
	</div>
	<!-- chart box end -->
</main>

<?php
	$this->load->view('includes/footer');
?>

<script type="text/javascript">
	$(document).ready(function() {

			var CatD = '<?php echo $cateFData; ?>';
			console.log("===",CatD);
			$('.showCat').text(CatD);

		var myVar;
        function myFunction() {
          myVar = setInterval(alertFunc, 2000);
        }
        function alertFunc() {
        }


		// chat with us start
			$(".chatbox").hide();

			$(function(){
				$('#startchat').click(function(){  
					$(".chatbox").show();
				});

				$('.fa-minus').click(function(){    
					$(this).closest('.chatbox').toggleClass('chatbox-min');
				});

				$('.chat-partner-name').click(function(){    
					$(this).closest('.chatbox').toggleClass('chatbox-min');
				});

				$('.close-icon').click(function(){
					$(this).closest('.chatbox').hide();
				});
			});
		// chat with us end
	});
</script>