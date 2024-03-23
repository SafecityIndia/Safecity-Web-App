<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$current_url = current_url();
$explode_url = explode('/', $current_url);
$cntArr = count($explode_url);
$getLastfield = $explode_url[$cntArr-1];

$lang_id = (isset($_COOKIE['language_id']) && !empty($_COOKIE['language_id']) ? $_COOKIE['language_id'] : '');
$assetsVal = base_url().'assets';
?>
<!-- Footer Start -->

<footer>
	<div class="container">
		<div class="copyright">
			<div class="text-center">
				<span>&copy; <?php echo $this->lang->line('safecity'); ?> <?php echo date('Y'); ?></span>
                <span>
                    <a href="privacy_policy" class="textColor">
                        <?php echo $this->lang->line('privacy_policy'); ?>
                    </a>
                </span> |
                <span>
                    <a href="terms_of_use" class="textColor">
                        <?php echo $this->lang->line('terms_of_use'); ?>
                    </a>
                </span>
            </div>
        </div>
    </div>


</footer>

<!-- Footer End -->

<script src="<?php echo $assetsVal; ?>/js/jquery.min.js"  ></script>
<script src="<?php echo $assetsVal; ?>/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo $assetsVal; ?>/js/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>assets/admin/js/select2.min.js"></script>
<script src="<?php echo $assetsVal; ?>/js/script-form.js"></script>
<script src="<?php echo $assetsVal; ?>/js/jquery.cookie.min.js" type="text/javascript"></script>
<script src="<?php echo $assetsVal; ?>/js/bootstrap3-typeahead.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo $assetsVal; ?>/js/language/language_change.js"></script>
<!-- Google MAP Script -->
<script defer src="https://maps.google.com/maps/api/js?key=AIzaSyA-RG4hM7qRh3jHfOwSuUOBexPTn0CZf6w&amp&libraries=geometry,places">
</script>

<script type="text/javascript">
	$(document).ready(function() {
        /*var myVar;

        function myFunction() {
          myVar = setInterval(alertFunc, 1000);
        }

        function alertFunc() {
          location.reload();
        }*/
            var $myGroup = $('#myGroup');
    $myGroup.on('show','.collapse', function() {
        $myGroup.find('.collapse.in').collapse('hide');
    });


		// if(!$.cookie("lang_id")){
            // $.cookie("lang_id", 1);
        // }

        if($.cookie('language')){
            $.cookie("language", $.cookie('language'));
        } else {
            $.cookie("language", 'English');
            $.cookie("language_id", 1);
        }

        if(!$.cookie("client_id")) {
            $.cookie("client_id", 1);
        }
        if(!$.cookie("country_id")) {
            $.cookie("country_id", 101);
        }
        if(!$.cookie("country")) {
            $.cookie("country", "India");
        }
        if(!$.cookie("city")) {
            $.cookie("city", "Mumbai");
        }

        // $.cookie("language_id", 1);
        // $.cookie("client_id", 1);

        console.log( $.cookie() );

        $(document).on('click','.main_menu',function(){
            $.cookie("menu_police", '');
            $.cookie("fir_menu", '');
        });
        $(document).on('click','.policestation_drop',function(){
            $.cookie("menu_police", 'yes');
        });
        $(document).on('click','.legal_menu_drop',function(){
            $.cookie("menu_police", '');
        });
        /*$(document).on('click','.police_dropdown',function(){
            $.cookie("menu_police", 'yes');
            $.cookie("fir_menu", '');
        });*/
        $(document).on('click','.fir_menu',function(){
            $.cookie("fir_menu", 'yes');
        });

        $(document).on('click','.shareSafetyInfo',function(){
            var safetyArr = ['shareSafetyTips'];
            $.cookie('safety_tip_url', safetyArr);
            $.cookie('l_u', 'shareSafetyTips');
        });

        if($.cookie("mapAddHospital")){
            $.removeCookie("mapAddHospital");
        }
        if($.cookie("mapAddPolice")){
            $.removeCookie("mapAddPolice");
        }

        // remove all cookies varibles start
            /*var cookies = $.cookie();
            for(var cookie in cookies) {
               $.removeCookie(cookie);
           }*/
        // remove all cookies varibles end

        // consent form start
            $(".consent_btn").click(function(e){
               if (!$('input[name^=agreeConsent]:checked').length) {
                  if($("div").hasClass("requiredAttr") != true){
    					var showHtml = "<div class='requiredAttr'><span style='color: red'><?php echo $this->lang->line('consent_error'); ?></span></div>";
    					$('.proceedError').append(showHtml);
                        $(".safetyBtn").attr("disabled", "disabled");
    					e.preventDefault();
    				} else {
                        // window.location.href="shareIncident-form";
    					e.preventDefault();
    				}
    			} else {
                    window.location.href="shareIncident-form";
                }
    		});

            $('input[name="agreeConsent"]').click(function(){
                var checkVal = $("input[name='agreeConsent']:checked").val();
                if(checkVal!=''){
                    $(".safetyBtn").removeAttr("disabled");
                    $('.proceedError').empty();
                } else {
                    var showHtml = "<div class='requiredAttr'><span style='color: red'><?php echo $this->lang->line('consent_error'); ?></span></div>";
                    $('.proceedError').append(showHtml);
                    $(".safetyBtn").attr("disabled", "disabled");
    	        }
            	if($(this).prop("checked") == true){
                    $(".safetyBtn").removeAttr("disabled");
            		$('.proceedError').empty();
            		$.cookie("is_consent", '1');
            	}
            	else if($(this).prop("checked") == false){
            		var showHtml = "<div class='requiredAttr'><span style='color: red'><?php echo $this->lang->line('consent_error'); ?></span></div>";
            		$('.proceedError').append(showHtml);
                    $(".safetyBtn").attr("disabled", "disabled");
            		$.cookie("is_consent", '0');
            	}
            });
        // consent form end
    });

  // <!-- Legal Resources Page -->
      $(window).on('load',function(){
          $('.legalResourceModal').modal('show');
      });
       $(document).ready(function(){
          $('.legalResourceModal').modal({
              backdrop: 'static'
          });
      });
  // <!-- Legal Resources Page -->
</script>

<!-- whatsapp widget -->
<!--
<script>
    var url = 'https://wati-integration-service.clare.ai/ShopifyWidget/shopifyWidget.js?25420';
    var s = document.createElement('script');
    s.type = 'text/javascript';
    s.async = true;
    s.src = url;
    var options = {
  "enabled":true,
  "chatButtonSetting":{
      "backgroundColor":"#4dc247",
      "ctaText":"",
      "borderRadius":"25",
      "marginLeft":"0",
      "marginBottom":"50",
      "marginRight":"50",
      "position":"right"
  },
  "brandSetting":{

      "brandName":"Safecity",
      "brandSubTitle":"Typically replies within a day",
      "brandImg":"https://webapp.safecity.in/assets/images/safecity-logo.png",
      "welcomeText":"Hi there!\nHow can I help you?",
      "messageText":"",
      "backgroundColor":"#0a5f54",
      "ctaText":"Start Chat",
      "borderRadius":"25",
      "autoShow":false,
      "phoneNumber":"912250323336"
  }
};
    s.onload = function() {
        CreateWhatsappChatWidget(options);
    };
    var x = document.getElementsByTagName('script')[0];
    x.parentNode.insertBefore(s, x);
</script>
-->
</body>