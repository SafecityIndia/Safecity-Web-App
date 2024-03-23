<?php
  if(isset($_COOKIE['safety_tip_url']) && !empty($_COOKIE['safety_tip_url'])){
      $explodeVal = explode(',', $_COOKIE['safety_tip_url']);
  }
  if(isset($explodeVal) && !empty($explodeVal) && in_array('shareSafetyTips', $explodeVal) && in_array('shareSafetyMap', $explodeVal) && in_array('shareSafetyTip', $explodeVal) && in_array('safetyTipTitle', $explodeVal) && in_array('thankYou', $explodeVal)){
      $this->load->view('includes/header');
?>
<!DOCTYPE html>

<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Jekyll v3.8.5">
  <title>Safe City</title> 

  <!-- Bootstrap core CSS -->
  <link rel="icon" type="image/png" href="assets/images/favicon.png" />
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" >
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/css/media-query.css" rel="stylesheet">
  <link href="assets/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/animate.compat.css">
  <link rel="stylesheet" href="assets/css/style-form.css">
</head>

<body>
  <main>
    <div class="main-content my-auto">
      <div class="container">
        <div class="text mx-auto width100" style="width: 36%;">
          <div class="text-center mb-4">
            <img src="assets/images/thank-you-check.png" class="img-fluid checkIcon">
          </div>
          <h4 class="mb-5 text-center textColor">
            <?php echo $this->lang->line('safety_thank_you_desc'); ?>
          </h4>
        
          <div class="text-center mt-4">
            <a href="home" class="btn w-100 btn_purple backHome">
              <?php echo $this->lang->line('button_go_home'); ?>
            </a>
          </div>

        </div>
      </div>    
    </div>
  </main>
</body>

<script src="assets/js/jquery-3.3.1.js"  ></script>     
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/script-form.js"></script>
<script type="text/javascript" src="assets/js/jquery.cookie.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.cookie.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
        $.removeCookie("localitySafe");
        $.removeCookie("landmarkSafe");
        $.removeCookie("citySafe");
        $.removeCookie("stateSafe");
        $.removeCookie("countrySafe");
        $.removeCookie("safetyTipD");
        $.removeCookie("safetyTipT");
        $.removeCookie("safety_tip_url");
        $.removeCookie("l_u");
        console.log( $.cookie() );

        // remove all cookies varibles start
            // $.removeCookie("getAge");
            // var cookies = $.cookie();
            // for(var cookie in cookies) {
            //    $.removeCookie(cookie);
            // }
        // remove all cookies varibles end
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
