@extends('./Participant/Layouts/AccountTemplate')

@section('ParticipantAccount')
    <div class="image">asdf</div>
    <div class="content pb-1 px-1 my-1">
        <h1>Tambah Anggota</h1>
        <form action="" class="form mt-1">
            <h3 class="mt-1">Nama Anggota</h3>
            <input type="text" name="" id="">
            <h3 class="mt-1">Idetitas Anggota(Kartu Pelajar/Surat Keterangan Aktif)</h3>
            <input type="file"  name="" id="data-diri" class="upload-file mt-1" >
            <h3 class="mt-1">Nama Anggota</h3>
            <input type="text" name="" id="">
            <h3 class="mt-1">Idetitas Anggota(Kartu Pelajar/Surat Keterangan Aktif)</h3>
            <input type="file"  name="" id="data-diri" class="upload-file mt-1" >
            <input type="submit" class="button mt-1" value="Selanjutnya">
        </form>
        <p>Sudah punya akun? <a href="{{ route('SignIn') }}"> klik untuk login</a></p>
    </div>
@endsection