@extends('./Admin/Layout/AdminLayout')
@section('admin')
<div class="container">


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive mt-3" >
                <h3>Tambah Timeline</h3>
                @error('tanggal')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
                @enderror
                @error('kegiatan')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
                @enderror
                
                <form action="{{ route('editTimelineProcess') }}" enctype="multipart/form-data" method="post" class="w-80">
                    @csrf
                    <input type="hidden" name="id" value="{{$timeline->id}}">
                    <div class="form-group">   
                        <label for="">Tanggal</label>
                        <input type="date" name="tanggal" value="{{$timeline->tanggal}}" id="biaya-pendaftaran" class="form-control" placeholder="Biaya Pendaftaran">
                    </div>
                    <div class="form-group">   
                        <label for="">Kegiatan</label>
                        <input type="text" name="kegiatan" value="{{$timeline->kegiatan}}" id="biaya-pendaftaran" class="form-control" placeholder="Kegiatan">
                    </div>
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