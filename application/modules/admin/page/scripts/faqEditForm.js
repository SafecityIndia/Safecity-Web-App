var faqEditForm = (function () {
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
							<h4>${recordData[0].type.toUpperCase().replaceAll('_', ' ')}</h4>
							<div class="row">
								<div class="col-md-3">
									<div class="edit-field__contentone">
										<div class="label fs-17">Location</div>
										<div id="detail_description" disabled="">
											${recordData[0].country}
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="edit-field__contentone">
										<div class="label fs-17">Language</div>
										<div id="detail_description" disabled="">
											${recordData[0].language}
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="edit-field__contentone">
										<div class="label fs-17">Date Modified</div>
										<div id="detail_description">${recordData[0].updated_on.split(' ')[0]}</div>
									</div>
								</div>

								<div class="col-md-3">
									<div class="edit-field__contentone">
										<div class="label fs-17">Date Added</div>
										<div id="detail_description">${recordData[0].created_on.split(' ')[0]}</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="legalarea">
										<h2>${recordData[0].resource_title}</h2> 
										<div class="row">
											<div class="col-12">
												<div class="form-group">
													<div class="label fs-15">Page Title</div>
													<input type="text" id="edittitle" class="form-control" value="${recordData[0].resource_title}"></div>
												</div>
											</div>
											<div class="resources_container">`;
											for (var i = 0; i < recordData.length; i++) {
												var record = recordData[i];
												formHTML += `
													<div class="legalsection recordList">
														<div class="legalsectionhead">
															<h3>Category ${i+1}</h3>
															<a class="deleteRecord" href="#">Delete</a>
														</div>

														<div class="border-left--input">
															<div class="row">
																<div class="col-12">
																	<div class="form-group">
																		<div class="label fs-15">
																			Category
																		</div>
																		<input
																			type="text"
																			class="form-control"
																			value="${record.title.trim()}"
																			data-required="true"
																		/>
																		<div class="invalid-msg text-danger"></div>
																	</div>
																</div>
																<div class="col-12">
																	<div class="form-group">
																		<div class="label fs-15">
																			Information
																		</div>
																		<textarea
																			type="text"
																			class="form-control is-rich-text"
																			id="richeditor${i+1}"
																			data-required="true"
																		/>
																		${record.content}
																		</textarea>
																		<div class="invalid-msg text-danger"></div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												`;	
											}
		formHTML += `
											</div>
											<a class="newadd addRecord">
												<i class="fas fa-plus"></i> Add Category
											</a>
										</div>
									</div>
								</div>
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
		initRichTextEditor();

		///////////////////
		// Record Delete //
		///////////////////
		
		$(document).on('click', '.deleteRecord', function(event) {
			event.preventDefault();
			$(this).closest('.recordList').remove();

			// Reset Record Counter
			resetCategoryNumber();
		});

		$(".addRecord").click(function(event) {
			event.preventDefault();

			var recordHtml = `
				<div class="legalsection recordList">
					<div class="legalsectionhead">
						<h3>Category </h3>
						<a class="deleteRecord" href="#">Delete</a>
					</div>

					<div class="border-left--input">
						<div class="row">
							<div class="col-12">
								<div class="form-group">
									<div class="label fs-15">
										Category
									</div>
									<input
										type="text"
										class="form-control"
										value=""
										data-required="true"
									>
									<div class="invalid-msg text-danger"></div>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group">
									<div class="label fs-15">
										Information
									</div>
									<textarea
										type="text"
										class="form-control is-rich-text"
										data-required="true"
									/>
									</textarea>
									<div class="invalid-msg text-danger"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			`;
			// Add new record to div
			$(".resources_container").append(recordHtml);

			// Reset Record Counter
			resetCategoryNumber();
		});

		/////////////////////////////////
		// Check validations on events //
		/////////////////////////////////
		$("#edit_div [type=text]").keyup(function (event) {
			validateAnswers();
		});
	}

	// Helper Functions
	function initRichTextEditor() {
		if (tinymce.activeEditor != null) {
			tinyMCE.remove("#edit_div textarea");
		}
		tinymce.init({
			// Set Base url for links
			relative_urls : false,
			remove_script_host : false,
			document_base_url : baseURL,
			// Links Baseurl end
			selector: "#edit_div textarea",
			plugins: "image code media link lists",
			//media_dimensions: false,
			//media_filter_html: false,
			media_live_embeds: true,
			extended_valid_elements:
				"video[controlslist|controls|width|height|poster]",
			video_template_callback: function (data) {
				return (
					'<video width="' +
					data.width +
					'" height="' +
					data.height +
					'"' +
					(data.poster ? ' poster="' + data.poster + '"' : "") +
					' controls="controls" controlslist="nodownload">\n' +
					'<source src="' +
					data.source1 +
					'"' +
					(data.source1mime
						? ' type="' + data.source1mime + '"'
						: "") +
					" />\n" +
					(data.source2
						? '<source src="' +
						  data.source2 +
						  '"' +
						  (data.source2mime
								? ' type="' + data.source2mime + '"'
								: "") +
						  " />\n"
						: "") +
					"</video>"
				);
			},
			images_upload_url: baseURL + "admin/pages/upload-image",
			menubar: false,
			toolbar:
				"undo redo | styleselect | bold underline lineheight | link image media | align  | backcolor forecolor | numlist bullist | code",
		});
	}

	function resetCategoryNumber() {
		var i = 1;
		$(".recordList").each(function(index, el) {
			$(el).find('.legalsectionhead h3').text('Category '+i);
			$(el).find('.is-rich-text').attr('id', 'richeditor'+i);
			i++;
		});

		// Assign Rich text editor
		initRichTextEditor();
	}

	function getAnswers() {
		var records =  $(".recordList").map(function(index, elem) {
			return {
				'title': $(elem).find('input[type=text]').val(),
				'content': tinyMCE.get($(elem).find('.is-rich-text').attr('id')).getContent()
			};
		});
		return {
			title: $("#edittitle").val(),
			records: records.get()
		};
	}

	function validateAnswers() {
		// Reset validations
		$(".is-invalid").removeClass("is-invalid");
		$(".invalid-msg").text("");

		var isValid = true;
		$("#edit_div [type=text][data-required=true], #edit_div textarea[data-required=true]").each(function (index, el) {
			var updatedVal = $(el).hasClass('is-rich-text') ? tinyMCE.get($(el).attr('id')).getContent():$(el).val();
			if (updatedVal.trim() == "") {
				$(el).addClass("is-invalid");
				$(el).parent().find('.invalid-msg').text("This Field is Required");
				isValid = false;
			} else {
				$(el).removeClass("is-invalid");
				$(el).parent().find('.invalid-msg').text("");
			}
		});

		if($(".is-invalid:first").hasClass('is-rich-text')) {
			tinyMCE.get($(".is-invalid:first").attr('id')).focus();
			$(".is-invalid:first").focus();
		} else {
			$(".is-invalid:first").focus();
		}


		/*var updatedVal = tinyMCE.get("editdescription").getContent();
		if (updatedVal.trim() == "") {
			$("editdescription").addClass("is-invalid");
			$("editdescription")
				.parent()
				.find(".invalid-msg")
				.text("This Field is Required");
			isValid = false;
		} else {
			$("editdescription").removeClass("is-invalid");
			$("editdescription").parent().find(".invalid-msg").text("");
		}*/

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
