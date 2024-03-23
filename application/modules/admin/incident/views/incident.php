<!-- header placeholder -->
<?php $this->load->view('admin/includes/header'); ?>

    <div class="admin-table-header bg-white">
        <?php $this->load->view('admin/includes/topbar'); ?>
        <div class="admin-table-header__options">
            <div class="title">
                Incidents
            </div>
            <div class="upload-download-new newtabinn">
                <div class="getin">
                    <a id="importRecordBtn" class="d-flex align-items-center px-2">
                        <img src="<?php echo base_url(); ?>assets/admin/images/Icon feather-download.svg">
                        <span> Upload Incidents</span>
                    </a>
                    <p class="px-2" id="download_sample_import_file"> <i class="fas fa-arrow-down"></i>get file format  for upload</p>
                </div>
                <form id="importRecordForm" method="post" enctype="multipart/form-data" action="<?=base_url();?>/admin/incident/import">
                    <input id="importFile" type="file" name="import_file" accept=".csv" class="d-none">
                </form>
                <a class="d-flex align-items-center px-2" id="exportRecordBtn" data-target="#downloadIncidents"
                    data-toggle="modal">
                    <img src="<?php echo base_url(); ?>assets/admin/images/Icon feather-download (1).svg">
                    <span>Download Incidents</span>
                </a>
                <button class="btn btn-primary create-new" id="create-new-button">Create new</button>
            </div>
        </div>
        <!-- Record Import Status -->
        <?php if($this->session->flashdata('upload_success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> <?php echo $this->session->flashdata('upload_success')['message']; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php elseif($this->session->flashdata('upload_failed')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Unable to upload Incident due to some errors:!</strong>
                <?php
                    $upload_failed = $this->session->flashdata('upload_failed');
                    if(isset($upload_failed['validations'])) {
                        echo "<ol>";
                        foreach ($upload_failed['validations'] as $err_msg) {
                            echo "<li>".$err_msg."</li>";
                        }
                        echo "</ol>";
                    } else {
                        echo $upload_failed['message'];
                    }
                ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <!-- Import Status End -->
        <div class="admin-table-header__tabs">
            <div class="tabs-holder">
                <div class="fs-14 status-filter active" data-status="pending_approval" data-count="<?= $statusesCount[
                    'pending_approval'
                ] ?>">
                    <span class="tabs-holder--text">Approval pending</span>
                    <span class="number-tags red"><?= $statusesCount[
                        'pending_approval'
                    ] ?></span>
                </div>
                <div class="fs-14 status-filter" data-status="approved" data-count="<?= $statusesCount[
                    'approved'
                ] ?>">
                    <span class="tabs-holder--text">Approved</span>
                    <span class="number-tags blue"><?= $statusesCount[
                        'approved'
                    ] ?></span>
                </div>
                <div class="fs-14 status-filter" data-status="saved" data-count="<?= $statusesCount[
                    'saved'
                ] ?>">
                    <span class="tabs-holder--text">Saved for later</span>
                    <span class="number-tags blue"><?= $statusesCount[
                        'saved'
                    ] ?></span>
                </div>
                <div class="fs-14 status-filter" data-status="published" data-count="<?= $statusesCount[
                    'published'
                ] ?>">
                    <span class="tabs-holder--text">Published</span>
                    <span class="number-tags blue"><?= $statusesCount[
                        'published'
                    ] ?></span>
                </div>
                <div class="fs-14 status-filter" data-status="rejected" data-count="<?= $statusesCount[
                    'rejected'
                ] ?>">
                    <span class="tabs-holder--text">Rejected</span>
                    <span class="number-tags red"><?= $statusesCount[
                        'rejected'
                    ] ?></span>
                </div>
                <div class="fs-14 status-filter" data-status="trashed" data-count="<?= $statusesCount[
                    'trashed'
                ] ?>">
                    <span class="tabs-holder--text mr-0">Trash</span>
                    <span class="number-tags red"><?= $statusesCount[
                        'trashed'
                    ] ?></span>
                </div>
            </div>
            <div class="searchbar newsearch">
                <input class="form-control" id="search_filter" placeholder="Search">
                <img class="search-icon" src="<?php echo base_url(); ?>assets/admin/images/Icon 01.svg">
            </div>
        </div>
    </div>
    <div class="admin-table-content">
        <div class="admin-table__main">
            <div class="filters__loc-time bg-white">
                <div class="mr-4">
                    <label class="fs-14"></label>
                    <div>Filters</div>
                </div>
                <div class="loc-time--holder ">
                    <div class="mr-4">
                        <label >Type</label>
                        <div class="dropdown">
                            <select id="type_filter" class="custom-select custom-select-sm init-select2">
                              <option value="" selected>All</option>
                              <option value="1">Primary Form</option>
                              <option value="2">Primary + Secondary Form</option>
                            </select>
                        </div>
                    </div>
                    <div class="mr-4">
                        <label >Category</label>
                        <div class="dropdown">
                            <select id="category_filter" class="custom-select custom-select-sm">
                              <!-- Option Placeholder -->
                            </select>
                        </div>
                        <!-- <div class="dropdown">
                            <a class="btn loc-time--holder--btn dropdown-toggle" href="#" role="button"
                                id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <span>All</span>
                            </a>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div> -->
                    </div>
                    <div class="newrange ">


                        <div class="dropdown ">
                            <div class="input-group input-daterange">
							<div class="row">
    							<div class="col-5">
    							   <label >Start Date</label>
                                    <input type="text" id="datepickerstart_filter" class="form-control">
    								<img class="calendar-icon" src="<?php echo base_url(); ?>assets/admin/images/calendar.svg">
    							</div>
    							<span class="centertext">to</span>
    							<div class="col-5" >
    								<label >End Date</label>
                                    <input type="text" id="datepickerend_filter" class="form-control">
    								<img class="calendar-icon" src="<?php echo base_url(); ?>assets/admin/images/calendar.svg">
    							</div>
							</div>
                           </div>

                        </div>
                    </div>
                    <!-- <div class="mr-4">
                        <label>Start Date</label>
                        <div class="dropdown">
                            <input type="text" class="form-control" id="datepickerstart_filter" data-toggle="datetimepicker" data-target="#datepickerstart_filter"/>
                        </div>
                    </div>
                    <div class="mr-4">
                        <label>End Date</label>
                        <div class="dropdown">
                            <input type="text" class="form-control" id="datepickerend_filter" data-toggle="datetimepicker" data-target="#datepickerend_filter"/>
                        </div>
                    </div> -->
					<div class="text-red fs-16 clear-all ">
                    <label class="fs-14"></label>
                    <div id="clear-filters" class="clearnew">Clear all filters</div>
                </div>
                </div>

            </div>
            <div class="table-main h-100 collapse-view">
                <div class="row h-100">
                    <!-- List Pane -->
                    <div id="table_container" class="col-12">
                        <div id="bulkaction-container" style="display:none;">
                            <div class="tableheader  bg-white" >
                                <div  class="hidediv__header--title">
                                    <div class="checklist" align="center">
                                        <span class="custom-checkbox">
                                            <input type="checkbox" class="select-all-record" id="theadCheckbulk">
                                            <label for="theadCheckbulk"></label>
                                        </span>
                                    </div>
                                    <div class="tagname">Selected (<span id="bulkselected">0</span>)</div>
                                </div>
                                <div class="sidediv__header--button bulkactionbtn-container" >
                                    <span class="icon-expand">
                                        <img src="<?php echo base_url(); ?>assets/admin/images/ionic-ios-expand.svg">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <table id="myTable" class="table-main__admin" cellspacing="0" cellpadding="0">
                            <thead>

                                    <td class="checklist" align="center">
                                        <span class="custom-checkbox">
                                            <input type="checkbox" class="select-all-record" id="theadCheck">
                                            <label for="theadCheck"></label>
                                        </span>
                                    </td>
                                    <td class="text-nowrap">Report ID, Categories, Location</td>
                                    <td>
                                        Posted By, Date, Action
                                        <span class="icon-expand hideSplitView">
                                            <img src="<?php echo base_url(); ?>assets/admin/images/ionic-ios-expand.svg">
                                        </span>
                                    </td>
                                    <td class="report-id">Report ID</td>
                                    <td class="category">Category</td>
                                    <td class="location table-fs-light">Location</td>
                                    <td class="posted-by table-fs-light">Posted By</td>
                                    <td class="date table-fs-light">Date</td>
                                    <td class="action">Action</td>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <!-- List Pane End -->

                    <!-- Detail Pane -->
                    <div id="detail_container" class="col-53 pl-0 d-none">
                        <div class="table-open table-open__incidents">
                            <div class="table-open__header bg-white">
                                <div id="datail_id" class="table-open__header--title">
                                    #1234
                                </div>
                                <div class="table-open__header--button" id="detail_actions">
                                    <!-- <button class="btn fs-17 text-red pl-0">Download</button> -->
                                   <!--  <button class="btn fs-17 text-red pl-0 detail-button">Trash</button>
                                    <button class="btn fs-17 text-red pl-0 detail-button">Reject</button>
                                    <button class="btn fs-17 text-grey pl-0 detail-button" id="editField">Edit</button>
                                    <button class="btn fs-17 text-grey pl-0 edit-button" id="saveChanges">Save</button>
                                    <button class="btn fs-17 text-primary pl-0 detail-button">Approve</button>
                                    <button class="btn btn btn-primary fs-17 detail-button">Publish</button> -->
                                </div>
                            </div>
                            <div class="table-open__content incidents edit-field">
                                <div class="posted__title">
                                    <span id="detail_category_title">Stalking, Taking pictures, Physical Assault</span>
                                    <span id="detail_posted_by">Posted By: <span id="detail_created_by">Member Name</span></span>
                                </div>
                                <form id="editIncidentForm">
                                    <div id="edit_div" style="display: none;">

                                    </div>
                                </form>
                                <div class="edit-field__content">
                                    <div class="label fs-17">Incident Description</div>
                                    <div id="detail_description"   disabled="">Lorem Ipsum is simply dummy text
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
                                        <div class="border-left--title">
                                            Address
                                        </div>
                                        <div class="border-left--input">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="label fs-15">Builing/locality/street/area</div>
                                                    <input id="detail_locality" class="form-control" disabled="" value="Colaba street">
                                                </div>
                                                <div class="col-12">
                                                    <div class="label fs-15">Landmark</div>
                                                    <input id="detail_landmark" class="form-control" disabled="" value="-">
                                                </div>
                                                <div class="col-6">
                                                    <div class="label fs-15">City</div>
                                                    <input id="detail_city" class="form-control" disabled="" value="-">
                                                </div>
                                                <div class="col-6">
                                                    <div class="label fs-15">State</div>
                                                    <input id="detail_state" class="form-control" disabled="" value="-detail_country">
                                                </div>
                                                <div class="col-12">
                                                    <div class="label fs-15">Country</div>
                                                    <input id="detail_country" class="form-control" disabled="" value="India">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="label fs-15">Address</div>
                                        <input id="detail_address" class="form-control" disabled="" value="">
                                        <div class="mapouter" id="detail_map" style="height:467px"></div>
                                        <!-- <img src="<?php echo base_url(); ?>assets/admin/images/googl_ED.png"> -->
                                    </div>
                                    <div id="detail_other_forms" class="col-12">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Detail Pane End -->
                </div>
            </div>
        </div>
    </div>

    <!-- Download Incident Modal -->
    <div class="modal fade" id="downloadIncidents" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="incident-title">Please select which incidents you would like to download</div>
                    <div class="download-incident">
                    <div class="row">
                        <div class="col-md-12">
                           <div class="newrangein ">


                        <div class="dropdown ">
                            <div class="input-group input-daterange">
							<div class="row">
							<div class="col-5">
							   <label >Start Date</label>
                                <input type="text" id="datepickerstart_export" class="form-control">
                                <img class="calendar-iconone" src="<?php echo base_url(); ?>assets/admin/images/calendar.svg">
								</div>

								<span class="centertext">to</span>

								<div class="col-5" style="padding-right:0;">
								<label >End Date</label>
                                <input type="text" id="datepickerend_export" class="form-control">
                                <img class="calendar-iconone" src="<?php echo base_url(); ?>assets/admin/images/calendar.svg">
								</div>
								</div>
                           </div>

                        </div>
                    </div>
                            </div>

                        <div class="col-md-12">
                            <div class="inputGroup custom-control  download-incident__sel">
                              <input type="checkbox" id="1" data-id="1" name="option7" class="custom-control-input getAttr dynamic-checkbox" value="pending_approval" data-parentid="0" data-ismain="1" data-val="Rape/Sexual Assault" data-hassuboptions="false" data-showtextbox="false">
                              <label class="custom-control-label label1" for="1"> Approval Pending</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="inputGroup custom-control download-incident__sel">
                              <input type="checkbox" id="2" data-id="1" name="option7" class="custom-control-input getAttr dynamic-checkbox" value="approved" data-parentid="0" data-ismain="1" data-val="Chain Snatching/Robbery" data-hassuboptions="false" data-showtextbox="false">
                              <label class="custom-control-label label1" for="2"> Approved</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="inputGroup custom-control download-incident__sel">
                              <input type="checkbox" id="3" data-id="1" name="option7" class="custom-control-input getAttr dynamic-checkbox" value="saved" data-parentid="0" data-ismain="1" data-val="Domestic Violence" data-hassuboptions="false" data-showtextbox="false">
                              <label class="custom-control-label label1" for="3"> Saved for Later</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="inputGroup custom-control download-incident__sel">
                              <input type="checkbox" id="4" data-id="1" name="option7" class="custom-control-input getAttr dynamic-checkbox" value="published" data-parentid="0" data-ismain="1" data-val="Physical assault" data-hassuboptions="false" data-showtextbox="false">
                              <label class="custom-control-label label1" for="4">Published</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="inputGroup custom-control download-incident__sel">
                              <input type="checkbox" id="5" data-id="1" name="option7" class="custom-control-input getAttr dynamic-checkbox" value="rejected" data-parentid="4" data-ismain="0" data-val="Stalking" data-hassuboptions="false" data-showtextbox="false">
                              <label class="custom-control-label label1" for="5">   Rejected</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="inputGroup custom-control download-incident__sel">
                              <input type="checkbox" id="6" data-id="1" name="option7" class="custom-control-input getAttr dynamic-checkbox" value="trashed" data-parentid="4" data-ismain="0" data-val="Ogling/Facial Expressions/Staring" data-hassuboptions="false" data-showtextbox="false">
                              <label class="custom-control-label label1" for="6"> Trash</label>
                            </div>
                        </div>
                    </div>
                    <div class="invalid-msg text-danger">Error</div>
                    <button type="button" class="btn btn-primary " id="exportBtn">Done</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <!-- createnew -->
    <div class="modal fade" id="createnew" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
             <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="incident-title">Please enter settings below to create incident report</div>
                    <div class="createnew">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label >Language</label>
                                    <div class="dropdown">
                                        <select id="type_filter" class="custom-select custom-select-sm select2">
                                          <option value="" selected>All</option>
                                          <option value="1">Primary Form</option>
                                          <option value="2">Primary + Secondary Form</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <button type="button" class="btn btn-primary " data-dismiss="modal">Done</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Footer -->
<?php $this->load->view('admin/includes/footer'); ?>
<script src="https://maps.google.com/maps/api/js?key=AIzaSyA-RG4hM7qRh3jHfOwSuUOBexPTn0CZf6w&libraries=geometry,places" async defer></script>
<script type="text/javascript">
var categories = <?php echo $categories; ?>;
</script>
<script src="<?php echo base_url(); ?>application/modules/admin/incident/scripts/incident.js"></script>
<script src="<?php echo base_url(); ?>application/modules/admin/incident/scripts/EditAddressForm.js"></script>
<script src="<?php echo base_url(); ?>application/modules/admin/incident/scripts/incidentEditForm.js"></script>


</body>
</html>