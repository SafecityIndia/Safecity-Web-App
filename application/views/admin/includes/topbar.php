<div class="admin-table-header__profile">
    <div class="admin-table-header__profile--box">
        <div class="head-logout">
            <form action="<?php echo base_url(); ?>auth/logout" method="post">

                <button class="btn btn-light" type="submit">Logout</button>


            </form>
        </div>
        <div class="head-profile">
            <div>
                <?php
                    $user_data = $_SESSION['user_data'];
                    if(isset($user_data) && $user_data->avatar)
                        $avatar_url = base_url().'assets/uploads/admin_avatars/'.$user_data->avatar;
                    else
                        $avatar_url = base_url().'assets/admin/images/profile.jpg';
                    echo $user_data->first_name.' '.$user_data->last_name;
                ?>
            </div>
            <div class="head-profile--img">
                <img src="<?=$avatar_url?>" alt="">
            </div>
        </div>
    </div>
</div>
<!-- Client topbar -->
<?php if($_SESSION['is_subclient']): ?>
<div class="newadmin-table-header__options">
    <div class="title">
    </div>
    <div class="upload-download-new ">
        <a class="d-flex align-items-center px-2" href="<?=base_url()?>admin/clients">
            <span> Remove Client</span>
        </a>
    </div>
</div>
<?php endif; ?>
<!-- Client topbar end -->