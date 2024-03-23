$(function () {
	var language_text = 'English';
	var language_sf   = "EN";
	var language_val  = "English";

	// Hide all blocks at start
	if (country_id == 0) $("#cityblock").hide();
	// Skipping organization selection
	// until we onboard a client
	/*if (city_id == 0) $("#organizationradioblock").hide();
	$("#oraganisationblock").hide();
	$("#languageblock").hide();*/

	// Remove this when we get a client
	if (city_id == 0) {
		$("#languageblock").hide();
	} else {
		setLanguages();
	}
	$("input[name=is_organization]#customRadio2").prop('checked', true)
	$("#organizationradioblock").hide();
	$("#oraganisationblock").hide();

	// On organization change
	$("input[name=is_organization]").click(function (event) {
		var is_organization = $("input[name=is_organization]:checked").val();
		if (
			is_organization == "1" &&
			$("#oraganisationblock").css("display") == "none"
		) {
			hideLanguageBlock();
			disableProceedButton();
			$("#oraganisationblock").show();
		} else if (
			is_organization == "0" &&
			($("#oraganisationblock").css("display") != "none" ||
				$("#languageblock").css("display") == "none")
		) {
			client_id = 1;
			hideOrganizationBlock();
			hideLanguageBlock();
			disableProceedButton();
			$("#languageblock").show();
			setLanguages();
		}
	});

	function setLanguages() {
		var pathname = window.location.pathname;
		$.ajax({
			url: baseUrl + "api/get-languages-autocomplete",
			type: 'POST',
			dataType: 'json',
			data: {client_id: client_id},
		})
		.done(function(data) {
			var html = '<option value="">Select Language</option>';
			if (data.status == true) {
				$("#autocomplete-language-id").empty();
				data.data.forEach(function(language) {
					html += '<option data-shortname="'+language.short_name+'" data-nativename="'+language.native_name+'" value="'+language.id+'">'+language.name+'</option>';
				});
			}
			$("#autocomplete-language-id").html(html);
			$("#autocomplete-language-id").select2({
				placeholder: "Select a language"
			});
			if(pathname=='/brazilonboarding'){
				$('select').val('89').trigger('change');
				$("#language_id").val(89);
				$.cookie("language_id", 89);
				$.cookie("lang_id", 89);
				$.cookie("language", 'Portuguese');
				$.cookie("languageSF", 'pt');
				$.cookie("language_val", 'Portuguese');
				enableProceedButton();
			}
		})
		.fail(function() {
			console.log("error");
			$("#autocomplete-language-id").html('');
			if(pathname=='/brazilonboarding'){
				$('select').val('89').trigger('change');
				$("#language_id").val(89);
				$.cookie("language_id", 89);
				$.cookie("lang_id", 89);
				$.cookie("language", 'Portuguese');
				$.cookie("languageSF", 'pt');
				$.cookie("language_val", 'Portuguese');
			}
			$("#autocomplete-language-id").select2({
				placeholder: "Select a language"
			});
		})
		.always(function() {
			console.log("complete");
		});
	}

	$(document).on('change', '#autocomplete-language-id', function(event) {
		event.preventDefault(); 
		var pathname = window.location.pathname;
		console.log(pathname);
		if(pathname=='/brazilonboarding'){
			language_id = 89;
			$.cookie("language_val", 'Portuguese');
		}else{
			language_id = $(this).val();
		}
		$("#language_id").val(language_id);
		if(language_id!='') {
			var selectedData = $(this).select2('data');
			var $selectedElem = $("#autocomplete-language-id option:selected");
			if(selectedData!=null) {
				language_text = selectedData[0].text;
				language_sf   = $selectedElem.data('shortname');
				language_val  = $selectedElem.data('nativename');
			} else {
				language_text = 'English';
				language_sf   = 'EN';
				language_val  = 'English';
			}
			enableProceedButton();
		}
		else
			disableProceedButton();
	});

	$("#org_done").click(function (event) {
		event.preventDefault();
		// Reset passcode error message
		$("#varification_code").siblings(".text-danger").html("");
		var verification_code = $("#varification_code").val();
		// Check for code validity
		$.ajax({
			url: baseUrl + "api/organization/verify-passcode",
			type: "POST",
			data: { id: organization_id, passcode: verification_code },
		})
			.done(function (response) {
				console.log("success");
				if (response.is_valid) {
					$("#org_varification").modal("hide");
					$("#languageblock").show();
					setLanguages();
				} else {
					// Set passcode error message
					$("#varification_code")
						.siblings(".text-danger")
						.html(code_error); //code changes by sonam - 29-10-2020
				}
			})
			.fail(function () {
				console.log("error");
			})
			.always(function () {
				console.log("complete");
			});
	});

	/** On submit/complete */
	$("#proceed_btn").click(function (event) {
		event.preventDefault();
		if (client_id > 0 && language_id > 0) {
			var country = $("#autocomplete-country").val();
			var city    = $("#autocomplete-city").val();
			$.cookie("country", country);
			$.cookie("country_id", country_id);
			$.cookie("city", city);
			$.cookie("city_id", city_id);
			$.cookie("client_id", client_id);
			$.cookie("lang_id", language_id);
			$.cookie("language_id", language_id);
			$.cookie("language", language_text);
			$.cookie("languageSF", language_sf);
			$.cookie("language_val", language_val);
			var ngo_id= $("#ngo_id").val();
			$.cookie("ngo_id", ngo_id);

			// Reset Form
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

			// Get latitude/longitude
			var geocoder =  new google.maps.Geocoder();
			geocoder.geocode( { 'address': city+', '+country}, function(results, status) {
			  if (status == google.maps.GeocoderStatus.OK) {
			      	$.cookie('lat', results[0].geometry.location.lat());
			      	$.cookie('lng', results[0].geometry.location.lng());
			      	// if(ngo_id !='0'){
			      		// window.location.href = baseUrl + "ngo";
			      	// }else{
			      		// window.location.href = baseUrl + "shareIncident";
			      	// }
					
					if(ngo_id !='0'){
						window.location.href = baseUrl + "ngo";
					}else{
						if(country_id=='111'){
							window.location.href = baseUrl + "Welcome";
						}else{
							window.location.href = baseUrl + "shareIncident";
						}
					}
					
			  } else {
			    	console.log('failed to get lat lng with status', status);
					// if(ngo_id !='0'){
			      		// window.location.href = baseUrl + "ngo";
			      	// }else{
			      		// window.location.href = baseUrl + "shareIncident";
			      	// }
					
					if(ngo_id !='0'){
						window.location.href = baseUrl + "ngo";
					}else{
						if(country_id=='111'){
							window.location.href = baseUrl + "Welcome";
						}else{
							window.location.href = baseUrl + "shareIncident";
						}
					}
			  }
			});
		} else {
			alert("Please select all fields properly to proceed!");
		}
	});

	/** Autocompletes */
	$("#autocomplete-country").typeahead({
		autoSelect: true,
		highlight: true,
		hint: true,
		displayText: function (item) {
			return item.country_name;
		},
		afterSelect: function (item) {
			this.$element[0].value = item.country_name;
			country_id = item.country_id;
			$("#country_id").val(item.country_id);
			// Reset Corresponding UI
			hideCityBlock();
			$("#cityblock").show();
			hideIsOrganizationBlock();
			hideOrganizationBlock();
			hideLanguageBlock();
			disableProceedButton();
		},
		source: function (query, process) {
			$.ajax({
				url: baseUrl + "home/getCountryAutocomplete",
				data: { query: query },
				dataType: "json",
				type: "POST",
				success: function (data) {
					process(data);
				},
			});
		},
	});

	$("#autocomplete-country").change(function(event) {
		console.log('in country changed');
		var current = $(this).typeahead("getActive");
		console.log(current);
		if(!current || current.country_name!=$(this).val()) {
			// Nothing is active so it is a new value (or maybe empty value)
			hideCityBlock();
			hideIsOrganizationBlock();
			hideOrganizationBlock();
			hideLanguageBlock();
			disableProceedButton();
		}
	});

	$("#autocomplete-city").typeahead({
		autoSelect: true,
		highlight: true,
		hint: true,
		displayText: function (item) {
			return item.city_name;
		},
		afterSelect: function (item) {
			console.log('fired!');
			this.$element[0].value = item.city_name;
			$("#city_id").val(item.id);
			city_id = item.id;
			client_id = item.client_id;
			//added ngo
			ngo_id=item.ngo_id;
			$("#ngo_id").val(item.ngo_id);
			// Reset Corresponding UI
			hideIsOrganizationBlock();
			hideOrganizationBlock();
			hideLanguageBlock();
			disableProceedButton();

			// Skipping organization selection
			// until we onboard a client
			//$("#organizationradioblock").show();
			$("#languageblock").show();
			setLanguages();
		},
		source: function (query, process) {
			$.ajax({
				url: baseUrl + "api/get-cities-autocomplete",
				data: { query: query, country_id: country_id },
				dataType: "json",
				type: "POST",
				success: function (data) {
					if (data.status == true) process(data.data);
					else process([]);
				},
			});
		},
	});

	$("#autocomplete-city").change(function(event) {
		var current = $(this).typeahead("getActive");
		if(!current || current.city_name!=$(this).val()) {
			// Nothing is active so it is a new value (or maybe empty value)
			hideIsOrganizationBlock();
			hideOrganizationBlock();
			hideLanguageBlock();
			disableProceedButton();
		}
	});

	$("#autocomplete-organization").typeahead({
		autoSelect: true,
		highlight: true,
		hint: true,
		displayText: function (item) {
			return item.name;
		},
		afterSelect: function (item) {
			this.$element[0].value = item.name;
			$("#organization_id").val(item.id);
			organization_id = item.id;
			client_id = item.client_id;
			// Reset Corresponding UI
			hideLanguageBlock();
			disableProceedButton();
			if (item.has_passcode == "1") { 
				$("#org_varification").modal("show");
			}
			else {
				$("#languageblock").show();
				setLanguages();
			}
		},
		source: function (query, process) {
			$.ajax({
				url: baseUrl + "api/get-organizations-autocomplete",
				data: {
					query: query,
					country_id: country_id,
					city_id: city_id,
				},
				dataType: "json",
				type: "POST",
				success: function (data) {
					if (data.status == true) process(data.data);
					else process([]);
				},
			});
		},
	});

	$("#autocomplete-language").typeahead({
		autoSelect: true,
		highlight: true,
		hint: true,
		displayText: function (item) {
			return item.name;
		},
		afterSelect: function (item) {
			this.$element[0].value = item.name;
			$("#language_id").val(item.id);
			language_id = item.id;
			enableProceedButton();
		},
		source: function (query, process) {
			$.ajax({
				url: baseUrl + "api/get-languages-autocomplete",
				data: { query: query, client_id: client_id },
				dataType: "json",
				type: "POST",
				success: function (data) {
					if (data.status == true) process(data.data);
					else process([]);
				},
			});
		},
	});

	/** Set Visibilities */
	function hideCityBlock() {
		city_id = 0;
		client_id = 1;
		$("#cityblock").hide();
		$("#autocomplete-city").val("");
		$("#city_id").val("");
	}

	function hideIsOrganizationBlock() {
		$("#organizationradioblock").hide();
		$("input[name=is_organization]").prop("checked", false);
	}

	function hideOrganizationBlock() {
		organization_id = 0;
		$("#oraganisationblock").hide();
		$("#autocomplete-organization").val("");
		$("#organization_id").val("");
	}

	function hideLanguageBlock() {
		language_id = 0;
		$("#languageblock").hide();
		$("#autocomplete-language").val("");
		$("#language_id").val("");
	}

	function enableProceedButton() {
		$("#proceed_btn").addClass("purple-btn");
		$("#proceed_btn").removeAttr("disabled");
	}

	function disableProceedButton() {
		$("#proceed_btn").removeClass("purple-btn");
		$("#proceed_btn").attr("disabled", "disabled");
	}
});
