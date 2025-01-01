<html>
    <head>
        <title>Registration Status</title>
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
            
                            {{-- <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Approval Account</p> --}}

                            <p class="text-left h5 mb-5 mx-1 mx-md-4 mt-5">  
                                <img src="/img/search.png" alt="" width="35px">
                                Approvals for new account
                            </p> 

                            <p class="text-left mb-5 mx-1 mx-md-4">  
                                Terima kasih telah mendaftar! Mohon tunggu sementara kami memproses permohonan registrasi Anda.
                            </p> 
                            
                            <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                <form action="{{ route('close-registration-status') }}" method="POST">
                                    @csrf
                            
                                    <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg">Go to Landing Page</button>
                                </form>
                            </div>
            
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