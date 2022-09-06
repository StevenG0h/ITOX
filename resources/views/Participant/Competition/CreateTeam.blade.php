@extends('./Participant/Layouts/AccountTemplate')

@section('ParticipantAccount')
    <div class="image">
        <div class="image-obj">
            <img src="{{ asset('image/undraw_team_up_re_84ok.svg') }}" alt="" srcset="">
        </div>
    </div>
    <div class="content pb-1 px-1 my-1">
        
        <h1>Buat Tim</h1>
        <form action="" class="form my-1" enctype="multipart/form-data">
            <h3 class="mt-1">Nama Tim</h3>
            <input type="text" name="" id="" class="form-text">
            <h3 class="mt-1">Nomor WA aktif ketua tim</h3>
            <input type="text" name="" id="" class="form-text">
            <h3 class="mt-1">Idetitas Ketua(Kartu Pelajar/Surat Keterangan Aktif)</h3>
            <input type="file"  name="" id="data-diri" class="upload-file mt-1" >
            <h3 class="mt-1">Cabang Lomba</h3>
            <select name="" id="" class="select-option">
                <option value="">Pilih Cabang Lomba</option>
                <option value="">Web</option>
                <option value="">Jaringan</option>
                <option value="">Pemrograman</option>
            </select>
            <input type="submit" class="button mt-1" value="Selanjutnya">
        </form>
    </div>
@endsection