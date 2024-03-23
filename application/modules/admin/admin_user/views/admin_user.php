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
                User Profiles
            </div>
            <div class="upload-download-new">
                <button class="btn btn-primary create-new" id="create-new-button">Add User</button>
            </div>
        </div>
    </div>
    <div class="admin-table-content newtop">
        <div class="admin-table__main">
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
                                    <td>Name, Username</td>
                                    <td>
                                        Access, Email ID, Action
                                        <span class="icon-expand hideSplitView">
                                            <img src="<?php echo base_url(); ?>assets/admin/images/ionic-ios-expand.svg">
                                        </span>
                                    </td>
                                    <td align="center">Name</td>
                                    <td>Username</td>
                                    <td>Email ID</td>
                                    <td>Access</td>
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
    <script src="<?php echo base_url(); ?>application/modules/admin/admin_user/scripts/recordEditForm.js"></script>
    <script src="<?php echo base_url(); ?>application/modules/admin/admin_user/scripts/admin_user.js"></script>

</body>
</html>
