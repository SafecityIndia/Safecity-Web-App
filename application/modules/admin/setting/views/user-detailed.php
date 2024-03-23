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
                <a>My Profile</a>
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
            <div class="table-main h-100 collapse-view mt-2">
                <div class="row h-100">
                    <div class="col-6 pr-0">
                        <table id="myTable" class="table-main__admin" cellspacing="0" cellpadding="0">
                            <thead>
                                <tr>
                                    <td class="checklist" align="center">
                                        <span class="custom-checkbox">
                                            <input type="checkbox" id="theadCheck">
                                            <label for="theadCheck"></label>
                                        </span>
                                    </td>
                                    <td align="">Name, Username</td>
                                    <td>Access, Email ID, Action</td>
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
                                    <td>
                                        <div class="d-flex">
                                            <div class="table-user--img">
                                                <img class="object-fit-cover--img" src="<?php echo base_url() ?>assets/admin/images/profile.jpg"
                                                    alt="">
                                            </div>
                                            <div>
                                                <div class="mb-2">ElsaMarie DSilva</div>
                                                <div class="mb-2">Safecity Admin</div>
                                                <div class="mb-2 table-fs-light">elsamarie@safecity.com
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="table-fs-light">
                                        <div class="mb-2">Super Admin</div>
                                        <div class="action--btn justify-content-start">
                                            <button class="btn text-red pl-0">Remove</button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" class="checklist">
                                        <span class="custom-checkbox">
                                            <input type="checkbox" id="1">
                                            <label for="1"></label>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="table-user--img">
                                                <img class="object-fit-cover--img" src="<?php echo base_url() ?>assets/admin/images/profile.jpg"
                                                    alt="">
                                            </div>
                                            <div>
                                                <div class="mb-2">ElsaMarie DSilva</div>
                                                <div class="mb-2">Safecity Admin</div>
                                                <div class="mb-2 table-fs-light">elsamarie@safecity.com
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="table-fs-light">
                                        <div class="mb-2">Super Admin</div>
                                        <div class="action--btn justify-content-start">
                                            <button class="btn text-red pl-0">Remove</button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" class="checklist">
                                        <span class="custom-checkbox">
                                            <input type="checkbox" id="1">
                                            <label for="1"></label>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="table-user--img">
                                                <img class="object-fit-cover--img" src="<?php echo base_url() ?>assets/admin/images/profile.jpg"
                                                    alt="">
                                            </div>
                                            <div>
                                                <div class="mb-2">ElsaMarie DSilva</div>
                                                <div class="mb-2">Safecity Admin</div>
                                                <div class="mb-2 table-fs-light">elsamarie@safecity.com
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="table-fs-light">
                                        <div class="mb-2">Super Admin</div>
                                        <div class="action--btn justify-content-start">
                                            <button class="btn text-red pl-0">Remove</button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" class="checklist">
                                        <span class="custom-checkbox">
                                            <input type="checkbox" id="1">
                                            <label for="1"></label>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="table-user--img">
                                                <img class="object-fit-cover--img" src="<?php echo base_url() ?>assets/admin/images/profile.jpg"
                                                    alt="">
                                            </div>
                                            <div>
                                                <div class="mb-2">ElsaMarie DSilva</div>
                                                <div class="mb-2">Safecity Admin</div>
                                                <div class="mb-2 table-fs-light">elsamarie@safecity.com
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="table-fs-light">
                                        <div class="mb-2">Super Admin</div>
                                        <div class="action--btn justify-content-start">
                                            <button class="btn text-red pl-0">Remove</button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" class="checklist">
                                        <span class="custom-checkbox">
                                            <input type="checkbox" id="1">
                                            <label for="1"></label>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="table-user--img">
                                                <img class="object-fit-cover--img" src="<?php echo base_url() ?>assets/admin/images/profile.jpg"
                                                    alt="">
                                            </div>
                                            <div>
                                                <div class="mb-2">ElsaMarie DSilva</div>
                                                <div class="mb-2">Safecity Admin</div>
                                                <div class="mb-2 table-fs-light">elsamarie@safecity.com
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="table-fs-light">
                                        <div class="mb-2">Super Admin</div>
                                        <div class="action--btn justify-content-start">
                                            <button class="btn text-red pl-0">Remove</button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" class="checklist">
                                        <span class="custom-checkbox">
                                            <input type="checkbox" id="1">
                                            <label for="1"></label>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="table-user--img">
                                                <img class="object-fit-cover--img" src="<?php echo base_url() ?>assets/admin/images/profile.jpg"
                                                    alt="">
                                            </div>
                                            <div>
                                                <div class="mb-2">ElsaMarie DSilva</div>
                                                <div class="mb-2">Safecity Admin</div>
                                                <div class="mb-2 table-fs-light">elsamarie@safecity.com
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="table-fs-light">
                                        <div class="mb-2">Super Admin</div>
                                        <div class="action--btn justify-content-start">
                                            <button class="btn text-red pl-0">Remove</button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" class="checklist">
                                        <span class="custom-checkbox">
                                            <input type="checkbox" id="1">
                                            <label for="1"></label>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="table-user--img">
                                                <img class="object-fit-cover--img" src="<?php echo base_url() ?>assets/admin/images/profile.jpg"
                                                    alt="">
                                            </div>
                                            <div>
                                                <div class="mb-2">ElsaMarie DSilva</div>
                                                <div class="mb-2">Safecity Admin</div>
                                                <div class="mb-2 table-fs-light">elsamarie@safecity.com
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="table-fs-light">
                                        <div class="mb-2">Super Admin</div>
                                        <div class="action--btn justify-content-start">
                                            <button class="btn text-red pl-0">Remove</button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-6 pl-0">
                        <div class="table-open">
                            <div class="table-open__header bg-white">
                                <div class="table-open__header--title">
                                    View User
                                </div>
                                <div class="table-open__header--button">
                                    <button class="btn fs-17 text-red pl-0">Remove</button>
                                    <button class="btn fs-17 text-primary pl-0" id="editField">Edit
                                        Profile</button>
                                </div>
                            </div>
                            <script>
                                window.onload = function () {
                                    var offsetValue = $(".table-open__header").outerHeight() - $(".dataTables_scrollHead").outerHeight()
                                    if(offsetValue < 0){
                                        var scrollHeight = $(".dataTables_scrollBody").outerHeight() + offsetValue
                                        $(".table-open__content").css("height", scrollHeight)
                                    }
                                    else{
                                        var scrollHeight = $(".dataTables_scrollBody").outerHeight() - offsetValue
                                        $(".table-open__content").css("height", scrollHeight)
                                    }
                                }
                            </script>
                            <div class="table-open__content edit-field">
                                <div class="view-user-detail">
                                    <div class="view-user-detail-img">
                                        <img class="object-fit-cover--img" src="<?php echo base_url() ?>assets/admin/images/profile.jpg" alt="">
                                    </div>
                                    <div class="view-user-detail--text">
                                        <div class="posted__title">
                                            <span>Sheryl Dsouza</span>
                                            <span></span>
                                        </div>
                                        <div class="edit-field__content row pl-0">
                                            <div class="col-6">
                                                <div class="label fs-15">Username</div>
                                                <input class="form-control" disabled="" value="S-admin">
                                            </div>
                                            <div class="col-6">
                                                <div class="label fs-15">Email ID</div>
                                                <input class="form-control" disabled=""
                                                    value="sheryl@gmail.com">
                                            </div>



                                            <div class="col-12">
                                                <div class="label fs-15">Access</div>
                                                <input class="form-control" disabled=""
                                                    value="Dashboard, Incidents, Safety Tips, Clients, Chat">
                                            </div>
                                            <div class="col-12">
                                                <div class="label fs-15">Password</div>
                                                <input class="form-control" disabled="" value="12345">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="view-user-detail d-block">
                                    <div class="posted__title pb-3">
                                        <span>Sheryl Dsouza</span>
                                        <span></span>
                                    </div>
                                    <div class="view-user-detail-img mb-3">
                                        <img class="object-fit-cover--img" src="<?php echo base_url() ?>assets/admin/images/profile.jpg" alt="">
                                    </div>
                                    <div class="view-user-detail--text">
                                        <div class="edit-field__content row pl-0">
                                            <div class="col-12">
                                                <div class="label fs-15">Username</div>
                                                <input class="form-control" value="S-admin">
                                            </div>
                                            <div class="col-12">
                                                <div class="label fs-15">Email ID</div>
                                                <input class="form-control" value="sheryl@gmail.com">
                                            </div>
                                            <div class="col-12">
                                                <div class="label fs-15">Access</div>
                                                <input class="form-control"
                                                    value="Dashboard, Incidents, Safety Tips, Clients, Chat">
                                            </div>
                                            <div class="col-12">
                                                <div class="label fs-15">Password</div>
                                                <input class="form-control" value="12345">
                                            </div>
                                            <div class="col-12 mb-4">
                                                <div class="label fs-15">Password</div>
                                                <span class="d-inline-block align-middle">
                                                    <input type="radio" id="test1" name="radio-group"
                                                        checked>
                                                    <label class="fs-17" for="test1">Super Admin</label>
                                                </span>
                                                <span class="d-inline-block align-middle ml-2">
                                                    <input type="radio" id="test2" name="radio-group"
                                                        checked>
                                                    <label class="fs-17" for="test2">Limited Access</label>
                                                </span>
                                            </div>
                                            <div class="col-12">
                                                <div class="custom-checkbox mb-2">
                                                    <input type="checkbox" id="a">
                                                    <label class="fs-15" for="a">
                                                        <span class="d-inline-block pl-2">Dashboard</span>
                                                    </label>
                                                </div>
                                                <div class="custom-checkbox mb-2">
                                                    <input type="checkbox" id="b">
                                                    <label for="b"><span
                                                            class="d-inline-block pl-2">Forms</span></label>
                                                </div>
                                                <div class="custom-checkbox mb-2">
                                                    <input type="checkbox" id="c">
                                                    <label for="c"><span
                                                            class="d-inline-block pl-2">Incidents</span></label>
                                                </div>
                                                <div class="custom-checkbox mb-2">
                                                    <input type="checkbox" id="d">
                                                    <label for="d"><span class="d-inline-block pl-2">Safety
                                                            Tips</span></label>
                                                </div>
                                                <div class="custom-checkbox mb-2">
                                                    <input type="checkbox" id="e">
                                                    <label for="e"><span
                                                            class="d-inline-block pl-2">Cleints</span></label>
                                                </div>
                                                <div class="custom-checkbox mb-2">
                                                    <input type="checkbox" id="f">
                                                    <label for="f"><span
                                                            class="d-inline-block pl-2">Pages</span></label>
                                                </div>
                                                <div class="custom-checkbox mb-2">
                                                    <input type="checkbox" id="g">
                                                    <label for="g"><span
                                                            class="d-inline-block pl-2">Chat</span></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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