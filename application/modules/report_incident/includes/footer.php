<script src="<?php echo base_url() ?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/script-form.js"></script>
<script src="<?php echo base_url() ?>assets/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/moment.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/daterangepicker.js"></script>
<script src="<?php echo base_url() ?>assets/js/tempusdominus-bootstrap-4.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery.cookie.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery.cookie.js"></script>

<script type="text/javascript">
    var todaydate = new Date();
    $('#datetimepicker').datetimepicker({
      format: 'L',
      // format: 'dd/mm/yyyy',
      // dateFormat: 'dd/mm/yyyy',
      // startDate: todaydate, 
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
    // $('#datetimepicker').trigger('click');

    $('#timepicker').datetimepicker({
      format: 'LT',
      // debug: true,
    });


    $('#timepicker1').datetimepicker({
      format: 'LT',
    });

    $('#timepicker2').datetimepicker({
      format: 'LT',
    });

    $('.show_one').click(function(){
      history.go(-1);
    }); 

    $('.prev_Btn').click(function(){
      history.go(-1);
    });

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