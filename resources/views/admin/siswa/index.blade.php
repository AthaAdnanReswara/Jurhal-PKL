@extends('layout.app')

@section('content')
<div class="col-12">
    <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Users table</h6>
            </div>
        </div>
        <div class="m-3 mb-2">
            <a href="{{ route('admin.siswa.create') }}" class="btn btn-primary mb-3">Tambah siswa</a>

            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif
        </div>
        <div class="card-body px-0 pb-2">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nis</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">TTL</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jenis Kelamin</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kelas</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jurusan</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Dudi</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pembimbing</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created-at</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>

                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($siswa as $data)
                        <tr>
                            <td class="align-middle text-sm">{{ $loop->iteration }}</td>
                            <td class="align-middle text-sm">{{ $data->user->name }}</td>
                            <td class="align-middle text-center text-sm">{{ $data->user->email }}</td>
                            <td class="align-middle text-center text-sm">{{ $data->NIS }}</td>
                            <td class="align-middle text-center text-sm">{{ $data->tempat_lahir }}, {{ $data->tanggal_lahir }}</td>
                            <td class="align-middle text-center text-sm">{{ $data->jenis_kelamin }}</td>
                            <td class="align-middle text-center text-sm">{{ $data->kelas->nama_kelas }}</td>
                            <td class="align-middle text-center text-sm">{{ $data->jurusan->jurusan }}</td>
                            <td class="align-middle text-center text-sm">{{ $data->dudi->nama_dudi }}</td>
                            <td class="align-middle text-center text-sm">{{ $data->pembimbing->name }}</td>
                            <td class="align-middle text-center text-sm">{{ $data->created_at->format('d-m-Y H:i') }}</td>
                            <td class="align-middle text-sm">
                                <a href="{{ route('admin.siswa.edit', $data->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.siswa.destroy', $data->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus siswa ini?')">Hapus</button>
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
@endsection