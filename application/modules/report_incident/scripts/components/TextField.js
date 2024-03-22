var textField = (function() {

	function nextClick() {
		var answer_id = 0;
		var answer = $("#" + currentQuestion.elementId).val();

		if (answer == "") {
			$("#dynamicNext").attr("disabled", "disabled");
			return false;
		}
		
		var answerJson = {
			"option_id": answer_id,
			"answer": answer
		};

		// Save and proceed
		saveCurrentAnswer(answer_id, answerJson);
	}
	
	function ValidateText(value) {
	    //Regex for Valid Characters i.e. Alphabets, Numbers and Space.
	    if($.cookie('language_id')==6){
			var regex = /[\u0600-\u06FF]/
		}else{
			var regex = /^[\w\s.-]+$/
		}

	    //Validate TextBox value against the Regex.
	    var isValid = regex.test(value);
	    /*if (!isValid) {
	        alert("Contains Special Characters.");
	    } else {
	        alert("Does not contain Special Characters.");
	    }*/
	    return isValid;
	}

	return function(data, properties, lastQuestion) {
		var answer = lastQuestion != null ? lastQuestion.currentQuestion.answerJson.answer : "";
		currentQuestion.elementId = "option" + data["question"]["id"];

		if (properties.validations.length == 4) {
			var validation_type = properties.validations[1].type != null ? properties.validations[1].type : "text";
			var number_req_msg = '<div class="validdation_text" style="color:red;">' + properties["validations"][0]["message"] + '</div>';
	    	var number_type_msg = '<div class="validdation_text" style="color:red;">' + properties["validations"][1]["message"] + '</div>';
	    	var number_min_msg = '<div class="validdation_text" style="color:red;">' + properties["validations"][2]["message"] + '</div>';
	    	var number_max_msg = '<div class="validdation_text" style="color:red;">' + properties["validations"][3]["message"] + '</div>';
		}
		else {
			var number_req_msg = '<div class="validdation_text" style="color:red;">' + properties["validations"][0]["message"] + '</div>';
			var text_alpha_valid_msg = '<div class="validdation_text" style="color:red;">' + properties["validations"][1]["message"] + '</div>';
		}
		
		if(validation_type == 'number') {
			var elementHtml = `<input type="${properties.validations[1].type}" id="option${data["question"]["id"]}" class="form-control inputBox getAge" name="option${data["question"]["id"]}" placeholder="${properties.placeholder}" value="${answer}" min="${properties.validations[2].min}" max="${properties.validations[3].max}" >`;
		}
		else {
			var elementHtml = `<input type="text" id="option${data["question"]["id"]}" class="form-control inputBox getAge" name="option${data["question"]["id"]}" placeholder="${properties.placeholder}" value="${answer}" >`;		
		}
		//var elementHtml = `<input type="text" id="option${data["question"]["id"]}" class="form-control inputBox getAge" name="option${data["question"]["id"]}" placeholder="${properties.placeholder}" value="${answer}" >`;
		//console.log(elementHtml);
		$("#options").html(elementHtml);

		$('.inputBox').focus();

		$(".inputBox").keyup(function(e) {
			$('.validdation_text').remove();
			if(validation_type == 'number') {
				var input_val =  parseInt($(".inputBox").val());
				if (input_val) {
					if (input_val < parseInt(properties.validations[2].min)) {
						$('.inputBox').after('<div class="validdation_text" style="color:red;">'+number_min_msg+'</div>');
						$("#dynamicNext").attr("disabled", "disabled");
					}
					else if (input_val > parseInt(properties.validations[3].max)) {
						$('.inputBox').after('<div class="validdation_text" style="color:red;">'+number_max_msg+'</div>');
						$("#dynamicNext").attr("disabled", "disabled");
					}
					else {
						$('.validdation_text').remove();
						$("#dynamicNext").removeAttr("disabled");
					}
				}
				else {
					$('.inputBox').after('<div class="validdation_text" style="color:red;" >'+number_type_msg+'</div>');
					$("#dynamicNext").attr("disabled", "disabled");
				}
			}
			else {
				if (($(".inputBox").val().trim()) != "") {
					//var txt_value = $(".inputBox").val();
					//if(ValidateText(txt_value)){
						$('.validdation_text').remove();
						$("#dynamicNext").removeAttr("disabled");
					/*}
					else {
						$('#options').append('<div class="validdation_text" style="color:red;">'+text_alpha_valid_msg+'</div>');
						$("#dynamicNext").attr("disabled", "disabled");
					}*/				
				}
				else {
					$('#options').append('<div class="validdation_text" style="color:red;">'+number_req_msg+'</div>');
					$("#dynamicNext").attr("disabled", "disabled");
				}
			}
	    });

	    // Add new event listener
	    $("#dynamicNext").off('click').click(function(event) {
	    	event.preventDefault();
	    	nextClick();
	    });
	}

})();