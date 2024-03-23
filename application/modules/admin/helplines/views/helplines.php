<!-- header placeholder -->
<?php $this->load->view('admin/includes/header'); ?>
    <style type="text/css">
        .invalid-msg {
            color: red;
        }
    </style>
    <div class="admin-table-header bg-white">
        <?php $this->load->view('admin/includes/topbar'); ?>
        <div class="admin-table-header__options">
            <div class="title">
                Helplines
            </div>
        </div>
    </div>
    <div class="admin-table-content newtop">
        <div class="admin-table__main">
			<div class="filters__loc-time bg-white">
                <div class="mr-4">
                    <label class="fs-15"></label>
                    <div>Filters</div>
                </div>
                <div class="loc-time--holder mr-4">	
                    <div class="mr-4">
                        <label>Country</label>
                        <div class="dropdown">
                            <select id="country_filter" class="custom-select custom-select-sm init-select2">
								<option value="">All</option>
                              <?php foreach ($countries as $country): ?>
							  <?php
							  if($_SESSION['user_id']==30){
							  ?>
                                <option value="<?=$country['id']?>" selected><?=$country['name']?></option>
								<?php
							  }else{
								?>
								
								<option value="<?=$country['id']?>"><?=$country['name']?></option>
								<?php
							  }
							  ?>
                              <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
					
					<div class="mr-4">
                        <label>Language</label>
                        <div class="dropdown">
                            <select id="language_filter" class="custom-select custom-select-sm init-select2">
                              <option value="" selected>All</option>
                              <?php foreach ($languages as $language): ?>
                                <option value="<?=$language['id']?>"><?=$language['name']?></option>
                              <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
					
					<div class="mr-4">
                        <label>Gender</label>
                        <div class="dropdown">
                            <select id="gender_filter" class="custom-select custom-select-sm init-select2">
                              <option value="" selected>All</option>
                                <option value="2">BOTH</option>
                                <option value="1">FEMALE</option>
                                <option value="3">MALE</option>
                            </select>
                        </div>
                    </div>
					
                </div>
                <div class="text-red fs-17 clear-all">
                    <label class="fs-15"></label>
                    <div id="clear-filters" class="clearnew">Clear all filters</div>
                </div>
				
				<div class="text-red fs-17 clear-all">
                    <label class="fs-15"></label>
                    <a class="btn btn-sm btn-primary" id="new_language" data-toggle="modal" data-target="#exampleModalLong" href="javascript:void(0);">Add New Helpline</a>
					
					<!-- Modal -->
					<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
					  <div class="modal-dialog" role="document">
						<div class="modal-content">
						  <div class="modal-header">
							<h5 class="modal-title" id="exampleModalLongTitle">Add New Helpline For - </h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							  <span aria-hidden="true">&times;</span>
							</button>
						  </div>
							<form id="update_optiontitle" class="update_optiontitle" method="post">
								<div class="modal-body">
								  <div class="form-group">
									<label for="recipient-name" class="col-form-label">Language:</label>
									<select name="language_id" class="form-control" id="language_id">
										<option value="">Select Language</option>
									</select>
								  </div>
								  
								  <div class="form-group">
									<label for="category_id" class="col-form-label">Category:</label>
									<select name="category_id" class="form-control" id="category_id">
										<option value="">Select Category</option>
									</select>
								  </div>
								  
								   <div class="form-group">
									<label for="gender" class="col-form-label">Gender:</label>
									<select name="gender" class="form-control" id="gender">
										<option value="2">BOTH</option>
										<option value="1">FEMALE</option>
										<option value="3">MALE</option>
									</select>
								  </div>
								  
								  <div class="form-group">
									<label for="gender" class="col-form-label">Emergency Title:</label>
									<input type="text" name="title" class="form-control" id="title" />
								  </div>
								  
								  <div class="form-group">
									<label for="gender" class="col-form-label">Emergency No:</label>
									<input type="text" name="emerg_no" class="form-control" id="emerg_no" />
								  </div>
								  
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary" id="savetitle" >Save changes</button>
								</div>
							</form>
						</div>
					  </div>
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
                                  
                                    <td align="center">Emergency Title</td>
                                    <td>Emergency No.</td>
                                    <td>Country</td>
                                    <td>Language</td>
                                    <td>Gender</td>
									 <td>Category</td>
                                    <td>Action</td>
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
                                    View User
                                </div>
                                <div class="table-open__header--button" id="detail_actions">
                                    <button class="btn fs-17 text-red pl-0">Remove</button>
                                    <button class="btn fs-17 text-primary pl-0" id="editField">Edit
                                        Profile</button>
                                </div>
                            </div>
                            <div class="table-open__content incidents edit-field">
                                <div id="show_div" class="view-user-detail">
                                    <div class="view-user-detail-img">
                                        <img class="object-fit-cover--img" id="detail_avatar" src="<?php echo base_url() ?>assets/admin/images/profile.jpg" alt="">
                                    </div>
                                    <div class="view-user-detail--text">
                                        <div class="posted__title">
                                            <span id="detail_name"></span>
                                            <span></span>
                                        </div>
                                        <div class="edit-field__content row pl-0">
                                            <div class="col-6">

                                                <div class="label fs-15">Username</div>
                                                <input class="form-control" id="detail_username" disabled="" value="S-admin">
                                            </div>
                                            <div class="col-6">
                                                <div class="label fs-15">Email ID</div>
                                                <input class="form-control" id="detail_email" disabled=""
                                                    value="sheryl@gmail.com">
                                            </div>
                                            <div class="col-12">
                                                <div class="label fs-15">Access</div>
                                                <input class="form-control" id="detail_permission" disabled=""
                                                    value="Dashboard, Incidents, Safety Tips, Clients, Chat">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="edit_div" style="display: none;" class="view-user-detail">
                                    <div class="row pl-0">
                                            <div class="col-12">
								   <div class="posted__title pb-3 newnaming">
                                        <span id="edit_name">Sheryl Dsouza</span>
                                        <span></span>
                                    </div>
                                    <div class="view-user-detail-img userimgin mb-3">

                                        <img class="img-fluid " id="edit_user_avatar" src="<?php echo base_url() ?>assets/admin/images/profile.jpg" alt="">
                                      <input type="file" id="upload_avatar">
									</div>
									<div class="editpro">
									<a href="javascript:void(0);" id="trigger_fileupload">Edit Profile Picture</a>
									</div>
                                    <div class="view-user-detail--text">
                                        <div class="row pl-0">
                                            <div class="col-12">
											<div class="form-group">
                                                <div class="label fs-15">First name</div>
                                                <input class="form-control" id="edit_first_name" value="Sherly" data-required="true">
                                                <div class="invalid-msg"></div>
                                            </div>
											  </div>
                                            <div class="col-12">
											<div class="form-group">
                                                <div class="label fs-15">Last name</div>
                                                <input class="form-control" id="edit_last_name" value="Sherly" data-required="true">
                                                <div class="invalid-msg"></div>
                                            </div>
											</div>
                                            <div class="col-12">
											<div class="form-group">
                                                <div class="label fs-15">Username</div>
                                                <input class="form-control" id="edit_username" value="S-admin" data-required="true">
                                                <div class="invalid-msg"></div>
                                            </div>
											  </div>
                                            <div class="col-12">
											<div class="form-group">
                                                <div class="label fs-15">Email ID</div>
                                                <input type="email" class="form-control" id="edit_email" value="sheryl@gmail.com" data-required="true">
                                                <div class="invalid-msg"></div>
                                            </div>
											</div>
                                            <div class="col-12">
											<div class="form-group">
                                                <div class="label fs-15" id="password_label">Password (leave blank to keep unchanged)</div>
                                                <input type="password" class="form-control" id="edit_password">
                                                <div class="invalid-msg"></div>
                                            </div>
											</div>
                                            <div class="col-12 mb-4">
											<div class="form-group">
                                                <div class="label fs-15">Access</div>
                                                <span class="d-inline-block align-middle">
                                                    <input type="radio" id="all_access" name="role" value="superadmin" data-roleid="1" checked>
                                                    <label class="fs-17" for="all_access">Super Admin</label>
                                                </span>
                                                <span class="d-inline-block align-middle ml-2">
                                                    <input type="radio" id="restricted_access" name="role" value="admin" data-roleid="2">
                                                    <label class="fs-17" for="restricted_access">Limited Access</label>
                                                </span>
                                            </div>
											 </div>
                                            <div class="col-12" id="available_permissions">
                                                <?php foreach ($permissions as $permission): ?>
                                                        <div class="custom-checkbox mb-2">
                                                            <input type="checkbox" id="<?=$permission['key']?>" value="<?=$permission['id']?>">
                                                            <label class="fs-15" for="<?=$permission['key']?>">
                                                                <span class="d-inline-block pl-2"><?=$permission['name']?></span>
                                                            </label>
                                                        </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
									 </div>
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

    <!-- Footer -->
    <?php $this->load->view('admin/includes/footer'); ?>
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyA-RG4hM7qRh3jHfOwSuUOBexPTn0CZf6w&libraries=geometry,places" async defer></script>
    <script src="<?php echo base_url(); ?>application/modules/admin/helplines/scripts/recordEditForm.js"></script>
    <script src="<?php echo base_url(); ?>application/modules/admin/helplines/scripts/helplines.js"></script>

<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script>
$(document).on('submit', '.update_optiontitle', function(e){
// $('.update_optiontitle').submit(function(e){
      e.preventDefault();
      var formData = new FormData(this);
	  formData.append("country", $("#country_filter").val());
	  // formData.append("language", $("#language_filter").val());
          $('.update_optiontitle').validate({
             rules: {
                 language_id: {
                     required: true,                    //lettersonly: true,
                 },
				 title: {
                     required: true,                    //lettersonly: true,
                 },
				 emerg_no: {
                     required: true,                    //lettersonly: true,
                 },
             },
             messages: {
                language_id: {
                    required: 'Please select language'
                },
				title: {
                    required: 'Please enter title'                    //lettersonly: true,
                 },
				emerg_no: {
                    required: 'Please enter number'                  //lettersonly: true,
                },
             }
         });

         var isvalidate = $(".update_optiontitle").valid();
           if(isvalidate){
			$.ajax({
                url:  baseURL+'admin/helplines/addhelpline',
				type: "POST",
                data:formData,
                processData:false,
                contentType:false,
                cache:false,
                async:false,
                success: function(response) 
                {
                    result =  JSON.parse(response);
					console.log(result);
                    if(result.status == true){
						$('.modal').modal('hide');
						$('.modal-backdrop').modal('hide');
						$("div").removeClass("modal-backdrop");
						// document.getElementById('country_filter').value = result.country;
						// document.getElementById('language_filter').value = result.language;
                        window.location.href = baseURL+"admin/helplines";	
                    }
                    else{  
						window.location.href = baseURL+"admin/helplines";	
                    }
                },
                error: function(response) {
                  alert("error");
                }
			});
      }
});
</script>
</body>
</html>