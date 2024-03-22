var recordEditForm = (function () {
	var recordData = {};

	function preInit() {
		$("#all_access").click(function(event) {
			$("#available_permissions").hide();
		});

		$("#restricted_access").click(function(event) {
			$("#available_permissions").show();
		});

		$("#trigger_fileupload").click(function(event) {
			event.preventDefault();
			$("#upload_avatar").click();
		});

		//////////////////
		// Image upload //
		//////////////////
		$("#upload_avatar").change(function(event) {
		    $img = $(this).parent().find('img');
		    readURL(this, function(base64str) {
		       $img.attr('src', base64str);
		    });
		});
	}

	function init(recordData) {
		recordData = recordData;
		if(recordData.id!=0) {
			$("#password_label").text('Password (leave blank to keep unchanged)');
			$("#edit_password").attr('data-required', false);
		}
		else {
			$("#password_label").text('Password');
			$("#edit_password").attr('data-required', true);
		}
		// Set Data
		$("#edit_name").text(recordData.first_name+' '+recordData.last_name);
		$("#edit_first_name").val(recordData.first_name);
		$("#edit_last_name").val(recordData.last_name);
		$("#edit_username").val(recordData.username);
		$("#edit_email").val(recordData.email);
		if(recordData.avatar!='' && recordData.avatar!=null)
			$("#edit_user_avatar").attr('src', baseURL+'assets/uploads/admin_avatars/'+recordData.avatar);
		else
            $("#detail_avatar").attr('src', baseURL+'assets/admin/images/profile.jpg');

		// Set Roles
		$("#restricted_access").click();
		var userRoles = recordData.roles;
		for (var i = 0; i < userRoles.length; i++) {
			if(userRoles[i].name=='superadmin') {
				$("#all_access").click();
				break;
			}
		}
		var selectedRole = $("input[type=radio][name=role]:checked").val();
		// Set Permissions
		$("#available_permissions input[type=checkbox]").prop('checked', false);
		if(selectedRole=='admin') {
			var userPermissions = Object.values(recordData.permissions);
			for (var i = 0; i < userPermissions.length; i++) {
				var permission = userPermissions[i];
				if(permission.value)
					$("#"+permission.key).prop('checked', true);
			}
		}

		// Make password required for add user
		if(recordData.id==0)
			$("#edit_div input[type=password]").attr('data-required', true);

		// Reset Dirty state
		$("#edit_div input[data-required=true]").attr('isdirty', false);

		// Initialize Events
		initializeEvents();
	}

	function initializeEvents() {

		/////////////////////////////////
		// Check validations on events //
		/////////////////////////////////
		$("#edit_div input[data-required=true]").keyup(function (event) {
			if($(this).data('isdirty'))
				validateAnswers();
			$(this).attr('data-isdirty', true);
		});
	}

	function getAnswers() {
		return {
			'report_id': 	recordData.id,
			'avatar': 		$("#upload_avatar").get(0).files[0],
			'first_name': 	$("#edit_first_name").val(),
			'last_name': 	$("#edit_last_name").val(),
			'username': 	$("#edit_username").val(),
			'email': 		$("#edit_email").val(),
			'password': 	$("#edit_password").val(),
			'role': 		$("input[type=radio][name=role]:checked").val(),
			'role_id':      $("input[type=radio][name=role]:checked").data('roleid'),
			'permissions':  $("#available_permissions input[type=checkbox]:checked").map((index, elem) => $(elem).val()).get().join(',')
		};
	}

	function validateAnswers() {
		// Reset validations
		$(".is-invalid").removeClass("is-invalid");
		$(".invalid-msg").text("");

		var isValid = true;
		$("#edit_div input[data-required=true][data-isdirty=true]").each(function (index, el) {
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
		preInit: preInit,
		init: function (incidentData) {
			init(incidentData);
		},
		valid: function () {
			$("#edit_div input[data-required=true]").attr('data-isdirty', true);
			return validateAnswers();
		},
		getAnswers: function () {
			return getAnswers();
		},
	};

})();
