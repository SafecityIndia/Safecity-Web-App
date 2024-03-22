<!-- header placeholder -->
<?php $this->load->view('admin/includes/header'); ?>

    <div class="admin-table-header bg-white">
        <?php $this->load->view('admin/includes/topbar'); ?>
        <div class="admin-table-header__options">
            <div class="title">
                Download Incidents
            </div>
			<div class="getin">
				<label >Category</label>
				<div class="dropdown">
					<select id="category_filter" class="custom-select custom-select-sm">
					  <!-- Option Placeholder -->
					</select>
				</div>
            </div>
			<div class="getin">
				<label >Form Type</label>
				<div class="dropdown">
					<select id="type_filter" class="custom-select custom-select-sm">
					  <option value="">All</option>
					  <option value="primary">Primary Form</option>
					  <option value="secondary">Secondary Form</option>
					</select>
				</div>
            </div>
			<div class="upload-download-new newtabinn">
                <a class="d-flex align-items-center px-2" id="exportReportBtn">
                    <img src="<?php echo base_url(); ?>assets/admin/images/Icon feather-download (1).svg">
                    <span>Download Incidents</span>
                </a>
				
            </div>
        </div>
        <!-- Record Import Status -->
    </div>
    <div class="admin-table-content">
        <div class="admin-table__main">
            <div class="table-main h-100 collapse-view">
                <div class="row h-100">
                    <!-- List Pane -->
                    <div id="table_container" class="col-12">
                        <table id="reportTable" class="table-main__admin" cellspacing="0" cellpadding="0">
                            <thead>
								<tr>
                                    <th>Report ID</th> 
                                    <th>Status</th>
                                    <th>Form Type</th>
									<th>Question</th>
                                    <th>Answer</th>									
                                    <th>Client ID</th>
                                    <th>Lang ID</th>
                                    <th>User ID</th>
                                    <th>Age</th>
                                    <th>Description</th>
                                    <th>Categories</th>
                                    <th>Reported To Police</th>
                                    <th>Attack Reason</th>
                                    <th>Additional Details</th>
                                    <th>Building</th>
                                    <th>Landmark</th>
                                    <th>Area</th>
                                    <th>City</th>
                                    <th>State</th>
                                    <th>Country</th>
                                    <th>Lattitude</th>
                                    <th>Longitude</th>
                                   <th>Platform</th>
                                    <th>App Version</th> 
                                    <th>Date</th>
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
<script src="<?php echo base_url(); ?>application/modules/admin/incident/scripts/incidentreport.js"></script>
<script src="<?php echo base_url(); ?>application/modules/admin/incident/scripts/EditAddressForm.js"></script>
<script src="<?php echo base_url(); ?>application/modules/admin/incident/scripts/incidentEditForm.js"></script>
</body>
</html>