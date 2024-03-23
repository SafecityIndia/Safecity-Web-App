$(function() {

   $("#new_language").hide();

    ////////////////
    // DataTables //
    ////////////////
    var language_id_filter = country_id_filter = gender_filter = '';
    var selected_recordId_arr = [];

    // Reset Filter
    function resetFilter() {
        gender_filter  = '';
        language_id_filter  = '';
        country_id_filter   = '';
        $("#gender_filter").val("").trigger('change.select2');
        $("#language_filter").val("").trigger('change.select2');
        $("#country_filter").val("").trigger('change.select2');
        // Refresh DataTable
        reloadDataTable(false);
    }
	
	 // Clear filters
    $("#clear-filters").click(function(event) {
		$("#new_language").hide();
		$('.modal').modal('hide');
		$('.modal-backdrop').modal('hide');
		$("div").removeClass("modal-backdrop");
        resetFilter();
    });
	
    // Initialize datatable
    var dataTableInstance = $('#myTable').DataTable({
                                lengthChange: false,
                                scrollResize: true,
                                searching: false,
                                //autoWidth: true,
                                //paging: false,
                                //info: false,
                                //scrollY: "100%",
                                scrollY: 500,
                                scrollCollapse: true,
                                processing: true,
                                serverSide: true,
                                rowId: 'id',
                                ajax: {
                                    url: baseURL+"admin/helplines/datatable",
                                    type: "POST",
                                    data: function (d) {
                                        d.gender    = gender_filter;
                                        d.lang_id    = language_id_filter;
                                        d.country_id = country_id_filter;
                                    }
                                },
                                columns: [
                                    
                                    {
                                        className: 'table-fs-light showSplitView',
										data: 'emergency_title',
                                        name:'emergency_title',
                                    },
                                    {
                                        className: 'location table-fs-light',
                                        data: 'emergency_no',
                                        name:'emergency_no',
                                    },
                                    {
                                        className: 'table-fs-light',
                                        data: 'country',
                                        name:'country'
                                    },
                                    {
                                        className: 'table-fs-light',
                                        name:'language',
                                        data: 'language'
                                    },
									 {
                                        className: 'table-fs-light',
                                        name:'gender',
                                        data: 'gender'
                                    },
									 {
                                        className: 'table-fs-light',
                                        name:'category',
                                        data: 'category'
                                    },
                                    {
                                        className: 'action',
                                        render: getActionHtml
                                    },
                                ],
                                createdRow: function(row, data, index) {
                                    if(data.id==selectedReportId) {
                                        $(row).find('tr').addClass('newhighlight');
                                    }
                                },
                                deferRender: true
                              });

    function reloadDataTable(preservePage) {
        if(!preservePage)
            dataTableInstance.ajax.reload();
        else {
            console.log('resetting without page change');
            // don't reset the current page
            dataTableInstance.ajax.reload(null, false)
        }
    }

    // Datatable Row Rendering Helper
    function getActionHtml(data, type, row, meta) {
        var html = `<div class="action--btn justify-content-start">`;
        html += `<button class="btn text-red pl-0 action-update-status" data-status="delete" data-reportid="${row.id}">Remove</button>`;
        html += `</div>`;
        return html;
    }

    function getReportDateTimeHtml(data, type, row, meta) {
        var date = moment(row.added_date).format('DD MMM YYYY');
        return `<div class="table-fs-light">${date}</div>`;
    }

	// Filter by Gender
    $("#gender_filter").change(function(event) {
        gender_filter = $(this).val();
        // Refresh DataTable
        reloadDataTable(false);
    });

	 // Filter by Language
    $("#language_filter").change(function(event) {
        language_id_filter = $(this).val();
		
		if(language_id_filter != ''){
			getCategory(language_id_filter,country_id_filter);
		}
		
        // Refresh DataTable
        reloadDataTable(false);
    });
	
	$("#language_id").change(function(event) {
        language_id = $(this).val();
		
		if(language_id != ''){
			getCategory(language_id,country_id_filter);
		}
    });

    // Filter by Country
    $("#country_filter").change(function(event) {
        country_id_filter = $(this).val();
		console.log($("#country_filter option:selected").text());
		$('.modal-title').html('Add New Helpline For - '+$("#country_filter option:selected").text());
		if(country_id_filter != ''){
			$("#new_language").show();
			getLanguage(country_id_filter);
		}
        // Refresh DataTable
        reloadDataTable(false);
    });
	
	function getCategory(lang_id,country_id) {
        $.ajax({
            url: baseURL+'admin/helplines/getCategory',
            method: 'POST',
            data: {country_id: country_id,language: lang_id}
        })
        .done(function(data) {
            console.log("success");
            console.log(data);
            if(data.success) {
				$("#category_id").html(data.data);
            } else {
                // things went wrong!
            }
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
    }
	
	function getLanguage(country_id) {
        $.ajax({
            url: baseURL+'admin/helplines/get-language-details',
            method: 'POST',
            data: {country_id: country_id}
        })
        .done(function(data) {
            console.log("success");
            console.log(data);
            if(data.success) {
				$("#language_id").html(data.data);
				
            } else {
                // things went wrong!
            }
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
    }

    // Clear filters
    $("#clear-filters").click(function(event) {
        resetFilter();
    });

    // Search
    $("#search_filter").keydown(function(event) {
        search_term = $(this).val();
        // Refresh DataTable
        reloadDataTable(false);
    });

    // Handle Datatable Actions
    $(document).on('click', '.hideSplitView', function(event) {
        event.preventDefault();
        console.log('hide split view!');
        $("#detail_container").addClass('d-none');
        $("#table_container").removeClass('col-47 pr-0').addClass('col-12');
        dataTableInstance.columns([2,3,4,5,6]).visible(true);
        dataTableInstance.columns([0,1]).visible(false);
        dataTableInstance.columns.adjust();
    });

    $(document).on('click', '.action-update-status', function(event) {
        event.preventDefault();
        var status = $(this).data('status');
        var id = $(this).data('reportid');
        updateStatus(id, status);
    });

    $(document).on('click', '.showSplitView', function(event) {
        event.preventDefault();
        // Add active highlight
        $('.newhighlight').removeClass('newhighlight');
        $(this).parent('tr').addClass('newhighlight');

        // Fetch selected record's id
        var id = dataTableInstance.row(this).id();

        // Fetch details
        fetchReportDetail(id);
    });

    function enableSplitView() {
        $("#table_container").removeClass('col-12').addClass('col-47 pr-0');
        $("#detail_container").removeClass('d-none');
        setDetailViewHeight();
        dataTableInstance.columns([2,3,4,5,6]).visible(false);
        dataTableInstance.columns([0,1]).visible(true);
        dataTableInstance.columns.adjust();
    }

    //////////////////
    // Bulk Actions //
    //////////////////

    $(".select-all-record").change(function(event) {
    	event.preventDefault();
    	var isChecked = $(this).is(':checked');
		$(".record-checkbox").each(function(index, el) {
			var id = $(el).data('reportid');
			$(el).prop('checked', isChecked);
			if(isChecked)
				updateToBulk(id, 'add');
			else
				updateToBulk(id, 'remove');
		});
		$(".select-all-record").prop('checked', isChecked);
    });

    $(document).on('change', '.record-checkbox', function(event) {
        event.preventDefault();
        var id = $(this).data('reportid');
        if($(this).is(':checked')) {
            updateToBulk(id, 'add');
        } else {
            updateToBulk(id, 'remove');
        }
    });

    /**
     * Add/Remove record id to/from bulk actions
     * @param  {Integer} id
     * @param  {String}  action add/remove
     * @return undefined
     */
    function updateToBulk(id, action) {
        var index = selected_recordId_arr.indexOf(id);
        if(action=='add') {
            // Add only if not already added
            if(index<0)
                selected_recordId_arr.push(id);
        } else {
            // Remove if already exists
            if (index > -1)
              selected_recordId_arr.splice(index, 1);
        }
        // Toggle Bulk action header
        toggleBulkActionHeader();
    }

    function toggleBulkActionHeader() {
        if(selected_recordId_arr.length>0) {
            $("#bulkaction-container").show();
            $("#bulkselected").text(selected_recordId_arr.length);
            var actionHtml = '<button class="btn fs-17 text-grey pl-0 bulk-download" >Download</button>';
            actionHtml += $(".action--btn:first").html();
            $(".bulkactionbtn-container").html(actionHtml);
            $(".bulkactionbtn-container .action-update-status").removeClass('action-update-status').addClass('bulkaction-update-status');
        } else {
            $("#bulkaction-container").hide();
            $("#bulkselected").text(0);
        }
    }

    function resetBulkSelection() {
        selected_recordId_arr = [];
        // Toggle Bulk action header
        toggleBulkActionHeader();
    }

    $(document).on('click', '.bulkaction-update-status', function(event) {
        event.preventDefault();
        var status = $(this).data('status');
        updateStatus(selected_recordId_arr, status);
    });

    $(document).on('click', '.bulk-download', function(event) {
    	event.preventDefault();
    	var record_ids = selected_recordId_arr.join(',');
    	window.open(baseURL+'admin/safety-tips/export?record_ids='+record_ids, '_blank');
    });

    /**
     * Update statuses of incidents
     * @param  {Array|Integer} report_id
     * @param  {String}        status
     * @return undefined
     */
    function updateStatus(report_id, status) {
        $.ajax({
            url: baseURL+'/admin/user-profiles/delete',
            type: 'POST',
            data: {id: report_id, status: status},
        })
        .done(function(data) {
            console.log("success");
            if(data.status==true) {
                // Update DataTable
                reloadDataTable(true);
                $(".hideSplitView").click();
            }
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
    }

    //////////////////////
    // Incident Details //
    //////////////////////

    var selectedReportId = 0;
    function fetchReportDetail(reportId) {
        selectedReportId = reportId;
        $.ajax({
            url: baseURL+'admin/user-profiles/get-details',
            type: 'POST',
            data: {id: selectedReportId},
        })
        .done(function(data) {
            console.log("success");
            console.log(data);
            if(data.status) {
                reportData = data.data;

                // Set Details
                setDetailData(reportData);

                // Set Edit form
                hideEdit();
                recordEditForm.init(reportData);

                // Change to SPlit view
                enableSplitView();
            } else {
                // things went wrong!
            }
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
    }

    // Set map
    function setDetailActionButtons() {
        var actionHtml = '';
        actionHtml += `<button class="btn text-red pl-0 detail-button action-update-status" data-status="delete" data-reportid="${selectedReportId}">Remove</button>`;
        actionHtml += `<button class="btn fs-17 text-grey pl-0 detail-button" id="editField">Edit</button>`;
        actionHtml += `<button class="btn fs-17 text-grey pl-0 edit-button" id="saveChanges">Save</button>`;
        $("#detail_actions").html(actionHtml);
    }

    function setDetailData(reportData) {
        // Set Action buttons
        setDetailActionButtons();

        // Set Detail Data
        //$("#datail_id").text("#"+reportData.id);
        $("#detail_name").text(reportData.first_name+' '+reportData.last_name);
        $("#detail_username").val(reportData.username);
        $("#detail_email").val(reportData.email);
        var permissionArr = Object.values(reportData.permissions);
        var permissions = permissionArr.map(function(permission) {
            return permission.name;
        }).join(', ');
        $("#detail_permission").val(permissions);
        if(reportData.avatar!='' && reportData.avatar!=null)
            $("#detail_avatar").attr('src', baseURL+'assets/uploads/admin_avatars/'+reportData.avatar);
        else
            $("#detail_avatar").attr('src', baseURL+'assets/admin/images/profile.jpg');
    }

    // Code by Arham
    function setDetailViewHeight() {
        var scrollHeight = $(".dataTables_scrollBody").height() -45;
        $(".table-open__content").css("height", scrollHeight);
    }

    /////////////////////
    // Update User     //
    /////////////////////

    // Configure Edit page
    recordEditForm.preInit();

    function showEdit() {

        $("#edit_div").show();
        $("#show_div").hide();
        //$(".edit-field__content").hide();

        // Toggle buttons
        $(".detail-button").hide();
        $(".edit-button").show();

    	// Update Text
    	$(".table-open__header--title").text('Edit User');
    }

    function hideEdit() {
        $("#show_div").show();
        $("#edit_div").hide();
        //$(".edit-field__content").show();

        // Toggle Buttons
        $(".detail-button").show();
        $(".edit-button").hide();

        // Update Text
        $(".table-open__header--title").text('View User');
    }

    $(document).on('click', '#saveChanges', function(event) {
        event.preventDefault();
        if(!recordEditForm.valid()) {
            toastr.error('Please fill all the required fields before proceeding!');
        	//alert('Please fill all the required fields before proceeding!');
            return false;
        }
        console.log('form is valid! Yeah!');
        var answersObj = recordEditForm.getAnswers();
        answersObj.id = selectedReportId;
        console.log(answersObj);

        // Create formData to upload with image
        var data = new FormData();
        var answerArr = Object.entries(answersObj);
        answerArr.forEach(function(answer) {
            data.append(answer[0], answer[1]);
        });

        // Send Update Request
        var api_endpoint = selectedReportId!=0?'admin/user-profiles/update':'admin/user-profiles/create';
        $.ajax({
            url: baseURL+api_endpoint,
            type: 'POST',
            contentType: false,
            processData: false,
            data: data,
        })
        .done(function(data) {
            console.log("success");
            console.log(data);
            if(data.status==true) {
                fetchReportDetail(data.id);
            } else {
                var error_message = data.message;
                if(data.errors) {
                    data.errors.forEach(function(error) {
                        error_message += '\n'+error;
                    });
                }
                toastr.error(error_message);
                //alert(error_message);
            }
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
        /* Act on the event */
    });

    $(document).on('click', '#editField', function(event) {
        event.preventDefault();
        // Show edit form
        showEdit();
    });

    //////////////////////
    // Add New User     //
    //////////////////////

    function showAdd() {

        $("#edit_div").show();
        $("#show_div").hide();

        // Set Buttons
        setDetailActionButtons();

        // Toggle buttons
        $(".detail-button").hide();
        $(".edit-button").show();

        // Show Split view
        enableSplitView();
    }

    $("#create-new-button").click(function(event) {
        event.preventDefault();
        // Set Edit form
        hideEdit();
        var reportData = {
            "id": 0,
            "first_name":"",
            "last_name":"",
            "username":"",
            "email":"",
            "roles": "admin",
            "permissions": {}
        };
        recordEditForm.init(reportData);

        selectedReportId = 0;

        // Remove title
        $(".table-open__header--title").text('Add User');
        //$(".posted__title").hide();

        showAdd();
    });

});