var recordEditForm = (function () {
	var questionsObj = {};

	function init(recordData) {
		var formHTML = renderHTML(recordData);

		$("#edit_div").html(formHTML);
		console.log("set div!");

		// Initialize Events
		initializeEvents();
	}

	function renderHTML(recordData) {
		var formHTML = "";
		formHTML += `
			<div class="newedit">
                <label>Title</label>
            	<input type="text" id="edittitle" class="form-control parent-option-field" value="${recordData.safety_tip_title}"  data-required="true" />
				<div class="invalid-msg text-danger"></div>
			</div>
			<div class="newedit">
                <label>Description</label>
            	<input type="text" id="editdescription" class="form-control parent-option-field" value="${recordData.safety_tip_desc}" data-required="true" />
				<div class="invalid-msg text-danger"></div>
			</div>
		`;

		mapHTML = editaddressForm.init(
					recordData.latitude,
					recordData.longitude,
					recordData.building || '',
					recordData.landmark || '',
					recordData.location || '',
					recordData.city,
					recordData.state,
					recordData.country
				);

		formHTML += mapHTML;
		return formHTML;
	}

	function initializeEvents() {

		/////////////////////////////////
		// Check validations on events //
		/////////////////////////////////
		$("#edit_div [type=text]").keyup(function (event) {
			validateAnswers();
		});
	}

	function getAnswers() {
		var address = editaddressForm.getAddress();
		return {
			'title': 	 	$("#edittitle").val(),
			'description':  $("#editdescription").val(),
			'building': address.building, 	
			'landmark': address.landmark,
			'area': address.area,
			'city': address.city,
			'state': address.state,
			'country': address.country,
			'latitude': address.latitude,
			'longitude': address.longitude,
		};
	}

	function validateAnswers() {
		// Reset validations
		$(".is-invalid").removeClass("is-invalid");
		$(".invalid-msg").text("");

		var isValid = true;
		$("#edit_div [type=text][data-required=true]").each(function (index, el) {
			if ($(el).val().trim() == "") {
				$(el).addClass("is-invalid");
				$(el).parent().find('.invalid-msg').text("This Field is Required");
				isValid = false;
			} else {
				$(el).removeClass("is-invalid");
				$(el).parent().find('.invalid-msg').text("");
			}
		});

		return isValid;
	}

	return {
		init: function (incidentData) {
			init(incidentData);
		},
		valid: function () {
			return validateAnswers();
		},
		getAnswers: function () {
			return getAnswers();
		},
	};
})();
