
$(function () {
  // keep next button disabled on page load
  $(".nxt").attr("disabled", "disabled");

  // remove d-none class of next button on click
  $(".nxt").removeClass("d-none");

   // save index position of li which is next to current li
  var img_cnt1 = $("li.activate").index() + 1;

  //check if current index position is - for previous buttons
  // if (img_cnt1 == "1") {
  //   $(".hide_one").addClass("d-none");
  //   $(".show_one").removeClass("d-none");
  // } else {
  //   $(".hide_one").removeClass("d-none");
  //   $(".show_one").addClass("d-none");
  // }

   /*
   On click of input check if input is empty or not
    add / remove - disabled attribute
    add / remove - valid / invalid class
    calculate for progress bar
   */
  $(".inputBox").on("input", function () {
    var input = $(this);
    var is_name = input.val();
    if (is_name) {
      input.removeClass("invalid").addClass("valid");
      $("li.activate div").remove();
      $(".nxt").removeAttr("disabled");
      var img_cnt = $("li.activate").index() + 1;
      var img_amt = $(".covering li.form-group").length;

      var progress = (img_cnt / img_amt) * 100;
      $(".progress-bar").css("width", Math.round(progress) + "%");              
      $(".progress-text").text(Math.round(progress) + "% Completed");
    } else {
      input.removeClass("valid").addClass("invalid");
      // $(".invalid").after('<div class="checkError">This field is required</div>');
      $(".nxt").attr("disabled", "disabled");
      var img_cnt = $("li.activate").index() + 1;
      var img_amt = $(".covering li.form-group").length;
      img_cnt--;
      var progress = (img_cnt / img_amt) * 100;
      $(".progress-bar").css("width", Math.round(progress) + "%");              
      $(".progress-text").text(Math.round(progress) + "% Completed");
    }
  });

  /*
  On selection of radio button value, calculate progress bar
  */
   $('input:radio.custom-control-input').change(
    function(){
        if ($(this).is(':checked')) {
            // append goes here
            var img_cnt = $("li.activate").index() + 1;
            var img_amt = $(".covering li.form-group").length;
            var progress = (img_cnt / img_amt) * 100;
            $(".progress-bar").css("width", Math.round(progress) + "%");              
            $(".progress-text").text(Math.round(progress) + "% Completed");
            $(".nxt").removeAttr("disabled");
        }
        else {
          var img_cnt = $("li.activate").index() + 1;
          var img_amt = $(".covering li.form-group").length;
          img_cnt--;
          var progress = (img_cnt / img_amt) * 100;
          $(".progress-bar").css("width", Math.round(progress) + "%");              
          $(".progress-text").text(Math.round(progress) + "% Completed");
          $(".nxt").attr("disabled", "disabled");
        }
    });

  var img_cnt = $("li.activate").index() + 1;
  var img_amt = $(".covering li.form-group").length;

  $(".img_cnt").html(img_cnt);
  $(".img_amt").html(img_amt);

  //On click of prev button
  $(".covering .prev").click(function () {
    event.preventDefault();

    //remove disabled attribute of next button
    $(".nxt").removeAttr("disabled");

    /*
    check if any option is selected in radio button,
    then remove disabled attribute of next button
    */
    if($('input:radio.custom-control-input').is(':checked')) {
      $(".nxt").removeAttr("disabled");
    }
    
    /*
      check if current li has activate class
      add / remove - activate / inactive class, and add or remove effects
    */
    if ($(".covering .progress-form li").hasClass("activate")) {
      var $curr = $("li.activate");

      var $inactive = $("li.inactive");

      $curr = $curr.prev().addClass("activate fadeInUp").removeClass("fadeOutLeftBig");
      $curr = $curr.next().addClass("inactive fadeOutLeftBig").removeClass("activate fadeInUp");
      $curr.nextAll().removeClass("inactive fadeOutLeftBig");
      $curr.prev().removeClass("fadeOutLeftBig");
      $curr.addClass("fadeInUp");
    }

    //count index of current li (question)
    var img_cnt = $("li.activate").index() + 1;

    //count total number of li (questions)
    var img_amt = $(".covering li.form-group").length;

    $(".img_cnt").html(img_cnt);
    $(".img_amt").html(img_amt);

    /*

    check the index of current li == 1
    remove d-none class of first previous button
    add d-none class to previous button
    */
    // if (img_cnt == "1") {
    //   $(".show_one").removeClass("d-none");
    //    $(".covering .prev").addClass("d-none");
    // }

    //add / remove - active / inactive class
    $curr.addClass("newoneclass");
    $(".covering .animated").not($curr).removeClass("newoneclass");
    if ($(".covering .progress-form li").hasClass("newoneclass")) {
      $(".covering li.newoneclass").next().removeClass("activate1").addClass("d-none");
      $inactive.removeClass("fadeOutLeftBig");
    }


    /*check if current li(question) is last question in the form
    add /remove -d-none class to hide_last button
    add / remove - d-none class to show_last button
    */
    if (img_cnt == img_amt) {
      $(".hide_last").addClass("d-none");
      $(".show_last").removeClass("d-none");
    } else {
      $(".hide_last").removeClass("d-none");
      $(".show_last").addClass("d-none");
    }
  });

  //on click of next button
  $(".covering .nxt").click(function () {
    //remove d-none class from previous button
    $(".prev").removeClass("d-none");

    //add fadeInUp class to next button
    $(".nxt").addClass("fadeInUp");
    
    //add disabled attribute to next question button (on click of next button)
    $(".nxt").attr("disabled", "disabled");

    //remove disabled attribute from next button - when any value is selected in radio button
    if($('input:radio.custom-control-input').is(':checked')) {
      $(".nxt").removeAttr("disabled");
    }

    
    /*check if current li has class active 
    add / remove activate class
    */
   if ($(".covering .progress-form li").hasClass("activate")) {
      $(".covering p.alerted").removeClass("fadeInLeft");

      var $activate = $("li.activate");
      var $inactive = $("li.inactive");
      $activate.addClass("newoneclass");
      $(".covering .animated").not($activate).removeClass("newoneclass");

      $activate.removeClass("fadeInUp activate").addClass("fadeOutLeftBig");
      
      if ($activate.hasClass("newoneclass")) {
        $inactive.removeClass("fadeOutLeftBig");
      }
      
      $inactive.removeClass("activate activate1 fadeInUp").prev().addClass("fadeInUp");
      $inactive.removeClass("d-none inactive").addClass("activate activate1 fadeInUp").next().addClass("inactive");
      
      var img_cnt = $("li.activate").index() + 1;
      var img_amt = $(".covering li.form-group").length;

      $(".img_cnt").html(img_cnt);
      $(".img_amt").html(img_amt);

      /*check if current index of li is greater than 1
      if yes - show second previous button - which will go to next screen
      if no - show first previous button - which will go to consent screen
      */
      // if (img_cnt > "1") {
      //   $(".show_one").addClass("d-none");
      // } else {
      //   $(".show_one").removeClass("d-none");
      // }

      /*check if current li(question) is the last one in form
      if yes - hide next button which will go to next screen & show next button which will redirect to thankyou page
      if no - show next button which will go to next screen (question)
      */
      if (img_cnt == img_amt) {                
            $(".hide_last").addClass("d-none");
             $(".show_last").removeClass("d-none");
          } else {
            $(".show_last").addClass("d-none");
            $(".hide_last").removeClass("d-none");
          }
        } //End Else

      });

      //Categories


});

$(".covering .inputBox").keydown(function (e) {
  if (e.keyCode == 13) {
    e.preventDefault();
    return false;
  }
});