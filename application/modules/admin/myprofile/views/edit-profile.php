<!-- header placeholder -->
<?php $this->load->view('admin/includes/header'); ?>
    <style>
	.admin-table-content
	{
		display:flex;
	}
     .error{
        color: red !important ;
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

    <div class="admin-table-content">
        <div class="admin-table__main">
            <div class="table-main h-100 collapse-view">
                <div class="row h-100">
                    <div class="col-6">
						<div class="profilemain">
                            <form id="update_profile"   method="post">
                                <div class="profileimg">
                                <img src="<?php echo !empty($profile_data->avatar)? base_url('assets/uploads/admin_avatars/'.$profile_data->avatar) : base_url('assets/admin/images/profile.jpg'); ?>" class="img-fluid img_tag"/>

                                <input type="file" accept="image/*" name="profile_pic" class="input_file">
                                <input type="hidden" name="profile_pic" value="<?= !empty($profile_data->avatar)?$profile_data->avatar :''; ?>">
                                </div>
                                <br><br>
			                    <!-- <a  href="#">Edit Profile Picture</a> -->

                    			<div class="neweditin">
                                    <label>First Name</label>
                                	<input type="text" id="edittitle" class="form-control parent-option-field" value="<?= !empty($profile_data->first_name)?$profile_data->first_name :''; ?>" name="first_name" data-required="true">
                    				<div class="invalid-msg text-danger"></div>
                    			</div>

                                <div class="neweditin">
                                <label>Last Name</label>
                                <input type="text" class="form-control parent-option-field" value="<?= !empty($profile_data->last_name)?$profile_data->last_name :''; ?>"  name="last_name"  >
                                <div class="invalid-msg text-danger"></div>
                                </div>
                    			<div class="neweditin">
                                    <label>User Name</label>
                                	<input type="text" id="editdescription" class="form-control parent-option-field"  name="user_name"  value="<?= !empty($profile_data->username)?$profile_data->username :''; ?>" data-required="true">
                    				<div class="invalid-msg text-danger"></div>
                    			</div>

                    			<div class="neweditin">
                    				<label>Email ID</label>
                                	<input type="text" id="search_address" name="email" placeholder="Start Typing" class="form-control parent-option-field pac-target-input" value="<?= !empty($profile_data->email)?$profile_data->email :''; ?>" autocomplete="off">
                                    <span id="mail_error"></span>
                                </div>

                    		 <!-- <button id="get_submit" class="btn btn-primary create-new" >Save Changes</button> -->
                              <input type="submit"  id="get_submit" name="submit" class="btn btn-primary create-new" value="Save Changes">
                        </form>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Footer -->
<?php $this->load->view('admin/includes/footer'); ?>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

<script>

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
            $('.img_tag').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

    $(".input_file").change(function() {
        readURL(this);
    });



$('#update_profile').submit(function(e){
      e.preventDefault();

      var formData = new FormData(this);


          $('#update_profile').validate({
             rules: {
                 first_name: {
                     required: true,
                    // lettersonly: true                     //lettersonly: true,

                 },
                 last_name: {
                     required: true,
                    // lettersonly: true                     //lettersonly: true,

                 },
                  user_name: {
                     required: true                   //lettersonly: true,

                 },
                  email: {
                     required: true,
                     email: true
                 }
             },
             messages: {

                 first_name: {
                     required: 'Please enter first name'
                 },
                 last_name: {
                     required: 'Please enter last name'
                   
                 },
                  user_name: {
                     required: 'Please enter user name',
                   
                 },
                 email: {
                     required: 'Please enter your email',
                     email: 'Enter valid email id'
                 
   
                 }
                
             }
         });

          jQuery.validator.addMethod("lettersonly", function(value, element) {
                    return this.optional(element) || /^[a-zA-Z\s]+$/i.test(value);
                    }, "Name containt Letters only"); 


         var isvalidate = $("#update_profile").valid();
           if(isvalidate){
          $.ajax(
              {
                url:  baseURL+'admin/my-profile/update',
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
                        document.getElementById('update_profile').reset();
                        window.location.href = baseURL+"admin/my-profile";
                        // $('#success_message').html('<div class="alert alert-success" role="alert">Profile update successfully.</div>');
                        // setTimeout(function() {
                        // $('#success_message').html(" ");
                        //   }, 2000 );
                     }
                    else{
                         $('#mail_error').html('<label  class="error">'+result.success_alert+'</label>');
                    }
                },
                error: function(response) {
                  alert("error"); 
                  //console.log(response);
                }
          });
      }
});
    
</script>
</body>
</html>