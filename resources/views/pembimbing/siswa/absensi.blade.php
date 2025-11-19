@extends('layout.app')


@section('content')
<div class="col-12">
    <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                <h4 class="text-white text-capitalize ps-3"> Table Absensi</h4>
                <h6 class="text-white text-capitalize ps-3">
                    {{ $siswa->user->name ?? '-' }} - {{ $siswa->kelas->nama_kelas ?? '-' }} - {{ $siswa->jurusan->jurusan ?? '-' }}
                </h6>
            </div>
        </div>
        <div class="m-3 mb-2">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible text-white">{{ session('success') }}
                <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
        </div>
        <div class="card-body px-0 pb-2">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0" id="absensi">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jam Masuk</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jam Pulang</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($absensis as $abs)
                        <tr>
                            <td class="align-middle text-sm">{{ $loop->iteration }}</td>
                            <td class="align-middle text-sm">{{ $abs->tanggal }}</td>
                            <td class="align-middle text-sm">{{ $abs->jam_masuk ?? '-' }}</td>
                            <td class="align-middle text-sm">{{ $abs->jam_pulang ?? '-' }}</td>
                            <td class="align-middle text-sm">
                                <span class="
                                @if($abs->status == 'hadir') bg-success text-white
                                @elseif($abs->status == 'alpa') bg-danger text-white
                                @elseif($abs->status == 'izin') bg-warning text-dark
                                @endif
                                px-2 py-1 rounded">
                                    {{ $abs->status }}
                                </span>
                            </td>

                            <td class="align-middle text-sm">{{ $abs->Keterangan ?? '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#absensi').DataTable();
    });
</script>

@endsection