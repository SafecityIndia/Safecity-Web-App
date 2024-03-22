$(function() {

    //////////////////
    // Date Filters //
    //////////////////

    $('.input-daterange').datepicker({
        format: 'yyyy/mm/dd',
        clearBtn: true
    });

    $(".calendar-icon").click(function(event) {
        console.log('')
        $(this).siblings('input').datepicker().focus();
    });

    ////////////////
    // DataTables //
    ////////////////
    var status_filter = 'pending_approval';
    var start_date_filter = end_date_filter = '';
    var search_term = "";
    var selected_recordId_arr = [];

    // Reset Filter
    function resetFilter() {
        start_date_filter = end_date_filter = search_term = '';
        $("#search_filter").val("");
        $("#datepickerstart_filter, #datepickerend_filter").datepicker('update', '');
        // Reset bulk selections
        resetBulkSelection();
        // Refresh DataTable
        reloadDataTable(false);
    }

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
                                    url: baseURL+"admin/safety-tips/datatable",
                                    type: "POST",
                                    data: function (d) {
                                        d.status      = status_filter;
                                        d.start_date  = start_date_filter;
                                        d.end_date    = end_date_filter;
                                        d.search_term = search_term;
                                    }
                                },
                                columns: [
                                    {
                                        className: 'checklist text-center',
                                        render: function(data, type, row, meta) {
                                            var isSelected = selected_recordId_arr.indexOf(parseInt(row.id))>-1;
                                            return `<span class="custom-checkbox">
                                                        <input type="checkbox" class="record-checkbox" data-reportid="${row.id}" id="row${row.id}" ${isSelected?'checked':''}>
                                                        <label for="row${row.id}"></label>
                                                    </span>`;
                                        },
                                    },
                                    {
                                        className: 'report-id showSplitView',
                                        data: 'id',
                                        name:'id',
                                        render: function(data, type, row, meta) {
                                            var title   = '<div>'+row.safety_tip_title+'<div>';
                                            var address    = '<div class="table-fs-light">'+row.landmark+', '+row.city+', '+row.state+', '+row.country+'</div>';
                                            return title+''+address;
                                        },
                                        visible: false
                                    },
                                    {
                                        className: 'action',
                                        data: 'id',
                                        name:'id',
                                        render: function(data, type, row, meta) {
                                            var postedBy = '<div class="table-fs-light">'+row.posted_by+'</div>';
                                            var report_date = getReportDateTimeHtml(data, type, row, meta);
                                            var actionHtml = getActionHtml(data, type, row, meta);
                                            return postedBy+''+report_date+''+actionHtml;
                                        },
                                        visible: false
                                    },
                                    {
                                        className: 'category showSplitView',
                                        data: 'safety_tip_title',
                                        name:'safety_tip_title'
                                    },
                                    {
                                        className: 'location table-fs-light',
                                        data: 'id',
                                        name:'id',
                                        render: function(data, type, row, meta) {
                                            return row.landmark+', '+row.city+', '+row.state+', '+row.country;
                                        }
                                    },
                                    {
                                        className: 'posted-by table-fs-light',
                                        data: 'posted_by',
                                        name:'posted_by'
                                    },
                                    {
                                        className: 'date table-fs-light',
                                        name:'id',
                                        render: getReportDateTimeHtml
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
        var html = `<div class="action--btn">`;
        if(row.status=='trashed')
            html += `<button class="btn text-red pl-0 action-update-status" data-status="delete" data-reportid="${row.id}">Delete forever</button>`;
        if(row.status!='trashed' && row.status!='pending_approval')
            html += `<button class="btn text-red pl-0 action-update-status" data-status="trashed" data-reportid="${row.id}">Trash</button>`;
        if(row.status!='rejected' && row.status!='trashed')
            html += `<button class="btn text-red action-update-status" data-status="rejected" data-reportid="${row.id}">Reject</button>`;
        if(row.status!='saved')
            html += `<button class="btn text-grey action-update-status" data-status="saved" data-reportid="${row.id}">Save</button>`;
        if(row.status!='approved' && row.status!='published')
            html += `<button class="btn text-primary action-update-status" data-status="approved" data-reportid="${row.id}">Approve</button>`;
        if(row.status!='published')
            html += `<button class="btn text-primary action-update-status" data-status="published" data-reportid="${row.id}">Publish</button>`;
        html += `</div>`;
        return html;
    }

    function getReportDateTimeHtml(data, type, row, meta) {
        var date = moment(row.added_date).format('DD MMM YYYY');
        return `<div class="table-fs-light">${date}</div>`;
    }

    // Filter by status
    $(".status-filter").click(function(event) {
        $(".status-filter.active").removeClass('active');
        $(this).addClass('active');
        status_filter = $(this).data('status');
        // Reset bulk selections
        resetBulkSelection();
        // Refresh DataTable
        reloadDataTable(false);
    });

    // Clear filters
    $("#clear-filters").click(function(event) {
        resetFilter();
    });

    // Filter by DateRange
    $("#datepickerstart_filter, #datepickerend_filter").change(function(event) {
        if($(this).val()=='') {
            $("#datepickerstart_filter, #datepickerend_filter").val('');
            start_date_filter = '';
            end_date_filter = '';
        } else {
            start_date_filter = $("#datepickerstart_filter").val()+' 00:00:00';
            end_date_filter = $("#datepickerend_filter").val()+' 23:59:59';
        }
        // Refresh DataTable
        reloadDataTable(false);
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
        dataTableInstance.columns([3,4,5,6,7]).visible(true);
        dataTableInstance.columns([1,2]).visible(false);
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
        dataTableInstance.columns([3,4,5,6,7]).visible(false);
        dataTableInstance.columns([1,2]).visible(true);
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
            url: baseURL+'/admin/safety-tips/update-status',
            type: 'POST',
            data: {report_id: report_id, status: status},
        })
        .done(function(data) {
            console.log("success");
            if(data.status==true) {

                var changed_count = 1;
                if(typeof report_id!="number") {
                    // Was bulk action
                    changed_count = report_id.length;
                    selected_recordId_arr = [];
                    // Reset bulk selections
                    resetBulkSelection();
                } else {
                    // Remove updated record from bulk action if exists
                    updateToBulk(report_id, 'remove');

                    // Fetch details
                    if(!$("#detail_container").hasClass('d-none') && report_id==selectedReportId)
                        fetchReportDetail(report_id);
                }

                // Update DataTable
                reloadDataTable(true);

                // Update the counts
                if(status!='delete') {
                    var $statusTab = $(".status-filter[data-status="+status+"]");
                    var prev_count = $statusTab.data('count');
                    $statusTab.find('.number-tags').text(prev_count+changed_count);
                    $statusTab.data('count', prev_count+changed_count);
                }

                // Reduce current status count
                var $activeStatusTab = $(".status-filter.active");
                var prev_count = $activeStatusTab.data('count');
                $activeStatusTab.find('.number-tags').text(prev_count-changed_count);
                $activeStatusTab.data('count', prev_count-changed_count);
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
            url: baseURL+'api/safety-tip/details',
            type: 'POST',
            data: {safety_tip_id: selectedReportId},
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
    var map = marker = null;

    function initializeDetailMap(latitude, longitude) {
        // Set the latitude & longitude for our location (London Eye)
        var myLatlng = new google.maps.LatLng(latitude, longitude);
        var mapOptions = {
            center: myLatlng, // Set our point as the centre location
            zoom: 14, // Set the zoom level
        };

        // Display a map on the page
        map = new google.maps.Map(document.getElementById("detail_map"), mapOptions);

        // Add a marker to the map based on our coordinates
        marker = new google.maps.Marker({
            position: myLatlng,
            map: map
        });
    }

    function updateMarker(latitude, longitude) {
        var location = new google.maps.LatLng(latitude, longitude);
        marker.setPosition(location);
        map.setCenter(location);
    }

    function setDetailActionButtons(status) {
        console.log('set deatail buttons for status', status);
        var actionHtml = '';
        if(status=='trashed')
            actionHtml += `<button data-status="delete" data-reportid="${selectedReportId}" class="btn fs-17 text-red pl-0 detail-button action-update-status">Delete Forever</button>`;
        if(status!='trashed' && status!='pending_approval')
            actionHtml += `<button data-status="trashed" data-reportid="${selectedReportId}" class="btn fs-17 text-red pl-0 detail-button action-update-status">Trash</button>`;
        if(status!='rejected' && status!='trashed')
            actionHtml += `<button data-status="rejected" data-reportid="${selectedReportId}" class="btn fs-17 text-red pl-0 detail-button action-update-status">Reject</button>`;
        if(status!='saved')
            actionHtml += `<button data-status="saved" data-reportid="${selectedReportId}" class="btn fs-17 text-red pl-0 detail-button action-update-status">Save</button>`;
        actionHtml += `<button class="btn fs-17 text-grey pl-0 detail-button" id="editField">Edit</button>`;
        actionHtml += `<button class="btn fs-17 text-grey pl-0 edit-button" id="saveChanges">Save</button>`;
        if(status!='approved' && status!='published')
            actionHtml += `<button data-status="approved" data-reportid="${selectedReportId}" class="btn fs-17 text-primary pl-0 detail-button action-update-status">Approve</button>`;
        if(status!='published')
            actionHtml += `<button data-status="published" data-reportid="${selectedReportId}" class="btn btn btn-primary fs-17 detail-button action-update-status">Publish</button>`;
        $("#detail_actions").html(actionHtml);
    }

    function setDetailData(reportData) {
        // Set Incident Map
        if(map==null && google) {
            initializeDetailMap(reportData.latitude, reportData.longitude);
        } else {
            updateMarker(reportData.latitude, reportData.longitude);
        }

        // Set Action buttons
        setDetailActionButtons(reportData.status);

        var answers = reportData.answers;

        // Set Detail Data
        //$("#datail_id").text("#"+reportData.id);
        $("#detail_category_title").text(reportData.safety_tip_title);
        $("#detail_created_by").text(reportData.posted_by);
        $("#detail_description").text(reportData.safety_tip_desc);
        // Address
        //$("#detail_locality").val(reportData.building);
        //$("#detail_landmark").val(reportData.landmark);
        //$("#detail_city").val(reportData.city);
        //$("#detail_state").val(reportData.state);
        //$("#detail_country").val(reportData.country);
        $("#detail_address").val(reportData.landmark+', '+reportData.city+', '+reportData.state+', '+reportData.country);
    }

    // Code by Arham
    function setDetailViewHeight() {
        var scrollHeight = $(".dataTables_scrollBody").height() -45;
        $(".table-open__content").css("height", scrollHeight);
    }

    /////////////////////
    // Update Incident //
    /////////////////////
    function showEdit() {

        // Init Edit Map
        console.log('initiating map');
        editaddressForm.initMap();

        $("#edit_div").show();
        $(".edit-field__content").hide();

        // Toggle buttons
        $(".detail-button").hide();
        $(".edit-button").show();

    	// Update Text
    	$(".table-open__header--title").text('Edit Safety tip');
    	$(".posted__title").hide();
    }

    function hideEdit() {
        $("#edit_div").hide();
        $(".edit-field__content").show();

        // Toggle Buttons
        $(".detail-button").show();
        $(".edit-button").hide();

        // Update Text
        $(".table-open__header--title").text('View Safety tip');
        $(".posted__title").show();
    }

    $(document).on('click', '#saveChanges', function(event) {
        event.preventDefault();
        if(!recordEditForm.valid()) {
        	alert('Please fix all validation before porceeding!');
            return false;
        }
        console.log('form is valid! Yeah!');
        var answersObj = recordEditForm.getAnswers();
        answersObj.report_id = selectedReportId;
        console.log(answersObj);

        // Send Update Request
       	var api_endpoint = selectedReportId!=0?'admin/safety-tips/update':'admin/safety-tips/create';
        $.ajax({
            url: baseURL+api_endpoint,
            type: 'POST',
            data: answersObj,
        })
        .done(function(data) {
            console.log("success");
            console.log(data);
            if(data.status==true) {
                fetchReportDetail(data.report_id);
            } else {
                alert(data.message);
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
    // Add New Incident //
    //////////////////////

    function showAdd() {

    	// Init Edit Map
    	editaddressForm.initMap();

    	$("#edit_div").show();
    	$(".edit-field__content").hide();

        // Set Buttons
        setDetailActionButtons('add');

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
        	"location_city_state":"",
        	"location":"",
        	"landmark":"",
        	"city":"",
        	"state":"",
        	"country":"",
        	"exact_location":"",
        	"map_lat":"",
        	"map_lon":"",
        	"safety_tip_title":"",
        	"safety_tip_desc":"",
        	"latitude":"",
        	"longitude":"",
        };
        recordEditForm.init(reportData);

        selectedReportId = 0;

        // Remove title
        $(".table-open__header--title").text('Create Safety tip');
        $(".posted__title").hide();

        showAdd();
    });

    ////////////////////
    // Export Records //
    ////////////////////
    $("#exportRecordBtn").click(function(event) {
    	event.preventDefault();
    	var $modalId = $('#exportRecordModal');
    	$modalId.find('.invalid-msg').text('');
    	$modalId.modal('show');
    });

    function validateExport() {
    	var err_msg = '';

    	// Validate Status selection
    	if($('#exportRecordModal').find('input[type=checkbox]:checked').length==0)
    		err_msg += '<li>Please select atleast one status to export</li>';

		// Validate Valid Date
    	var export_from = $("#datepickerstart_export").val();
    	var export_to   = $("#datepickerend_export").val();
    	if(export_from=='' || export_to=='') {
    		err_msg += '<li>Please select valid range to export!</li>';
    	}
    	else {
    		var start = moment(export_from);
    		var end   = moment(export_to);
    		var day_diff = end.diff(start, 'days');
    		if(day_diff<0)
    			err_msg += '<li>Please select valid date range!</li>';
    		else if(day_diff>30)
    			err_msg += '<li>Date Range diff should not exceed 30 days!</li>';
    	}
    	$('#exportRecordModal').find('.invalid-msg').html(err_msg);
    	if(err_msg!='')
    		$("#exportBtn").attr('disabled', 'disabled');
    	else
    		$("#exportBtn").removeAttr('disabled');
    	return err_msg;
    }

    $("#exportRecordModal input[type=text],#exportRecordModal input[type=checkbox] ").change(function(event) {
    	validateExport();
    });

    $("#exportBtn").click(function(event) {
    	$exportModal = $('#exportRecordModal');
    	$exportModal.find('.invalid-msg').text('');

    	// Filter by Status
    	var statuses = '';
    	$exportModal.find('input[type=checkbox]:checked').each(function(index, el) {
    		statuses += statuses==''?$(el).val():','+$(el).val();
    	});

    	// Filter by Date Range
    	var export_from = $("#datepickerstart_export").val();
    	var export_to   = $("#datepickerend_export").val();

    	// Trigger Download
    	if(validateExport()=='') {
    		window.open(baseURL+'admin/safety-tips/export?statuses='+statuses+'&start='+export_from+'&end='+export_to, '_blank');
    		$exportModal.find('input[type=checkbox]').prop('checked', false);
    		$("#datepickerstart_export").val('');
    		$("#datepickerend_export").val('');
    		$exportModal.modal('hide');
    	}
    });

    ////////////////////
    // Import Records //
    ////////////////////

    $("#download_sample_import_file").click(function(event) {
        window.open(baseURL+'admin/safety-tips/get-import-csv', '_blank');
    });

    $("#importRecordBtn").click(function(event) {
    	event.preventDefault();
    	$("#importFile").trigger('click');
    });

    $("#importFile").change(function(event) {
    	$("#importRecordForm").submit();
    });

});