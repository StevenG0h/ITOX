@extends('./Participant/Layouts/DashboardTemplate')

@section('ParticipantDashboard')
    <div class="welcome p1">
        <h1>Welcome, team {{ $team->nama_tim }}</h1>
    </div>
    <div class="team-data-page radius-sm">
        <div class="team-data">
            <h2>Daftar Anggota</h2>
        @if($restMember != 0)
        <a href="{{ route('AddMember') }}" class="button addMemberButton">Tambah Anggota</a>
        @endif
        <table>
            
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Nomor Identitas</th>
                    <th>Status verifikasi</th>
                    <th>Edit Data</th>
                    <th>Hapus</th>
                </tr>
            </thead>
            <tbody>
                @foreach($members as $member)
                <tr>
                    <td>{{ $member->nama }}</td>
                    <td>{{ $member->nomor_identitas }}</td>
                    <td>
                        @if($member->verify == 0)
                            Menunggu Verifikasi
                        @elseif($member->verify == 1)
                            sudah di verifikasi
                        @else
                            Verifikasi Gagal
                        @endif
                    </td>
                    
                    <td>
                        @if($member->verify == 2)
                        <a href="{{ route('EditMember',$member->member_id) }}" class="button button-warning">
                            Edit Data
                        </a>
                        @endif
                    </td>
                    
                    <td>
                        @if($member->verify != 1 && $member->member_id != $team->kode_ketua)
                        <form action="{{route('deleteMember')}}" method="post">
                            @csrf
                            <input type="hidden" name="member_id" value="{{$member->member_id}}">
                            <button type="submit" value="Hapus" class="button button-delete" onclick="return confirm('yakin ingin hapus?')">Hapus</button>
                        </form>
                        @endif
                    </td>
                    
                </tr>
                @endForeach
            </tbody>
            
        </table>
        </div>
        
    </div>
@endsection