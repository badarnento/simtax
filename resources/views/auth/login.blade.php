<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="bootstrap admin template">
  <meta name="author" content="">
  <title>Login | SIMTAX</title>
  <link rel="apple-touch-icon" href="{{asset('template')}}/base/assets/images/apple-touch-icon.png">
  <link rel="shortcut icon" href="{{asset('template')}}/base/assets/images/favicon.ico">
  <!-- Stylesheets -->
  <link rel="stylesheet" href="{{asset('template')}}/global/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{asset('template')}}/global/css/bootstrap-extend.min.css">
  <link rel="stylesheet" href="{{asset('template')}}/base/assets/css/site.min.css">
  <!-- Plugins -->
  <link rel="stylesheet" href="{{asset('template')}}/global/vendor/animsition/animsition.css">
  <link rel="stylesheet" href="{{asset('template')}}/global/vendor/asscrollable/asScrollable.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <link rel="stylesheet" href="{{asset('template')}}/base/assets/examples/css/pages/login-v3.css">
  <!-- Fonts -->
  <link rel="stylesheet" href="{{asset('template')}}/global/fonts/material-design/material-design.min.css">
  <!-- <link rel="stylesheet" href="{{asset('template')}}/global/fonts/brand-icons/brand-icons.min.css"> -->
  <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>
  <!--[if lt IE 9]>
    <script src="{{asset('template')}}/global/vendor/html5shiv/html5shiv.min.js"></script>
    <![endif]-->
  <!--[if lt IE 10]>
    <script src="{{asset('template')}}/global/vendor/media-match/media.match.min.js"></script>
    <script src="{{asset('template')}}/global/vendor/respond/respond.min.js"></script>
    <![endif]-->
  <!-- Scripts -->
  <script src="{{asset('template')}}/global/vendor/breakpoints/breakpoints.js"></script>
  <script>
    // Breakpoints();
  </script>
  <link rel="stylesheet" href="{{asset('css')}}/custom.css">

</head>

<body class="animsition page-login-v3 layout-full">
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
  <!-- Page -->
  <div class="page vertical-align text-center" data-animsition-in="fade-in" data-animsition-out="fade-out">>
    <div class="page-content vertical-align-middle">
      <div class="panel">
        <div class="panel-body">
          <div class="brand">
            <!-- <img class="brand-img" src="{{asset('template')}}/base/assets//images/logo-blue.png" alt="..."> -->
            <h2 class="brand-text font-size-18">SIMTAX</h2>
          </div>
          <form id="loginForm" autocomplete="off">
            <div class="form-group form-material floating" data-plugin="formMaterial">
              <input id="email" type="email" class="form-control" name="email" />
              <label class="floating-label">Email</label>
            </div>
            <div class="form-group form-material floating" data-plugin="formMaterial">
              <input id="password" type="password" class="form-control" name="password" minlength="8" />
              <label class="floating-label">Password</label>
            </div>
            <!--         <div class="form-group clearfix">
              <div class="checkbox-custom checkbox-inline checkbox-primary checkbox-lg float-left">
                <input type="checkbox" id="inputCheckbox" name="remember">
                <label for="inputCheckbox">Remember me</label>
              </div>
              <a class="float-right" href="forgot-password.html">Forgot password?</a>
            </div> -->
            <button type="submit" class="btn btn-primary btn-block btn-lg mt-40">Sign in</button>
          </form>
          <!-- <p>Still no account? Please go to <a href="register-v3.html">Sign up</a></p> -->
        </div>
      </div>
      <footer class="page-copyright page-copyright-inverse">
        <!-- <p>WEBSITE BY amazingSurge</p> -->
        <p>© 2025. All RIGHT RESERVED.</p>
      </footer>
    </div>
  </div>
  <!-- End Page -->
  <!-- Core  -->
  <script src="{{asset('template')}}/global/vendor/babel-external-helpers/babel-external-helpers.js"></script>
  <script src="{{asset('template')}}/global/vendor/jquery/jquery.js"></script>
  <script src="{{asset('template')}}/global/vendor/tether/tether.js"></script>
  <script src="{{asset('template')}}/global/vendor/bootstrap/bootstrap.js"></script>
  <script src="{{asset('template')}}/global/vendor/animsition/animsition.js"></script>
  <script src="{{asset('template')}}/global/vendor/mousewheel/jquery.mousewheel.js"></script>
  <script src="{{asset('template')}}/global/vendor/asscrollbar/jquery-asScrollbar.js"></script>
  <script src="{{asset('template')}}/global/vendor/asscrollable/jquery-asScrollable.js"></script>
  <script src="{{asset('template')}}/global/vendor/ashoverscroll/jquery-asHoverScroll.js"></script>
  <!-- Plugins -->
  <!-- Scripts -->
  <script src="{{asset('template')}}/global/js/State.js"></script>
  <script src="{{asset('template')}}/global/js/Component.js"></script>
  <script src="{{asset('template')}}/global/js/Plugin.js"></script>
  <script src="{{asset('template')}}/global/js/Base.js"></script>
  <script src="{{asset('template')}}/global/js/Config.js"></script>
  <script src="{{asset('template')}}/base/assets/js/Section/Menubar.js"></script>
  <script src="{{asset('template')}}/base/assets/js/Section/GridMenu.js"></script>
  <script src="{{asset('template')}}/base/assets/js/Section/Sidebar.js"></script>
  <script src="{{asset('template')}}/base/assets/js/Section/PageAside.js"></script>
  <script src="{{asset('template')}}/base/assets/js/Plugin/menu.js"></script>
  <script>
    Config.set('assets', "{{asset('template')}}/base/assets");
  </script>
  <!-- Page -->
  <script src="{{asset('template')}}/base/assets/js/Site.js"></script>
  <script src="{{asset('template')}}/global/js/Plugin/asscrollable.js"></script>
  <script src="{{asset('template')}}/global/js/Plugin/slidepanel.js"></script>
  <script src="{{asset('template')}}/global/js/Plugin/material.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  <script>
    (function(document, window, $) {
      'use strict';
      var Site = window.Site;
      $(document).ready(function() {
        Site.run();
      });
    })(document, window, jQuery);
  </script>

  <!-- Tambahkan Toastr CSS & JS -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  <!-- Tambahkan Toastr CSS & JS -->

  <script>
    // Ambil token dari cookie
    function getCookie(name) {
      let match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
      return match ? match[2] : null;
    }

    let token = getCookie("token");

    if (token) {
      // Coba validasi token dengan API /me
      fetch("/api/me", {
          method: "GET",
          headers: {
            "Authorization": "Bearer " + token,
            "Content-Type": "application/json"
          }
        })
        .then(response => {
          if (response.ok) {
            window.location.href = "#/";
          }
        })
        .catch(error => {
          console.error("Token check failed:", error);
        });
    }
  </script>

  <script>
    document.getElementById("loginForm").addEventListener("submit", function(e) {
      e.preventDefault();

      let email = document.getElementById("email").value;
      let password = document.getElementById("password").value;

      if (!document.getElementById("loading-screen")) {
        document.body.insertAdjacentHTML('beforeend', `
                <div id="loading-screen">
                    <div class="spinner"></div>
                </div>
            `);
      }

      let loadingScreen = document.getElementById("loading-screen");
      loadingScreen.style.display = "flex";
      $(loadingScreen).hide().fadeIn(200);

      fetch("/api/login", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            email,
            password
          }),
        })
        .then(response => response.json())
        .then(data => {
          if (data.type === "success" && data.data.access_token) {
            let token = data.data.access_token;
            let expiry = data.data.expiry_in;

            let expiryDate = new Date();
            expiryDate.setTime(expiryDate.getTime() + expiry * 1000);

            let secureFlag = location.protocol === 'https:' ? '; Secure' : '';

            document.cookie = `token=${token}; expires=${expiryDate.toUTCString()}; path=/; SameSite=Lax${secureFlag}`;

            toastr.success("Login Successful", "Success");

            setTimeout(() => {
              window.location.href = "/#/";
            }, 500)
          } else if (data.type === "error") {
            toastr.error(data.message || "Login Failed", "Error");
          } else {
            toastr.error("An error occurred", "Error");
          }
        })
        .catch(error => {
          console.error("Error:", error);
          toastr.error("Something went wrong", "Error");
        })
        .finally(() => {
          $("#loading-screen").fadeOut(200, function() {
            $(this).css("display", "none");
          });
        });
    });
  </script>

</body>

</html>