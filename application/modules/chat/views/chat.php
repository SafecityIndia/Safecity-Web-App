<div class="chatbox-holder">
	<div class="chatbox">
		<div class="chatbox-top">
			<div id="user_dialog_<?php echo $_POST['to_user_id'];?>" class="chat-partner-name user_dialog" title="You have chat with <?php echo $_POST['to_user_id'];?>">
			<!-- <div class="chat-partner-name"> -->
				Chat with Us
			</div>
			<div class="chatbox-icons">
				<a href="javascript:void(0);"><i class="fa fa-minus"></i></a>
				<a href="javascript:void(0);"><i class="fa close-icon"><img src="assets/images/close_white.svg" class="img-fluid" /></i></a>
			</div>
		</div>
		
		<!-- <div class="chat-messages custom-scrolbar"> -->
		<div class="chat-messages custom-scrolbar chat_history" data-touserid="<?php echo $_POST['to_user_id'];?>" id="chat_history_<?php echo $_POST['to_user_id'];?>">
			<!-- <div class="message-box-holder"> -->
		</div>
		
		<div class="chat-input-holder">
			<textarea name="chat_message_<?php echo $_POST['to_user_id'];?>" id="chat_message_<?php echo $_POST['to_user_id'];?>" class="chat-input" placeholder="Type a message"></textarea>
			<a href="#"><img src="assets/images/send.svg" class="img-fluid message-send send_chat" id="<?php echo $_POST['to_user_id'];?>"></a>
		</div>
	</div>
</div>

<script type="text/javascript">

	var interval = null;

	$('.fa-minus').click(function() {
		$(this).closest('.chatbox').toggleClass('chatbox-min');
	});

	$('.chat-partner-name').click(function() {    
		$(this).closest('.chatbox').toggleClass('chatbox-min');
	});

	$('.close-icon').click(function() {
		$(this).closest('.chatbox').hide();
		clearInterval(interval); // stop the interval
	});

	$(document).ready(function() {

		var to_user_id = '<?php echo $_POST['to_user_id'];?>';
		var from_user_id = '<?php echo $_POST['incident_id'];?>';

		fetch_user_chat_history(to_user_id);

		//fetch_user();
		interval = setInterval(function() {
			update_last_activity();
			//fetch_user();
			update_chat_history_data();
		}, 2000);

		function fetch_user()
		{
			$.ajax({
				//url: '<?php echo base_url('help_chat')?>',//"fetch_guest_user.php",
				//url: "http://localhost/SafecityChatApp/fetch_guest_user.php",
				method: "POST",
				success: function(data) {
					console.log(data);
					//$('#user_details').html(data);
				}
			})
		}

		function update_last_activity()
		{
			$.ajax({
				url: '<?php echo base_url('api/chat-login-update')?>',
				success:function(data)
				{
					console.log("user update: ",data);
				}
			})
		}

		$(document).on('click', '.send_chat', function() {
			var to_user_id = $(this).attr('id');
			var chat_message = $.trim($('#chat_message_'+to_user_id).val());			

			if(chat_message != '')
			{
				var new_chat_element;

				$.ajax({
					url: '<?php echo base_url('api/chat-insert')?>',
					method:"POST",
					data:{to_user_id:to_user_id, chat_message:chat_message},
					success:function(data)
					{
						console.log("success send chat: ",data);
						var chat_data = data.data[0];

						new_chat_element = `<div class="message-box-holder">
													<div class="message-box">
													${chat_data["chat_message"]} <span class="chattime ligpurple-time">${timeConvert(chat_data["timestamp"])}</span>
													</div>
												</div>`;

						$('#chat_message_'+to_user_id).val('');
						$('#chat_history_'+to_user_id).append(new_chat_element);
					},
					complete: function(data)
					{
						//Message div scroll to the bottom
						scrollToBottom('chat_history_'+to_user_id);
					}
				})
			}
			else
			{
				//$('.chat-input').val('Type something').css('color','red');
				//$('.chat-input').append('<div class="validdation_text" style="color:red;">Type something</div>');
				alert('Type something');
			}
		});

		function fetch_user_chat_history(to_user_id)
		{
			$.ajax({
				url: '<?php echo base_url('api/get-chat-history')?>',
				method:"POST",
				data:{to_user_id: to_user_id},
				success:function(data) {
					var chat_data_arr = data.data;
					console.log("chat history: ", data);
					var chat_element = '';
					for (let chat_data of chat_data_arr) {
						if(chat_data['from_user_id'] == from_user_id)
						{
							chat_element += `<div class="message-box-holder">
													<div class="message-box">
													${chat_data["chat_message"]} <span class="chattime ligpurple-time">${timeConvert(chat_data["timestamp"])}</span>
													</div>
												</div>`;
						}
						else {
							chat_element += `<div class="message-box-holder">
													<div class="message-box message-partner">
													${chat_data["chat_message"]} <span class="chattime">${timeConvert(chat_data["timestamp"])}</span>
													</div>
												</div>`;
						}
					}

					//To Add Messages in Scrollbar Div
					$('#chat_history_'+to_user_id).html(chat_element);

					//Message div scroll to the bottom
					//scrollToBottom('chat_history_'+to_user_id);
				}
			})
		}

		function update_chat_history_data()
		{
			$('.chat_history').each(function() {
				var to_user_id = $(this).data('touserid');
				fetch_user_chat_history(to_user_id);
			});
		}

		function timeConvert(date) {
            var date = new Date(date);
            var time = date.toLocaleString([], { hour: '2-digit', minute: '2-digit' });
            return time;
        }

        function scrollToBottom(id)
        {
        	var msgDiv = document.getElementById(id);
			msgDiv.scrollTop = msgDiv.scrollHeight;
        }

		$(document).on('click', '.ui-button-icon', function() {
			$('.user_dialog').dialog('destroy').remove();
			//$('#is_active_group_chat_window').val('no');
		});

		$(document).on('focus', '.chat_message', function() {
			var is_type = 'yes';
			$.ajax({
				url: '<?php echo base_url('api/get-user-type-status')?>',
				method:"POST",
				data:{is_type: is_type},
				success:function(data)
				{
				}
			})
		});

		$(document).on('blur', '.chat_message', function() {
			var is_type = 'no';
			$.ajax({
				url: '<?php echo base_url('api/get-user-type-status')?>',
				method:"POST",
				data:{is_type: is_type},
				success:function(data)
				{
				}
			})
		});

		/*$(document).on('blur', '.chat-input', function() {
			console.log("text clear");
			$('.chat-input').val('');
		});*/

	});
</script>