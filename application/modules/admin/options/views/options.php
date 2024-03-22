<!-- header placeholder -->
<?php $this->load->view('admin/includes/header'); ?>
    <div class="admin-table-header bg-white">
        <?php $this->load->view('admin/includes/topbar'); ?>
        <div class="admin-table-header__options">
            <div class="title">
                Safety Tips
            </div>
        </div>
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
                              <?php foreach ($countries as $country): ?>
							  <?php
							  if($_SESSION['user_id']==30){
							  ?>
                                <option value="<?=$country['id']?>"><?=$country['name']?></option>
								<?php
							  }else{
								?>
								
								<option value="<?=$country['id']?>" <?php if($country['id']==101){ echo "selected"; } ?>><?=$country['name']?></option>
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
        <!-- Record Import Status -->
        <?php if($this->session->flashdata('upload_success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> <?php echo $this->session->flashdata('upload_success')['message']; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php elseif($this->session->flashdata('upload_failed')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Unable to upload safety tips due to some errors:!</strong>
                <?php
                    $upload_failed = $this->session->flashdata('upload_failed');
                    if(isset($upload_failed['validations'])) {
                        echo "<ol>";
                        foreach ($upload_failed['validations'] as $err_msg) {
                            echo "<li>".$err_msg."</li>";
                        }
                        echo "</ol>";
                    } else {
                        echo $upload_failed['message'];
                    }
                ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <!-- Import Status End -->
        <!--<div class="admin-table-header__tabs">
            <div class="tabs-holder">
                <div class="fs-14 status-filter active" data-status="pending_approval">
                    <span class="tabs-holder--text">Primary Form</span>
                </div>
            </div>
        </div>-->
    </div>
    <div class="admin-table-content">
        <div class="admin-table__main">
            <div class="table-main h-100 collapse-view">
                <div class="row h-100">
                    <!-- List Pane -->
                    <div id="table_container" class="col-12">
                        <div id="bulkaction-container">
                            <div class="table-open__content incidents edit-field" style="height: 100%;">
                                <div id="edit_div" style="" class="view-user-detail">
                                <div class="row pl-0">
                                    <div class="col-12">	
                                    <div class="view-user-detail--text">
                                        <div class="row pl-0" id="ajaxdiv">
											<?php
												$i = 1;
												foreach($questions as $val){
												if(@$questions[$i]['question']['question']!='' && (@$questions[$i]['question']['properties'] !='')){
											?>
                                            <div class="col-12">
												<div class="form-group">
													<div class="label fs-15" style="margin-bottom:10px;"><?php echo $i.'.'.'&nbsp;&nbsp;&nbsp;'. @$questions[$i]['question']['question']; ?></div>
													<?php
														foreach(@$questions[$i]['options'] as $optionval){
												if($optionval['title']!=''){
													
													?>
													<!--options starts-->
													<div class="form-group row">
														<div class="col-sm-5">
														  <input type="text" readonly disabled class="form-control" id="<?php echo @$optionval['order_no']; ?>" value="<?php echo @$optionval['title']; ?>" style="margin-bottom:10px;" />
														</div>
														<label for="<?php echo @$optionval['order_no']; ?>" class="col-sm-2 col-form-label"><a class="exportRecordBtn" data-attr="<?php echo @$optionval['id']; ?>" id="exportRecordBtn" data-target="#exportRecordModal<?php echo @$optionval['id']; ?>">
															Edit
														</a></label>
													  </div>
													  <!-- options ends-->
													  
													  <!-- suboptions starts-->
													  <?php foreach(@$questions[$i]['suboptions'][@$optionval['id']] as $suboption){ 
														
													  ?>
													 <div class="form-group row" style="margin-left:10px;">
														<div class="col-sm-5">
														   <input type="text" readonly disabled class="form-control" id="<?php echo @$suboption['order_no']; ?>" value="<?php echo @$suboption['title']; ?>" style="margin-bottom:10px;" />
														</div>
														<label for="<?php echo @$suboption['order_no']; ?>" class="col-sm-2 col-form-label"><a class="suboptionRecordBtn" data-attr="<?php echo @$suboption['id']; ?>" id="suboptionRecordBtn" data-target="#suboptionModal<?php echo @$suboption['id']; ?>">
															Edit
														</a></label>
													  </div>
													 <!-- suboptions ends-->
													 
	<div class="modal fade" id="suboptionModal<?php echo @$suboption['id']; ?>" tabindex="-1" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<?php echo @$optionval['title']; ?>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
					<form id="update_optiontitle" class="update_optiontitle" method="post">
						<div class="download-incident">
						<div class="row">
							<div class="col-md-12">
								<div class="newrangein">
									<div class="dropdown ">
										<div class="input-group input-daterange">
											<div class="row">
												<div class="col-12">
													<input type="hidden" value="<?php echo $suboption['id']; ?>" id="optionid" name="optionid" class="form-control">
													<input type="text"  value="<?php echo $suboption['title']; ?>" id="optiontitle" data-required="true" name="optiontitle" value="" class="form-control">
													<div class="invalid-msg text-danger"></div>
												</div>
											</div>
									   </div>
									</div>
								</div>
							</div>
							
							<div class="col-md-12">
								<br />
							</div>
						</div>
						<div class="invalid-msg text-danger">Errro</div>
							<button type="submit" class="btn btn-primary" id="savetitle" >Update</button>
						</div>
					</form>
					</div>
				</div>
			</div>
		</div>
													  
													<?php
													  }
													?>
													<!-- Download Incident Modal -->
    <div class="modal fade" id="exportRecordModal<?php echo @$optionval['id']; ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
					<?php echo @$questions[$i]['question']['question']; ?>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
				<form id="update_optiontitle" class="update_optiontitle" method="post">
                    <div class="download-incident">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="newrangein">
                                <div class="dropdown ">
                                    <div class="input-group input-daterange">
            							<div class="row">
            							    <div class="col-12">
                                                <input type="hidden" value="<?php echo $optionval['id']; ?>" id="optionid" name="optionid" class="form-control">
                                                <input type="text"  value="<?php echo $optionval['title']; ?>" id="optiontitle" data-required="true" name="optiontitle" value="" class="form-control">
												<div class="invalid-msg text-danger"></div>
                                            </div>
            							</div>
                                   </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <br />
                        </div>
                    </div>
                    <div class="invalid-msg text-danger">Errro</div>
						<button type="submit" class="btn btn-primary" id="savetitle" >Update</button>
                    </div>
				</form>
                </div>
            </div>
        </div>
    </div>
													
													<?php
													}
														}
													?>
												</div>
											</div>
											<?php
											}
												$i++;
												}
											?>
                                        </div>
                                    </div>
									</div>
								</div>
                            </div>
                            </div>
						</div>
                        
                    <!-- Detail Pane -->
                    <div id="detail_container" class="col-53 pl-0">
                        
                    </div>
                    <!-- Detail Pane End -->
                    </div>
                    <!-- List Pane End -->

                </div>
            </div>
        </div>
    </div>
<!-- Footer -->
<?php $this->load->view('admin/includes/footer'); ?>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script>
$(document).on('click', '.exportRecordBtn', function(event){
	event.preventDefault();
	var idappend = $(this).data('attr');
	var modal_id = '#'+'exportRecordModal'+idappend;
	console.log(modal_id);
	var $modalId = $('#'+'exportRecordModal'+idappend);
	console.log($modalId);
	$modalId.find('.invalid-msg').text('');
	$modalId.modal('show');
});

$(document).on('click', '.suboptionRecordBtn', function(event){
	event.preventDefault();
	var idappend = $(this).data('attr');
	var modal_id = '#'+'suboptionModal'+idappend;
	console.log(modal_id);
	var $suboptionmodalId = $('#'+'suboptionModal'+idappend);
	console.log($suboptionmodalId);
	$suboptionmodalId.find('.invalid-msg').text('');
	$suboptionmodalId.modal('show');
});

// Filter by Language
$("#language_filter").change(function(event) {
	$.ajax({
		url:  baseURL+'admin/options/getform',
		type: "POST",
		data:'language='+$(this).val(),
		cache:false,
		async:false,
		success: function(response) 
		{
			console.log(response);
			$("#ajaxdiv").html(response);
		},
		error: function(response) {
		  alert("error");
		}
	});
});

$("#country_filter").change(function(event) {
	$.ajax({
		url:  baseURL+'admin/options/getform',
		type: "POST",
		data:'country='+$(this).val(),
		cache:false,
		async:false,
		success: function(response) 
		{
			console.log(response);
			$("#ajaxdiv").html(response);
		},
		error: function(response) {
		  alert("error");
		}
	});
});
$(document).on('submit', '.update_optiontitle', function(e){
// $('.update_optiontitle').submit(function(e){
      e.preventDefault();
      var formData = new FormData(this);
	  formData.append("country", $("#country_filter").val());
	  formData.append("language", $("#language_filter").val());
          $('.update_optiontitle').validate({
             rules: {
                 optiontitle: {
                     required: true,                    //lettersonly: true,
                 },
             },
             messages: {
                 optiontitle: {
                     required: 'Please enter title'
                 },
             }
         });

         var isvalidate = $(".update_optiontitle").valid();
           if(isvalidate){
			$.ajax({
                url:  baseURL+'admin/options/update',
				type: "POST",
                data:formData,
                processData:false,
                contentType:false,
                cache:false,
                async:false,
                success: function(response) 
                {
                    result =  JSON.parse(response);
					console.log(result);
                    if(result.status == true){
						$('.modal').modal('hide');
						$('.modal-backdrop').modal('hide');
						$("div").removeClass("modal-backdrop");
						document.getElementById('country_filter').value = result.country;
						document.getElementById('language_filter').value = result.language;
                        // window.location.href = baseURL+"admin/options";
						
						$.ajax({
							url:  baseURL+'admin/options/getform',
							type: "POST",
							data:'country='+$("#country_filter").val()+'&language='+$("#language_filter").val(),
							cache:false,
							async:false,
							success: function(response) 
							{
								console.log(response);
								$("#ajaxdiv").html(response);
							},
							error: function(response) {
							  alert("error");
							}
						});
						
                    }
                    else{     
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