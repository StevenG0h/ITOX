@extends('./Participant/Layouts/AccountTemplate')

@section('ParticipantAccount')
    <div class="image">asdf</div>
    <div class="content pb-1 px-1 my-1">
        <h1>Daftar</h1>
        <form action="" class="form mt-1">
            <h3 class="mt-1">Email</h3>
            <input type="email" name="" id="">
            <h3 class="mt-1">Password</h3>
            <input type="password" name="" id="">
            <h3 class="mt-1">Ketik Ulang Password</h3>
            <input type="password" name="" id="">
            <input type="submit" class="button mt-1" value="Daftar">
        </form>
        <p>Sudah punya akun? <a href="{{ route('SignIn') }}"> klik untuk login</a></p>
    </div>
@endsection