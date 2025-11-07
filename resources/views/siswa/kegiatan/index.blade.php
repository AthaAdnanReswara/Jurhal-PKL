@extends('layout.app')


@section('content')
<div class="col-12">
    <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Table Kegiatan</h6>
            </div>
        </div>
        <div class="m-3 mb-2">
            <a href="{{ route('siswa.kegiatan.create') }}" class="btn btn-primary mb-3">Tambah Kegiatan</a>

            @if(session('success'))
            <div class="alert alert-success alert-dismissible text-white">{{ session('success') }}
                <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
        </div>
        <div class="card-body px-0 pb-2">
            <div class="table-responsive p-0" >
                <table class="table align-items-center mb-0" id="kegiatan">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jam Mulai</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jam Selesai</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kegiatan</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Dukumentasi</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Catatan Pembimbing</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">created_at</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">updated_at</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kegiatan as $item)
                        <tr>
                            <td class="align-middle text-sm">{{ $loop->iteration }}</td>
                            <td class="align-middle text-sm">{{ $item->siswa->user->name }}</td>
                            <td class="align-middle text-sm">{{ $item->tanggal }}</td>
                            <td class="align-middle text-sm">{{ $item->jam_mulai }}</td>
                            <td class="align-middle text-sm">{{ $item->jam_selesai }}</td>
                            <td class="align-middle text-sm">{{ $item->kegiatan }}</td>
                            <td class="align-middle text-sm">{{ $item->dukumentasi }}</td>
                            <td class="align-middle text-sm">{{ $item->catatan_pembimbing }}</td>
                            <td class="align-middle text-sm">{{ $item->created_at->format('d-m-Y H:i') }}</td>
                            <td class="align-middle text-sm">{{ $item->updated_at->format('d-m-Y H:i') }}</td>
                            <td class="align-middle text-sm">
                                <a href="{{ route('siswa.kegiatan.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('siswa.kegiatan.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus absensi ini?')">Hapus</button>
                                </form>
                            </td>

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
        $('#kegiatan').DataTable();
    });
</script>

@endsection