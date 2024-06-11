
//request ajax sending Post request
$(document).on("submit", "#request", function (e) {
  e.preventDefault();
  $("#request > .submit_btn").attr("disabled", "true");
  let url = "../../handlers/handleRequest.php";
  
  $.ajax({
    type: "post",
    url: url,
    data: $(this).serialize(),
    dataType: "JSON",

    success: function (data) {
      console.log(data);
      $("#request > .submit_btn").removeAttr("disabled");
      if (data.success) {
        $("#requestErrs").empty();
        $(".successMsg").empty();
        $(".successMsg").append(
          `
            <p class='p-3 m-0' >${data.successMsg}</p>
          `
        );
        $("#request")[0].reset();
      } else {
         $(".successMsg").empty();
        $("#requestErrs").empty();
        for (err of data) {
          $("#requestErrs").append(
            `
              <p class='px-3 py-1 mb-2' >-${err}</p>
            `
          );
        }
      }
    },
  });
});

//register ajax sending Post request
$(document).on("submit", "#registerForm1", function (e) {
  e.preventDefault();
  $("#registerForm1 > .submit_btn").attr("disabled", "true");
  let url = "./handlers/handleRegister.php";
  $.ajax({
    type: "post",
    url: url,
    data: $(this).serialize(),
    dataType: "JSON",
    success: function (data) {
      console.log(data);
      $("#registerForm1 > .submit_btn").removeAttr("disabled");
      if (data.success) {
        $("#Errs").empty();
        $(".successMsg").empty();
        $(".successMsg").append(`<p class='p-3 m-0' >${data.successMsg}</p>`);
        $("#registerForm1")[0].reset();
        window.location.href = data.redirect;
      } 
      else {
        $(".successMsg").empty();
        $("#Errs").empty();
        for (err of data) {
          $("#Errs").append(`<p class='px-3 py-1 m-0' >-${err}</p>`);
        }
      }
    },
  });
});
//logInForm ajax sending Post request
$(document).on("submit", "#loginForm", function (e) {
  e.preventDefault();
  // $("#loginForm > .submit_btn").attr("disabled", "true");
  let url = "./handlers/handleLogin.php";
  $.ajax({
    type: "post",
    url: url,
    data: $(this).serialize(),
    dataType: "JSON",

    success: function (data) {
      console.log(data);
      $("#loginForm > .submit_btn").removeAttr("disabled");
      if (data.loggedin) {
        window.location.href = data.redirect;

      }
      if (data.success) {

        $("#loginErrs").empty();
        $("#successMsg").empty();
        $("#successMsg").append(
          `
            <p class='p-3 m-0' >${data.successMsg}</p>
          `
        );
      } else {
         $("#successMsg").empty();
        $("#loginErrs").empty();
        for (err of data) {
          $("#loginErrs").append(
            `
              <p class='px-3 py-1 m-0' >-${err}</p>
            `
          );
        }
      }
    },

  
  });
});

//reset password ajax sending Post request  to send reset mail
$(document).on("submit", "#resetPasswordForm", function (e) {
  e.preventDefault();
  $("#resetPasswordForm > .submit_btn").attr("disabled", "true");
  let url = "./handlers/resetPass.php";
  $.ajax({
    type: "post",
    url: url,
    data: $(this).serialize(),
    dataType: "JSON",

    success: function (data) {
      console.log(data);
      $("#resetPasswordForm > .submit_btn").removeAttr("disabled");
      if (data.success) {
        $("#resetPassErrs").empty();
        $("#successMsg").empty();
        $("#successMsg").append(
          `
                        <p class='p-3 m-0' >${data.successMsg}</p>
                    `
        );
      } else {
         $("#successMsg").empty();
        $("#resetPassErrs").empty();
        for (err of data) {
          $("#resetPassErrs").append(
            `
              <p class='px-3 py-1 m-0' >-${err}</p>
            `
          );
        }
      }
    },
  });
});

//reset password  sending ajax Post request
$(document).on("submit", "#resetPassword", function (e) {
  e.preventDefault();
  $("#resetPassword > .submit_btn").attr("disabled", "true");
  let url = "../../handlers/handleResetPass.php";
  $.ajax({
    type: "post",
    url: url,
    data: $(this).serialize(),
    dataType: "JSON",

    success: function (data) {
      console.log(data);
      $("#resetPassword > .submit_btn").removeAttr("disabled");
      if (data.success) {
        $("#resetPassErrs").empty();
        $("#successMsg").empty();
        $("#successMsg").append(
          `
                        <p class='p-3 m-0' >${data.successMsg}</p>
                    `
        );
        setTimeout(function () {
          window.location.href = "http://localhost/task"; // the redirect goes here
        }, 5000); // 5 seconds
      } else {
         $("#successMsg").empty();
        $("#resetPassErrs").empty();
        for (err of data) {
          $("#resetPassErrs").append(
            `
              <p class='px-3 py-1 m-0' >-${err}</p>
            `
          );
        }
      }
    },
  });
});


  
//reset password  sending ajax Post request
$(document).on("submit", "#activeEmail", function (e) {
  e.preventDefault();
  $("#activeEmail > .submit_btn").attr("disabled", "true");
  let url = "../../handlers/activeEmail.php";
  $.ajax({
    type: "post",
    url: url,
    data: $(this).serialize(),
    dataType: "JSON",

    success: function (data) {
      console.log(data);
      $("#activeEmail > .submit_btn").removeAttr("disabled");
      if (data.success) {
        $("#resetPassErrs").empty();
        $("#successMsg").empty();
        $("#successMsg").append(
          `
                        <p class='p-3 m-0' >${data.successMsg} we will redirect you to login form after 5 secends</p>
                    `
        );
        setTimeout(function () {
          window.location.href = "http://localhost/task"; // the redirect goes here
        }, 5000); // 5 seconds
      } else {
         $("#successMsg").empty();
        $("#resetPassErrs").empty();
        for (err of data) {
          $("#resetPassErrs").append(
            `
              <p class='px-3 py-1 m-0' >-${err}</p>
            `
          );
        }
      }
    },
  });
});



//add new home things
$(document).on("submit", ".add", function (e) {
  e.preventDefault();
  $(".add > .submit_btn").attr("disabled", "true");
  let url = "../../handlers/handleAddHome.php";
  var certificates_logo = new FormData(this);
  $.ajax({
    type: "post",
    url: url,
    data: certificates_logo ,
    dataType: "JSON",
    cache: false,
    contentType: false,
    processData: false,
    success: function (data) {

      $(".add > .submit_btn").removeAttr("disabled");
      if (data.success) {
        $(".Errs").empty();
        $(".successMsg").empty();
        $(".successMsg").append(
          `
            <p class='p-3 m-0' >${data.successMsg}</p>
          `
        );
        setTimeout(function () {
          $(".successMsg").empty();
        },2000);

      } else {
         $(".successMsg").empty();
        $(".Errs").empty();
        for (err of data) {
          $(".Errs").append(
            `
              <p class='px-3 py-1 m-0' >-${err}</p>
            `
          );

        }
        setTimeout(function () {
          $(".Errs").empty();
        },2000);
      }
    },
  });
});


//add new home things
$(document).on("submit", ".update", function (e) {
  e.preventDefault();
  $(".update > .submit_btn").attr("disabled", "true");
  let url = "../../handlers/handleUpdateHome.php";
  var certificates_logo = new FormData(this);
  $.ajax({
    type: "post",
    url: url,
    data: certificates_logo ,
    dataType: "JSON",
    cache: false,
    contentType: false,
    processData: false,
    success: function (data) {
      console.log(data);
      $(".update > .submit_btn").removeAttr("disabled");
      if (data.success) {
        // $("#update > .submit_btn").attr("disabled", "true");
        $(".Errs").empty();
        $(".successMsg").empty();
        $(".successMsg").append(
          `
            <p class='p-3 m-0' >${data.successMsg}</p>
          `
          );
          document.getElementById('update').reset();
          document.getElementById('update-x').reset();
          setTimeout(function () {
            $(".successMsg").empty();
          },2000);

      } else {
         $(".successMsg").empty();
        $(".Errs").empty();
        for (err of data) {
          $(".Errs").append(
            `
              <p class='px-3 py-1 m-0' >-${err}</p>
            `
          );
        }
        setTimeout(function () {
          $(".Errs").empty();
        },2000);
      }
    },
  });
});

function getSliderDetailes() {
  var product_detailes = $('#slider-id').val();
  url = '../../handlers/handleAjax.php';


  $.ajax({
    url: url, // Change to the URL of your PHP file to fetch cities
    type: 'GET',
    dataType: "JSON",

    data: {
      id: product_detailes
    },
    success: function(response) {
      console.log(response.p);

      $('.about_img-img').remove();
      $('.about_img').append(`<img class='about_img-img' src="../../assets/img/home/sliders/${response.img}" style='width:150px; height:150px' alt="">`);
      $('.p').val(response.p);
      $('.old_img').val(response.img);
      $('.h').val(response.h);
      $('.button_text').val(response.button_text);
      $('.button_url').val(response.button_url);

    }
  });
}
