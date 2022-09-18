@extends('./Participant/Layouts/AccountTemplate')

@section('ParticipantAccount')
    <div class="image">
        <div class="image-obj">
            <img src="{{ asset('image/undraw_apartment_rent_o-0-ut.svg') }}" alt="" srcset="">
        </div>
    </div>
    <div class="content pb-1 px-1 my-1">
        
        <h1>Pilih Lomba</h1>
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
            <h3 class="mt-1">Cabang Lomba</h3>
            <select name="kode_lomba" id="" class="select-option" required>
                @foreach($competitions as $competition)
                    <option value="{{ $competition->kode_lomba }}">{{ $competition->nama_lomba }}</option>
                @endforeach
            </select>
            
            <input type="submit" class="button mt-1" value="Selanjutnya">
        </form>
    </div>
@endsection