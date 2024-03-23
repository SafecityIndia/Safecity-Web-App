function filterFunction() {
  var input, filter, ul, li, a, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  div = document.getElementById("myDropdown");
  a = div.getElementsByTagName("a");
  for (i = 0; i < a.length; i++) {
    txtValue = a[i].textContent || a[i].innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      a[i].style.display = "";
    } else {
      a[i].style.display = "none";
    }
  }
}

// File upload preview
function readURL(input, callback) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      callback(e.target.result);
    }

    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

$(document).ready(function () {

    // Intialize select2
    $(".init-select2").select2();

    // Set default for toastr
    toastr.options.closeButton = true;
    toastr.options.timeOut = 0;
    toastr.options.extendedTimeOut = 0;

    /*$("#editField").on("click", function (e) {
      e.preventDefault();
      $('.edit-field .form-control').attr("disabled", false)
    })
    $("#saveChanges").on("click", function (e) {
      e.preventDefault();
      $('.edit-field .form-control').attr("disabled", true)
    })*/
    // let newValue = document.getElementById("incidentDesc").value.replace(/\s/g, '')
    // document.getElementById("incidentDesc").value = newValue;
});

$(document).ajaxError(function( event, jqxhr, settings, exception ) {
  console.log(jqxhr.status);
    if ( jqxhr.status== 401 ) {
        window.location.href = baseURL+"/auth/login";
    } else if(jqxhr.status==403) {
      toastr.error('Unauthorized Request!');
    }
});