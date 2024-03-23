$(function() {

    ////////////////
    // DataTables //
    ////////////////

    var status_filter = 'active';

    // Reset Filter
    function resetFilter() {
        // Refresh DataTable
        reloadDataTable(false);     
    }

    // Initialize datatable
    var dataTableInstance = $('#myTable').DataTable({
                                language: {
                                    infoEmpty: "No data available in table",
                                },
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
                                deferRender: true,
                                rowId: 'id',
                                ajax: {
                                    url: baseURL+"admin/chat/datatable",
                                    type: "POST",
                                    data: function (d) {
                                        var chat_search_filter = $('#chat_search').val();
                                        d.status               = status_filter;
                                        d.chat_search          = chat_search_filter;
                                        d.client_id            = client_id;
                                    },
                                    complete: function (data) {
                                        //console.log("datatable data: ", dataTableInstance, data.responseJSON.recordsTotal);
                                        if(status_filter == 'active') {
                                            var datatable_rows = 0;
                                            if (data.responseJSON.recordsTotal) {
                                                datatable_rows = data.responseJSON.recordsTotal;
                                            }
                                            $('#active_count_span').text(datatable_rows);
                                        }
                                        /*if(status_filter == 'history') {
                                            var datatable_rows = dataTableInstance.rows().count();
                                            $('#history_count_span').text(datatable_rows);
                                        }
                                        if(status_filter == 'trashed') {
                                            var datatable_rows = dataTableInstance.rows().count();
                                            $('#trashed_count_span').text(datatable_rows);
                                        }*/
                                    }
                                },
                                columns: [
                                    /*{
                                        className: 'checklist text-center',
                                        render: function(data, type, row, meta) {
                                            return `<span class="custom-checkbox">
                                                        <input type="checkbox" class="record-checkbox" data-incidentid="${row.id}" id="row${row.id}" >
                                                        <label for="row${row.id}"></label>
                                                    </span>`;
                                        }
                                    },*/
                                    {
                                        className: 'report-id showSplitView',
                                        data: 'id',
                                        name:'id',
                                        render: function(data, type, row, meta) {
                                            var guest_name = '<div>'+row.guest_name+'</div>';
                                            var address    = '<div>'+row.building+', '+row.landmark+', '+row.area+', '+row.city+', '+row.state+', '+row.country+'</div>';
                                            var language_name = '<div>'+row.language_name+'</div>';
                                            return guest_name+''+address+''+language_name;
                                        },
                                        visible: false
                                    },
                                    {
                                        className: 'action',
                                        data: 'id',
                                        name:'id',
                                        render: function(data, type, row, meta) {
                                            var category = '<div>'+row.categories+'</div>';
                                            var guest_live_status = getGuestLiveStatus(data, type, row, meta);
                                            var chat_agent = row.admin_name;
                                            var actionHtml = getActionHtml(data, type, row, meta);
                                            return category+''+guest_live_status+''+chat_agent+''+actionHtml;
                                        },
                                        visible: false
                                    },
                                    {
                                        className: 'action',
                                        data: 'id',
                                        name:'id',
                                        render: function(data, type, row, meta) {
                                            var category = '<div>'+row.categories+'</div>';
                                            var chat_date = getReportDateTimeHtml(data, type, row, meta);
                                            var actionHtml = getActionHtml(data, type, row, meta);
                                            return category+''+chat_date+''+actionHtml;
                                        },
                                        visible: false
                                    },
                                    { 
                                        className: 'report-id showSplitView',
                                        data: 'guest_name',
                                        render: function(data, type, row, meta) {
                                            return row.guest_name;
                                        }
                                    },
                                    { 
                                        className: 'category showSplitView',
                                        data: 'categories',
                                        name:'categories',
                                        render: function(data, type, row, meta) {
                                            return '<div data-language="'+row.language_name+'">'+row.categories+'</div>';
                                        }
                                    },
                                    { 
                                        className: 'location showSplitView',
                                        data: 'id',
                                        name:'id',
                                        render: function(data, type, row, meta) {
                                            return row.building+', '+row.landmark+', '+row.area+', '+row.city+', '+row.state+', '+row.country;
                                        }
                                    },
                                    { 
                                        className: 'location showSplitView',
                                        data: 'language_name',
                                        name:'language_name'
                                    },
                                    { 
                                        className: 'posted-by table-fs-light showSplitView',
                                        render: function(data, type, row, meta) {
                                            var guest_live_status = getGuestLiveStatus(data, type, row, meta);
                                            return guest_live_status;
                                        }
                                        /*data: 'guest_online_status',
                                        name: 'guest_online_status'*/
                                    },
                                    {
                                        className: 'posted-by table-fs-light showSplitView',
                                        data: 'admin_name',
                                        name:'admin_name'
                                    },
                                    {
                                        className: 'action',
                                        render: function(data, type, row, meta) {
                                            var actionHtml = getActionHtml(data, type, row, meta);
                                            return actionHtml;
                                        }
                                    }
                                ]
                              });

    $(document).on('keyup','#chat_search',function() {
        dataTableInstance.draw();
    });

    function reloadDataTable(preservePage) {
        if(!preservePage)
            dataTableInstance.ajax.reload();
        else {
            console.log('resetting without page change');
            // don't reset the current page
            dataTableInstance.ajax.reload(null, false)
        }
        /*if(status_filter == 'active') {
            var datatable_rows = dataTableInstance.rows().count();
            $('#active_count_span').text(datatable_rows);
        }*/
    }

    // Datatable Row Rendering Helper
    function getActionHtml(data, type, row, meta) {
        //return `<div class="action--btn"><a href="#" data-id=${row.id} class="btn text-primary start_chat ${chat_disabled}">Start Chat</a></div>`;
        if(row.guest_status == 'active') {
            return `<div class=""><a href="#" data-id=${row.id} data-language=${row.language_name} class="text-primary start_chat ${chat_disabled}">Start Chat</a></div>`;
        }
        else if(row.guest_status == 'history') {
            return `<div class=""><a href="#" data-id=${row.id} data-language=${row.language_name} class="text-red trash_chat">Trash</a></div>`;
        }
        else if(row.guest_status == 'trashed') {
            return `<div class=""><a href="#" data-id=${row.id} data-language=${row.language_name} class="text-red delete_chat">Delete</a><a href="#" data-id=${row.id} data-language=${row.language_name} class="text-red delete_chat">Delete</a></div>`;
        }
    }

    function getReportDateTimeHtml(data, type, row, meta) {
        var date = moment(row.ug_last_activity).format('DD MMM YYYY hh:mm A');
        return `<div>${date}</div>`;
    }

    //Reload datatable to check guest is online or not
    interval_sync = setInterval(function() {
        reloadDataTable(true);
        //adminLoginUpdate();
    }, 5000);

    /*function adminLoginUpdate() {
        $.ajax({
            url: baseURL+'admin/chat/chat-admin-update',
            method:"POST",
            data: {admin_id: from_user_id},
            success:function(data)
            {
                //console.log("history user update: ", data);
            }
        })
    }*/

    /*function getGuestLiveStatus(data, type, row, meta) {
        to_user_id = row.id;
        var live_status = '';
        var nowDate = new Date();
        if (row.ug_last_activity != null) {
            var user_last_activity = new Date(row.ug_last_activity.replace(/\s/g,"T") + "Z");
        }
        else {
            var user_last_activity = new Date(row.ug_last_activity + " UTC");
        }
        var current_timestamp = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), nowDate.getHours(), nowDate.getMinutes(), nowDate.getSeconds() - 4);
        //console.log(current_timestamp < user_last_activity);
        if(user_last_activity > current_timestamp)
        {
            live_status = '<div class="fs-14 mb-2 text-green">Online</div>';
            chat_disabled = '';
            if(row.guest_status == 'active') {
                $("#guest_online_status").html(live_status);
            }
        }
        else
        {
            live_status = '<div class="fs-14 mb-2 text-red">Offline</div>';
            chat_disabled = ' disabled';
            if(row.guest_status == 'active') {
                $("#guest_online_status").html(live_status);
            }
        }
        return live_status;
    }*/

    function getGuestLiveStatus(data, type, row, meta) {
        to_user_id = row.id;
        var live_status = '';
        if(row.guest_online_status == 'Online')
        {
            live_status = '<div class="fs-14 mb-2 text-green">Online</div>';
            chat_disabled = '';
            if(row.guest_status == 'active') {
                $("#guest_online_status").html(live_status);
            }
        }
        else
        {
            live_status = '<div class="fs-14 mb-2 text-red">Offline</div>';
            chat_disabled = ' disabled';
            if(row.guest_status == 'active') {
                $("#guest_online_status").html(live_status);
            }
        }
        return live_status;
    }

    // Filter by status
    $(".status-filter").click(function(event) {
        $(".status-filter.active").removeClass('active');
        $(this).addClass('active');
        status_filter = $(this).data('status');
        //console.log("status_filter: ",status_filter);
        // Reset bulk selections
        //resetBulkSelection();
        // Refresh DataTable
        hideSplitView();
        reloadDataTable(false);
        if (status_filter != 'active') {
            clearInterval(interval_sync);
        }
        else {
            interval_sync = setInterval(function() {
                reloadDataTable(true);
            }, 2000);
        }
    });

    // Clear filters
    $("#clear-filters").click(function(event) {
        resetFilter();
    });

    // Handle Datatable Actions
    $(document).on('click', '.hideSplitView', function(event) {
        event.preventDefault();
        //console.log('hide split view!');
        hideSplitView();
    });

    function hideSplitView() {
        clearInterval(interval_sync); // stop the interval
        $("#detail_container").addClass('d-none');
        $("#table_container").removeClass('col-47 pr-0').addClass('col-12');
        /*dataTableInstance.columns([0, 3, 4, 5, 6, 7, 8, 9]).visible(true);
        dataTableInstance.columns([1, 2]).visible(false);*/
        if (status_filter == 'active') {
            dataTableInstance.columns([3, 4, 5, 6, 7, 8, 9]).visible(true);
            dataTableInstance.columns([0, 1, 2]).visible(false);
        }
        else { // if (status_filter == 'history') {
            dataTableInstance.columns([3, 4, 5, 6, 8, 9]).visible(true);
            dataTableInstance.columns([0, 1, 2, 7]).visible(false);
        }
        /*else if (status_filter == 'trashed') {
            dataTableInstance.columns([3, 4, 5, 6, 8]).visible(true);
            dataTableInstance.columns([0, 1, 2, 7, 9]).visible(false);
        }*/
        dataTableInstance.columns.adjust();
    }

    function enableSplitView() {
        $("#table_container").removeClass('col-12').addClass('col-47 pr-0');
        $("#detail_container").removeClass('d-none');
        setDetailViewHeight();        
        /*dataTableInstance.columns([3, 4, 5, 6, 7, 8, 9]).visible(false);
        dataTableInstance.columns([0, 1, 2]).visible(true);*/
        if (status_filter == 'active') {
            dataTableInstance.columns([2, 3, 4, 5, 6, 7, 8, 9]).visible(false);
            dataTableInstance.columns([0, 1]).visible(true);
        }
        else { //if (status_filter == 'history') {
            dataTableInstance.columns([1, 3, 4, 5, 6, 7, 8, 9]).visible(false);
            dataTableInstance.columns([0, 2]).visible(true);
        }
        /*else if (status_filter == 'trashed') {
            dataTableInstance.columns([1, 3, 4, 5, 6, 7, 8, 9]).visible(false);
            dataTableInstance.columns([0, 2]).visible(true);
        }*/
        dataTableInstance.columns.adjust();
    }

    //Event for active tab
    $(document).on('click', '.start_chat', function(event) {
        event.preventDefault();
        var id = $(this).closest('tr').attr('id');
        guest_language = $(this).data('language');
        $("#guest_language").text(guest_language);
        //Reload chat history
        clearInterval(interval_sync); // stop the interval
        to_user_id = id;
        
        interval_sync = setInterval(function() {
            fetch_user_chat_history(client_id, id, from_user_id, 'web');
        }, 2000);

        //Set Detail Div Data
        fetchIncidentDetail(to_user_id);
        // Sync Guest User
        sync_admin_guest_byID(client_id, id);
    });

    //Event for history and trash tab
    $(document).on('click', '.showSplitView', function(event) {
        event.preventDefault();
        guest_language = $(this).find('div').data('language');
        $("#guest_language").text(guest_language);
        if (status_filter != 'active') {
            guest_language = $(this).data('language');
            $("#guest_language").text(guest_language);            
            var id = $(this).closest('tr').attr('id');
            //Reload chat history
            clearInterval(interval_sync); // stop the interval
            to_user_id = id;
            //Fetch Chat History
            fetch_user_chat_history(client_id, to_user_id, from_user_id, 'admin');
            //Set Detail Div Data
            fetchIncidentDetail(to_user_id);
        }
    });

    //Event for active tab
    $(document).on('click', '.history_chat', function(event) {
        event.preventDefault();
        var id = $(this).data('id');
        to_user_id = id;
        $.ajax({
            url: baseURL+'admin/chat/chat-history',
            method:"POST",
            data: {client_id: client_id, to_user_id: to_user_id, from_user_id: from_user_id},
            success:function(data)
            {
                //console.log("history user update: ", data);
                if(data.success == true) {
                    to_user_id = 0;
                    location.reload();
                }
            }
        })
    });

    //Event for history tab
    $(document).on('click', '.trash_chat', function(event) {
        event.preventDefault();
        var id = $(this).data('id');
        to_user_id = id;
        $.ajax({
            url: baseURL+'admin/chat/chat-trash',
            method:"POST",
            data: {client_id: client_id, to_user_id: to_user_id},
            success:function(data)
            {
                //console.log("trash user update: ", data);
                if(data.success == true) {
                    location.reload();
                }
            }
        })
    });

    //Event for trash tab
    $(document).on('click', '.delete_chat', function(event) {
        event.preventDefault();
        var id = $(this).data('id');
        to_user_id = id;
        $.ajax({
            url: baseURL+'admin/chat/chat-delete',
            method:"POST",
            data: {client_id: client_id, to_user_id: to_user_id},
            success:function(data)
            {
                //console.log("trash user update: ", data);
                if(data.success == true) {
                    location.reload();
                }
            }
        })
    });

    //Event for trash tab
    $(document).on('click', '.restore_chat', function(event) {
        event.preventDefault();
        var id = $(this).data('id');
        to_user_id = id;
        $.ajax({
            url: baseURL+'admin/chat/chat-restore',
            method:"POST",
            data: {client_id: client_id, to_user_id: to_user_id},
            success:function(data)
            {
                //console.log("trash user update: ", data);
                if(data.success == true) {
                    location.reload();
                }
            }
        })
    });

    /////////////
    // Details //
    /////////////

    function timeConvert(date) {
        var date = new Date(date);
        var time = date.toLocaleString([], { hour: '2-digit', minute: '2-digit' });
        return time;
    }

    function sync_admin_guest_byID(client_id, guest_id)
    {
        //console.log("client_id and guest_id: ", client_id, guest_id);
        $.ajax({
            url: baseURL+'admin/chat/sync-guest-user',
            method:"POST",
            data:{client_id: client_id, guest_id: guest_id},
            success:function(data)
            {
                //console.log("sync id: ", data);
            }
        })
    }

    function fetch_user_chat_history(client_id, to_user_id, from_user_id, sent_by)
    {
        $.ajax({
            url: baseURL+'api/get-chat-history',
            method:"POST",
            data:{client_id: client_id, to_user_id: to_user_id, from_user_id: from_user_id, sent_by: sent_by},
            success:function(data) {
                var chat_data_arr = data.data;
                console.log("chat history: ", data, "to: ", to_user_id,"from: ", from_user_id);
                var chat_element = '';
                for (let chat_data of chat_data_arr) {
                    var chat_date = new Date(chat_data["timestamp"].replace(/\s/g,"T") + "Z");                    
                    if(chat_data['sent_by'] == 'admin')
                    {
                        chat_element += `<div class="sender-chat">
                                            <div class="sender-chat--text">
                                                <span class="sender-chat--text--msg">
                                                    ${chat_data["chat_message"]}
                                                    <span class="sender-chat--text--date">
                                                        ${timeConvert(chat_date)}
                                                    </span>
                                                </span>
                                            </div>
                                        </div>`;
                    }
                    else {
                        chat_element += `<div class="receiver-chat">
                                            <div class="receiver-chat--text">
                                                <span class="receiver-chat--text--msg">
                                                    ${chat_data["chat_message"]}
                                                    <span class="receiver-chat--text--date">
                                                        ${timeConvert(chat_date)}
                                                    </span>
                                                </span>
                                            </div>
                                        </div>`;
                    }
                }
                //To Add Messages in Scrollbar Div
                $('#chat_history_data').html(chat_element);
            }
        })
    }

    function send_chat_action(client_id, to_user_id, chat_message) {
        console.log("send chat info: ", client_id, to_user_id, chat_message);
        if(chat_message != '')
        {
            var new_chat_element;
            $.ajax({
                url: baseURL+'api/chat-insert',
                method:"POST",
                data: {client_id: client_id, to_user_id: to_user_id, from_user_id: from_user_id, chat_message: chat_message, sent_by: 'admin'},
                success:function(data)
                {
                    var chat_data = data.data[0];
                    var chat_date = new Date(chat_data["timestamp"].replace(/\s/g,"T") + "Z");
                    console.log("send chat info: ", chat_data);
                    new_chat_element = `<div class="sender-chat">
                                            <div class="sender-chat--text">
                                                <span class="sender-chat--text--msg">
                                                    ${chat_data["chat_message"]}
                                                    <span class="sender-chat--text--date">
                                                        ${timeConvert(chat_date)}
                                                    </span>
                                                </span>
                                            </div>
                                        </div>`;

                    $('#chat_message_send').val('');
                    $('#chat_history_data').append(new_chat_element);
                },
                complete: function(data)
                {
                    //Message div scroll to the bottom
                    scrollToBottom('chat_history_data');
                }
            })
        }
        else
        {
            alert('Type something');
        }
    }

    //Send Chat Message on Send Button Click
    $(document).on('click', '.send_chat', function(event) {
        to_user_id = $('#chat_message_send').data('id');
        var chat_message = $.trim($('#chat_message_send').val());
        console.log("chat_message: ", client_id, to_user_id, chat_message);
        send_chat_action(client_id, to_user_id, chat_message);
    });

    //Send Chat Message on Enter Key Press
    $(document).on('keypress', '.chat-input', function(event) {
        if(event.keyCode == 13) {
            to_user_id = $('#chat_message_send').data('id');
            var chat_message = $.trim($('#chat_message_send').val());
            console.log("chat_message: ", client_id, to_user_id, chat_message);
            send_chat_action(client_id, to_user_id, chat_message);
        }
    });

    var selectedIncidentId = 0; 
    function fetchIncidentDetail(incidentId) {
        selectedIncidentId = incidentId;
        $.ajax({
            url: baseURL+'api/reported-incident/details',
            type: 'POST',
            data: {incident_id: selectedIncidentId},
        })
        .done(function(data) {
            console.log("success");
            console.log(data);
            if(data.status) {
                var incidentData = data.data;

                // Set Details
                setDetailData(incidentData);

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

    function setDetailData(incidentData) {
        // Set Incident Map
        if(map==null && google) {
            initializeDetailMap(incidentData.latitude, incidentData.longitude);
        } else {
            updateMarker(incidentData.latitude, incidentData.longitude);
        }

        // Set Action buttons
        // setDetailActionButtons(incidentData.status);
        //console.log("incidentData2", incidentData);

        var answers = incidentData.answers;

        // Set Detail Tab Chat Info
        $("#guest_id").text(incidentData.id);
        $("#short_address").text(incidentData.state + ', ' + incidentData.country);
        $("#guest_categories").text(incidentData.categories);
        
        var chat_detail_btn_html = ``;
        var chat_input_html = ``;
        if (status_filter == 'active') {
            chat_detail_btn_html = `<button id="chat_status_btn" data-status="active" data-id="${incidentData.id}" class="btn btn btn-primary fs-17 detail-button action-update-status history_chat">End Chat</button>`;
            chat_input_html = `<input class="form-control chat-input" name="chat_message_send" id="chat_message_send" data-id="${incidentData.id}" placeholder="Type a message">
                                <a href="#"><img src="`+baseURL+`assets/admin/images/Icon material-send.svg" class="send_chat"></a>`;
        }
        else if (status_filter == 'history') {
            chat_detail_btn_html = `<button id="chat_status_btn" data-status="history" data-id="${incidentData.id}" class="btn btn btn-primary fs-17 detail-button action-update-status trash_chat">Trash</button>`;
        }
        else if (status_filter == 'trashed') {
            chat_detail_btn_html = `<button id="chat_status_btn" data-status="trashed" data-id="${incidentData.id}" class="btn btn btn-primary fs-17 detail-button action-update-status delete_chat">Delete</button>`;
        }
        
        $('#chat_detail_btn_div').html(chat_detail_btn_html);
        $('#chat_input_div').html(chat_input_html);

        // Set Incident Detail Data
        $("#datail_id").text(incidentData.id);
        $("#detail_category_title").text(incidentData.categories);
        $("#admin_active_user").text(incidentData.posted_by);
        $("#incidentDesc").text(incidentData.description);
        $("#detail_reporting_for").val(answers.primary.sharing_for.answer);
        $("#detail_age").val(incidentData.age);
        $("#detail_gender").val(incidentData.gender);
        $("#detail_date").val(incidentData.incident_date);
        var full_inc_date = incidentData.incident_date + ' ' + incidentData.time_from;
        $("#detail_time").val(moment(full_inc_date).format('hh:mm A'));
        $("#detail_categories").val(incidentData.categories);
        $("#detail_medical_help").val(answers.primary.medical_help?.answer);
        $("#detail_police").val(answers.primary.reported_to_police?.answer);
        // Address
        $("#detail_locality").val(incidentData.building);
        $("#detail_landmark").val(incidentData.landmark);
        $("#detail_city").val(incidentData.city);
        $("#detail_state").val(incidentData.state);
        $("#detail_country").val(incidentData.country);
        $("#detail_address").val(incidentData.building+' '+incidentData.landmark+', '+incidentData.city+', '+incidentData.state+', '+incidentData.country);

        // Set secondary form answers
        var form_answers = Object.values(answers);
        var html = '';
        for (var i = 1; i < form_answers.length; i++) {
            var otherFormAnswers = Object.values(form_answers[i]);
            for (var j = 0; j < otherFormAnswers.length; j++) {
                var answer = otherFormAnswers[j];
                html += `
                    <div class="col-12">
                        <div class="label fs-15">${answer.question}</div>
                        <input class="form-control" disabled="" value="${answer.answer}">
                    </div>
                `;
            }
        }
        $("#detail_other_forms").html(html);
    }

    // Set Detail View Height
    function setDetailViewHeight() {
        var scrollHeight = $(".dataTables_scrollBody").height() -45;
        $(".table-open__content").css("height", scrollHeight);
    }

    // Set Scroll to Bottom of Chat Box
    function scrollToBottom(id)
    {
        var msgDiv = document.getElementById(id);
        msgDiv.scrollTop = msgDiv.scrollHeight;
    }

});