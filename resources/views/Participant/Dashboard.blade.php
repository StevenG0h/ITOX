@extends('./Participant/Layouts/AccountTemplate')

@section('ParticipantAccount')
    <div class="welcome p1">
        <h1>Welcome, team bla bla</h1>
    </div>
    <div class="status p1">
        <div class="alert alert-warning">
            Tim anda belum melakukan pembayaran
        </div>
        <div class="alert alert-done mt-1">
            Klik link ini untuk mengunduh guidebook lomba
            <a href="">Guide book</a>
        </div>
    </div>
    <div class="timeline p1">
        <h2>Timeline</h2>
        <table>
            <tr>
                <th>Kegiatan</th>
                <th>Tanggal</th>
            </tr>
            <tr>
                <td>Batas pendaftaran dan pengumpulan resource</td>
                <td>1 November 2022</td>
            </tr>
            <tr>
                <td>Pembukaan dan technical meeting</td>
                <td>4 November 2022</td>
            </tr>
            <tr>
                <td>Hari pertama lomba</td>
                <td>5 November 2022</td>
            </tr>
            <tr>
                <td>Hari Kedua lomba dan pengumuman pemenang</td>
                <td>6 November 2022</td>
            </tr>
        </table>
    </div>
    <div class="team-data p1">
        <h2>Data Tim</h2>
        <ul>
            <li>Nama Tim : Bla Bla</li>
            <li>Cabang Lomba : Web Design</li>
        </ul>
    </div>
    <div class="team-data p1">
        <h2>Daftar Anggota</h2>
        <ul>
            <li>Ketua : Interimo</li>
            <li>Anggota : Adapare</li>
            <li>Anggota : Dorime</li>
        </ul>
    </div>
    <div class="payment p1">
        <h2>Pembayaran</h2>
        <form action="" method="post" class="form">
            <div class="upload-wrapper">
                <input type="file"  name="" id="data-diri" class="upload-file mt-1" >
            </div>
            <input type="submit" value="Upload" class="button">
        </form>
    </div>
@endsection