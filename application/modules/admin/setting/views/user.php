<!-- header placeholder -->
<?php $this->load->view('admin/includes/header'); ?>

    <div class="admin-table-header bg-white">
        <?php $this->load->view('admin/includes/topbar'); ?>
        <div class="admin-table-header__options">
            <div class="title">
                Settings
            </div>
        </div>
    </div>
    <div class="admin-table-content">
        <div class="admin-table__sidebar bg-white">
            <div class="admin-table__sidebar--content">
                <a>Dashboard Settings</a>
                <a class="active">User Profiles</a>
                <a href="<?php echo base_url('myprofile/my-profile') ?>">My Profile</a>
            </div>
        </div>
        <div class="admin-table__main">
            <div>
                <div class="admin-table-header__options m-0 p-4 bg-white border-top-light">
                    <div class="title">
                        Users
                    </div>
                    <div class="upload-download-new">
                        <button class="btn btn-primary create-new" data-toggle="modal"
                            data-target="#incidentModal">Add User</button>
                    </div>
                </div>
            </div>
            <div class="table-main h-100 collapse-view">
                <div class="row h-100">
                    <div class="col-12">
                        <table id="myTable" class="table-main__admin" cellspacing="0" cellpadding="0">
                            <thead>
                                <tr>
                                    <td class="checklist" align="center">
                                        <span class="custom-checkbox">
                                            <input type="checkbox" id="theadCheck">
                                            <label for="theadCheck"></label>
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
                                <tr>
                                    <td align="center" class="checklist">
                                        <span class="custom-checkbox">
                                            <input type="checkbox" id="1">
                                            <label for="1"></label>
                                        </span>
                                    </td>
                                    <td class="table-fs-light">
                                        <div class="d-flex align-items-center">
                                            <div class="table-user--img">
                                                <img class="object-fit-cover--img" src="<?php echo base_url() ?>assets/admin/images/profile.jpg"
                                                    alt="">
                                            </div>
                                            <div><a href="<?php echo base_url() ?>admin/settings/detailed">ElsaMarie DSilva</a></div>
                                        </div>
                                    </td>
                                    <td>Safecity Admin</td>
                                    <td class="table-fs-light">elsamarie@safecity.com</td>
                                    <td class="table-fs-light">
                                        Super Admin
                                    </td>
                                    <td class="action">
                                        <div class="action--btn justify-content-start">
                                            <button class="btn text-red pl-0">Remove</button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" class="checklist">
                                        <span class="custom-checkbox">
                                            <input type="checkbox" id="2">
                                            <label for="2"></label>
                                        </span>
                                    </td>
                                    <td class="table-fs-light">
                                        <div class="d-flex align-items-center">
                                            <div class="table-user--img">
                                                <img class="object-fit-cover--img" src="<?php echo base_url() ?>assets/admin/images/profile.jpg"
                                                    alt="">
                                            </div>
                                            <div><a href="<?php echo base_url() ?>admin/settings/detailed">Tania Sharma</a></div>
                                        </div>
                                    </td>
                                    <td>T-123</td>
                                    <td class="table-fs-light">tania@safecity.com</td>
                                    <td class="table-fs-light">
                                        Dashboard, Incidents, Safety Tips, Clients, Chat
                                    </td>
                                    <td class="action">
                                        <div class="action--btn justify-content-start">
                                            <button class="btn text-red pl-0">Remove</button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" class="checklist">
                                        <span class="custom-checkbox">
                                            <input type="checkbox" id="3">
                                            <label for="3"></label>
                                        </span>
                                    </td>
                                    <td class="table-fs-light">
                                        <div class="d-flex align-items-center">
                                            <div class="table-user--img">
                                                <img class="object-fit-cover--img" src="<?php echo base_url() ?>assets/admin/images/profile.jpg"
                                                    alt="">
                                            </div>
                                            <div><a href="<?php echo base_url() ?>admin/settings/detailed">ElsaMarie DSilva</a></div>
                                        </div>
                                    </td>
                                    <td>Safecity Safecity Admin</td>
                                    <td class="table-fs-light">elsamarie@safecity.com</td>
                                    <td class="table-fs-light">
                                        Super Admin
                                    </td>
                                    <td class="action">
                                        <div class="action--btn justify-content-start">
                                            <button class="btn text-red pl-0">Thrash</button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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