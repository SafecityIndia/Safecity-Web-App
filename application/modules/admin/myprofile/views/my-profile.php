<!-- header placeholder -->
<?php $this->load->view('admin/includes/header'); ?>
    <style>
    .admin-table-content
    {
        display:flex;

    }
     .error{
            color: red;
        }
    </style>

    <div class="admin-table-header bg-white">
        <?php $this->load->view('admin/includes/topbar'); ?>
        <div class="admin-table-header__options">
            <div class="title">
                My Profile
            </div>
        </div>
    </div>
    <?php if (!empty($profile_data)) {  ?>
        <div class="admin-table-content">
        <div class="admin-table__main">
            <div class="table-main h-100 collapse-view">
            <div class="maineditprofile">
<div id="success_message">

</div>
                <div class="row h-100">

                    <div class="col-2 ">

                                <div class="profileimg mx-auto">
            <img src="<?php echo !empty($profile_data->avatar)? base_url('assets/uploads/admin_avatars/'.$profile_data->avatar) : base_url('assets/admin/images/profile.jpg'); ?>" class="img-fluid"/>

            </div>
             </div>

             <div class="col-8">
                        <div class="editprofile">
             <h6><?= !empty($profile_data->first_name) && !empty($profile_data->last_name)?$profile_data->first_name.' '.$profile_data->last_name :''; ?></h6>
                <a href="<?=base_url()?>admin/my-profile/edit">Edit Profile</a>


            <div class="editprofilein">
                <label>Name</label>
                <p><?= !empty($profile_data->username)?$profile_data->username :''; ?></p>
            </div>
            <div class="editprofilein">
                <label>Email ID</label>
                <p><?= !empty($profile_data->email)?$profile_data->email :''; ?></p>
            </div>

            <div class="editprofilein">
                <label>Access</label>
                <p><?php
               if (!empty($permissions)) {
                    $permission = array_column($permissions, 'name');
                    echo $tags = implode(', ', $permission);
               }
                 ?></p>
            </div>
            <div class="neweditin">
            <a href="#" data-target="#changepassword" data-toggle="modal">Reset Password</a>
            </div>


                                </div>
                   </div>
                </div>
                 </div>
            </div>
        </div>
    </div>
  <?php  } ?>
    <div class="modal fade" id="changepassword" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                    <form id="update_password"  method="post">
                        <div class="modal-body">
                            <div class="download-incident">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label>Current Password</label>
                                    <input type="password"  class="form-control" name="old_password" data-required="true">
                                    <span id="old_password_error"></span>
                                    </div>

                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label>New Password</label>
                                    <input type="password"  class="form-control new_password" id="new_password" name="new_password" data-required="true">

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label>Re-enter New Password</label>
                                    <input type="password"  class="form-control confirm_password" name="confirm_password" data-required="true">
                                    <div class="cnfm_pas_error"></div>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <!-- <button type="button" class="btn btn-primary" >Save Changes</button> -->
                            <input type="submit" name="submit" class="btn btn-primary" value="Save Changes">
                            <span id="success_msg"></span>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
<!-- Footer -->
<?php $this->load->view('admin/includes/footer'); ?>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script>

$('#update_password').submit(function(e){
      e.preventDefault();
      var formData = new FormData(this);


          $('#update_password').validate({
             rules: {
                 old_password: {
                     required: true,
                 },
                 new_password: {
                    required: true,
                    minlength : 6,

                 },
                  confirm_password: {
                    required: true,
                    minlength : 6,
                    equalTo : "#new_password"
                 }
             },
             messages: {

                 old_password: {
                    required: 'Please enter current password',
                 },
                 new_password: {
                    required: 'Please enter new password',
                    minlength : 'Please enter minimum 6 digit password' ,

                 },
                  confirm_password: {
                    required: 'Please enter re-enter rew password',
                    minlength : 'Please enter minimum 6 digit password' ,
                    equalTo:'Passwords do not match',

                 }

                 }

             });

         var isvalidate = $("#update_password").valid();

        if(isvalidate){
          $.ajax(
              {
                url:  baseURL+'admin/my-profile/update_password',
                type: "POST",
                data:formData,
                processData:false,
                contentType:false,
                cache:false,
                async:false,
                success: function(response)
                {
                    result =  JSON.parse(response);
                    if(result.status == true){
                        $('#success_msg').html('<label style="color:green">password updated successfully</label>');
                         window.setTimeout(function(){location.reload()},3000)
                     }
                    else{
                        $('#old_password_error').html('<label style="color:red">password does not match</label>');
                        // console.log('piu');
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
