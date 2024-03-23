$(document).ready(function() {
  // language change 
    $(document).on('click','.languageSelect a',function(){
		// deleteCookies();
        var this_id = $(this).data('id');
        var this_val = $(this).data('val');
        var text_val = $(this).data('lang');
        var mainval = $(this).data('mainval');
        // console.log(mainval,"==");
		// if(text_val=='Arabic'){
			// $( "html" ).attr("dir", "rtl");
		// }else{
			// $( "html" ).attr("dir", "ltr");
		// }

        $('.languageImg').css('display','none');
        $('.languageShortForm').text(mainval);

        $.cookie("language_id", this_id);
        $.cookie("language", $.trim(text_val));
        $.cookie("languageSF", this_val);
        $.cookie("language_val", mainval);
        location.reload();
    });
	
	var cookieValue = $.cookie("language");
	if(cookieValue=='Arabic'){
		console.log('Arabic Language');
		$("html").attr("dir", "rtl");
		$("body").css("text-align", "start");
	}else{
		console.log('English Language');
		$("html").attr("dir", "ltr");
		$("body").css("text-align", "start");
	}
	console.log(cookieValue);
});


function deleteCookies() {
	console.log('delete cookie called');
	var allCookies = document.cookie.split(';');
	for (var i = 0; i < allCookies.length; i++)
		document.cookie = allCookies[i] + "=;expires="
		+ new Date(0).toUTCString();
}