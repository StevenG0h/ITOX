@extends('./Participant/Layouts/AccountTemplate')

@section('ParticipantAccount')
<div class="image">
    <div class="image-obj">
        <img src="{{ asset('image/undraw_positive_attitude_re_wu7d.svg') }}" alt="" srcset="">
    </div>
</div>
    <div class="content pb-1 px-1 my-1">
        <h1>Tambah Anggota</h1>
        <form action="" class="form my-1">
            <h3 class="mt-1">Nama Anggota</h3>
            <input type="text" name="" id="" class="form-text" required placeholder="Masukkan nama anggota">
            <h3 class="mt-1">Idetitas Anggota(Kartu Pelajar/Surat Keterangan Aktif)</h3>
            <input type="file"  name="" id="data-diri" class="upload-file mt-1" required>
            <h3 class="mt-2">Nama Anggota</h3>
            <input type="text" name="" id="" class="form-text" required placeholder="Masukkan nama anggota">
            <h3 class="mt-1">Idetitas Anggota(Kartu Pelajar/Surat Keterangan Aktif)</h3>
            <input type="file"  name="" id="data-diri" class="upload-file mt-1" required>

            <input type="submit" class="button mt-1" value="Selanjutnya">
        </form>
    </div>
@endsection