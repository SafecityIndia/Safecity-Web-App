$(function() {

    ////////////////
    // DataTables //
    ////////////////
    var language_id_filter = country_id_filter = '';
    var selected_recordId_arr = [];

    // Reset Filter
    function resetFilter() {
        language_id_filter  = '';
        country_id_filter   = '';
        $("#language_filter").val("").trigger('change.select2');
        $("#country_filter").val("").trigger('change.select2');
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
                                    url: baseURL+"admin/pages/datatable",
                                    type: "POST",
                                    data: function (d) {
                                        d.lang_id    = language_id_filter;
                                        d.country_id = country_id_filter;
                                    }
                                },
                                columns: [
                                    {
                                        className: 'report-id showSplitView',
                                        data: 'id',
                                        name:'id',
                                        render: function(data, type, row, meta) {
                                            var title   = '<div>'+row.type+'<div>';
                                            var lang   = '<div class="table-fs-light">'+row.lang_name+'<div>';
                                            var updated_by = '<div>'+row.updated_by+'</div>';
                                            return title+lang+updated_by;
                                        },
                                        visible: false
                                    },
                                    {
                                        className: 'action showSplitView',
                                        data: 'id',
                                        name:'id',
                                        render: function(data, type, row, meta) {
                                            var last_updated_on = '<div class="table-fs-light">'+row.updated_on+'</div>';
                                            var added_on = '<div class="table-fs-light">'+row.created_on+'</div>';
                                            var actionHtml = getActionHtml(data, type, row, meta);
                                            return last_updated_on+''+added_on+''+actionHtml;
                                        },
                                        visible: false
                                    },
                                    {
                                        className: 'category showSplitView',
                                        data: 'type',
                                        name:'type'
                                    },
                                    {
                                        className: 'posted-by table-fs-light',
                                        data: 'lang_name',
                                        name:'lang_name'
                                    },
                                    {
                                        className: 'posted-by table-fs-light',
                                        data: 'updated_by',
                                        name:'updated_by'
                                    },
                                    {
                                        className: 'posted-by table-fs-light',
                                        data: 'updated_on',
                                        name:'updated_on'
                                    },
                                    {
                                        className: 'posted-by table-fs-light',
                                        data: 'created_on',
                                        name:'created_on'
                                    },
                                    {
                                        className: 'action showSplitView',
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
        return `<div>
                    <button class="btn text-primary pl-0 action-update-status" data-status="view" data-incidentid="${row.id}">View</button>
                </div>`;
    }

    function getReportDateTimeHtml(data, type, row, meta) {
        var date = moment(row.created_on).format('DD MMM YYYY hh:mm A');
        return `<div class="">${date}</div>`;
    }

    // Filter by Language
    $("#language_filter").change(function(event) {
        language_id_filter = $(this).val();
        // Refresh DataTable
        reloadDataTable(false);
    });

    // Filter by Country
    $("#country_filter").change(function(event) {
        country_id_filter = $(this).val();
        // Refresh DataTable
        reloadDataTable(false);
    });

    // Clear filters
    $("#clear-filters").click(function(event) {
        resetFilter();
    });

    // Handle Datatable Actions
    $(document).on('click', '.hideSplitView', function(event) {
        event.preventDefault();
        console.log('hide split view!');
        $("#detail_container").addClass('d-none');
        $("#table_container").removeClass('col-47 pr-0').addClass('col-12');
        dataTableInstance.columns([2, 3, 4, 5, 6, 7]).visible(true);
        dataTableInstance.columns([0, 1]).visible(false);
        dataTableInstance.columns.adjust();
    });

    $(document).on('click', '.showSplitView', function(event) {
        event.preventDefault();
        // Add active highlight
        $('.newhighlight').removeClass('newhighlight');
        $(this).parent('tr').addClass('newhighlight');

        // Fetch selected record's id
        var id  = dataTableInstance.row(this).id();

        // Fetch details
        fetchReportDetail(id);
    });

    function enableSplitView() {
        $("#table_container").removeClass('col-12').addClass('col-47 pr-0');
        $("#detail_container").removeClass('d-none');
        setDetailViewHeight();
        dataTableInstance.columns([2, 3, 4, 5, 6, 7]).visible(false);
        dataTableInstance.columns([0, 1]).visible(true);
        dataTableInstance.columns.adjust();
    }

    /////////////
    // Details //
    /////////////

    var selectedReportId = 0;
    var isFaq = false; // True for record of type FAQ, FIR and Legal Resources.
    function fetchReportDetail(id) {
        selectedReportId = id;

        $.ajax({
            url: baseURL+'admin/pages/get-details',
            method: 'POST',
            data: {id: id}
        })
        .done(function(data) {
            console.log("success");
            console.log(data);
            if(data.success) {

                // Set Details
                setDetailData(data.data);

                // Set Edit form
                hideEdit();
                if(data.data[0].mode=='single') {
                    // Initialize Edit Form
                    recordEditForm.init(data.data[0]);
                    isFaq = false;
                } else {
                    // Initialize Edit Form
                    faqEditForm.init(data.data);
                    isFaq = true;
                }

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

    function setDetailData(data) {
        // Set Detail Title
        //$("#datail_id").text(forms[0].name);

        // Set Detail Content
        var title = data[0]?.type;
        title = title!=undefined?title.toUpperCase().replace('_', ' '):'';
        var htmlContent = '<div class="posted__title"><span>'+title+'</span><span></span></div>';
        if(data.length==0) {
            htmlContent += 'No Data!';
        }
        else if(data.length<=1) {
            htmlContent += data[0].content;
        } else {
            htmlContent += '<div class="fs-22 text-black-100 mb-3">'+data[0].resource_title+'</div>'
            data.forEach(function(resource) {
                htmlContent += '<div>';
                htmlContent += '<div class="label fs-17"><b>'+resource.title+'</b></div>';
                htmlContent += '<div class="fs-16 text-black-100">'+resource.content+'</div>';
                htmlContent += '</div>';
            });
        }
        $("#detail_content").html(htmlContent);
        $("#detail_content").show();
    }

    // Code by Arham
    function setDetailViewHeight() {
        var scrollHeight = $(".dataTables_scrollBody").height() ;
        $(".table-open__content").css("height", scrollHeight);
    }

    /////////////////
    // Update Page //
    /////////////////
    function showEdit() {

        $("#edit_div").show();
        $("#detail_content").hide();

        // Toggle buttons
        $(".detail-button").hide();
        $(".edit-button").show();

        // Update Text
        $(".table-open__header--title").text('Edit Page');
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
        var editForm = isFaq?faqEditForm:recordEditForm;
        if(!editForm.valid()) {
            alert('Please fill all the required fields before proceeding!');
            return false;
        }
        console.log('form is valid! Yeah!');
        var answersObj         = editForm.getAnswers();
        answersObj.resource_id = selectedReportId;
        answersObj.type        = isFaq?'multiple':'single';
        console.log(answersObj);

        // Send Update Request
        var api_endpoint = 'admin/pages/update';
        $.ajax({
            url: baseURL+api_endpoint,
            type: 'POST',
            data: answersObj,
        })
        .done(function(data) {
            console.log("success");
            console.log(data);
            if(data.status==true) {
                fetchReportDetail(selectedReportId);
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

});