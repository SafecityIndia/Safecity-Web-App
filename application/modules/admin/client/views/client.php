<!-- header placeholder -->
<?php $this->load->view('admin/includes/header'); ?>

    <div class="admin-table-header bg-white">
        <?php $this->load->view('admin/includes/topbar'); ?>
        <div class="admin-table-header__options">
            <div class="title">
                Clients
            </div>
            <div class="upload-download-new">

            </div>
            <div class="searchbar">
                <input class="form-control" placeholder="Search">
                <img class="search-icon" src="<?php echo base_url() ?>assets/admin/images/Icon 01.svg">
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
                    <div>Clear all filters</div>
                </div>
            </div>
            <div class="table-main h-100 collapse-view">
                <div class="row h-100">
                    <div class="col-12">
                        <table id="myTable" class="table-main__admin" cellspacing="0" cellpadding="0">
                            <thead>
                                <tr>
                                    <td class="report-id">Client Name</td>
                                    <td class="category">Location</td>
                                    <td class="location table-fs-light"># Incidents</td>
                                    <td class="posted-by table-fs-light"># Safety Tips</td>
                                    <td class="date table-fs-light">Type</td>
                                    <td class="date table-fs-light">Added on</td>
                                    <td class="action">Action</td>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>
    </div>

<!-- Footer -->
<?php $this->load->view('admin/includes/footer'); ?>
<script src="<?php echo base_url(); ?>application/modules/admin/client/scripts/client.js"></script>
</body>
</html>