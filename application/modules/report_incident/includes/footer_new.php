<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/script-form.js"></script>
<script src="assets/js/bootstrap-datepicker.min.js"></script>
<script src="assets/js/moment.min.js"></script>
<script src="assets/js/daterangepicker.js"></script>
<script src="assets/js/tempusdominus-bootstrap-4.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>

<script type="text/javascript">

  var todaydate = new Date();
  $('#datetimepicker').datetimepicker({
    format: 'L',
    startDate: todaydate,
    todayHighlight: true,
    showClose: true,
    toolbarplacement: 'bottom',
    showClear: true,
    showClose: true,
    icons: {
      close: 'OK'
    }
  });


   /*
    //calculate progress bar on selection of date
    $('#datetimepicker').datepicker()
    .on('change', function(e) {
      var img_cnt = $("li.activate").index() + 1;
      var img_amt = $(".covering li.form-group").length;
      var progress = (img_cnt / img_amt) * 100;
      $(".progress-bar").css("width", Math.round(progress) + "%");              
      $(".progress-text").text(Math.round(progress) + "% Completed");
      $(".nxt").removeAttr("disabled");
  });

  */

  $(function () {    
    $('#timepicker').datetimepicker({
      format: 'LT',
    });

    $('#timepicker1').datetimepicker({
      format: 'LT',
    });

    $('#timepicker2').datetimepicker({
      format: 'LT',
    });
  })

  $('.show_one').click(function(){
   history.go(-1);
 }); 

  $('.prev_Btn').click(function(){
   history.go(-1);
 });

  $("#violence_cat").click(function() {

      //get attribute value of checked checkbox on button click
      var selectedAttr = $(".getAttr:checkbox:checked").map(function () {
        return $(this).data('id')
      }).get();

      //if id is 1 - Domestic Violence - replace url start
      if(selectedAttr == '1') {
        $('#violence_cat').each(function(){ 
          var url = "<?php echo base_url(); ?>form_pc";
          $(this).attr('href',url);
        });
      }
      //if id is 1 - Domestic Violence - replace url end

      if(selectedAttr == '3') {
        $('#violence_cat').each(function(){ 
          var url = "<?php echo base_url(); ?>form_pa";
          $(this).attr('href',url);
        });
      }

      //if id is 4 - Physical Assault - replace url start
      if(selectedAttr == '4') {
        $('#violence_cat').each(function(){ 
          var url = "<?php echo base_url(); ?>form_pb";
          $(this).attr('href',url);
        });
      }

       //if id is 12 - Chain Snatching/Robbery - replace url start
       if(selectedAttr == '12') {
        $('#violence_cat').each(function(){ 
          var url = "<?php echo base_url(); ?>form_pb";
          $(this).attr('href',url);
        });
      }

      //if id is 3 & 12 - Rape & Chain Snatching/Robbery - replace url start
      if(selectedAttr == '3,12') {
        $('#violence_cat').each(function(){ 
          var url = "<?php echo base_url(); ?>form_pb";
          $(this).attr('href',url);
        });
      }

    //if id is 1 & 3 - Domestric Violence & Chain Snatching/Robbery - replace url start
      if(selectedAttr == '1,3') {
        $('#violence_cat').each(function(){ 
          var url = "<?php echo base_url(); ?>form_pa";
          $(this).attr('href',url);
        });
      }

      //if id is 3 & 4 - Rape & Physical Assault - replace url start
      if(selectedAttr == '3,4') {
        $('#violence_cat').each(function(){ 
          var url = "<?php echo base_url(); ?>form_pa";
          $(this).attr('href',url);
        });
      }
      
      //if id is 1 & 12 - Domestic & Chain Snatching - replace url start
      if(selectedAttr == '1,12') {
        $('#violence_cat').each(function(){ 
          var url = "<?php echo base_url(); ?>form_pb";
          $(this).attr('href',url);
        });
      }

      //if id is 4 & 12 - physical assault & Chain Snatching - replace url start
      if(selectedAttr == '1,12') {
        $('#violence_cat').each(function(){ 
          var url = "<?php echo base_url(); ?>form_pb";
          $(this).attr('href',url);
        });
      }

      //if id is 1 & 4 - domestic & physical assault - replace url start
      if(selectedAttr == '1,12') {
        $('#violence_cat').each(function(){ 
          var url = "<?php echo base_url(); ?>form_pb";
          $(this).attr('href',url);
        });
      }

      //if id is 1 & 4 - domestic & rape & chain snatching - replace url start
      if(selectedAttr == '1,3,12') {
        $('#violence_cat').each(function(){ 
          var url = "<?php echo base_url(); ?>form_pa";
          $(this).attr('href',url);
        });
      }

    });

      //for physical assualt -> b -> (yes-a-7) -> (no-7) start
      $("#physical_hurt").click(function() {

        //get attribute value of checked checkbox on button click
        var sAttr = $(".getAttr:checked").map(function () {
          return $(this).data('id')
        }).get();

        //if id is 1 - yes start
        if(sAttr == '1') {
          $('#physical_hurt').each(function(){ 
            var url = "<?php echo base_url(); ?>form_pa";
            $(this).attr('href',url);
          });
        }

          //if id is 2 - no start
          if(sAttr == '2') {
            $('#physical_hurt').each(function(){ 
              var url = "<?php echo base_url(); ?>form_p8";
              $(this).attr('href',url);
            });
          }
          
        });
      //for physical assualt -> b -> (yes-a-7) -> (no-7) end

      $("input[type='radio']").click(function() {
       if ($('.specify').is(':checked')) {
        $('.specifyBox').removeClass('d-none');
        $('.specifyBox').addClass('fadeInUp');
      }
      else {
        $('.specifyBox').addClass('d-none');
        $('.specifyBox').removeClass('fadeInUp');
        $('.specifyBox').val('');
      }

    });


  </script>
</body>
</html>