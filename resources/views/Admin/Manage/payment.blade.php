@extends('./Admin/Layout/AdminLayout')
@section('admin')
<div class="container-fluid">


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive mt-3" >
                <h1>Pembayaran</h1>
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Tim</th>
                            <th>Nama Ketua</th>
                            <th>Cabang Lomba</th>
                            <th>institusi asal</th>
                            <th>Jenis institusi</th>
                            <th>bukti Pembayaran</th>
                            <th>Verifikasi</th>
                            <th>Tolak</th>
                            <th>Hapus</th>
                        </tr>
                    </thead>
                    <tfoot>
                        @foreach ($teams as $team)
                        <tr>
                            <td>
                                {{ $team->nama_tim }}
                            </td>
                            
                            <td>
                                {{ $team->nama }}
                            </td>
                            <td>
                                {{ $team->nama_lomba }}
                            </td>
                            <td>
                                {{ $team->institusi_asal }}
                            </td>
                            <td>
                                {{ $team->jenis_institusi }}
                            </td>
                            <td>
                                <a href="{{ asset('storage/'.$team->bukti_pembayaran) }}">
                                    bukti pembayaran
                                </a>
                            </td>
                            <td class="text-center">
                                <form action="{{ route('verifyPayment') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="kode_tim" value="{{ $team->kode_tim }}">
                                    <button type="submit" class="btn 
                                    @if($team->verified == 1)
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
                                <form action="{{ route('verifyPaymentNotValid') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="kode_tim" value="{{ $team->kode_tim }}">
                                    <button type="submit" class="btn
                                    @if($team->verified == 2)
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
                                <form action="{{ route('deleteCompetitions') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="payment_id" value="{{ $team->payment_id }}">
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