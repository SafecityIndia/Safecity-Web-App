var estimateDatePickerField = (function() {

	function nextClick() {

		var answer_id = 0;
		var answer = $("input[name="+currentQuestion.elementId+"]").val();
		var isEstimate = $("input[name="+currentQuestion.elementId+"checked]").is(':checked');
		if (answer == "") {
			$("#dynamicNext").attr("disabled", "disabled");
			return false;
		}
		var answerJson = {
			"option_id": answer_id,
			"answer": answer,
			"isEstimate": isEstimate
		};

		// Save and proceed
		saveCurrentAnswer(answer_id, answerJson);
	}
	
	/** Get Todays date helper */
	function getTodayDate(format) {
		var date = new Date().toJSON().slice(0, 10);
		switch(format) {
			case 'Y-m-d':
				return date;
			case 'd-m-Y':
				return date.slice(8, 10) + '/'  + date.slice(5, 7) + '/'  + date.slice(0, 4);
			case 'm-d-Y':
				return date.slice(5,7)+'/'+date.slice(8, 10)+'/'+date.slice(0, 4);
			default:
				return date;
		}
	}

	return function(data, lastQuestion) {
		currentQuestion.elementId = "option" + data["question"]["id"];
		var answer = lastQuestion != null ? lastQuestion.currentQuestion.answerJson.answer : "";
		var setDate = answer==""?getTodayDate('m-d-Y'):answer;
		var isEstimate = lastQuestion != null ? lastQuestion.currentQuestion.answerJson.isEstimate: false;
		var elementHtml = "";
		elementHtml = `
						<label>
							<h6 class="textColor">Select Date</h6>
						</label>
						<div class="input-group date selectDate w-75 width100" id="datetimepicker" data-target-input="nearest">
	                        <input type="text" class="form-control datetimepicker-input getDate"  name="option${data["question"]["id"]}" data-target="#datetimepicker">
	                        <div class="input-group-append" data-target="#datetimepicker" data-toggle="datetimepicker">
	                          <div class="input-group-text"> <img src="assets/images/calender.png" class="img-fluid"></div>
	                        </div>
	                      </div>
	                      <div class="custom-control custom-checkbox estimate">
	                        <input type="checkbox" name="option${data["question"]["id"]}checked" class="custom-control-input estimate" id="estimate" ${isEstimate?"checked":""}>
	                        <label class="custom-control-label eLabel" for="estimate">This is an estimate</label>
	                      </div>`;
		$("#options").html(elementHtml);

		// Initialize Datepicker
		var todaydate = new Date();
		$('#datetimepicker').datetimepicker({
		     format: 'L', 
		     todayHighlight: true,
		     showClose: true,
		     toolbarplacement: 'bottom',
		     showClear: true,
		     showClose: true,
		     endDate: todaydate,
		     maxDate: todaydate,
		     icons: { 
		       close: 'OK'
		     },
		     // debug: true
		});
		$('#datetimepicker').data("datetimepicker").date(setDate);

		$("#dynamicNext").removeAttr("disabled");
		
		/*$("#datetimepicker").click(function(event) {
			$("#dynamicNext").removeAttr("disabled");
		});*/

		// Add new event listener
		$("#dynamicNext").off('click').click(function(event) {
			event.preventDefault();
			nextClick();
		});
	}

})();
