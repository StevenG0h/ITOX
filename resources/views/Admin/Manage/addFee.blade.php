@extends('./Admin/Layout/AdminLayout')
@section('admin')
<div class="container">


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive mt-3" >
                <h3>Biaya Pendaftaran</h3>
                @error('biaya_pendaftaran')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
                @enderror
                
                <form action="{{ route('addCompetitionFee') }}" enctype="multipart/form-data" method="post" class="w-80">
                    @csrf
                    <input type="hidden" name="kategori" value="{{$kategori}}">
                    <input type="hidden" name="kode_lomba" value="{{$kode_lomba}}">
                    @if($kategori ==0 )
                    <div class="form-group">   
                        <input type="hidden" name="kategori[]" value="0">
                        <label for="">Biaya Pendaftaran SMA/SMK/MA</label>
                        <input type="number" name="biaya[]" id="biaya-pendaftaran" class="form-control" placeholder="Biaya Pendaftaran">
                    </div>
                    @elseif($kategori ==1)
                    <div class="form-group">
                        <input type="hidden" name="kategori[]" value="0">
                        <label for="">Biaya Pendaftaran SMA/SMK/MA</label>
                        <input type="number" name="biaya[]" id="biaya-pendaftaran" class="form-control" placeholder="Biaya Pendaftaran">
                    </div>
                    <div class="form-group">   
                        <input type="hidden" name="kategori[]" value="1">
                        <label for="">Biaya Pendaftaran Mahasiswa/umum</label>
                        <input type="number" name="biaya[]" id="biaya-pendaftaran" class="form-control" placeholder="Biaya Pendaftaran">
                    </div>
                    @else
                    <div class="form-group">   
                        <input type="hidden" name="kategori[]" value="1">
                        <label for="">Biaya Pendaftaran Mahasiswa/umum</label>
                        <input type="number" name="biaya[]" id="biaya-pendaftaran" class="form-control" placeholder="Biaya Pendaftaran">
                    </div>
                    @endif
                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-primary">
                    </div>
                </form>
                </div>
            </div>
    </div>
</div>
<!-- Scroll to Top Button-->
@endsection