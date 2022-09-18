@extends('./Admin/Layout/AdminAuthLayout')

@section('adminLogin')
<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-5 col-lg-6 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Tambah Admin</h1>
                                    </div>
                                    <form class="user" method="post" action="{{ route('registerAdminProcess') }}">
                                        @error('nama')
                                            {{$message}}
                                        @enderror
                                        @error('email')
                                            {{$message}}
                                        @enderror
                                        @error('password')
                                            {{$message}}
                                        @enderror
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" name="nama" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Nama">
                                        </div>
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Email">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password_confirmation" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Ketik ulang Password">
                                        </div>
                                        <input type="submit" class="btn btn-primary btn-user btn-block" value="Daftar">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>
@endsection