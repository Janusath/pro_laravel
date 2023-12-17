<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Pages / Register - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
{{-- jquery --}}
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">



  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Nov 17 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-8 col-md-8 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block">User</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                    <p class="text-center small">Enter your personal details to create account</p>
                  </div>

                  <form class="row g-3 needs-validation" novalidate action="{{ route('entrepreneur_register_user') }}" method="POST">
                    @csrf
                      <!-- Add this script at the end of your Blade file -->
                  @if(Session::has('sweet_alert'))
                  <script>
                      document.addEventListener('DOMContentLoaded', function () {
                          Swal.fire({
                              icon: '{{ Session::get('sweet_alert.type') }}',
                              title: '{{ Session::get('sweet_alert.title') }}',
                              text: '{{ Session::get('sweet_alert.text') }}',
                              timer: {{ Session::get('sweet_alert.timer') }},
                              timerProgressBar: {{ Session::get('sweet_alert.timerProgressBar', 'false') }},
                              showConfirmButton: false,
                          });
                      });
                  </script>
                  {{ Session::forget('sweet_alert') }}
                  @endif
                    <div class="col-md-6">
                      <label for="userName" class="form-label">userName</label>
                      <input type="text" name="userName" class="form-control" id="ownerName" required>
                      <div class="invalid-feedback">Please, enter owner name!</div>
                    </div>

                      <div class="col-md-6">
                        <label for="location" class="form-label">location</label>
                        <input type="text" name="location" class="form-control" id="location" required>
                        <div class="invalid-feedback">Please, enter location!</div>
                      </div>

                      <div class="col-md-6">
                        <label for="other" class="form-label">Other</label>
                        <input type="text" name="other" class="form-control" id="other" required>
                        @error('businessReNo')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                        <div class="invalid-feedback">Please, enter other!</div>
                      </div>
                      <div class="col-md-6">
                        <label for="phoneNo" class="form-label">phone Number</label>
                        <input type="number" name="phoneNo" class="form-control" id="phoneNo" required>
                        <div class="invalid-feedback">Please, enter phone Number!</div>
                      </div>


                    <div class="col-md-6">
                      <label for="Email" class="form-label">Email</label>
                      <input type="email" name="email" class="form-control" id="Email" required>
                      @error('email')
                      <div class="mt-2 text-danger">{{ $message }}</div>
                      @enderror
                      <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                    </div>

                    <div class="col-md-6">
                        <label for="Password" class="form-label">Password</label>
                        <div class="input-group input-group-merge">
                            <input type="password" name="password" class="form-control" id="Password" required>
                            <span class="input-group-text cursor-pointer toggle-password" data-target="Password"><i class="bx bx-hide"></i></span>
                        </div>
                        <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <div class="col-md-6">
                        <label for="ConfirmPassword" class="form-label">Confirm Password</label>
                        <div class="input-group input-group-merge">
                            <input type="password" name="confirmPassword" class="form-control" id="ConfirmPassword" required>
                            <span class="input-group-text cursor-pointer toggle-password" data-target="ConfirmPassword"><i class="bx bx-hide"></i></span>
                        </div>
                        <div class="invalid-feedback">Please confirm your password!</div>
                    </div>

                    {{-- <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                        <label class="form-check-label" for="acceptTerms">I agree and accept the <a href="#">terms and conditions</a></label>
                        <div class="invalid-feedback">You must agree before submitting.</div>
                      </div>
                    </div> --}}
                    <div class="col-md-12">
                      <button class="btn btn-primary w-100" type="submit">Create Account</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Already have an account? <a href="{{route('entrepreneur_login')}}">Log in</a></p>
                    </div>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
        var passwordInput = document.getElementById('Password');
        var rePasswordInput = document.getElementById('ConfirmPassword');
        var form = document.querySelector('form');

        form.addEventListener('submit', function (event) {
            if (passwordInput.value !== rePasswordInput.value) {
                // Prevent the form from submitting
                event.preventDefault();

                // Show Bootstrap alert
                var alertDiv = document.createElement('div');
                alertDiv.className = 'alert alert-danger';
                alertDiv.innerHTML = '<strong>Error:</strong> Passwords do not match. Please re-enter your passwords.';
                form.insertBefore(alertDiv, form.firstChild);

                // Show Bootstrap validation state
                passwordInput.classList.add('is-invalid');
                rePasswordInput.classList.add('is-invalid');
            }
        });

        // Clear alert and validation state when inputs are changed
        passwordInput.addEventListener('input', function () {
            clearAlertAndValidation();
        });

        rePasswordInput.addEventListener('input', function () {
            clearAlertAndValidation();
        });

        function clearAlertAndValidation() {
            var alertDiv = form.querySelector('.alert');
            if (alertDiv) {
                form.removeChild(alertDiv);
            }

            passwordInput.classList.remove('is-invalid');
            rePasswordInput.classList.remove('is-invalid');
        }
    });
</script>


<script>
    $(document).ready(function () {
        $(".toggle-password").click(function () {
            var targetId = $(this).data("target");
            var input = $("#" + targetId);
            var icon = $(this).find("i");

            if (input.attr("type") === "password") {
                input.attr("type", "text");
                icon.removeClass("bx bx-hide").addClass("bx bx-show");
            } else {
                input.attr("type", "password");
                icon.removeClass("bx bx-show").addClass("bx bx-hide");
            }
        });
    });
</script>

{{-- sweet alert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</body>

</html>
