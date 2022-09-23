@extends('./Participant/Layouts/AccountTemplate')

@section('ParticipantAccount')
    <div class="image">
        <div class="image-obj">
            <img src="{{ asset('image/undraw_team_up_re_84ok.svg') }}" alt="" srcset="">
        </div>
    </div>
    <div class="content pb-1 px-1 my-1">
        
        <h1>Pembayaran</h1>
        <form action="{{ route('PaymentProcess') }}" method="post" class="form my-1" enctype="multipart/form-data">
            @csrf
            @error('bukti_pembayaran')
            <div class="radius-sm pl-1 alert-danger">
                <p>{{ $message  }}</p>
                
            </div>   
            @enderror
            <h3>Tata cara pembayaran</h3>
            <ul>
                <li>Transfer ke nomor rekening berikut : <br> 2155301053 a/n lorem Bank BNI</li>
                <li class="mt-1">Upload bukti transfer di form dibawah</li>
                <li class="mt-1">Biaya Pendaftaran : {{$fee->biaya}}</li>
            </ul>
            <h3 class="mt-1">Bukti Pembayaran</h3>
            <input type="file"  name="bukti_pembayaran" id="data-diri" class="upload-file mt-1" required>
            <input type="submit" class="button mt-1" value="Selanjutnya">
        </form>
    </div>
@endsection