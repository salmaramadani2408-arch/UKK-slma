<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistem Informasi Surat</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        .card-login {
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        .card-login:hover {
            transform: translateY(-10px);
            box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.25);
        }
        .icon-circle {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2.5rem;
        }
        .bg-gradient-admin {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        }
        .bg-gradient-kaban {
            background: linear-gradient(135deg, #1cc88a 0%, #13855c 100%);
        }
    </style>
</head>

<body>

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center align-items-center" style="min-height: 100vh;">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="text-center mb-5">
                    <h1 class="h2 text-white mb-2">
                        <i class="fas fa-envelope fa-2x mb-3"></i>
                        <br>
                        Sistem Informasi Surat
                    </h1>
                    <p class="text-white-50">Silakan pilih portal login sesuai akses Anda</p>
                </div>

                <div class="row">

                    <!-- Card Admin -->
                    <div class="col-lg-6 mb-4">
                        <a href="{{ route('admin.login') }}" class="text-decoration-none">
                            <div class="card card-login border-0">
                                <div class="card-body p-5 text-center">
                                    <div class="icon-circle bg-gradient-admin text-white">
                                        <i class="fas fa-user-shield"></i>
                                    </div>
                                    <h3 class="h4 font-weight-bold text-gray-900 mb-3">
                                        Portal Admin
                                    </h3>
                                    <p class="text-gray-600 mb-4">
                                        Akses untuk administrator sistem, mengelola disposisi, surat masuk, dan data master
                                    </p>
                                    <div class="btn btn-primary btn-lg px-5">
                                        <i class="fas fa-sign-in-alt mr-2"></i>
                                        Login sebagai Admin
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Card Kaban/Pimpinan -->
                    <div class="col-lg-6 mb-4">
                        <a href="{{ route('kaban.login') }}" class="text-decoration-none">
                            <div class="card card-login border-0">
                                <div class="card-body p-5 text-center">
                                    <div class="icon-circle bg-gradient-kaban text-white">
                                        <i class="fas fa-user-tie"></i>
                                    </div>
                                    <h3 class="h4 font-weight-bold text-gray-900 mb-3">
                                        Portal Pimpinan
                                    </h3>
                                    <p class="text-gray-600 mb-4">
                                        Akses untuk Kepala Badan, melihat surat masuk dan melakukan disposisi
                                    </p>
                                    <div class="btn btn-success btn-lg px-5">
                                        <i class="fas fa-sign-in-alt mr-2"></i>
                                        Login sebagai Pimpinan
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                </div>

                <!-- Footer Copyright -->
                <div class="text-center mt-4">
                    <p class="text-white-50 small">
                        &copy; {{ date('Y') }} Sistem Informasi Surat. All Rights Reserved.
                    </p>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

</body>
</html>