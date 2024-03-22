<!-- header placeholder -->
<?php $this->load->view('admin/includes/header'); ?>
    
    <div class="admin-table-header bg-white">
        <?php $this->load->view('admin/includes/topbar'); ?>
         <div class="admin-table-header__options">
                        <div class="title">
                            Legal View
                        </div>
                        <div class="upload-download-new">


                            <div class="searchbar">
                                <input class="form-control" placeholder="Search">
                                <img class="search-icon" src="<?php echo base_url() ?>assets/admin/images/Icon 01.svg">
                            </div>
                            <button class="btn btn-primary create-new" data-toggle="modal"
                                data-target="#incidentModal">Create new</button>
                        </div>
                    </div>
                </div>
                <div class="admin-table-content">
             
                    <div class="admin-table__main">
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
                        <div class="table-main h-100 split-view">
                            <div class="row h-100">
                                <div class="col-47 pr-0">
                                    <table id="myTable" class="table-main__admin" cellspacing="0" cellpadding="0">
                                        <thead>
                                            <tr>
                                                <td class="checklist" align="center">
                                                    <span class="custom-checkbox">
                                                        <input type="checkbox" id="theadCheck">
                                                        <label for="theadCheck"></label>
                                                    </span>
                                                </td>
                                                <td class="text-nowrap">Page, Location, Language</td>
                                                <td class="text-right"><div class="d-flex justify-content-end">
                                                    <span>Status, Modified By, Date modified, Action</span>
                                                    <span class="icon-expand">
                                                        <img src="<?php echo base_url() ?>assets/admin/images/ionic-ios-expand.svg">
                                                    </span>
                                                </div></td>
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
                                                    <div class="mb-2">Legal Resources</div>
                                                    <div class="table-fs-light mb-2">India</div>
                                                    <div class="table-fs-light mb-2">English</div>
                                                </td>
                                                <td class="action text-right">
                                                    <div class="td-border-right">
                                                         <div class="table-fs-light mb-2">
                                                            <span class="d-inline-block pr-3">Active</span>
                                                            <span>Safecity Admin</span>
                                                        </div>
                                                        <div class="table-fs-light">20 Jan 2020, 10:38 AM - 10:45 AM
                                                        </div>
                                                        <div class="action--btn">
                                                            <button class="btn fs-17 text-red pl-0">Hide</button>
                                                            <button class="btn fs-17 text-primary">Manage</button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="active">
                                                <td align="center" class="checklist">
                                                    <span class="custom-checkbox">
                                                        <input type="checkbox" id="1">
                                                        <label for="1"></label>
                                                    </span>
                                                </td>
                                                <td class="report-id">
                                                    <div class="mb-2">Legal Resources</div>
                                                    <div class="table-fs-light mb-2">India</div>
                                                    <div class="table-fs-light mb-2">English</div>
                                                </td>
                                                <td class="action text-right">
                                                    <div class="td-border-right">
                                                         <div class="table-fs-light mb-2">
                                                            <span class="d-inline-block pr-3">Active</span>
                                                            <span>Safecity Admin</span>
                                                        </div>
                                                        <div class="table-fs-light">20 Jan 2020, 10:38 AM - 10:45 AM
                                                        </div>
                                                        <div class="action--btn">
                                                            <button class="btn fs-17 text-red pl-0">Hide</button>
                                                            <button class="btn fs-17 text-primary">Manage</button>
                                                        </div>
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
                                                    <div class="mb-2">Legal Resources</div>
                                                    <div class="table-fs-light mb-2">India</div>
                                                    <div class="table-fs-light mb-2">English</div>
                                                </td>
                                                <td class="action text-right">
                                                    <div class="d-flex justify-content-between table-fs-light mb-2">
                                                        <span>Active</span>
                                                        <span>Safecity Admin</span>
                                                    </div>
                                                    <div class="table-fs-light">20 Jan 2020, 10:38 AM - 10:45 AM</div>
                                                    <div class="action--btn">
                                                        <button class="btn fs-17 text-red pl-0">Hide</button>
                                                        <button class="btn fs-17 text-primary">Manage</button>
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
                                                    <div class="mb-2">Legal Resources</div>
                                                    <div class="table-fs-light mb-2">India</div>
                                                    <div class="table-fs-light mb-2">English</div>
                                                </td>
                                                <td class="action text-right">
                                                    <div class="d-flex justify-content-between table-fs-light mb-2">
                                                        <span>Active</span>
                                                        <span>Safecity Admin</span>
                                                    </div>
                                                    <div class="table-fs-light">20 Jan 2020, 10:38 AM - 10:45 AM</div>
                                                    <div class="action--btn">
                                                        <button class="btn fs-17 text-red pl-0">Hide</button>
                                                        <button class="btn fs-17 text-primary">Manage</button>
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
                                                    <div class="mb-2">Legal Resources</div>
                                                    <div class="table-fs-light mb-2">India</div>
                                                    <div class="table-fs-light mb-2">English</div>
                                                </td>
                                                <td class="action text-right">
                                                    <div class="d-flex justify-content-between table-fs-light mb-2">
                                                        <span>Active</span>
                                                        <span>Safecity Admin</span>
                                                    </div>
                                                    <div class="table-fs-light">20 Jan 2020, 10:38 AM - 10:45 AM</div>
                                                    <div class="action--btn">
                                                        <button class="btn fs-17 text-red pl-0">Hide</button>
                                                        <button class="btn fs-17 text-primary">Manage</button>
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
                                                    <div class="mb-2">Legal Resources</div>
                                                    <div class="table-fs-light mb-2">India</div>
                                                    <div class="table-fs-light mb-2">English</div>
                                                </td>
                                                <td class="action text-right">
                                                    <div class="d-flex justify-content-between table-fs-light mb-2">
                                                        <span>Active</span>
                                                        <span>Safecity Admin</span>
                                                    </div>
                                                    <div class="table-fs-light">20 Jan 2020, 10:38 AM - 10:45 AM</div>
                                                    <div class="action--btn">
                                                        <button class="btn fs-17 text-red pl-0">Hide</button>
                                                        <button class="btn fs-17 text-primary">Manage</button>
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
                                                    <div class="mb-2">Legal Resources</div>
                                                    <div class="table-fs-light mb-2">India</div>
                                                    <div class="table-fs-light mb-2">English</div>
                                                </td>
                                                <td class="action text-right">
                                                    <div class="d-flex justify-content-between table-fs-light mb-2">
                                                        <span>Active</span>
                                                        <span>Safecity Admin</span>
                                                    </div>
                                                    <div class="table-fs-light">20 Jan 2020, 10:38 AM - 10:45 AM</div>
                                                    <div class="action--btn">
                                                        <button class="btn fs-17 text-red pl-0">Hide</button>
                                                        <button class="btn fs-17 text-primary">Manage</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <script>
                                    window.onload = function () {
                                        var offsetValue = $(".table-open__header").outerHeight() - $(".dataTables_scrollHead").outerHeight()
                                         if(offsetValue < 0){
                                            var scrollHeight = $(".dataTables_scrollBody").outerHeight() - offsetValue
                                            $(".table-open__content").css("height", scrollHeight)
                                        }
                                        else{
                                            var scrollHeight = $(".dataTables_scrollBody").outerHeight() - offsetValue
                                            $(".table-open__content").css("height", scrollHeight)
                                        }
                                    }
                                </script>
                                <div class="col-53 pl-0">
                                    <div class="table-open table-open__incidents">
                                        <div class="table-open__header bg-white">
                                            <div class="table-open__header--title">
                                                View Page
                                            </div>
                                            <div class="table-open__header--button">
                                                <button class="btn fs-17 text-primary pl-0" id="editField">Edit</button>
                                                <div class="dropdown">
                                                    <a class="btn dropdown-toggle d-flex align-items-center" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <span class="fs-13">
                                                            <span class="circle"></span>
                                                            <span>Active</span>
                                                        </span>
                                                    </a>
            
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-open__content incidents edit-field">
                                            <div class="posted__title">
                                                <span>Legal resources</span>
                                                <span></span>
                                            </div>
                                            <div class="edit-field__content row pl-0">
                                                <div class="col-12">
                                                    <div class="safecity-lang-date">
                                                        <div class="about-safecity--date">
                                                            <div>Language</div>
                                                            <div>English</div>
                                                        </div>
                                                        <div class="about-safecity--date">
                                                            <div>Date Modified</div>
                                                            <div>22/06/2020</div>
                                                        </div>
                                                        <div class="about-safecity--date">
                                                            <div>Date Added</div>
                                                            <div>22/06/2020</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="tabs-switch">
                                                        <div class="tabs-switch--tabs">
                                                            <button class="btn w-50 active">
                                                                Sexual Violence Laws under IPC, 1860
                                                            </button>
                                                            <button class="btn w-50 bg-white">
                                                                Filing of an FIR
                                                            </button>
                                                        </div>
                                                        <div class="tabs-switch--content">
                                                            <div class="fs-22 text-black-100 mb-3">
                                                                Sexual Violence Laws under IPC, 1860
                                                            </div>
                                                            <div class="edit-field__content">
                                                                <div class="label fs-17">Domestic Violence</div>
                                                                <div class="fs-16 text-black-100">
                                                                    Which sections of the law address this crime?
                                                                    Domestic Violence – Section 498A of the IPC and
                                                                    Domestic Violence Act, 2005
                                                                    <br>
                                                                    <br>
                                                                    How is domestic violence
                                                                    defined under the IPC? Husband or relative of the
                                                                    husband of a woman subjecting her to cruelty —
                                                                    Whoever, being the husband or the relative of the
                                                                    husband of a woman, subjects such woman to cruelty
                                                                    shall be punished with imprisonment for a term which
                                                                    may extend to three years and shall also be liable
                                                                    to fine.
                                                                    <br>
                                                                    <br>
                                                                    Explanation. — For the purposes of this
                                                                    section, “cruelty” means— (a) any wilful conduct
                                                                    which is of such a nature as is likely to drive the
                                                                    woman to commit suicide or to cause grave injury or
                                                                    danger to life, limb or health (whether mental or
                                                                    physical) of the woman; or (b) harassment of the
                                                                    woman where such harassment is with a view to
                                                                    coercing her or any person related to her to meet
                                                                    any unlawful demand for any property or valuable
                                                                    security or is on account of failure by her or any
                                                                    person related to her to meet such demand. What is
                                                                    the punishment under the IPC? Imprisonment from 3
                                                                    years and a fine Fo
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
                </div>
            </div>
        </div>