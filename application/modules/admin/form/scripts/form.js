$(function() {

    ////////////////
    // DataTables //
    ////////////////
    var language_id_filter = '';

    // Reset Filter
    function resetFilter() {
        language_id_filter  = '';
        $("#language_filter").val("").trigger('change.select2');
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
                                    url: baseURL+"admin/form/datatable",
                                    type: "POST",
                                    data: function (d) {
                                        d.lang_id    = language_id_filter;
                                    }
                                },
                                columns: [
                                    {
                                        className: 'report-id showSplitView',
                                        data: 'id', 
                                        name:'id', 
                                        render: function(data, type, row, meta) {
                                            var title   = '<div>'+row.name+'<div>';
                                            return title;
                                        },
                                        visible: false
                                    },
                                    {
                                        className: 'action',
                                        data: 'id',
                                        name:'id',
                                        render: function(data, type, row, meta) {
                                            var language = '<div>'+row.language+'</div>';
                                            var date = getReportDateTimeHtml(data, type, row, meta);
                                            var actionHtml = getActionHtml(data, type, row, meta);
                                            return language+''+date+''+actionHtml;
                                        },
                                        visible: false
                                    },
                                    { 
                                        className: 'category showSplitView',
                                        data: 'name',
                                        name:'name'
                                    },
                                    { 
                                        className: 'posted-by table-fs-light',
                                        data: 'language',
                                        name:'language'
                                    },
                                    { 
                                        className: 'date table-fs-light',
                                        render: getReportDateTimeHtml
                                    },
                                    { 
                                        className: 'action showSplitView',
                                        render: getActionHtml
                                    },
                                ],
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
        return `<div>${date}</div>`;
    }

    // Filter by Language
    $("#language_filter").change(function(event) {
        language_id_filter = $(this).val();
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
        dataTableInstance.columns([2, 3, 4, 5]).visible(true);
        dataTableInstance.columns([0,1]).visible(false);
        dataTableInstance.columns.adjust();
    });

    $(document).on('click', '.showSplitView', function(event) {
        event.preventDefault();
        var id = dataTableInstance.row(this).id();
        var form_name = dataTableInstance.row(this).data().name;
        fetchReportDetail(id, form_name);
    });
    
    function enableSplitView() {
        $("#table_container").removeClass('col-12').addClass('col-47 pr-0');
        $("#detail_container").removeClass('d-none');
        setDetailViewHeight();
        dataTableInstance.columns([2, 3, 4, 5]).visible(false);
        dataTableInstance.columns([0, 1]).visible(true);
        dataTableInstance.columns.adjust();
    }

    /////////////
    // Details //
    /////////////

    var selectedReportId = 0; 
    function fetchReportDetail(id, form_name) {
        selectedReportId = id;

        $.ajax({
            url: baseURL+'admin/forms/get-details?name='+form_name,
        })
        .done(function(data) {
            console.log("success");
            console.log(data);
            if(data.success) {

                // Set Details
                setDetailData(data.data.forms, data.data.questions, data.data.categories);

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

    function setDetailData(forms, questionsObj, categories) {
        // Set Detail Title
        $("#datail_id").text(forms[0].name);

        // Set Detail Content
        var questionHtml ='';
        for (var i = 0; i < forms.length; i++) {
            /*if(forms[i].type=='logic')
                continue;*/
            console.log('on form '+i);
            var form = JSON.parse(forms[i].question_ids_json);
            for (var j = 0; j < form.length; j++) {
                var question_id = form[j].question_id;
                var question = questionsObj[question_id].question;
                var question_properties = JSON.parse(question.properties);
                var suboptions = questionsObj[question_id].suboptions || {};
                var options = questionsObj[question_id].options;
                questionHtml += `
                    <div>
                        <div>${question.question}</div>
                        <div>${question.subtext}</div>
                `;
                switch (question_properties.type) {
                    case "radio":
                    case "checkbox":
                        if (question.is_category == true) {
                            var options = [];
                            categories.forEach(function (category) {
                                options.push({
                                    id: category.id,
                                    textbox_placeholder: null,
                                    title: category.title,
                                    parent_id: category.parent_id,
                                    is_main: category.is_main,
                                });
                            });
                        }
                        options.forEach(function (option) {
                            var hassuboption = option.suboption_properties != null ? option.suboption_properties.type : false;
                            questionHtml += `
                                <div style="border-style:outset;border-color:black;border-width:thin;margin:5px;">${option.title}</div>
                            `;
                            if(option.textbox_placeholder != null) {
                                questionHtml += `<div style="height:20px;border-style:dotted;border-color:grey;border-width:thin;margin:5px;">${option.textbox_placeholder}</div>`;
                            }
                            else if(hassuboption) {
                                var elemsuboptions = suboptions[option.id];
                                elemsuboptions.forEach(function (elemsuboption) {
                                    questionHtml += `<div style="border-style:dotted;border-color:grey;border-width:thin;margin:5px;">${elemsuboption.title}</div>`;
                                });
                            }
                        });
                    break;

                    case "text":
                        questionHtml += `
                            <div style="height:20px;border-style:outset;border-color:black;border-width:thin;margin:5px;">${question_properties.placeholder}</div>
                        `;
                    break;

                    case "estimate-datepicker":
                         questionHtml += `
                            Select Date
                            <div style="height:20px;border-style:outset;border-color:black;border-width:thin;margin:5px;"></div>
                         `;
                    break;

                    case "estimate-time-or-rangepicker":
                        questionHtml += `
                            Select Time
                                <div style="height:20px;border-style:outset;border-color:black;border-width:thin;margin:5px;"></div>
                                OR
                            Select Time Range
                                <div style="height:20px;border-style:outset;border-color:black;border-width:thin;margin:5px;"></div>
                        `;
                    break;

                    default:
                    break;
                }
                questionHtml += `</div>`;

            }
        }
        $("#detail_content").html(questionHtml);
    }

    // Code by Arham
    function setDetailViewHeight() {
        var scrollHeight = $(".dataTables_scrollBody").height() -45;
        $(".table-open__content").css("height", scrollHeight);
    }

});