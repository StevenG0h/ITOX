@extends('./Admin/Layout/AdminLayout')
@section('admin')
<div class="container-fluid">


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        
        <div class="card-body">
            <form action="{{route('AdminDashboard')}}" class="d-none d-sm-inline-block form-inline mr-auto my-3 my-md-0 mw-100 navbar-search">
                <div class="input-group bg-light">
                    <input type="text" class="form-control bg-light border-0 " name="search" placeholder="Cari Berdasarkan"
                         aria-describedby="basic-addon2">
                         <select name="search_category" id="" class="form-select bg-light border-0 outline-none mx-3">
                            <option value="nama_tim">Nama Tim</option>
                            <option value="institusi_asal">Institusi Asal</option>
                            <option value="nama_lomba">Cabang Lomba</option>
                            <option value="nomor_identitas">Nomor Identitas</option>
                        </select>
                    <div class="input-group-append">
                        
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
            <div class="table-responsive mt-3">
                
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Nomor Identitas</th>
                            <th>Team</th>
                            <th>Cabang Lomba</th>
                            <th>Kategori</th>
                            <th>Institusi Asal</th>
                            <th>Dokumen</th>
                            <th>Verifikasi</th>
                            <th>Berkas Tidak Valid</th>
                            <th>Hapus Peserta</th>
                        </tr>
                    </thead>
                    <tfoot>
                        @foreach ($participants as $participant)
                        <tr>
                            <td>
                                {{ $participant->nama }}
                            </td>
                            <td>
                                {{ $participant->nomor_identitas }}
                            </td>
                            <td>
                                {{ $participant->nama_tim }}
                            </td>
                            <td>
                                {{ $participant->nama_lomba }}
                            </td>
                            <td>
                                {{ $participant->jenis_institusi }}
                            </td>
                            <td>
                                {{ $participant->institusi_asal }}
                            </td>
                            <td>
                                <a href="{{ asset('storage/'.$participant->url_dokumen) }}">
                                    dokumen
                                </a>
                            </td>
                            <td class="text-center">
                                <form action="{{ route('verifyParticipant') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="member_id" value="{{ $participant->member_id }}">
                                    <button type="submit" class="btn 
                                    @if($participant->verify == 1)
                                    btn-success
                                    @else
                                    btn-secondary
                                    @endif
                                    ">
                                        <i class="fa fa-check"></i>
                                    </button>
                                </form>
                            </td>
                            <td class="text-center">
                                <form action="{{ route('docNotValid') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="member_id" value="{{ $participant->member_id }}">
                                    <button type="submit" class="btn
                                    @if($participant->verify == 2)
                                    btn-warning
                                    @else
                                    btn-secondary
                                    @endif
                                    ">
                                        X
                                    </button>
                                    
                                </form>
                            </td>
                            <td class="text-center">
                                <form action="{{ route('deleteParticipant') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="member_id" value="{{ $participant->member_id }}">
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>

                                </form>
                            </td>
                        </tr> 
                        @endforeach
                    </tbody>
                        
                </table>
                <div class="linkwrapper" style="width:10%">
                    {{$participants->links('vendor\pagination\bootstrap-4')}}
                </div>
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