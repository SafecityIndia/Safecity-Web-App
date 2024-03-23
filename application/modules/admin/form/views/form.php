<!-- header placeholder -->
<?php $this->load->view('admin/includes/header'); ?>
    
    <div class="admin-table-header bg-white">
        <?php $this->load->view('admin/includes/topbar'); ?>
        <div class="admin-table-header__options">
            <div class="title">
                Forms
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
                </div>
                <div class="text-red fs-17 clear-all">
                    <label class="fs-15"></label>
                    <div>Clear all filters</div>
                </div>
            </div>
            <div class="table-main h-100 collapse-view">
                <div class="row h-100">
                    <!-- List Pane -->
                    <div id="table_container" class="col-12">
                        <table id="myTable" class="table-main__admin" cellspacing="0" cellpadding="0">
                            <thead>
                                <tr>
                                    <td class="text-nowrap">Title, Location, Type</td>
                                    <td>
                                        Language, Date, Action
                                        <span class="icon-expand hideSplitView">
                                            <img src="<?php echo base_url() ?>assets/admin/images/ionic-ios-expand.svg">
                                        </span>
                                    </td>
                                    <td class="title">Title</td>
                                    <td class="language table-fs-light">Language</td>
                                    <td class="date table-fs-light">date</td>
                                    <td class="action">Action</td>
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
                                    Primary Form
                                </div>
                                <div class="table-open__header--button">
                                    <button class="btn fs-17 text-primary pl-0">Publish</button>
                                </div>
                            </div>
                            <div id="detail_content" class="tablecontent incidents edit-field">
                                <!-- Content Goes Here -->
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
<script src="<?php echo base_url(); ?>application/modules/admin/form/scripts/form.js"></script>

<script>
    /*
    function getActionHtmlMini(data, type, row, meta) {
        return `<div>
                    <button class="btn text-red pl-0 action-update-status" data-status="hide" data-incidentid="${row.id}">Hide</button>
                    <button class="btn text-primary action-update-status" data-status="edit" data-incidentid="${row.id}">Edit</button>
                    <button class="btn text-primary action-update-status" data-status="published" data-incidentid="${row.id}">Publish</button>
                </div>`;        
    }
    */

</script>
</body>
</html>