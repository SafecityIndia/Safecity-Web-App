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
		console.log(recordData);
		var formHTML = "";
		formHTML += `
			<div class="row">
				<div class="col-md-12">
					<div class="editlegal">
						<h4>${recordData.type.toUpperCase().replaceAll('_', ' ')}</h4>
						<div class="row">
							<div class="col-md-3">
								<div class="edit-field__contentone">
									<div class="label fs-17">Location</div>
									<div id="detail_description" disabled="">
										${recordData.country}
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="edit-field__contentone">
									<div class="label fs-17">Language</div>
									<div id="detail_description" disabled="">
										${recordData.language}
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="edit-field__contentone">
									<div class="label fs-17">Date Modified</div>
									<div id="detail_description">${recordData.updated_on.split(' ')[0]}</div>
								</div>
							</div>

							<div class="col-md-3">
								<div class="edit-field__contentone">
									<div class="label fs-17">Date Added</div>
									<div id="detail_description">${recordData.created_on.split(' ')[0]}</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="legalarea">
									<input type="hidden" id="report_id" value="${recordData.content_id}">
									<div class="newedit">
						                <label>Title</label>
						            	<input type="text" id="edittitle" class="form-control parent-option-field" value="${recordData.title}"  data-required="true" />
										<div class="invalid-msg text-danger"></div>
									</div>
									<div class="newedit">
						                <label>Content</label>
						                <textarea id="editdescription" class="form-control parent-option-field" data-required="true">${recordData.content}</textarea>
										<div class="invalid-msg text-danger"></div>
									</div>
								</div>
							</div>
						</div>
		`;

		return formHTML;
	}

	function initializeEvents() {

		/////////////////////////////////
		// Initialize Rich text editor //
		/////////////////////////////////
		if(tinymce.activeEditor!=null) {
			tinyMCE.remove('#edit_div textarea');
		}
		tinymce.init({
			// Set Base url for links
			relative_urls : false,
			remove_script_host : false,
			document_base_url : baseURL,
			// Links Baseurl end
			selector:'#edit_div textarea',
			plugins: 'image code media link',
			//media_dimensions: false,
			//media_filter_html: false,
			media_live_embeds: true,
			extended_valid_elements: 'video[controlslist|controls|width|height|poster]',
			video_template_callback: function(data) {
			   return '<video width="' + data.width + '" height="' + data.height + '"' + (data.poster ? ' poster="' + data.poster + '"' : '') + ' controls="controls" controlslist="nodownload">\n' + '<source src="' + data.source1 + '"' + (data.source1mime ? ' type="' + data.source1mime + '"' : '') + ' />\n' + (data.source2 ? '<source src="' + data.source2 + '"' + (data.source2mime ? ' type="' + data.source2mime + '"' : '') + ' />\n' : '') + '</video>';
			},
			images_upload_url: baseURL+'admin/pages/upload-image',
			menubar: false,
			//forced_root_block : 'div',
			force_br_newlines : true,
			toolbar: 'undo redo | styleselect | bold underline lineheight | link image media | align  | backcolor forecolor | numlist bullist | code'
		});

		/////////////////////////////////
		// Check validations on events //
		/////////////////////////////////
		$("#edit_div [type=text]").keyup(function (event) {
			validateAnswers();
		});
	}

	function getAnswers() {
		return {
			'title': 	$("#edittitle").val(),
			'content':  tinyMCE.get('editdescription').getContent(),
			'report_id': $("#report_id").val()
		};
	}

	function validateAnswers() {
		// Reset validations
		$(".is-invalid").removeClass("is-invalid");
		$(".invalid-msg").text("");

		var isValid = true;
		/*$("#edit_div [type=text][data-required=true], #edit_div textarea[data-required=true]").each(function (index, el) {
			var updatedVal = $(el).attr('id')=='editdescription' ? tinyMCE.get('editdescription').getContent():$(el).val();
			if (updatedVal.trim() == "") {
				$(el).addClass("is-invalid");
				$(el).parent().find('.invalid-msg').text("This Field is Required");
				isValid = false;
			} else {
				$(el).removeClass("is-invalid");
				$(el).parent().find('.invalid-msg').text("");
			}
		});*/

		var updatedVal = tinyMCE.get('editdescription').getContent();
		if (updatedVal.trim() == "") {
			$("editdescription").addClass("is-invalid");
			$("editdescription").parent().find('.invalid-msg').text("This Field is Required");
			isValid = false;
		} else {
			$("editdescription").removeClass("is-invalid");
			$("editdescription").parent().find('.invalid-msg').text("");
		}

		return isValid;
	}

	return {
		init: function (recordData) {
			init(recordData);
		},
		valid: function () {
			return validateAnswers();
		},
		getAnswers: function () {
			return getAnswers();
		},
	};
})();
