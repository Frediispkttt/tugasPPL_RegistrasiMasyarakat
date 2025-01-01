<html>
    <head>
        <title>E-Waste - Change Password</title>
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
        <section class="vh-100" style="background-color: #eee;">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px;">
                        <div class="card-body p-md-5">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
            
                            <p class="text-center h3 mb-5 mx-1 mx-md-4 mt-5">  
                                Change Your Password
                            </p> 

                            <p class="text-center mb-5 mx-1 mx-md-4">  
                                Please enter your username and new password to change your password.
                            </p> 

                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }} 
                                    <a href="/login" class="alert-link">Login here</a>.
                                </div>                            
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                            
                            <!-- Change Password Form -->
                            <form method="POST" action="{{ route('new-password.update') }}">
                                @csrf
                                @method('PUT')
                                <div class="form-outline mb-2">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="email" id="email" name="email" class="form-control form-control-lg" required />
                                </div>
                            
                                <div class="form-outline mb-2">
                                    <label class="form-label" for="new-password">New Password</label>
                                    <input type="password" id="new-password" name="new_password" class="form-control form-control-lg" required />
                                </div>
                            
                                <div class="form-outline mb-2">
                                    <label class="form-label" for="new-password-confirmation">Confirm Password</label>
                                    <input type="password" id="new-password-confirmation" name="new_password_confirmation" class="form-control form-control-lg" required />
                                </div>
                            
                                <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                    <button type="submit" class="btn btn-primary btn-lg">Change Password</button>
                                </div>
                            </form>
                            
            
                            </div>
                            <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
            
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                                class="img-fluid" alt="Sample image">
            
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>
