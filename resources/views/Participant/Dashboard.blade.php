@extends('./Participant/Layouts/DashboardTemplate')

@section('ParticipantDashboard')
    <div class="welcome p1">
        <h1>Welcome, team bla bla</h1>
    </div>
    <div class="status">
        <div class="alert alert-danger">
            Tim anda belum melakukan pembayaran
        </div>
    </div>
    <div class="timeline pt-1 p1 radius-sm">
        <h2>Timeline</h2>
        <table>
            <tbody>
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
            </tbody>
        </table>
    </div>
    <div class="team-data p1 radius-sm">
        <h2>Data Tim</h2>
        <ul>
            <li>Nama Tim : Bla Bla</li>
            <li>Cabang Lomba : Web Design</li>
            <li>Kategori : Mahasiswa</li>
            <li>Institusi asal : Politeknik Caltex Riau</li>
        </ul>
    </div>
    <div class="team-data p1 radius-sm">
        <h2>Daftar Anggota</h2>
        <ul>
            <li>Ketua : Interimo</li>
            <li>Anggota : Adapare</li>
            <li>Anggota : Dorime</li>
        </ul>
    </div>
    <a href="" class="payment radius-sm p1">
        <h3>Pembayaran</h3>
    </a>
    <a href="" class="payment radius-sm p1">
        <h3>Unduh Peraturan Lomba</h3>
    </a>
@endsection