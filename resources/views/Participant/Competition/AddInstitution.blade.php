@extends('./Participant/Layouts/AccountTemplate')

@section('ParticipantAccount')
    <div class="image">
        <div class="image-obj">
            <img src="{{ asset('image/undraw_apartment_rent_o-0-ut.svg') }}" alt="" srcset="">
        </div>
    </div>
    <div class="content pb-1 px-1 my-1">
        
        <h1>Institusi</h1>
        <form action="{{ route('AddInstitutionProcess') }}" method="post" class="form my-1" enctype="multipart/form-data">
            @csrf
            @error('jenis_institusi')
            <div class="radius-sm pl-1 alert-danger">
                <p>{{ $message  }}</p>
                
            </div>   
            @enderror
            @error('institusi_asal')
            <div class="radius-sm pl-1 alert-danger">
                <p>{{ $message  }}</p>
                
            </div>   
            @enderror
            <h3 class="mt-1">Institusi Asal</h3>
            <input type="text" name="institusi_asal" id="" class="form-text" required placeholder="Masukkan nama sekolah atau kampus anda">
            <h3 class="mt-1">Jenis Institusi</h3>
            <select name="jenis_institusi" id="" class="select-option" required>
                <option value="">Pilih Jenis Institusi</option>
                <option value="SMA/K/MA">SMA/K/MA</option>
                <option value="Perguruan Tinggi">Perguruan Tinggi</option>
            </select>
            <input type="submit" class="button mt-1" value="Selanjutnya">
        </form>
    </div>
@endsection