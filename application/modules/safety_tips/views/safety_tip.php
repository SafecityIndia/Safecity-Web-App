<?php
  if(isset($_COOKIE['safety_tip_url']) && !empty($_COOKIE['safety_tip_url'])){
      $explodeVal = explode(',', $_COOKIE['safety_tip_url']);
  }
  if(isset($explodeVal) && !empty($explodeVal) && in_array('shareSafetyTips', $explodeVal) && in_array('shareSafetyMap', $explodeVal) && in_array('shareSafetyTip', $explodeVal)){
      $this->load->view('includes/header');
?>

  <div class="covering my-auto pt-4 pb-4 shareSafetyTips">  


    <div class="container">
      <div class="text mx-auto">

        <div class="col-md-12 col-sm-6 col-xs-12">
          <div class="row">

            <div class="col-md-3 pl-0 my-auto">
              <!-- <?php $this->load->view('sidebar'); ?> -->
              <div class="navList1">
                <ul class="nav flex-column"> 
                    <li class="nav-item">     
                        <div class="box active"></div>               
                        <a class="nav-link mo-d-none" href="javascript:void(0);">
                          <?php echo $this->lang->line('safety_location'); ?>
                        </a>
                    </li>
                    <!-- <li class="nav-item">
                        <div class="box active"></div>
                        <a class="nav-link mo-d-none" href="javascript:void(0);">
                          <?php //echo $this->lang->line('safety_map'); ?>
                        </a>
                    </li> -->
                    <li class="nav-item">
                        <div class="box active"></div>
                        <a class="nav-link" href="javascript:void(0);">
                          <?php echo $this->lang->line('write_safety_tip'); ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <div class="box"></div>
                        <a class="nav-link mo-d-none" href="javascript:void(0);">
                          <?php echo $this->lang->line('title_safety_tip'); ?>
                        </a>
                    </li>
                </ul>
              </div>
            </div>

            <div class="col-md-9 pl-0">

              <div class="questionaire">
                <form>

                  <ul class="progress-form">

                    <div class="Step1">

                      <a href="shareSafetyTips" class="pull-left animated fadeInUp show_one back-arrow"><img src="assets/images/icon-feather-arrow-left.svg" class="img-fluid leftIcon"></a>
                                            
                      <!-- step2 start -->
                     <li class="form-group animated fadeInUp activate selected " data-color="#E1523D" data-percentage="20%">

                        <label for="nameInput">                  
                          <h5 class="textColor"><?php echo $this->lang->line('safety_tips_desc'); ?></h5>
                        </label>
                        <input type="text" name="shareTipD" autocomplete="off" class="form-control inputBox shareTipD" placeholder="<?php echo $this->lang->line('safety_tips_desc_placeholder'); ?>" value="">
                        <span class="safetyTipErr"></span>
                      </li>
                      <!-- step2 end -->
                      <div class="text-left mainHtml">
                        <button class="btn btn-primary safetyBtn shareD animated nextPage fadeInUp pull-right mt-3 nxt_btn">
                          <?php echo $this->lang->line('button_next'); ?>
                          <span class="glyphicon glyphicon-chevron-down"></span>
                        </button>
                     </div>
                    </div>

                  </ul>

                </form>
                

             </div> <!-- //questionaire -->
           </div>

         </div>
       </div>



     </div> <!-- //text mx-auto -->

   </div>


 </div>


 <div class="clearfix"></div>

<?php
  $this->load->view('includes/footer');
?>


<script type="text/javascript">
  var required_field = "<?php echo $this->lang->line('required_field'); ?>";

  var myVar;

  function myFunction() {
    myVar = setInterval(alertFunc, 1000);
  }

  function alertFunc() {
    location.reload();
  }
  
  $(document).ready(function() {

       function disablePrev() { window.history.forward() }
       window.onload = disablePrev();
       window.onpageshow = function(evt) { if (evt.persisted) disableBack() }
       
       var inputValue =  $(".shareTipD").val().length;
        if(inputValue > 0){
            $(".safetyBtn").removeAttr("disabled");
        } else {
            $(".safetyBtn").attr("disabled", "disabled");
        }

      $('.shareTipD').keyup(function(){
          var inputValue =  $(".shareTipD").val().length;
          if(inputValue > 0){
              $(".safetyBtn").removeAttr("disabled");
          } else {
              $(".safetyBtn").attr("disabled", "disabled");
          }

          if(inputValue > 0){
              $('.safetyTipErr').hide();
          } else {
              $(".safetyTipErr").html(required_field).css('color','red').show();
          }
      });

      $(document).on('click','.shareD',function(e){
          var safetyTipD = $(".shareTipD").val();
          if(safetyTipD==''){
              $(".safetyTipErr").html(required_field).css('color','red').show();
            return false;
          } else {
              $('.safetyTipErr').hide();
              $.cookie("safetyTipD", safetyTipD);
              $.cookie('safety_tip_url', 'shareSafetyTips,shareSafetyMap,shareSafetyTip,safetyTipTitle');
              $.cookie('l_u', 'safetyTipTitle');
              window.location.href="safetyTipTitle";
              return false;
          }
          console.log( $.cookie() );
      });
      
  });
</script>

<?php
  } 
  else 
  {
      if(isset($_COOKIE['l_u']) && !empty($_COOKIE['l_u'])){
          redirect($_COOKIE['l_u']);
      } else {
          redirect('home');
      }
  }
?>
