<!-- header placeholder -->
<?php $this->load->view('admin/includes/header'); ?>
    
    <div class="admin-table-header bg-white">
        <?php $this->load->view('admin/includes/topbar'); ?>
        <div class="admin-table-header__options">
            <div class="title">
                Goa Police
            </div>
            <div>
                <a class="text-primary">Remove Client</a>
            </div>
        </div>
    </div>
    <div class="admin-table-content">
        <div class="admin-table__sidebar bg-white">
            <div class="logo-img">
                <img class="object-fit-cover--img" src="<?php echo base_url() ?>assets/admin/images/safecity.png">
            </div>
            <div class="admin-table__sidebar--content">
                <a>Dashboard</a>
                <a class="active">Incidents</a>
                <a>Safety Tips</a>
                <a>Forms</a>
                <a>Pages</a>
                <a>Chat</a>
                <a>Profile</a>
            </div>
        </div>
        <div class="admin-table__main">
            <div>
                <div class="admin-table-header__options">
                    <div class="title">
                        Incident
                    </div>
                    <div class="upload-download-new">
                        <a class="d-flex align-items-center pl-5">
                            <img src="<?php echo base_url() ?>assets/admin/images/Icon feather-download.svg">
                            <span class="fs-17"> Upload Safety Tip</span>
                        </a>
                        <a class="d-flex align-items-center pl-5" data-target="#downloadSafeTips"
                            data-toggle="modal">
                            <img src="<?php echo base_url() ?>assets/admin/images/Icon feather-download (1).svg">
                            <span class="fs-17">Download Safety Tip</span>
                        </a>
                        <button class="btn btn-primary create-new" data-toggle="modal"
                            data-target="#incidentModal">Create new</button>
                    </div>
                </div>
                <div class="admin-table-header__tabs">
                    <ul class="nav nav-tabs tabs-holder" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link fs-15 active" data-toggle="tab" href="#tabs-1" role="tab">
                                <span class="tabs-holder--text">Approval pending</span>
                                <span class="number-tags red">5</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-15 approve" data-toggle="tab" href="#tabs-2" role="tab">
                                <span class="tabs-holder--text">Approved</span>
                                <span class="number-tags blue">3144</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-15" data-toggle="tab" href="#tabs-3" role="tab">
                                <span class="tabs-holder--text">Saved for later</span>
                                <span class="number-tags blue">11</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-15" data-toggle="tab" href="#tabs-4" role="tab">
                                <span class="tabs-holder--text">Published</span>
                                <span class="number-tags blue">16</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-15" data-toggle="tab" href="#tabs-5" role="tab">
                                <span class="tabs-holder--text">Rejected</span>
                                <span class="number-tags red">27</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-15" data-toggle="tab" href="#tabs-6" role="tab">
                                <span class="tabs-holder--text mr-0">Trash</span>
                                <span class="number-tags red">19</span>
                            </a>
                        </li>
                    </ul>
                    <div class="searchbar">
                        <input class="form-control" placeholder="Search">
                        <img class="search-icon" src="<?php echo base_url() ?>assets/admin/images/Icon 01.svg">
                    </div>
                </div>
                <div class="filters__loc-time bg-white">
                    <div class="mr-4">
                        <label class="fs-15"></label>
                        <div>Filters</div>
                    </div>
                    <div class="loc-time--holder mr-4">
                        <div class="mr-4">
                            <label class="fs-15">Type</label>
                            <div class="dropdown">
                                <a class="btn loc-time--holder--btn dropdown-toggle" href="#" role="button"
                                    id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <span>All</span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <div class="mr-4">
                            <label>location</label>
                            <div class="dropdown">
                                <a class="btn loc-time--holder--btn dropdown-toggle" href="#" role="button"
                                    id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <span>All</span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <div class="mr-4">
                            <label>Category</label>
                            <div class="dropdown">
                                <a class="btn loc-time--holder--btn dropdown-toggle" href="#" role="button"
                                    id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <span>All</span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label>Date</label>
                            <div class="dropdown">
                                <a class="btn loc-time--holder--btn dropdown-toggle" href="#" role="button"
                                    id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <span>All</span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-red fs-17 clear-all">
                        <label class="fs-15"></label>
                        <div>
                        <a class="text-red" href="#">Clear all filters</a>
                    </div>
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
                                    <td class="report-id">Report ID</td>
                                    <td class="category">Category</td>
                                    <td class="location table-fs-light">location</td>
                                    <td class="posted-by table-fs-light">Posted By</td>
                                    <td class="date table-fs-light">date</td>
                                    <td class="action">Action</td>
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
                                    <td class="report-id">
                                        <div class="text-nowrap">
                                            <span class="">#12345</span>
                                            <span class="circle"></span>
                                        </div>
                                    </td>
                                    <td class="category">Stalking, Taking pictures, Touching /Groping,
                                        Others</td>
                                    <td class="location table-fs-light">ADB PWD Colony, Sector 16A,
                                        Faridabad, Haryana 121002, India</td>
                                    <td class="posted-by table-fs-light">Member Name</td>
                                    <td class="date table-fs-light">
                                        <div>20 Jan 2020</div>
                                        <div>10:38 AM - 10:45 AM</div>
                                    </td>
                                    <td class="action">
                                        <div class="action--btn">
                                            <button class="btn text-red pl-0">Thrash</button>
                                            <button class="btn text-red">Reject</button>
                                            <button class="btn text-grey">Save</button>
                                            <button class="btn text-primary">Approve</button>
                                            <button class="btn text-primary">Publish</button>
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
                                    <td class="report-id">
                                        <div class="text-nowrap">
                                            <span class="">#12345</span>
                                            <span class="circle"></span>
                                        </div>
                                    </td>
                                    <td class="category">Stalking, Taking pictures, Touching /Groping,
                                        Others</td>
                                    <td class="location table-fs-light">ADB PWD Colony, Sector 16A,
                                        Faridabad, Haryana 121002, India</td>
                                    <td class="posted-by table-fs-light">Member Name</td>
                                    <td class="date table-fs-light">
                                        <div>20 Jan 2020</div>
                                        <div>10:38 AM - 10:45 AM</div>
                                    </td>
                                    <td class="action">
                                        <div class="action--btn">
                                            <button class="btn text-red pl-0">Thrash</button>
                                            <button class="btn text-red">Reject</button>
                                            <button class="btn text-grey">Save</button>
                                            <button class="btn text-primary">Approve</button>
                                            <button class="btn text-primary">Publish</button>
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
                                    <td class="report-id">
                                        <span>#12345</span>
                                        <span></span>
                                    </td>
                                    <td class="category">Stalking, Taking pictures, Touching /Groping,
                                        Others</td>
                                    <td class="location table-fs-light">ADB PWD Colony, Sector 16A,
                                        Faridabad, Haryana 121002, India</td>
                                    <td class="posted-by table-fs-light">Member Name</td>
                                    <td class="date table-fs-light">
                                        <div>20 Jan 2020</div>
                                        <div>10:38 AM - 10:45 AM</div>
                                    </td>
                                    <td class="action">
                                        <div class="action--btn">
                                            <button class="btn text-red pl-0">Thrash</button>
                                            <button class="btn text-red">Reject</button>
                                            <button class="btn text-grey">Save</button>
                                            <button class="btn text-primary">Approve</button>
                                            <button class="btn text-primary">Publish</button>
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
                                    <td class="report-id">
                                        <div class="text-nowrap">
                                            <span class="">#1234567</span>
                                            <span class="circle"></span>
                                        </div>
                                    </td>
                                    <td class="category">Stalking, Taking pictures, Touching /Groping,
                                        Others</td>
                                    <td class="location table-fs-light">ADB PWD Colony, Sector 16A,
                                        Faridabad, Haryana 121002, India</td>
                                    <td class="posted-by table-fs-light">Member Name</td>
                                    <td class="date table-fs-light">
                                        <div>20 Jan 2020</div>
                                        <div>10:38 AM - 10:45 AM</div>
                                    </td>
                                    <td class="action">
                                        <div class="action--btn">
                                            <button class="btn text-red pl-0">Thrash</button>
                                            <button class="btn text-red">Reject</button>
                                            <button class="btn text-grey">Save</button>
                                            <button class="btn text-primary">Approve</button>
                                            <button class="btn text-primary">Publish</button>
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
                                    <td class="report-id">#12345</td>
                                    <td class="category">Stalking, Taking pictures, Touching /Groping,
                                        Others</td>
                                    <td class="location table-fs-light">ADB PWD Colony, Sector 16A,
                                        Faridabad, Haryana 121002, India</td>
                                    <td class="posted-by table-fs-light">Member Name</td>
                                    <td class="date table-fs-light">
                                        <div>20 Jan 2020</div>
                                        <div>10:38 AM - 10:45 AM</div>
                                    </td>
                                    <td class="action">
                                        <div class="action--btn">
                                            <button class="btn text-red pl-0">Thrash</button>
                                            <button class="btn text-red">Reject</button>
                                            <button class="btn text-grey">Save</button>
                                            <button class="btn text-primary">Approve</button>
                                            <button class="btn text-primary">Publish</button>
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
                                    <td class="report-id">#12345</td>
                                    <td class="category">Stalking, Taking pictures, Touching /Groping,
                                        Others</td>
                                    <td class="location table-fs-light">ADB PWD Colony, Sector 16A,
                                        Faridabad, Haryana 121002, India</td>
                                    <td class="posted-by table-fs-light">Member Name</td>
                                    <td class="date table-fs-light">
                                        <div>20 Jan 2020</div>
                                        <div>10:38 AM - 10:45 AM</div>
                                    </td>
                                    <td class="action">
                                        <div class="action--btn">
                                            <button class="btn text-red pl-0">Thrash</button>
                                            <button class="btn text-red">Reject</button>
                                            <button class="btn text-grey">Save</button>
                                            <button class="btn text-primary">Approve</button>
                                            <button class="btn text-primary">Publish</button>
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
                                    <td class="report-id">#12345</td>
                                    <td class="category">Stalking, Taking pictures, Touching /Groping,
                                        Others</td>
                                    <td class="location table-fs-light">ADB PWD Colony, Sector 16A,
                                        Faridabad, Haryana 121002, India</td>
                                    <td class="posted-by table-fs-light">Member Name</td>
                                    <td class="date table-fs-light">
                                        <div>20 Jan 2020</div>
                                        <div>10:38 AM - 10:45 AM</div>
                                    </td>
                                    <td class="action">
                                        <div class="action--btn">
                                            <button class="btn text-red pl-0">Thrash</button>
                                            <button class="btn text-red">Reject</button>
                                            <button class="btn text-grey">Save</button>
                                            <button class="btn text-primary">Approve</button>
                                            <button class="btn text-primary">Publish</button>
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