@extends('./Admin/Layout/AdminLayout')
@section('admin')
<div class="container-fluid">


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive mt-3" >
                <h1>Cabang Lomba</h1>
                <a class="btn btn-primary mb-3" href="{{ route('addCompetitionsView') }}">Tambah Lomba</a>
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama lomba</th>
                            <th>Anggota minimal</th>
                            <th>Anggota maksimal</th>
                            <th>Kategori</th>
                            <th>Batas pendaftaran</th>
                            <th>Maskot</th>
                            <th>Guidebook</th>
                            <th>Edit</th>
                            <th>Hapus</th>
                        </tr>
                    </thead>
                    <tfoot>
                        @foreach ($competitions as $competition)
                        <tr>
                            <td>
                                {{ $competition->nama_lomba }}
                            </td>
                            
                            <td>
                                {{ $competition->min_anggota }}
                            </td>
                            <td>
                                {{ $competition->max_anggota }}
                            </td>
                            <td>
                                @if($competition->kategori == 0)
                                SMA/SMK
                                @elseif($competition->kategori == 1)
                                Mahasisiwa/Umum
                                @else
                                SMA/SMK dan Mahasiswa/Umum
                                @endif
                            </td>
                            <td>
                                {{ $competition->batas_pendaftaran }}
                            </td>
                            <td>
                                <a href="{{ asset('storage/'.$competition->maskot) }}" target="_blank">
                                    maskot
                                </a>
                            </td>
                            <td>
                                <a href="{{ asset('storage/'.$competition->url_guidebook) }}" target="_blank">
                                    guidebook
                                </a>
                            </td>
                            <td class="text-center">
                                <a href="{{route('updateCompetitionView',$competition->kode_lomba)}}" class="btn btn-warning">Edit</a>
                            </td>
                            <td class="text-center">
                                <form action="{{ route('deleteCompetitions') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="kode_lomba" value="{{ $competition->kode_lomba }}">
                                    <button type="submit" value="Hapus" class="btn btn-danger" onclick="return confirm('yakin ingin hapus?')">Hapus</button>
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