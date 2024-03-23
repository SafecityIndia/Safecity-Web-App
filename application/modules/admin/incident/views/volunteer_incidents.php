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
            <div class="searchbar newsearch">
                <input class="form-control" id="search_filter" placeholder="Search">
                <img class="search-icon" src="<?php echo base_url(); ?>assets/admin/images/Icon 01.svg">
            </div>
        </div>
    </div>
    <div class="admin-table-content">
            <div class="table-main h-100 collapse-view">
                <div class="row h-100">
                    <!-- List Pane -->
                    <div id="table_container" class="col-12">
                        <table id="myVolunteerTable" class="table-main__admin" cellspacing="0" cellpadding="0">
                            <thead>
								<tr>
                                    <td>Volunteer Code</td>
                                    <td>Category</td>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <!-- List Pane End -->
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
</body>
</html>