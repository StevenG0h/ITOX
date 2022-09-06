@extends('./Participant/Layouts/AccountTemplate')

@section('ParticipantAccount')
    <div class="image">
        <div class="image-obj">
            <img src="{{ asset('image/undraw_apartment_rent_o-0-ut.svg') }}" alt="" srcset="">
        </div>
    </div>
    <div class="content pb-1 px-1 my-1">
        
        <h1>Institusi</h1>
        <form action="" class="form my-1" enctype="multipart/form-data">
            <h3 class="mt-1">Institusi Asal</h3>
            <input type="text" name="" id="" class="form-text" required placeholder="Masukkan nama sekolah atau kampus anda">
            <h3 class="mt-1">Jenis Institusi</h3>
            <select name="" id="" class="select-option" required>
                <option value="">Pilih Jenis Institusi</option>
                <option value="">SMA/K/MA</option>
                <option value="">Perguruan Tinggi</option>
            </select>
            <input type="submit" class="button mt-1" value="Selanjutnya">
        </form>
    </div>
@endsection