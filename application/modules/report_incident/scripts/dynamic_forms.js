var incident_id = 0;
var currentQuestion = "";
var currentParentKey = 0;
var currentTreeOptions = [];
var selectedAnswers = [];
var dynamicQuestionJson = [];
var currentForm = 0;
var dependedQuestionsAnswers = {};
var isThankYouPage = false;
var totalQuestions = 0;
var totalParentAnswers = 0;

$(document).ready(function () {

	$("#dynamicNext").attr("disabled", "disabled");

	// On page refresh start from where user left
	fetchState();

	$("#dynamicBack").click(function (event) {
		event.preventDefault();
		$("#dynamicNext").removeAttr("disabled");

		if (selectedAnswers.length == 0) {
			if(top.location.pathname.includes('shareIncident-form')) {
				// Redirect back to actual previous page
				window.location.href = baseURL + "shareIncident";
			} else {
				// Page is loaded in iframe for admin
				top.location.href = baseURL+"admin/incidents";
			}
		} else {
			// Back to previous question

			// Get previous question back
			var lastQuestion = selectedAnswers.pop();
			if(clientForms[currentForm].type=='primary' || currentParentKey!=lastQuestion.currentQuestion.currentParentKey) {
				console.log('reducing progress -1');
				// Update answer
				totalParentAnswers--;
				setProgress();
			}

			currentParentKey =
				lastQuestion.currentQuestion.currentParentKey;
			currentTreeOptions =
				lastQuestion.currentQuestion.currentTreeOptions;

			// Has form changed to previous form?
			if(currentForm!=lastQuestion.currentQuestion.currentForm) {
				console.log('form changed!');
				currentForm = lastQuestion.currentQuestion.currentForm;
				setFormDynamicQuestion(clientForms[currentForm], function() {
					// Show the previous question
					getDynamicQuestions(
						lastQuestion.currentQuestion.id,
						lastQuestion
					);
				});
			} else {
				// Show the previous question
				getDynamicQuestions(
					lastQuestion.currentQuestion.id,
					lastQuestion
				);
			}


		}
	});
        
        //ngo selection
        $("body").on('click', '#suboption-container-642 .dynamic-radio-suboption', function(){
            var ngoId = $(this).attr('id');
            
            $('#options [data-val="An NGO"]').val(ngoId);
        });

});

/** Progress Bar */
function calculateTotalQuestions() {
	totalQuestions = 0;
	for (var i = 0; i < clientForms.length; i++) {
		if(clientForms[i].type=='primary')
			totalQuestions += JSON.parse(clientForms[i].question_ids_json).length;
		else if(clientForms[i].type=='logic') {
			console.log('calculate Total Questions:');
			console.log(clientForms[i].estimate_question);
			totalQuestions += clientForms[i].estimate_question || 0;
		}
		if(clientForms[i].is_submit==true)
			break;
	}
	console.log(totalQuestions);
	setProgress();
}

function setProgress() {
	var progressPercent = totalParentAnswers/totalQuestions*100;
	$(".progress-bar").css("width", Math.round(progressPercent) + "%");
	var lang_id 	= $.cookie('language_id') || 1;
	if(lang_id==43){
		$(".progress-text").text(Math.round(progressPercent) + "% Dovršeno");
	}else{
		$(".progress-text").text(Math.round(progressPercent) + "% Completed");	
	}
	
}
/** Progress Bar END */

/** State Management */
function fetchState() {
	if(localStorage.getItem("selectedAnswers")!=undefined) {
		selectedAnswers = JSON.parse(localStorage.getItem("selectedAnswers"));
		if(selectedAnswers.length>0) {
			console.log('setting state back');
			clientForms = JSON.parse(localStorage.getItem("clientForms"));
			dynamicQuestionOptionJson = JSON.parse(localStorage.getItem("dynamicQuestionOptionJson"));
			incident_id = parseInt(localStorage.getItem("incident_id"));
			currentQuestion = JSON.parse(localStorage.getItem("currentQuestion"));
			currentParentKey = parseInt(localStorage.getItem("currentParentKey"));
			currentTreeOptions = JSON.parse(localStorage.getItem("currentTreeOptions"));
			dynamicQuestionJson = JSON.parse(localStorage.getItem("dynamicQuestionJson"));
			currentForm = parseInt(localStorage.getItem("currentForm"));
			dependedQuestionsAnswers = JSON.parse(localStorage.getItem("dependedQuestionsAnswers"));
			totalQuestions = parseInt(localStorage.getItem("totalQuestions"));
			totalParentAnswers = parseInt(localStorage.getItem("totalParentAnswers"));
			isThankYouPage = localStorage.getItem('isThankYouPage')=="true"?true:false;
		}
	}

	// Set Total Questions Count
	calculateTotalQuestions();

	if(selectedAnswers.length==0) {
		intiateForm();
	}
	else if(isThankYouPage) {
		onFormSaved(clientForms[currentForm]);
	}
	else {
		getDynamicQuestions(currentQuestion.id, null);
	}
}

function saveStateLocally() {
	// Save data to localstorage
	localStorage.setItem("clientForms", JSON.stringify(clientForms));
	localStorage.setItem("dynamicQuestionOptionJson", JSON.stringify(dynamicQuestionOptionJson));
	localStorage.setItem("incident_id", incident_id);
	localStorage.setItem("currentQuestion", JSON.stringify(currentQuestion));
	localStorage.setItem("currentParentKey", currentParentKey);
	localStorage.setItem("currentTreeOptions", JSON.stringify(currentTreeOptions));
	localStorage.setItem("selectedAnswers", JSON.stringify(selectedAnswers));
	localStorage.setItem("dynamicQuestionJson", JSON.stringify(dynamicQuestionJson));
	localStorage.setItem("currentForm", currentForm);
	localStorage.setItem("dependedQuestionsAnswers", JSON.stringify(dependedQuestionsAnswers));
	localStorage.setItem("totalQuestions", totalQuestions);
	localStorage.setItem("totalParentAnswers", totalParentAnswers);
}

function resetState() {
	localStorage.removeItem("clientForms");
	localStorage.removeItem("dynamicQuestionOptionJson");
	localStorage.removeItem("incident_id");
	localStorage.removeItem("currentQuestion");
	localStorage.removeItem("currentParentKey");
	localStorage.removeItem("currentTreeOptions");
	localStorage.removeItem("selectedAnswers");
	localStorage.removeItem("dynamicQuestionJson");
	localStorage.removeItem("currentForm");
	localStorage.removeItem("dependedQuestionsAnswers");
	localStorage.removeItem("totalQuestions");
	localStorage.removeItem("totalParentAnswers");
	localStorage.removeItem("isThankYouPage");
}
/* State Management End */

function showNextForm() {
	if(clientForms[currentForm+1]!=undefined) {
		currentForm++;
		console.log('moving forward to form '+currentForm);
		intiateForm();
	} else {
		console.log("The END!");
	}
}

function intiateForm() {
	var form = clientForms[currentForm];
	setFormDynamicQuestion(form, function() {
		// Reset counters
		currentParentKey = 0;
		if(dynamicQuestionJson.length>0) {
			currentTreeOptions  = dynamicQuestionJson[0]["on_option_id"];

			getDynamicQuestions(dynamicQuestionJson[0].question_id, null);
		} else {
			// To Fix 125% error
			// In this case there is no logical question for selection
			// but showNextParentQuestion was called which increased total answer count
			// and it will get called again does increasing answer count by 2 inplace of 1.
			totalParentAnswers--;
			showNextParentQuestion();
		}
	});
}

function setFormDynamicQuestion(form, callback) {
	if(form.type=="logic") {
		// figure out the actual answer to use to get the logical questions
		var logicDetails = JSON.parse(form.question_ids_json);
		var dependant_question_id = logicDetails.dependant_question_id;
		var answer_type = logicDetails.answer_type;
		if(answer_type=="main") {
			var dependent_answers = dependedQuestionsAnswers[dependant_question_id]["main_answers"];
		} else if (answer_type=="parent") {
			var dependent_answers = dependedQuestionsAnswers[dependant_question_id]["parent_answers"];
		} else {
			// answer_type = "actual"
			var dependent_answers = dependedQuestionsAnswers[dependant_question_id]["answers"];
		}

		// make a ajax call to get combination json data
		$.ajax({
			url: baseURL+'api/get-logical-questions',
			type: 'POST',
			data: {
				form_id: form.id, 
				question_id:dependant_question_id, 
				ans_ids: dependent_answers, 
				lang_id: lang_id,
				country_id: country_id
			},
		})
		.done(function(data) {
			console.log("success");
			//var parsedData = JSON.parse(data);
			var parsedData = data;
			dynamicQuestionJson = parsedData.comb_json;

			// Update Progress based on newly added questions
			//totalQuestions += dynamicQuestionJson.length;
			console.log('add '+dynamicQuestionJson.length+' questions');
			clientForms[currentForm].estimate_question = dynamicQuestionJson.length;
			console.log('estimate questions:', )
			calculateTotalQuestions();
			//setProgress();

			var relatedquestions = Object.values(parsedData.questions);
			// Update questin options
			relatedquestions.forEach(function(questionObj) {
				dynamicQuestionOptionJson[questionObj.question.id] = questionObj;
			});
			callback();
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});

		// When data was already available
		/*var parsedJSON = JSON.parse(form.question_ids_json);
		if(parsedJSON[dependent_answers]!=undefined) {
			dynamicQuestionJson = parsedJSON[dependent_answers];
			console.log(dynamicQuestionJson);
		} else {
			dynamicQuestionJson = [];
		}*/
	} else {
		dynamicQuestionJson = JSON.parse(form.question_ids_json);
		callback();
	}
}

function showNextParentQuestion() {
	// We update progress only for answer to parent questions
	totalParentAnswers++;
	setProgress();
console.log(dynamicQuestionJson[currentParentKey + 1]);
	if (dynamicQuestionJson[currentParentKey + 1] != undefined) {
		var nextParent = dynamicQuestionJson[++currentParentKey];
		currentTreeOptions = nextParent["on_option_id"];
		console.log(nextParent["question_id"]);
		getDynamicQuestions(nextParent["question_id"], null);
	} else {
		// dynamicQuestionJson recursion completed
		// Check if form needs to be submitted
		var thisForm = clientForms[currentForm];
		if(thisForm.is_submit==true) {
			// Submit the form and get back id
			console.log("answer");

			var lang_id 	= $.cookie('lang_id') || 1;
			var client_id 	= $.cookie('client_id') || 1;
			$.ajax({
				url: baseURL+'api/save-incident',
				type: 'POST',
				data: {
					answers_json: JSON.stringify(selectedAnswers),
					incident_id: incident_id,
					lang_id:lang_id,
					country_id:country_id,
					client_id: client_id
				},
			})
			.done(function(data) {
				console.log("success");
                                //var parsedData = JSON.parse(data);
				var parsedData = data;
				console.log(parsedData);
				if(parsedData.success==true) {
					incident_id = parsedData.incident_id;
					onFormSaved(thisForm);
				} else {
					alert('Something went wrong!');
				}
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
		} else {
			// continue with the form recursion
			showNextForm();
		}
	}
}

function getDynamicQuestions(questionId, lastQuestion) { 
	console.log('questionId : '+questionId);
	console.log(dynamicQuestionOptionJson);
	var parsedData = dynamicQuestionOptionJson[questionId];
	currentQuestion = parsedData["question"];
	currentQuestion.currentParentKey = currentParentKey;
	currentQuestion.currentForm = currentForm;

	// Set question and subtext
	$("#question_span").html(currentQuestion.question);
	$("#subtext_span").html(currentQuestion.subtext);

	createDynamicElement(parsedData, lastQuestion);

	saveStateLocally();
}

function createDynamicElement(data, lastQuestion) {
	var properties = JSON.parse(data.question.properties);
	switch (properties.type) {
		case "radio":
			radioField(data, lastQuestion);
			break;

		case "text":
			textField(data, properties, lastQuestion);
			break;

		case "estimate-datepicker":
			estimateDatePickerField(data, lastQuestion);
			break;

		case "estimate-time-or-rangepicker":
			estimateTimeRangePickerField(data, lastQuestion);
			break;

		case "checkbox":
			checkboxField(data, lastQuestion);
			break;

		case "incident-address-form":
			addressFormField(data, properties, lastQuestion);
			break;

		case "incident-pin-map":
			locationPinMapField(data, lastQuestion);
			break;

		default:
			radioField(data, lastQuestion);
			break;
	}
}

function saveCurrentAnswer(answer_id, answerJson) {
	// Append form type to answer
	console.log(currentForm);
	console.log(clientForms);
	answerJson.form_type = clientForms[currentForm].name;

	// Disable next button
	$("#dynamicNext").attr("disabled", "disabled");

	// Save the questions and answers
	if (currentTreeOptions.length == 0) {
		currentQuestion.currentTreeOptions = [];
	} else {
		currentQuestion.currentTreeOptions = currentTreeOptions;
	}
	currentQuestion.answerJson = answerJson;
	selectedAnswers.push({ currentQuestion });

	// Show Next Questions
	if (currentTreeOptions.length == 0) {
		// Goto next parent if exists
		showNextParentQuestion();

	} else {
		// Continue parsing the tree
		for (var i = 0; i < currentTreeOptions.length; i++) {
			var option = currentTreeOptions[i];
			console.log(option.id, answer_id);
			if (option.id==undefined || option.id == answer_id) {
				currentTreeOptions = option["on_option_id"];
				console.log('get question '+ option["question_id"]);
				getDynamicQuestions(option["question_id"], null);
				break;
			}
			// Last loop
			if (i == currentTreeOptions.length - 1) {
				// None of the option matches the condition
				// Continue to next parent if exists.
				showNextParentQuestion();
			}
		}
	}
}

function onFormSaved(thisForm) {
	// Reset the variables to disable back
	clientForms.splice(0, currentForm+1);
	currentForm=-1;
	currentQuestion = "";
	currentParentKey = 0;
	currentTreeOptions = [];
	selectedAnswers = [];
	dynamicQuestionJson = {};
	totalParentAnswers = 0;
console.log(thisForm);
	if(thisForm.thank_you_web!=null) {
		// Set Thank You page to fix issues on reload
		localStorage.setItem("isThankYouPage", true);
		var thankyouJson = JSON.parse(thisForm.thank_you_web);
		$(".dynamic-success-title").html(thankyouJson.title);
		$(".dynamic-success-content").html(thankyouJson.content);
		var links = '';
		var redirect_url = "";
		thankyouJson.links.forEach(function(link) {
			if(link.is_next)
				links += '<a href="#" class="btn w-75 btn_p_white mb-4 dynamic-thankyou-next d-block ml-auto mr-auto">'+link.title+'</a>';
			else {
				redirect_url = link.redirect_url!=undefined?baseURL+link.redirect_url:'#';
				links += '<a href="#" class="btn w-75 btn_purple dynamic-thankyou-end d-block ml-auto mr-auto">'+link.title+'</a>';
			}
		});
		$(".dynamic-success-link").html(links);

		// Show thank you div
		$(".questionaire").hide();
		$(".thankyou-section").show();

		$(".dynamic-thankyou-next").click(function(event) {
			event.preventDefault();

			// Reset progress counter
			calculateTotalQuestions();

			showNextForm();

			// Hide thank you div
			$(".thankyou-section").hide();
			$(".questionaire").show();

			localStorage.setItem("isThankYouPage", false);
		});

		$(".dynamic-thankyou-end").click(function(event) {
			event.preventDefault();
			resetState();
			if(top.location.pathname.includes('shareIncident-form')) {
				window.location.href = redirect_url+'?inc='+incident_id;
			} else {
				// Page is loaded in iframe for admin
				top.location.href = baseURL+"admin/incidents";
			}
		});
	} else {
		// continue with the form recursion
		showNextForm();
	}
}