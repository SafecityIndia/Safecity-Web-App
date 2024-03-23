<!-- header placeholder -->
<?php $this->load->view('admin/includes/header'); ?>
    
    <div class="admin-table-header bg-white">
        <?php $this->load->view('admin/includes/topbar'); ?>
        <div class="admin-table-header__options">
            <div class="title">
                Chat
            </div>
            <div class="upload-download-new">
                <button class="btn btn-primary create-new" data-toggle="modal"
                    data-target="#incidentModal">Create new</button>
            </div>
        </div>
        <div class="admin-table-header__tabs">
            <div class="tabs-holder">
                <div class="fs-15 status-filter active" data-status="active">
                    <span class="tabs-holder--text">Active</span>
                    <span class="number-tags red">5</span>
                </div>
                <div class="fs-15 status-filter" data-status="history">
                    <span class="tabs-holder--text">Chat History</span>
                    <span class="number-tags blue">300</span>
                </div>
                <div class="fs-15 status-filter" data-status="trash">
                    <span class="tabs-holder--text">Trash</span>
                    <span class="number-tags red">15</span>
                </div>
            </div>
            <div class="searchbar">
                <input class="form-control" placeholder="Search">
                <img class="search-icon" src="<?php echo base_url() ?>assets/admin/images/Icon 01.svg">
            </div>
        </div>
    </div>
    <div class="admin-table-content">
        <div class="admin-table__main">
            <div class="table-main h-100 split-view">
                <div class="row h-100">
                    <div class="col-42 pr-0">
                        <table id="myTable" class="table-main__admin" cellspacing="0" cellpadding="0">
                            <thead>
                                <tr>
                                    <td class="checklist" align="center">
                                        <span class="custom-checkbox">
                                            <input type="checkbox" id="theadCheck">
                                            <label for="theadCheck"></label>
                                        </span>
                                    </td>
                                    <td class="text-nowrap">Guest ID, Location, Language</td>
                                    <td>
                                        <div class="d-flex justify-content-end">
                                            <span>Category, Status, Action</span>
                                            <span class="icon-expand">
                                                <img src="<?php echo base_url() ?>assets/admin/images/ionic-ios-expand.svg">
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td align="center" class="checklist">
                                        <span class="custom-checkbox">
                                            <input type="checkbox" id="1">
                                            <label for="1"></label>
                                        </span>
                                    </td>
                                    <td class="report-id">
                                        <div class="mb-2">Legal Resources</div>
                                        <div class="table-fs-light mb-2">India</div>
                                        <div class="table-fs-light mb-2">English</div>
                                    </td>
                                    <td class="action">
                                        <div class="td-border-right">
                                            <div class="mb-2">Stalking, Taking pictures</div>
                                            <div class="fs-14 mb-2 text-green">Online</div>
                                            <div class="fs-14 mb-2 text-primary">Start Chat</div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="active">
                                    <td align="center" class="checklist">
                                        <span class="custom-checkbox">
                                            <input type="checkbox" id="1">
                                            <label for="1"></label>
                                        </span>
                                    </td>
                                    <td class="report-id">
                                        <div class="mb-2">Legal Resources</div>
                                        <div class="table-fs-light mb-2">India</div>
                                        <div class="table-fs-light mb-2">English</div>
                                    </td>
                                    <td class="action">
                                        <div class="td-border-right">
                                            <div class="mb-2">Stalking, Taking pictures</div>
                                            <div class="fs-14 mb-2 text-green">Online</div>
                                            <div class="fs-14 mb-2 text-primary">Start Chat</div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" class="checklist">
                                        <span class="custom-checkbox">
                                            <input type="checkbox" id="1">
                                            <label for="1"></label>
                                        </span>
                                    </td>
                                    <td class="report-id">
                                        <div class="mb-2">Legal Resources</div>
                                        <div class="table-fs-light mb-2">India</div>
                                        <div class="table-fs-light mb-2">English</div>
                                    </td>
                                    <td class="action">
                                        <div class="td-border-right">
                                            <div class="mb-2">Stalking, Taking pictures</div>
                                            <div class="fs-14 mb-2 text-green">Online</div>
                                            <div class="fs-14 mb-2 text-primary">Start Chat</div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" class="checklist">
                                        <span class="custom-checkbox">
                                            <input type="checkbox" id="1">
                                            <label for="1"></label>
                                        </span>
                                    </td>
                                    <td class="report-id">
                                        <div class="mb-2">Legal Resources</div>
                                        <div class="table-fs-light mb-2">India</div>
                                        <div class="table-fs-light mb-2">English</div>
                                    </td>
                                    <td class="action">
                                        <div class="td-border-right">
                                            <div class="mb-2">Stalking, Taking pictures</div>
                                            <div class="fs-14 mb-2 text-green">Online</div>
                                            <div class="fs-14 mb-2 text-primary">Start Chat</div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" class="checklist">
                                        <span class="custom-checkbox">
                                            <input type="checkbox" id="1">
                                            <label for="1"></label>
                                        </span>
                                    </td>
                                    <td class="report-id">
                                        <div class="mb-2">Legal Resources</div>
                                        <div class="table-fs-light mb-2">India</div>
                                        <div class="table-fs-light mb-2">English</div>
                                    </td>
                                    <td class="action">
                                        <div class="td-border-right">
                                            <div class="mb-2">Stalking, Taking pictures</div>
                                            <div class="fs-14 mb-2 text-green">Online</div>
                                            <div class="fs-14 mb-2 text-primary">Start Chat</div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" class="checklist">
                                        <span class="custom-checkbox">
                                            <input type="checkbox" id="1">
                                            <label for="1"></label>
                                        </span>
                                    </td>
                                    <td class="report-id">
                                        <div class="mb-2">Legal Resources</div>
                                        <div class="table-fs-light mb-2">India</div>
                                        <div class="table-fs-light mb-2">English</div>
                                    </td>
                                    <td class="action">
                                        <div class="td-border-right">
                                            <div class="mb-2">Stalking, Taking pictures</div>
                                            <div class="fs-14 mb-2 text-green">Online</div>
                                            <div class="fs-14 mb-2 text-primary">Start Chat</div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <script>
                        
                        window.onload = function () {
                            var offsetValue = $(".table-open__header").outerHeight() - $(".dataTables_scrollHead").outerHeight()
                            if(offsetValue < 0){
                                var scrollHeight = $(".dataTables_scrollBody").outerHeight() - offsetValue
                                $(".table-open__content").css("height", scrollHeight)
                            }
                            else{
                                var scrollHeight = $(".dataTables_scrollBody").outerHeight() - offsetValue
                                $(".table-open__content").css("height", scrollHeight)
                            }
                        }
                    </script>
                    <div class="col-58 pl-0">
                        <div class="table-open table-open__chat">
                            <div class="table-open__header bg-white">
                                <div class="table-open__header--title">
                                    Guest ID: 1234
                                </div>
                                <div class="table-open__header--button">
                                    <span class="d-inline-block align-middle ml-2">
                                        <span class="fs-15 text-dark-grey">Chat Agent:</span>
                                        <span class="fs-16">Tania Sharma</span>
                                    </span>
                                    <div class="fs-16 text-green pl-5">Online</div>
                                </div>
                            </div>
                            <div class="table-open__content chat">
                                <div class="edit-field pb-0">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="safecity-lang-date">
                                                <div class="about-safecity--date">
                                                    <div>Language</div>
                                                    <div>English</div>
                                                </div>
                                                <div class="about-safecity--date">
                                                    <div>Date Modified</div>
                                                    <div>22/06/2020</div>
                                                </div>
                                                <div class="about-safecity--date">
                                                    <div>Date Added</div>
                                                    <div>22/06/2020</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-white py-5">
                                    <div class="chat-main">
                                        <div class="chat-holder">
                                            <div id="chat_history_data"></div>
                                            <!-- <div class="sender-chat">
                                                <div class="sender-chat--text">
                                                    <span class="sender-chat--text--msg">
                                                        Can you tell me about ABC?
                                                        <span class="sender-chat--text--date">
                                                            4.11 PM
                                                        </span>
                                                    </span>
                                                </div>
                                                <div class="sender-chat--text">
                                                    <span class="sender-chat--text--msg">
                                                        Hello
                                                        <span class="sender-chat--text--date">
                                                            4.11 PM
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="receiver-chat">
                                                <div class="receiver-chat--text">
                                                    <span class="receiver-chat--text--msg">
                                                        Can you tell me about ABC?
                                                        <span class="receiver-chat--text--date">
                                                            4.11 PM
                                                        </span>
                                                    </span>
                                                </div>
                                                <div class="receiver-chat--text">
                                                    <span class="receiver-chat--text--msg">
                                                        Hi
                                                        <span class="receiver-chat--text--date">
                                                            4.11 PM
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                            
                                            <div class="incident-link">

                                            </div>
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
                                                                <div id="incidentDesc" class="fs-16">                                Lorem Ipsum is simply dummy text of the printing and typesetting
                                        industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                                        when Cnd scrambled it to make a type specimen
                                        book. It has survived not only five centuries, but also the leap into electronic
                                        typesetting, remaining essentially unchanged. It was popularised in the 1960s with the
                                        release of Letraset sheets containing Lorem Ipsum passages, and more recently with
                                        desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                                                </div>
                                                            </div>
                                                            <div class="edit-field__content row">
                                                                <div class="col-6">
                                                                    <div class="label fs-15">Reporting for
                                                                    </div>
                                                                    <input class="form-control" disabled="" value="myself">
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="label fs-15">Age</div>
                                                                    <input class="form-control" disabled="" value="26">
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="label fs-15">Gender</div>
                                                                    <input class="form-control" disabled="" value="Female">
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="label fs-15">Date</div>
                                                                    <input class="form-control" disabled="" value="22/06/2020">
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="label fs-15">Time</div>
                                                                    <input class="form-control" disabled="" value="6:00 PM">

                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="label fs-15">Categories
                                                                    </div>
                                                                    <input class="form-control" disabled="" value="Stalking, Taking pictures, Physical Assault">
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="label fs-15">Medical Help
                                                                    </div>
                                                                    <input class="form-control" disabled="" value="Received">
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="label fs-15">Police Report
                                                                    </div>
                                                                    <input class="form-control" disabled="" value="I tried, police did not register my report">
                                                                </div>

                                                                <div class="col-12">
                                                                    <div class="label fs-15">Address</div>
                                                                    <input class="form-control" disabled="" value="d it to make a type specimen">

                                                                    <img src="<?php echo base_url() ?>assets/admin/images/googl_ED.png">
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </span>
                                                </div>
                                            </div> -->
                                        </div>  
                                        <div class="send-input">
                                            <input class="form-control" placeholder="Text a message">
                                            <img src="<?php echo base_url() ?>assets/admin/images/Icon material-send.svg">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Footer -->
<?php $this->load->view('admin/includes/footer'); ?>

<script>
    $(document).ready(function () {
      $('#myTable').DataTable({
        scrollResize: true,
        searching: false, 
        paging: false, 
        info: false,
        //scrollY: "100%",
        scrollY: 100,
        scrollCollapse: true,
      });
    });
</script>
</body>
</html>