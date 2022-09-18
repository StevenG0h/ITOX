@extends('./Admin/Layout/AdminLayout')
@section('admin')
<div class="container-fluid">


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive mt-3" >
                <h1>Akun Peserta</h1>
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Nama Tim</th>
                            <th>Institusi Asal</th>
                            <th>Hapus</th>
                        </tr>
                    </thead>
                    <tfoot>
                        @foreach ($users as $user)
                        <tr>
                            <td>
                                {{ $user->nama }}
                            </td>
                            <td>
                                {{ $user->email }}
                            </td>
                            <td>
                                {{ $user->nama_tim }}
                            </td>
                            <td>
                                {{ $user->institusi_asal }}
                            </td>
                            
                            
                            <td class="text-center">
                                <form action="{{ route('deleteUser') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                    <input type="submit" value="Hapus" class="btn btn-danger">
                                </form>
                            </td>
                        </tr> 
                        @endforeach
                    </tbody>
                </table>
                <div class="linkwrapper" style="width:10%">
                    {{$users->links('vendor\pagination\bootstrap-4')}}
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive mt-3" >
                <h1>Admin</h1>
                <a href="{{route('registerAdmin')}}" class="btn btn-primary mb-3">
                    Tambah Admin
                </a>
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Hapus</th>
                        </tr>
                    </thead>
                    <tfoot>
                        @foreach ($admins as $admin)
                        <tr>
                            <td>
                                {{ $admin->nama }}
                            </td>  
                            <td>
                                {{ $admin->email }}
                            </td>
                            <td class="text-center">
                                <form action="{{ route('deleteUser') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $admin->id }}">
                                    <input type="submit" value="Hapus" class="btn btn-danger">
                                </form>
                            </td>
                        </tr> 
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
<div class="container my-auto">
    <div class="copyright text-center my-auto">
        <span>Copyright &copy; ITO X 2022</span>
    </div>
</div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
<div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
<div class="modal-footer">
    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
    <a class="btn btn-primary" href="login.html">Logout</a>
</div>
</div>
</div>
</div>
@endsection