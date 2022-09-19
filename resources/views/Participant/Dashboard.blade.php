@extends('./Participant/Layouts/DashboardTemplate')

@section('ParticipantDashboard')
    <div class="welcome p1">
        <h1>Welcome, team {{ $team->nama_tim }}</h1>
    </div>
    <div class="status">
        @if($paymentStatus == 0)
        <div class="flash alert-danger">
            Tim anda belum melakukan pembayaran
        </div>
        @elseif($paymentStatus ==1)
        <div class="flash alert-warning">
            Pembayaran sedang diverifikasi
        </div>
        @elseif($paymentStatus ==3)
        <div class="flash alert-danger">
            Pembayaran Ditolak
        </div>
        @else
        <div class="flash alert-succes">
            Pembayaran sukses
        </div>
        @endif
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
            <li>Nama Tim : {{ $team->nama_tim }}</li>
            <li>Cabang Lomba : {{ $namaLomba }}</li>
            <li>Kategori : {{ $team->jenis_institusi }}</li>
            <li>Institusi asal : {{ $team->institusi_asal }}</li>
        </ul>
    </div>
    <div class="team-data p1 radius-sm">
        <h2>Daftar Anggota</h2>
            <table class="team-data">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($members as $member)
                    <tr>
                        @if($member->member_id == $team->kode_ketua)
                        <td>{{ $member->nama }}(Ketua)</td>
                        @else
                        <td>{{ $member->nama }}</td>
                        @endif
                        <td>@if($member->verify == 0)
                            Menunggu Verifikasi
                        @elseif($member->verify == 1)
                            sudah di verifikasi
                        @else
                            Verifikasi Gagal
                        @endif</td>
                    @endForeach
                    </tr>
                </tbody>
                
            </table>
            
            <a href="{{route('showMembers')}}">Selengkapnya</a>
    </div>
    <a href="{{ route('Payment') }}" class="payment radius-sm p1">
        <h3>Pembayaran</h3>
    </a>
    <a href="{{ asset('storage/'.$guidebook) }}" class="payment radius-sm p1">
        <h3>Unduh Peraturan Lomba</h3>
    </a>
@endsection