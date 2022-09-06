@extends('./Participant/Layouts/AccountTemplate')

@section('ParticipantAccount')
    <div class="image">
        <div class="image-obj">
            <img src="{{ asset('image/undraw_access_account_re_8spm.svg') }}" alt="" srcset="">
        </div>
    </div>
    <div class="content pb-1 px-1 my-3 ">
        <h1>Daftar</h1>
        <form action="" class="form mt-1">
            <h3 class="mt-1">Email</h3>
            <input type="email" name="" id="" class="form-text" placeholder="Masukkan alamat email anda" required>
            <h3 class="mt-1">Password</h3>
            <input type="password" name="" id="" class="form-text" placeholder="Masukkan password anda" required>
            <h3 class="mt-1">Ketik Ulang Password</h3>
            <input type="password" name="" id="" class="form-text" placeholder="Ketik ulang passsword anda" required>
            <input type="submit" class="button mt-1" value="Daftar">
        </form>
        <p>Sudah punya akun? <a href="{{ route('SignIn') }}"> klik untuk login</a></p>
    </div>
@endsection