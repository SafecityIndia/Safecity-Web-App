var estimateTimeRangePickerField = (function() {

	function nextClick() {
		var properties = JSON.parse(currentQuestion.properties);
		var answer_id = 0;
		var answer = $("input[name="+currentQuestion.elementId+"]").val();
		var isEstimate = $("input[name="+currentQuestion.elementId+"checked]").is(':checked');
		var timeStart = $("input[name="+currentQuestion.elementId+"start]").val();
		var timeEnd   = $("input[name="+currentQuestion.elementId+"end]").val();

		/*if(answer == "" && timeStart == "" && timeEnd == "") {
			if(!$('#options').next('.validdation_time').length) {
				$('#options').after('<div class="validdation_time" style="color:red;">' + properties["validations"][0]["timeorrange"] + '</div>');
			}
			$("#dynamicNext").attr("disabled", "disabled");
			return false;
		}*/
		//else {
			if(answer == "" && (timeStart != "" || timeEnd != "")) {
				answer = timeStart+'-'+timeEnd;
				isEstimate = true;
			
				var timeStart1 = new Date("01/01/2020 " + timeStart);
				var timeEnd1 = new Date("01/01/2020 " + timeEnd);
				var hourDiff = (timeEnd1 - timeStart1) / 1000;

				if (timeStart == "" || timeEnd == "") {
					if(!$('.timeRange').next('.validdation_time').length) {
						$('.timeRange').after('<div class="validdation_time" style="color:red;">' + properties["validations"][0]["startendtime"] + '</div>');
					}			
					$("#dynamicNext").attr("disabled", "disabled");
					return false;
				}
				else if (hourDiff < 0) {
					if(!$('.timeRange').next('.validdation_time').length) {
						$('.timeRange').after('<div class="validdation_time" style="color:red;">' + properties["validations"][0]["timediff"] + '</div>');
					}			
					$("#dynamicNext").attr("disabled", "disabled");
					return false;
				}
			}
			else
			{
				if (answer == "") {
					if(!$('.mainTime').next('.validdation_time').length) {
						$('.mainTime').after('<div class="validdation_time" style="color:red;">' + properties["validations"][0]["maintime"] + '</div>');
					}			
					$("#dynamicNext").attr("disabled", "disabled");
					return false;
				}
			}			
		//}
		
		var answerJson = {	
			"option_id": answer_id,
			"answer": answer,
			"isEstimate": isEstimate
		};
		
		// Save and proceed
		saveCurrentAnswer(answer_id, answerJson);
	}

	return function(data, lastQuestion) {
		currentQuestion.elementId = "option" + data["question"]["id"];
		var answer = lastQuestion != null ? lastQuestion.currentQuestion.answerJson.answer : "";
		var selectedTime = answer!="" && !answer.includes("-")?answer:"";
		var selectedStarTime = answer.includes("-")?answer.split("-")[0]:""; 
		var selectedEndTime = answer.includes("-")?answer.split("-")[1]:""; 
		var isEstimate = lastQuestion != null ? lastQuestion.currentQuestion.answerJson.isEstimate: false;
		var elementHtml = "";
		elementHtml = `<div class="mainTime">
		                  <div class="row">
		                  	<div class="col-md-12">
		                  		<label><h6 class="textColor">Select Time</h6></label>
		                  	</div>
		                    <div class="col-md-8 col-sm-8 col-xs-12 col-12">
		                      <div class="input-group date selectTime" id="timepicker" data-target-input="nearest">
		                        <input type="text" class="form-control datetimepicker-input timepicker" name="option${data["question"]["id"]}" data-target="#timepicker" value=""/>
		                        <div class="input-group-append timePick" data-target="#timepicker" data-toggle="datetimepicker">
		                          <div class="input-group-text">
		                            <img src="assets/images/timer.png" class="img-fluid">
		                          </div>
		                        </div>
		                      </div>
		                    </div>
		                    <div class="col-md-4 col-sm-4 col-xs-12 col-12">
		                      <a class="clearTime btn animated fadeInUp pull-right mt-0 themeColor">Clear Time</a>
		                    </div>
		                  </div>
		                  <div class="custom-control custom-checkbox estimate mb-20">
		                    <input type="checkbox" name="option${data["question"]["id"]}checked" class="custom-control-input estimate1" id="estimate1" ${isEstimate?"checked":""}>
		                    <label class="custom-control-label eLabel" for="estimate1">This is an estimate</label>
		                  </div>
		                </div>

		                <div class="timeRange">
		                  <div class="text-center">
		                    <label class="themeColor">OR</label>
		                  </div>
		                  <div class="row">
		                    <div class="col-md-12">
		                      <label>
		                        <h6 class="textColor">Select a Time Range</h6>
		                      </label>
		                    </div>
		                    <div class="col-md-12">
		                      <div class="row">
		                        <div class="col-md-12">
		                          <div class="row">
		                            <div class="col-md-8">
		                              <div class="col-md-5 col-5 p-0 float-left">
		                                <div class="input-group date selectTime" id="timepicker1" data-target-input="nearest">
		                                  <input type="text" name="option${data["question"]["id"]}start" class="form-control datetimepicker-input startTime" data-target="#timepicker1" value=""/>
		                                  <div class="input-group-append rangeTime" data-target="#timepicker1" data-toggle="datetimepicker">
		                                    <div class="input-group-text"><img src="assets/images/timer.png" class="img-fluid"></div>
		                                  </div>
		                                </div>
		                              </div>
		                              <div class="col-md-2 col-2 text-center p-0 float-left">
		                                <span class="themeColor">To</span>
		                              </div>
		                              <div class="col-md-5 col-5 p-0 float-left">
		                                <div class="input-group date selectTime" id="timepicker2" data-target-input="nearest">
		                                  <input type="text" name="option${data["question"]["id"]}end" class="form-control datetimepicker-input endTime" data-target="#timepicker2" value=""/>
		                                  <div class="input-group-append rangeTime" data-target="#timepicker2" data-toggle="datetimepicker">
		                                    <div class="input-group-text"><img src="assets/images/timer.png" class="img-fluid"></div>
		                                  </div>
		                                </div>
		                              </div>
		                            </div>
		                            <div class="col-md-4">
		                              <a class="clearTimeRange btn animated fadeInUp pull-right mt-0 themeColor">Clear Time Range</a>
		                            </div>
		                          </div>
		                        </div>
		                      </div>
		                    </div>
		                  </div> 
		                </div>
	                `;
	    $("#options").html(elementHtml);

	    // Intialize Timepickers
	    $('#timepicker').datetimepicker({
	      format: 'LT',
	    });
		$('#timepicker').data("datetimepicker").date(selectedTime);

	    $('#timepicker1').datetimepicker({
	      format: 'LT',
	    });
		$('#timepicker1').data("datetimepicker").date(selectedStarTime);

	    $('#timepicker2').datetimepicker({
	      format: 'LT',
	    });
		$('#timepicker2').data("datetimepicker").date(selectedEndTime);

		// Hide a picker if ones value is already selected
		if(selectedTime!="") {
	  		$('.timeRange').css('opacity','0.2').css('pointer-events','none');
	  		console.log("selectedTime");
	  		//$("#dynamicNext").removeAttr("disabled");
		} else if(selectedStarTime!="" && selectedEndTime!="") {
	  		$('.mainTime').css('opacity','0.2').css('pointer-events','none');
	  		console.log("MainTime");
	  		//$("#dynamicNext").removeAttr("disabled");
		}

	    // Hide/show other picker based on selections
	    $(".timePick").click(function(e){
	      $('.startTime').val('');
	      $('.endTime').val('');
	      $('.timeRange').css('opacity','0.2').css('pointer-events','none');
	      $(".timeRange_valid").remove();
	      $("#dynamicNext").removeAttr("disabled");
	      $('.validdation_time').remove();
	    });

	    $(".clearTime").click(function(e){
	      $('.timepicker').val('');
	      $('.estimate1').prop('checked',false);
	      $('.timeRange').css('opacity','1').css('pointer-events','all');
	      $("#dynamicNext").attr("disabled", "disabled");
	      $('.validdation_time').remove();
	    });

	    $(".rangeTime").click(function(e){
	      $('.timepicker').val('');
	      $('.estimate1').prop('checked',false);
	      $('.mainTime').css('opacity','0.2').css('pointer-events','none');
	      $(".timeRange_valid").remove();
	      $("#dynamicNext").removeAttr("disabled");
	      $('.validdation_time').remove();
	    });

	    $(".clearTimeRange").click(function(e){
	      $('.startTime').val('');
	      $('.endTime').val('');
	      $('.mainTime').css('opacity','1').css('pointer-events','all');
	      $("#dynamicNext").attr("disabled", "disabled");
	      $('.validdation_time').remove();
	    });

	    // Add new event listener
	    $("#dynamicNext").off('click').click(function(event) {
	    	event.preventDefault();
	    	nextClick();
	    });
	};

})();