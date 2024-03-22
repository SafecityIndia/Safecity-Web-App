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

<div class="form-group row">
	<div class="col-sm-5">
	  <input type="text" class="form-control" id="<?php echo @$optionval['order_no']; ?>" value="<?php echo @$optionval['title']; ?>" style="margin-bottom:10px;" />
	</div>
	<label for="<?php echo @$optionval['order_no']; ?>" class="col-sm-2 col-form-label"><a class="exportRecordBtn" data-attr="<?php echo @$optionval['id']; ?>" id="exportRecordBtn" data-target="#exportRecordModal<?php echo @$optionval['id']; ?>">
		Edit
	</a></label>
  </div>
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
													<input type="hidden" value="<?php echo $suboption['order_no']; ?>" id="optionid" name="optionid" class="form-control">
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
 <!-- suboptions ends-->

 
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
                                                <input type="text" value="<?php echo $optionval['title']; ?>" id="optiontitle" data-required="true" name="optiontitle" value="" class="form-control">
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