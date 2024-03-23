<!-- header placeholder -->
<?php $this->load->view('admin/includes/header'); ?>
    <style>
	.table-open__content {
    overflow-x: hidden;
    overflow-y: auto;
	}

	</style>
    <div class="admin-table-header bg-white">
        <?php $this->load->view('admin/includes/topbar'); ?>
        <div class="admin-table-header__options">
            <div class="title">
                Pages
            </div>
            <!-- <div class="upload-download-new">
                <div class="pull-right searchbar">
                    <input class="form-control" placeholder="Search">
                    <img class="search-icon" src="<?php echo base_url() ?>assets/admin/images/Icon 01.svg">
                </div>
            </div> -->
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
                    <div class="mr-4">
                        <label>Country</label>
                        <div class="dropdown">
                            <select id="country_filter" class="custom-select custom-select-sm init-select2">
								<option value="">All</option>
                              <?php foreach ($countries as $country): ?>
							  <?php
							  if($_SESSION['user_id']==30){
							  ?>
                                <option value="<?=$country['id']?>" selected><?=$country['name']?></option>
								<?php
							  }else{
								?>
								
								<option value="<?=$country['id']?>"><?=$country['name']?></option>
								<?php
							  }
							  ?>
                              <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="text-red fs-17 clear-all">
                    <label class="fs-15"></label>
                    <div id="clear-filters" class="clearnew">Clear all filters</div>
                </div>
            </div>
            <div class="table-main h-100 collapse-view">
                <div class="row h-100">
                    <!-- List Pane -->
                    <div id="table_container" class="col-12">
                        <table id="myTable" class="table-main__admin" cellspacing="0" cellpadding="0">
                            <thead>
                                <tr>
                                    <td class="text-nowrap">Page, Language, Modified By</td>
                                    <td>
                                        Last modified, Added On, Action
                                        <span class="icon-expand hideSplitView">
                                            <img src="<?php echo base_url() ?>assets/admin/images/ionic-ios-expand.svg">
                                        </span>
                                    </td>
                                    <td class="report-id">Page Title</td>
                                    <td class="location table-fs-light">Language</td>
                                    <td class="posted-by table-fs-light">Modified By</td>
                                    <td class="date table-fs-light">Last Modified</td>
                                    <td class="date table-fs-light">Added on</td>
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
                                        View Page
                                    </div>
                                    <div class="table-open__header--button">
                                        <button class="btn fs-17 text-primary pl-0 detail-button" id="editField">Edit</button>
                                        <button class="btn fs-17 text-primary pl-0 edit-button" id="saveChanges">Save</button>
                                        <div class="dropdown">
                                            <span class="fs-13">
                                                <span class="circle"></span>
                                                <span class="btn">Active</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div id="detail_content" class="tablecontent table-open__content incidents edit-field">
                                    <!-- Content Goes Here -->
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
                                    <!-- Content END -->
                                </div>
                                <div id="edit_div" class="table-open__content" style="display: none;">
                                    
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
<script src="https://cdn.tiny.cloud/1/7unhz0zgvkshcoldvsd1oo9ed56z1ard1bjp53uael2q8sg2/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script src="<?php echo base_url() ?>application/modules/admin/page/scripts/faqEditForm.js"></script>
<script src="<?php echo base_url() ?>application/modules/admin/page/scripts/recordEditForm.js"></script>
<script src="<?php echo base_url() ?>application/modules/admin/page/scripts/page.js"></script>
</body>
</html>