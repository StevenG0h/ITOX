@extends('./Participant/Layouts/AccountTemplate')

@section('ParticipantAccount')
    <div class="image">
        <div class="image-obj">
            <img src="{{ asset('image/undraw_completing_re_i7ap.svg') }}" alt="" srcset="">
        </div>
    </div>
    <div class="content pb-1 px-1 my-3">
        <h1>Login</h1>
        <form action="" class="form mt-1">
            <h3 class="mt-1">Email</h3>
            <input type="email" name="" id="" class="form-text" placeholder="Masukkan alamat email anda" required>
            <h3 class="mt-1">Password</h3>
            <input type="password" name="" id="" class="form-text" placeholder="Masukkan password" required>
            <input type="submit" class="button my-1 p1" value="Login">
        </form>
        <p>Belum punya akun? <a href="{{ route('SignUp') }}">klik untuk Daftar</a></p>
    </div>
@endsection