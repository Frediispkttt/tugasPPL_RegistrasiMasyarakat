<html>
    <head>
        <title>E-waste - Login</title>
        <link rel="stylesheet" href="auth/login.css">
        <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        rel="stylesheet"
        />
        <link
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
        rel="stylesheet"
        />
        <link
        href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/8.1.0/mdb.min.css"
        rel="stylesheet"
        />
    </head> 
    <body>
        <section class="vh-100">
            <div class="container-fluid h-custom">
              <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                  <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                    class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                  <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                      <p class="lead fw-normal mb-0 me-3">Login</p>
                    </div>

                    <!-- Email input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                      <x-input-label for="email" :value="__('Email')" />
                      <x-text-input id="email" class="form-control form-control-lg" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                      <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
          
                    <!-- Password input -->
                    <div data-mdb-input-init class="form-outline mb-3">
                      <x-input-label for="password" :value="__('Password')" />
                      <x-text-input id="password" class="form-control form-control-lg" type="password" name="password" required autocomplete="current-password" />
                      <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <!-- Remember Me Checkbox -->
                        <div class="form-check mb-0">
                          <input id="remember_me" type="checkbox" class="form-check-input me-2" name="remember">
                          <label class="form-check-label" for="remember_me">{{ __('Remember me') }}</label>
                        </div>
                        @if (Route::has('password.request'))
                          <a href="{{ route('password.request') }}" class="text-body">Forgot password?</a>
                        @endif
                    </div>
                    
                    <div class="text-center text-lg-start mt-4 pt-2">
                      <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg"
                        style="padding-left: 2.5rem; padding-right: 2.5rem;">Log in</button>
                      <p class="small fw-bold mt-2 pt-1 mb-0">Doesn't have an account? <a href="/register"
                          class="link-danger">Register Now!</a></p>
                    </div>
          
                  </form>
                </div>
              </div>
            </div>
            <div
              class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
              <!-- Copyright -->
              <div class="text-white mb-3 mb-md-0">
                Copyright © 2024. All rights reserved.
              </div>
              <!-- Right -->
              <div>
                <a href="#!" class="text-white me-4">
                  <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#!" class="text-white me-4">
                  <i class="fab fa-twitter"></i>
                </a>
                <a href="#!" class="text-white me-4">
                  <i class="fab fa-google"></i>
                </a>
                <a href="#!" class="text-white">
                  <i class="fab fa-linkedin-in"></i>
                </a>
              </div>
              <!-- Right -->
            </div>
          </section>
    </body>
</html>
