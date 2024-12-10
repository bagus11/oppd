<!DOCTYPE html>
<html lang="en" dir="ltr" data-bs-theme="light" data-color-theme="Blue_Theme" data-layout="vertical">

<head>
  <!-- Required meta tags -->
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Favicon icon-->
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />

  <!-- Core Css -->
  <link rel="stylesheet" href="../assets/css/styles.css" />

  <title>MatDash Bootstrap Admin</title>
</head>

<body>
  <!-- Preloader -->
  <div class="preloader">
    <img src="../assets/images/logos/favicon.png" alt="loader" class="lds-ripple img-fluid" />
  </div>
  <div id="main-wrapper">
    <div class="position-relative overflow-hidden radial-gradient min-vh-100 w-100">
      <div class="position-relative z-index-5">
        <div class="row gx-0">

          <div class="col-lg-4 col-xl-5 col-xxl-4">
            <div class="min-vh-100 bg-body row justify-content-center align-items-center p-5">
              <div class="col-12 auth-card">
                <div class="row mb-4">
                    <div class="col-2">
                        <a href="../main/index.html" class="text-nowrap logo-img d-block w-100">
                          <img src="../assets/images/logos/logo-icon.svg" class="dark-logo" alt="Logo-Dark" />
                        </a>
                    </div>
                    <div class="col-8">
                        <strong style="font-size: 24px; color:black">Login</strong>
                    </div>
                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="row">
                        <div class="col-4 mt-2">
                            <label for="email">{{ __('Email') }}</label>
                        </div>   
                        <div class="col-8">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-4 mt-2">
                            <label for="password">{{ __('Password') }}</label>

                        </div>
                        <div class="col-8">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        </div>
                    </div>
                
                    <div class="row mt-4 mx-2">
                        <button type="submit" class="btn btn-primary w-100 py-8 mb-4 rounded-2">
                            {{ __('Login') }}
                        </button>
                    </div>
                </form>
              </div>
            </div>
          </div>

          <div class="col-lg-8 col-xl-7 col-xxl-8 position-relative overflow-hidden bg-dark d-none d-lg-block">
            <div class="circle-top"></div>
            <div>
              <img src="../assets/images/logos/logo-icon.svg" class="circle-bottom" alt="Logo-Dark" />
            </div>
            <div class="d-lg-flex align-items-center z-index-5 position-relative h-n80">
              <div class="row justify-content-center w-100">
                <div class="col-lg-6">
                  <h2 class="text-white fs-10 mb-3 lh-base">
                    Welcome to
                    <br />
                    HRIS
                  </h2>
                  <span class="opacity-75 fs-4 text-white d-block mb-3">MatDash helps developers to build organized
                    and well
                    <br />
                    coded dashboards full of beautiful and rich modules.
                  </span>
                
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="dark-transparent sidebartoggler"></div>
  <!-- Import Js Files -->
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.min.js"></script>
  <script src="../assets/js/theme/app.init.js"></script>
  <script src="../assets/js/theme/theme.js"></script>
  <script src="../assets/js/theme/app.min.js"></script>

  <!-- solar icons -->
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

</html>