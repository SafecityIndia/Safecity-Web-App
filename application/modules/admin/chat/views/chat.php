<!-- header placeholder -->
<?php $this->load->view('admin/includes/header'); ?>

    <div class="admin-table-header bg-white">
        <?php $this->load->view('admin/includes/topbar'); ?>
        <div class="admin-table-header__options">
            <div class="title">
                Chat
            </div>
            <!-- <div class="upload-download-new">
                <button class="btn btn-primary create-new" data-toggle="modal"
                    data-target="#incidentModal">Create new</button>
            </div> -->
        </div>
        <div class="admin-table-header__tabs">
            <div class="tabs-holder">
                <div class="fs-15 status-filter active" data-status="active">
                    <span class="tabs-holder--text">Active</span>
                    <span class="number-tags red" id="active_count_span"><?= $statusesCount['active'] ?></span>
                </div>
                <div class="fs-15 status-filter" data-status="history">
                    <span class="tabs-holder--text">Chat History</span>
                    <span class="number-tags blue" id="history_count_span"><?= $statusesCount['history'] ?></span>
                </div>
                <div class="fs-15 status-filter" data-status="trashed">
                    <span class="tabs-holder--text mr-0">Trash</span>
                    <span class="number-tags red" id="trashed_count_span"><?= $statusesCount['trashed'] ?></span>
                </div>
            </div>
            <div class="searchbar">
                <input class="form-control" id="chat_search" placeholder="Search">
                <img class="search-icon" src="<?php echo base_url() ?>assets/admin/images/Icon 01.svg">
            </div>
        </div>
    </div>
    <div class="admin-table-content">
        <div class="admin-table__main">
            <div class="table-main h-100 collapse-view filters__loc-time">
                <div class="row h-100">
                    <div id="table_container" class="col-12">
                        <table id="myTable" class="table-main__admin" cellspacing="0" cellpadding="0">
                            <thead>
                                <tr>
                                    <!-- <td class="checklist" align="center">
                                        <span class="custom-checkbox">
                                            <input type="checkbox" id="theadCheck">
                                            <label for="theadCheck"></label>
                                        </span>
                                    </td> -->
                                    <td class="text-nowrap">Guest ID, Location, Language</td>
                                    <td>
                                        Category, Status, Action
                                        <span class="icon-expand hideSplitView">
                                            <img src="<?php echo base_url(); ?>assets/admin/images/ionic-ios-expand.svg">
                                        </span>
                                    </td>
                                    <td>
                                        Category, Date, Action
                                        <span class="icon-expand hideSplitView">
                                            <img src="<?php echo base_url(); ?>assets/admin/images/ionic-ios-expand.svg">
                                        </span>
                                    </td>
                                    <td class="report-id">Guest ID</td>
                                    <td class="category">Category</td>
                                    <td class="location table-fs-light">Location</td>
                                    <td class="location table-fs-light">Language</td>
                                    <td class="posted-by table-fs-light">Status</td>
                                    <td class="posted-by table-fs-light">Chat Agent</td>
                                    <td class="action">Action</td>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                    <!-- Detail Pane -->

                    <div id="detail_container" class="col-53 pl-0 d-none">
                        <div class="table-open table-open__chat">
                            <div class="table-open__header bg-white">
                                <div class="table-open__header--title">
                                    Guest ID: <span id="guest_id"></span>
                                </div>
                                <div class="table-open__header--button">
                                    <span class="d-inline-block align-middle ml-2">
                                        <span class="fs-15 text-dark-grey">Chat Agent:</span>
                                        <span class="fs-16" id="admin_active_user"></span>
                                    </span>
                                    <div class="fs-16 pl-5">
                                        <span id="guest_online_status"></span>
                                    </div>
                                    <div class="fs-16 text-green pl-5">
                                        <div class="action--btn" id="chat_detail_btn_div"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-open__content chat">
                                <div class="edit-field pb-0">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="safecity-lang-date">
                                                <div class="about-safecity--date">
                                                    <div>Location</div>
                                                    <div><span id="short_address"></span></div>
                                                </div>
                                                <div class="about-safecity--date">
                                                    <div>Language</div>
                                                    <div><span id="guest_language"></span></div>
                                                </div>
                                                <div class="about-safecity--date">
                                                    <div>Categories</div>
                                                    <div><span id="guest_categories"></span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-white py-5">
                                    <div class="chat-main">
                                        <div class="chat-holder">
                                            <!-- chat messages div -->
                                            <div id="chat_history_data"></div>
                                            <!-- chat messages div -->
                                            <div class="incident-link">
                                            </div>
                                            <!-- Incident Detail in chat -->
                                            <div class="receiver-chat">
                                                <div class="receiver-chat--text">
                                                    <span class="receiver-chat--text--msg">
                                                        <div class="edit-field p-0 text-initial">
                                                            <div class="posted__title pb-4">
                                                                <span>Incident Report submitted by
                                                                    guest:</span>
                                                                <span></span>
                                                            </div>
                                                            <div class="edit-field__content">
                                                                <div class="label fs-17">Incident
                                                                    Description</div>
                                                                <div id="incidentDesc" class="fs-16">Lorem Ipsum is simply dummy text.
                                                                </div>
                                                            </div>
                                                            <div class="edit-field__content row">
                                                                <div class="col-6">
                                                                    <div class="label fs-15">Reporting for</div>
                                                                    <input id="detail_reporting_for" class="form-control" disabled="" value="myself">
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="label fs-15">Age</div>
                                                                    <input id="detail_age" class="form-control" disabled="" value="26">
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="label fs-15">Gender</div>
                                                                    <input id="detail_gender" class="form-control" disabled="" value="Female">
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="label fs-15">Date</div>
                                                                    <input id="detail_date" class="form-control" disabled="" value="22/06/2020">
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="label fs-15">Time</div>
                                                                    <input id="detail_time" class="form-control" disabled="" value="6:00 PM">
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="label fs-15">Categories</div>
                                                                    <input id="detail_categories" class="form-control" disabled=""
                                                                        value="Stalking, Taking pictures, Physical Assault">
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="label fs-15">Medical Help</div>
                                                                    <input id="detail_medical_help" class="form-control" disabled="" value="Received">
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="label fs-15">Police Report</div>
                                                                    <input id="detail_police" class="form-control" disabled=""
                                                                        value="I tried, police did not register my report">
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="label fs-15">Address</div>
                                                                    <input id="detail_address" class="form-control" disabled="" value="">
                                                                    <div class="mapouter" id="detail_map" style="height:467px"></div>
                                                                </div>
                                                                <div id="detail_other_forms" class="col-12">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </span>
                                                </div>
                                            </div>
                                            <!-- Incident Detail in chat -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Send chat button -->
                            <div class="send-input" id="chat_input_div"></div>
                        </div>
                    </div>
                    <!-- Detail Pane End -->
                </div>
            </div>
        </div>
    </div>

<!-- Footer -->
<?php $this->load->view('admin/includes/footer'); ?>
<style type="text/css">
    a.disabled {
        pointer-events: none;
        color: #ccc;
    }
</style>

<script src="https://maps.google.com/maps/api/js?key=AIzaSyA-RG4hM7qRh3jHfOwSuUOBexPTn0CZf6w&libraries=geometry,places" async defer></script>
<script src="<?php echo base_url(); ?>application/modules/admin/chat/scripts/chat.js"></script>

<script>
    var baseURL = "<?php echo base_url() ?>";
    var client_id = 1;
    var from_user_id = '<?php echo $_SESSION['user_id'];?>';
    var to_user_id = null;
    var interval_sync = null;
    var chat_disabled = '';
    var guest_language = '';
    //$.cookie("to_user_id", null);
    /*if(!$.cookie("city_id")){
      $.cookie("city_id", 133024);
    }*/
    $(document).ready(function () {
      /*$('#myTable').DataTable({
        scrollResize: true,
        searching: false,
        paging: false,
        info: false,
        //scrollY: "100%",
        scrollY: 100,
        scrollCollapse: true,
      });*/
    });
</script>
</body>
</html>