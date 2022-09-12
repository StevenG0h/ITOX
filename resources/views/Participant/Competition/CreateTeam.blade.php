@extends('./Participant/Layouts/AccountTemplate')

@section('ParticipantAccount')
    <div class="image">
        <div class="image-obj">
            <img src="{{ asset('image/undraw_team_up_re_84ok.svg') }}" alt="" srcset="">
        </div>
    </div>
    <div class="content pb-1 px-1 my-1">
        
        <h1>Buat Tim</h1>
        <form action="{{ route('RegisterTeam') }}" method="post" class="form my-1" enctype="multipart/form-data">
            @csrf
            <h3 class="mt-1">Nama Tim</h3>
            <input type="text" name="nama_tim" id="" class="form-text" required>
            <h3 class="mt-1">Nama Ketua Tim</h3>
            <input type="text" name="nama" id="" class="form-text" required>
            <h3 class="mt-1">Nomor identitas (NIM/NISN)</h3>
            <input type="text" name="nomor_identitas" id="" class="form-text" required>
            <h3 class="mt-1">Nomor WA aktif ketua tim</h3>
            <input type="text" name="nomor_hp" id="" class="form-text" required>
            <h3 class="mt-1">Idetitas Ketua(Kartu Pelajar/Surat Keterangan Aktif)</h3>
            <input type="file"  name="url_dokumen" id="data-diri" class="upload-file mt-1" required>
            <h3 class="mt-1">Cabang Lomba</h3>
            <select name="kode_lomba" id="" class="select-option" required>
                <option value="1">Web</option>
                <option value="2">Jaringan</option>
                <option value="3">Pemrograman</option>
            </select>
            <input type="submit" class="button mt-1" value="Selanjutnya">
        </form>
    </div>
@endsection