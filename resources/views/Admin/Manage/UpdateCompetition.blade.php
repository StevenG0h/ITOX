@extends('./Admin/Layout/AdminLayout')
@section('admin')
<div class="container">


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive mt-3" >
                <h3>Tambah Lomba</h3>
                @error('nama_lomba')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
                @enderror
                @error('max_anggota')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
                @enderror
                @error('batas_pendaftaran')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
                @enderror
                @error('desc')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
                @enderror
                @error('maskot')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
                @enderror
                @error('url_guidebook')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
                @enderror
                
                <form action="{{ route('updateCompetitionProcess') }}" enctype="multipart/form-data" method="post" class="w-80">
                    @csrf
                    <input type="hidden" name="kode_lomba" value="{{ $competition->kode_lomba }}">
                    <div class="form-group">
                        <label for="">Nama Lomba</label>
                        <input type="text" name="nama_lomba" id="nama-lomba" class="form-control" value="{{ $competition->nama_lomba }}" placeholder="Nama Lomba">
                    </div>
                    <div class="form-group">   
                        <label for="">Jumlah Minimal per Tim</label>
                        <input type="number" name="min_anggota" id="max-anggota" value="{{ $competition->max_anggota }}" class="form-control" placeholder="Batas Anggota">
                    </div>
                    <div class="form-group">   
                        <label for="">Jumlah Maksimal per Tim</label>
                        <input type="number" name="max_anggota" id="max-anggota" value="{{ $competition->max_anggota }}" class="form-control" placeholder="Batas Anggota">
                    </div>
                    <div class="form-group">
                        <label for="">Kategori Peserta</label>
                        <select name="kategori" id="" class="form-control">
                            <option value="">Kategori Peserta</option>
                            <option value="0" @if($competition->kategori == 0) selected @endif >SMA / SMK</option>
                            <option value="1" @if($competition->kategori == 1) selected @endif>SMA / SMK dan Mahasiswa / umum</option>
                            <option value="2" @if($competition->kategori == 2) selected @endif>Mahasiswa / umum</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Batas Pendaftaran</label>
                        <input type="date" name="batas_pendaftaran" value="{{ $competition->batas_pendaftaran }}" id="batas-pendaftaran" class="form-control" placeholder="Batas Pendaftaran">
                    </div>
                    <div class="form-group">
                        <label for="">Deskripsi singkat lomba</label>
                        <textarea name="desc" id="" class="form-control" cols="30" rows="10">{{ $competition->desc }}</textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-primary">
                    </div>
                </form>
                <form action="{{ route('updateMaskot') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <h2>Update Maskot</h2>
                    <input type="hidden" name="kode_lomba" value="{{ $competition->kode_lomba }}">
                    <div class="form-group">
                        <label for="">Upload Maskot Lomba</label>
                        <input type="file" name="maskot" id="url-guidebook" class="form-control-file" placeholder="Guidebook">
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-primary">
                    </div>
                </form>
                <form action="{{ route('updateGuidebook') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <h2>Update Guidebook</h2>
                    <input type="hidden" name="kode_lomba" value="{{ $competition->kode_lomba }}">
                    <div class="form-group">
                        <label for="">Upload Guidebook</label>
                        <input type="file" name="url_guidebook" id="url-guidebook" class="form-control-file" placeholder="Guidebook">
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-primary">
                    </div>
                </form>
                
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