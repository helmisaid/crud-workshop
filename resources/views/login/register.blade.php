<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Skydash Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth px-0">
          <div class="row w-100 mx-0">
            <div class="col-lg-4 mx-auto">
              <div class="rounded text-left py-5 px-4 px-sm-5 shadow border ">
                <div class="d-flex justify-content-center py-2">
                  <a href="{{ route('login') }}" class="logo d-flex align-items-center justify-content-center pb-2">
                      <img src="{{ asset('assets/images/faviconwelife.png') }}" alt="Logo Perpustakaan Nasional" style="width: 20%; height: auto;">
                  </a>
                </div>
                <h4>Register dulu bro</h4>
                <h6 class="font-weight-light"></h6>
                <form class="pt-3" method="POST" action="{{ route('register.post') }}">
                  @csrf
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" id="nama_user" name="nama_user" placeholder="Full name" required>
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" id="username" name="username" placeholder="Username" required>
                  </div>
                  <div class="form-group">
                    <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="Email" required>
                  </div>
                  <div class="form-group position-relative">
                    <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Password" required>
                    <i class="mdi mdi-eye-off position-absolute" id="togglePassword" style="top: 50%; right: 10px; cursor: pointer;"></i>
                  </div>
                  <div class="form-group position-relative">
                    <input type="password" class="form-control form-control-lg" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required>
                    <i class="mdi mdi-eye-off position-absolute" id="togglePasswordConfirmation" style="top: 50%; right: 10px; cursor: pointer;"></i>
                  </div>
                  <div class="mb-4">

                  </div>
                  <div class="mt-3 d-grid gap-2">
                    <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN UP</button>
                  </div>
                  <div class="text-center mt-4 font-weight-light"> Sudah punya akun? <a href="{{ route('login') }}" class="text-primary">Login</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/template.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/todolist.js') }}"></script>
    <!-- endinject -->
    <script>
      @if(Session::has('success'))
        Swal.fire({
            title: 'Success!',
            text: '{{ Session::get('success') }}',
            icon: 'success',
            confirmButtonText: 'OK'
        });
      @endif

      const togglePassword = document.querySelector('#togglePassword');
      const password = document.querySelector('#password');
      togglePassword.addEventListener('click', function (e) {
        // toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        // toggle the eye slash icon
        this.classList.toggle('mdi-eye');
        this.classList.toggle('mdi-eye-off');
      });

      const togglePasswordConfirmation = document.querySelector('#togglePasswordConfirmation');
      const passwordConfirmation = document.querySelector('#password_confirmation');
      togglePasswordConfirmation.addEventListener('click', function (e) {
        // toggle the type attribute
        const type = passwordConfirmation.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordConfirmation.setAttribute('type', type);
        // toggle the eye slash icon
        this.classList.toggle('mdi-eye');
        this.classList.toggle('mdi-eye-off');
      });

    </script>
  </body>
</html>
