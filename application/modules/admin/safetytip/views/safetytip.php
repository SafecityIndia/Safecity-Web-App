<!-- header placeholder -->
<?php $this->load->view('admin/includes/header'); ?>

    <div class="admin-table-header bg-white">
        <?php $this->load->view('admin/includes/topbar'); ?>
        <div class="admin-table-header__options">
            <div class="title">
                Safety Tips
            </div>
            <div class="upload-download-new newtabinn">
			<div class="getin">
                <a id="importRecordBtn" class=" align-items-center px-2">
                    <img src="<?php echo base_url(); ?>assets/admin/images/Icon feather-download.svg">
                    <span > Upload Safety Tips</span>

                </a>
				<p class="px-2" id="download_sample_import_file"> <i class="fas fa-arrow-down"></i>get file format  for upload</p>
				</div>
                <form id="importRecordForm" method="post" enctype="multipart/form-data" action="<?=base_url();?>/admin/safety-tips/import">
                    <input id="importFile" type="file" name="import_file" accept=".csv" class="d-none">
                </form>
                <a class="d-flex align-items-center px-2" id="exportRecordBtn" data-target="#exportRecordModal">
                    <img src="<?php echo base_url(); ?>assets/admin/images/Icon feather-download (1).svg">
                    <span >Download Safety Tips</span>
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
                <strong>Unable to upload safety tips due to some errors:!</strong>
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
            <div class="searchbar">
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
                    <div class="newrange " style="width:75%;">
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
                                    <td class="text-nowrap">Title, Location</td>
                                    <td>
                                        Posted By, Date, Action
                                        <span class="icon-expand hideSplitView">
                                            <img src="<?php echo base_url(); ?>assets/admin/images/ionic-ios-expand.svg">
                                        </span>
                                    </td>
                                    <td class="report-id">Title</td>
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
                                    View Safety Tip
                                </div>
                                <div class="table-open__header--button" id="detail_actions">
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
                                    <div class="label fs-17">Safety Tip</div>
                                    <div id="detail_description"  >Lorem Ipsum is simply dummy text
                                    </div>
                                </div>
                                <div class="edit-field__content row">
                                    <div class="col-12">
                                        <div class="label fs-15">Address</div>
                                        <input id="detail_address" class="form-control" disabled="" value="">
                                        <div class="mapouter" id="detail_map" style="height:467px"></div>
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

    <!-- Download Record Modal -->
    <!-- Download Incident Modal -->
    <div class="modal fade" id="exportRecordModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="incident-title">Please select which safety tips you would like to download</div>
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
            								<div class="col-5" >
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
                              <input type="checkbox" id="export_approval_pending" class="custom-control-input getAttr dynamic-checkbox" value="pending_approval">
                              <label class="custom-control-label label1" for="export_approval_pending"> Approval Pending</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="inputGroup custom-control download-incident__sel">
                              <input type="checkbox" id="export_approved" class="custom-control-input getAttr dynamic-checkbox" value="approved">
                              <label class="custom-control-label label1" for="export_approved"> Approved</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="inputGroup custom-control download-incident__sel">
                              <input type="checkbox" id="export_saved" class="custom-control-input getAttr dynamic-checkbox" value="saved">
                              <label class="custom-control-label label1" for="export_saved"> Saved for Later</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="inputGroup custom-control download-incident__sel">
                              <input type="checkbox" id="export_published" class="custom-control-input getAttr dynamic-checkbox" value="published">
                              <label class="custom-control-label label1" for="export_published">Published</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="inputGroup custom-control download-incident__sel">
                              <input type="checkbox" id="export_rejected" class="custom-control-input getAttr dynamic-checkbox" value="rejected"><label class="custom-control-label label1" for="export_rejected">Rejected</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="inputGroup custom-control download-incident__sel">
                              <input type="checkbox" id="export_trash" class="custom-control-input getAttr dynamic-checkbox" value="trashed"><label class="custom-control-label label1" for="export_trash">Trash</label>
                            </div>
                        </div>
                    </div>
                    <div class="invalid-msg text-danger">Errro</div>
                    <button type="button" class="btn btn-primary" id="exportBtn" >Done</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Download Record Modal End -->

    <!-- Footer -->
    <?php $this->load->view('admin/includes/footer'); ?>
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyA-RG4hM7qRh3jHfOwSuUOBexPTn0CZf6w&libraries=geometry,places" async defer></script>
    <script src="<?php echo base_url(); ?>application/modules/admin/incident/scripts/EditAddressForm.js"></script>
    <script src="<?php echo base_url(); ?>application/modules/admin/safetytip/scripts/recordEditForm.js"></script>
    <script src="<?php echo base_url(); ?>application/modules/admin/safetytip/scripts/safetytip.js"></script>

</body>
</html>
