@extends('./Participant/Layouts/AccountTemplate')

@section('ParticipantAccount')
<div class="image">
    <div class="image-obj">
        <img src="{{ asset('image/undraw_positive_attitude_re_wu7d.svg') }}" alt="" srcset="">
    </div>
</div>
    <div class="content pb-1 px-1 my-1">
        <h1>Edit Anggota</h1>
        <form action="{{ route('EditMemberProcess') }}" method="post" class="form my-1" enctype="multipart/form-data">
            @csrf
            @error('nama')
            <div class="radius-sm pl-1 alert-danger">
                <p>{{ $message  }}</p>
                
            </div>   
            @enderror
            @error('nomor_identitas')
            <div class="radius-sm pl-1 alert-danger">
                <p>{{ $message  }}</p>
                
            </div>   
            @enderror
            @error('url_dokumen')
            <div class="radius-sm pl-1 alert-danger">
                <p>{{ $message  }}</p>
                
            </div>   
            @enderror
            <input type="hidden" name="member_id" value="{{ $member->member_id }}">
            <h3 class="mt-1">Nama Anggota</h3>
            <input type="text" name="nama" id="" class="form-text"  placeholder="Masukkan nama anggota" value="{{ $member->nama }}" required>
            <h3 class="mt-1">Nomor Identitas Anggota</h3>
            <input type="text" name="nomor_identitas" id="" class="form-text"  placeholder="Masukkan nomor identitas anggota" value="{{ $member->nomor_identitas }}" required>
            <h3 class="mt-1">Idetitas Anggota(Kartu Pelajar/Surat Keterangan Aktif)</h3>
            <input type="file"  name="url_dokumen" id="data-diri" class="upload-file mt-1" required>
            <input type="submit" class="button mt-1" value="Simpan">
        </form>
    </div>
@endsection