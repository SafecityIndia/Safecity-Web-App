function make_chat_dialog_box(to_user_id)
{
	var chatbox_msg_div = '';
	$.ajax({
		url: baseURL+'api/chat-start',
    	type: 'post',
    	data: {client_id: client_id, incident_id: incident_id, to_user_id: to_user_id},
    	success:function(data) {
    		//call chat create function
    		var guest_user_detail = data.data;
    		console.log("chat start: ", guest_user_detail);
    		guest_login_details_id = guest_user_detail.guest_login_details_id;
    		from_user_id = guest_user_detail.guest_id;
    		chatbox_load(to_user_id);
    	}
	});
}

function chatbox_load(to_user_id)
{
	$("#chatbox_div").html('');
	var chat_send_flag = '';
	if(to_user_id == 0) {
		chat_send_flag = ' disabled';
	}

	chatbox_msg_div = `
		<div class="chatbox-holder">
			<div class="chatbox">
				<div class="chatbox-top">
					<div id="user_dialog_${to_user_id}" class="chat-partner-name user_dialog" title="You have chat with ${to_user_id}">
					<!-- <div class="chat-partner-name"> -->
						Chat with Us
					</div>
					<div class="chatbox-icons">
						<a href="javascript:void(0);"><i class="fa fa-minus"></i></a>
						<a href="javascript:void(0);"><i class="fa close-icon"><img src="assets/images/close_white.svg" class="img-fluid" /></i></a>
					</div>
				</div>						
				
				<div class="chat-messages custom-scrolbar chat_history" data-touserid="${to_user_id}" id="chat_history_${to_user_id}">
					<!-- <div class="message-box-holder"> -->
				</div>
				
				<div class="chat-input-holder">
					<input name="chat_message_${to_user_id}" id="chat_message_${to_user_id}" class="chat-input" placeholder="Type a message" ${chat_send_flag}>
					<a href="#" class="${chat_send_flag}"><img src="assets/images/send.svg" class="img-fluid message-send send_chat" id="${to_user_id}"></a>
				</div>
			</div>
		</div>
	`;
	//<textarea name="chat_message_${to_user_id}" id="chat_message_${to_user_id}" class="chat-input" placeholder="Type a message"></textarea>

	$("#chatbox_div").html('');
	$("#chatbox_div").html(chatbox_msg_div);

	//Send Chat Message on Send Button Click
	$('.send_chat').click(function() {
		var client_id = $.cookie('client_id');
		var to_user_id = $(this).attr('id');
		var chat_message = $.trim($('#chat_message_'+to_user_id).val());
		send_chat_action(client_id, to_user_id, chat_message);
	});

	//Send Chat Message on Enter Key Press
	$('.chat-input').keypress(function (e) {
	    if(e.keyCode == 13) {
	    	var client_id = $.cookie('client_id');
			var to_user_id = $('.send_chat').attr('id');
			var chat_message = $.trim($('#chat_message_'+to_user_id).val());
	    	send_chat_action(client_id, to_user_id, chat_message);
	    }
	});

	$(document).on('click', '.ui-button-icon', function() {
		$('.user_dialog').dialog('destroy').remove();
		//$('#is_active_group_chat_window').val('no');
	});

	$(document).on('focus', '.chat_message', function() {
		var is_type = 'yes';
		$.ajax({
			url: baseURL+'api/get-user-type-status',
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
			url: baseURL+'api/get-user-type-status',
			method:"POST",
			data:{is_type: is_type},
			success:function(data)
			{
			}
		})
	});

	$(function() {

		$('.fa-minus').click(function() {
			$(this).closest('.chatbox').toggleClass('chatbox-min');
		});

		$('.chat-partner-name').click(function() {
			$(this).closest('.chatbox').toggleClass('chatbox-min');
		});

		$('.close-icon').click(function() {
			$(this).closest('.chatbox').hide();
			clearInterval(interval); // stop the interval
			remove_sync_user();
		});
	});

	function send_chat_action(client_id, to_user_id, chat_message) {
		if(chat_message != '')
		{
			var new_chat_element;
			$.ajax({
				url: baseURL+'api/chat-insert',
				method:"POST",
				data: {client_id: client_id, to_user_id: to_user_id, from_user_id: from_user_id, chat_message: chat_message, sent_by: 'web'},
				success:function(data)
				{
					var chat_data = data.data[0];
					var chat_date = new Date(chat_data["timestamp"].replace(/\s/g,"T") + "Z");
					new_chat_element = `<div class="message-box-holder">
												<div class="message-box">
												${chat_data["chat_message"]} <span class="chattime ligpurple-time">${timeConvert(chat_date)}</span>
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
			alert('Type something');
		}
	}
}

function remove_sync_user()
{
	$.ajax({
		url: baseURL+'api/chat-unsync-user-guest',
		method: "POST",
		data:{client_id: client_id, from_user_id: from_user_id, to_user_id: to_user_id},
		success: function(data) {
			//console.log("unsync data:", data);
			clearInterval(interval);
			to_user_id = 0;
			if (!data.status) {
				//console.log("false");
				//clearInterval(interval);
			}
		}
	})
}

function update_last_activity()
{
	$.ajax({
		url: baseURL+'api/chat-login-update',
		method:"POST",
		data: {client_id: client_id, to_user_id: to_user_id, from_user_id: from_user_id, guest_login_details_id: guest_login_details_id},
		success:function(data)
		{
			console.log("user update: ", data);
			if (data.to_user_id == '0') {
				var chat_default_element = `<div class="message-box-holder">
									<div class="message-box message-partner">
									${chat_default_msg} <span class="chattime"></span>
									</div>
								</div>`;
				$('#chat_history_'+to_user_id).html(chat_default_element);
			}
			else if (data.to_user_id != '0') {
				if (data.admin_sync == true) {
					to_user_id = data.to_user_id;
				  	chatbox_load(data.to_user_id);
				}
				set_chat_history(data.chat_history);
			}
		}
	})
}

function set_chat_history(chat_history)
{
	//console.log("chat history: ", data, "to: ", to_user_id,"from: ", from_user_id);
	var chat_data_arr = chat_history;
	var chat_element = '';
	for (let chat_data of chat_data_arr) {
		var chat_date = new Date(chat_data["timestamp"].replace(/\s/g,"T") + "Z");
        
		if(chat_data['sent_by'] == 'web')
		{
			chat_element += `<div class="message-box-holder">
									<div class="message-box">
									${chat_data["chat_message"]} <span class="chattime ligpurple-time">${timeConvert(chat_date)}</span>
									</div>
								</div>`;
		}
		else {
			chat_element += `<div class="message-box-holder">
									<div class="message-box message-partner">
									${chat_data["chat_message"]} <span class="chattime">${timeConvert(chat_date)}</span>
									</div>
								</div>`;
		}
	}

	//To Add Messages in Scrollbar Div
	$('#chat_history_'+to_user_id).html(chat_element);
}

/*function update_chat_history_data()
{
	$('.chat_history').each(function() {
		var to_user_id = $(this).data('touserid');
		fetch_user_chat_history(client_id, to_user_id, from_user_id);
	});
}*/

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