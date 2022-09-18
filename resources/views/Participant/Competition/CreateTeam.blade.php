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
            @error('nama_tim')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
                @enderror
                @error('nomor_hp')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
                @enderror
                @error('nomor_identitas')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
                @enderror
                @error('nama')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
                @enderror
                @error('institusi_asal')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
                @enderror
                @error('jenis_institusi')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
                @enderror
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
            
            <h3 class="mt-1">Institusi Asal</h3>
            <input type="text" name="institusi_asal" id="" class="form-text" required placeholder="Masukkan nama sekolah atau kampus anda">
            <h3 class="mt-1">Jenis Institusi</h3>
            <select name="jenis_institusi" id="" class="select-option" required>
                <option value="">Pilih Jenis Institusi</option>
                <option value="SMA/K/MA">SMA/K/MA</option>
                <option value="Perguruan Tinggi/umum">Perguruan Tinggi</option>
            </select>
            <input type="submit" class="button mt-1" value="Selanjutnya">
        </form>
    </div>
@endsection