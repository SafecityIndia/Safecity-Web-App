var checkboxField = (function() {

	var text_field_required_msg = '';
	var text_field_valid_msg = '';

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

	function nextClick() {
		var answer_id  = '';
		var answer = '';
		var other_answers = {};
		var parent_answer_arr = [];
		var main_answer_arr = [];

		var is_valid = true;
		// Get all checked options
		$("input[name=" + currentQuestion.elementId + "]:checked").each(function(index, el) {
			var this_ans_id = $(this).val();
			answer += ','+$(this).data('val');
			answer_id += ','+this_ans_id;

			// Has Subtext? Get textbox value
			if($(this).data('showtextbox')==true)
				other_answers[this_ans_id] = $("input[name=option"+this_ans_id+"textbox").val();

			// Is Main? Used for logical questions of categories
			if($(this).data('ismain'))
				main_answer_arr.push(this_ans_id);

			// Has parent id? Used for secondary questions
			var parent_id = $(this).data('parentid');
			parent_id = parent_id==0 || parent_id==undefined?parseInt(this_ans_id):parent_id;
			if(!parent_answer_arr.includes(parent_id))
				parent_answer_arr.push(parent_id);

			// Get answer of suboption of type radio
			// Currently there can only be two types of suboptions i.e. radio and checkbox
			// Checbox suboption answer already gets selected as normal option
			// Below code fetches answer for suboption of type radio.
			if($(this).data('hassuboptions')==true) {
				//$("#dynamicNext").attr("disabled", "disabled");
				var suboptionElem = $("input[name=suboption"+this_ans_id+"]:checked");
				if(suboptionElem.length>0) {
					answer += ',' + suboptionElem.data('val');
					answer_id += ',' + suboptionElem.val();
				}
			}

		});

		answer_id = answer_id.replace(',', '');

		if (answer_id == "") {
			$("#dynamicNext").attr("disabled", "disabled");
			return false;
		}
		else {
			var parent_answer_id = parent_answer_arr.sort().join(',');
			var main_answer_id  = main_answer_arr.sort().join(',');
			var answerJson = {
				"option_id": answer_id,
				"main_answer_id": main_answer_id,
				"parent_option_id": parent_answer_id,
				"other_answers": other_answers,
				"answer": ""
			}
			answer = answer.replace(',', '');
			var parent_answer_id = parent_answer_arr.sort().join(',');
			var main_answer_id  = main_answer_arr.sort().join(',');
			var answerJson = {
				"option_id": answer_id,
				"main_answer_id": main_answer_id,
				"parent_option_id": parent_answer_id,
				"other_answers": other_answers,
				"answer": answer
			};

			if(currentQuestion.has_logic_dependency=="1") {
				dependedQuestionsAnswers[currentQuestion.id] = {
					"answers": answer_id,
					"main_answers": main_answer_id,
					"parent_answers": parent_answer_id
				};
			}
		}

		// Save and proceed
		saveCurrentAnswer(answer_id, answerJson);
	}

	function validate(clickedId) {
		var is_valid = true;
		var total_checked = $("#options input[type=checkbox]:checked").length;
		if(total_checked==0) {
			is_valid = false;
		}
		$("#options input[type=checkbox]:checked").each(function(index, el) {
			var parentOptionId = $(el).attr('id');
			// Check for suboptions validity
			if($(el).data('hassuboptions')==true) {
				if($("#suboption-container-"+parentOptionId+" input:checked").length==0)
					is_valid = false; 
			}

			// Check for other textbox validity
			if($(el).data('showtextbox')==true) {
				var textboxSelector = 'input[name=option'+parentOptionId+'textbox]';
				// if(!ValidateText($('input[name=option'+parentOptionId+'textbox]').val())) {
					// is_valid = false;
					// Check if textbox is shown just now (not dirty)
					if(clickedId!=parentOptionId || clickedId==null) {
						if($(textboxSelector+'+.validdation_text').length==0)
							$(textboxSelector).after('<div class="validdation_text" style="color:red;">'+text_field_required_msg+'</div>');
					}
				// } else {
					// $(textboxSelector+'+.validdation_text').remove();
				// }
			}
		});

		
		if(!is_valid)
			$("#dynamicNext").attr("disabled", "disabled");
		else
			$("#dynamicNext").removeAttr("disabled");
		return is_valid;
	}
	
	return function(data, lastQuestion) {
		var selectedAnswerId =
			lastQuestion != null ? lastQuestion.currentQuestion.answerJson.option_id : null;
		var selectedAnswerArr = selectedAnswerId==null?[]:selectedAnswerId.split(',');
		currentQuestion.elementId = "option" + data["question"]["id"];
		var elementHtml = `<div class="row">`;
		var i = 0;
		if(data["question"].is_category==true) {
			var data_options = [];
			categories.forEach(function (category) {
				data_options.push({
					'id': category.id,
					'textbox_placeholder': null,
					'title': category.title,
					'parent_id': category.parent_id,
					'is_main': category.is_main
				});
			});
			data["options"] = data_options;
		}
		var thisQuestion = dynamicQuestionOptionJson[data["question"]["id"]];
		var hasSuboptions = thisQuestion['suboptions']==undefined?false:true;
		data["options"].sort(function(a, b) {
			return a.order_no - b.order_no;
		});
		data["options"].forEach(function (option) {
			var showTextbox = option.textbox_placeholder!=null;
			var isSelected = selectedAnswerArr.includes(option.id);
			var includesSuboptions = hasSuboptions?thisQuestion["suboptions"][option.id]!=undefined?true:false:false;
			if(!hasSuboptions){
				elementHtml += `<div class="col-md-6">`;
				if(option.title!=null){	
					elementHtml += `
						<div class="inputGroup custom-control shareincidentform">
						  <input type="checkbox" id="${option.id}" data-id="1"  name="option${data["question"]["id"]}" class="custom-control-input getAttr dynamic-checkbox" value="${option.id}" data-parentid="${option.parent_id}" data-ismain="${option.is_main}" data-val="${option.title}" data-hasSuboptions="${includesSuboptions}" data-showtextbox="${showTextbox}" ${isSelected?"checked":""}>
						  <label class="custom-control-label label1" for="${option.id}">${option.title[0].toUpperCase()+option.title.substr(1)}</label>
						</div>
					`;
				}
			}else{
				elementHtml += `<div class="col-md-6">`;
				if(option.title!=null){
					elementHtml += `
						<div class="inputGroup custom-control shareincidentform">
						  <input type="checkbox" id="${option.id}" data-id="1"  name="option${data["question"]["id"]}" class="custom-control-input getAttr dynamic-checkbox" value="${option.id}" data-parentid="${option.parent_id}" data-ismain="${option.is_main}" data-val="${option.title}" data-hasSuboptions="${includesSuboptions}" data-showtextbox="${showTextbox}" ${isSelected?"checked":""}>
						  <label class="custom-control-label label1" for="${option.id}">${option.title[0].toUpperCase()+option.title.substr(1)}</label>
						</div>
					`;
				}
			}
			if(showTextbox) {
				var text_placeholder = option.textbox_placeholder;
				try {
					var text_properties = JSON.parse(option.textbox_placeholder);
					text_field_required_msg = text_properties["validations"][0]["message"];
				  	text_field_valid_msg = text_properties["validations"][1]["message"];
				   	text_placeholder = text_properties["placeholder"];
				}
				catch (e) {
					text_placeholder = option.textbox_placeholder;
				}
				var otheranswers =  selectedAnswerId!=null?lastQuestion.currentQuestion.answerJson.other_answers:null;
				var othertextval = otheranswers!=null && otheranswers[option.id]!=undefined?otheranswers[option.id]:"";
				elementHtml += `
				<input type="text" class="form-control input1 specifyBox1 shareincidentform ${isSelected?"":"d-none"}" name="option${option.id}textbox" placeholder="${text_placeholder}" value="${othertextval}">
				`;
			} else if(hasSuboptions && includesSuboptions) {
				elementHtml += `<ul id="suboption-container-${option.id}" style="${isSelected?'':'display:none'}" class="custom-radio-inside  suboption-container">`;

				var subOptionProperties = JSON.parse(option.suboption_properties);
				thisQuestion['suboptions'][option.id].forEach(function (suboption) {
					var isSuboptionSelected = selectedAnswerArr.includes(suboption.id);
					if(subOptionProperties.type=='checkbox') {
						if(suboption.title!=null){
						elementHtml += `
							<li>
							  <div class="inputGroup custom-control shareincidentform">
							    <input type="checkbox" id='${suboption.id}' name="option${data["question"]["id"]}" class="custom-control-input" value="${suboption.id}" data-parentid="${suboption.parent_id}" data-ismain="${suboption.is_main}" data-val="${suboption.title}" data-hasSuboptions="false" data-showtextbox="false" ${isSuboptionSelected?"checked":""} >
							    <label class="custom-control-label label1" for="${suboption.id}">${suboption.title}</label>
							  </div>
							</li>`;
						}
					} else {
						if(suboption.title!=null){
						elementHtml += `
							<li>
		                      <div class="inputGroup custom-control shareincidentform">
		                        <input type="radio" id='${suboption.id}' name="suboption${option.id}" class="custom-control-input suboption-radio" value="${suboption.id}"  data-val="${suboption.title}" ${isSuboptionSelected?"checked":""}>
		                        <label class="custom-control-label label1" for="${suboption.id}">${suboption.title}</label>
		                      </div>
		                    </li>`;
						}
					}
				});

				elementHtml += `</ul>`;
			}
			if(!hasSuboptions){
				elementHtml += `</div>`;
			}else{
				elementHtml += `</div>`;
			}
				
		});
		elementHtml += `</div>`;
		$("#options").html(elementHtml);

		$("#options input[type=checkbox]").click(function(event) {
			
			// Handle other textbox toggle
			var optionid = $(this).attr('id');
			if($(this).data('showtextbox')==true) {
				if($(this).is(':checked')) {
					$("input[name=option"+optionid+"textbox]").removeClass('d-none');				
				} else {
					$("input[name=option"+optionid+"textbox]").addClass('d-none');
					$("input[name=option"+optionid+"textbox]+.validdation_text").remove();
				}
			}

			// Handle suboptions toggle
			if($(this).data('hassuboptions')==true) {
				//$("#dynamicNext").attr("disabled", "disabled");
				if($(this).is(':checked')) {
					$("#suboption-container-"+optionid).fadeIn('slow');
				} else {
					$("#suboption-container-"+optionid).fadeOut('slow');
					// Uncheck all suboptions
					$("#suboption-container-"+optionid+" input[type=checkbox]").prop('checked', false);
					$("#suboption-container-"+optionid+" input[type=radio]").prop('checked', false);
				}
			}

			// Run Validation
			validate(optionid);

		});

		// Run validation on suboption radio click
		$(".suboption-container input[type=radio]").click(function(event) {
			validate(null);
		});

		// Run Validation on textbox
		$("#options input[type=text]").keyup(function(event) {
			validate(null);
		});

		// Add new event listener
		$("#dynamicNext").off('click').click(function(event) {
			event.preventDefault();
			var is_valid = validate(null);
			if(is_valid)
				nextClick();
		});
	}

})();
