@extends('layout.app')

@section('title','kelas')

@section('content')
<div class="col-12">
    <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Kelas table</h6>
            </div>
        </div>
        <div class="m-3 mb-2">
            <a href="{{ route('admin.kelas.create') }}" class="btn btn-primary mb-3">Tambah Kelas</a>
            @if (session('success'))
            <div class="alert alert-success text-center small">{{ session('success') }}</div>
            @elseif (session('error'))
            <div class="alert alert-danger text-center text-white small">{{ session('error') }}</div>
            @endif
            <!-- @if(session('success'))
            <div class="alert alert-success alert-dismissible text-white">{{ session('success') }}
                <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif -->
        </div>
        <div class="card-body px-3 pb-2">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0" id="kelas">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">created_at</th>
                            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kelas as $kls)
                        <tr>
                            <td class="align-middle text-sm">{{ $loop->iteration }}</td>
                            <td class="align-middle text-sm">{{ $kls->nama_kelas }}</td>
                            <td class="align-middle text-sm">{{ $kls->created_at->format('d-m-Y H:i') }}</td>
                            <td class">
                                <a href="{{ route('admin.kelas.edit', $kls->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.kelas.destroy', $kls->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus kelas ini?')">Hapus</button>
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
        $('#kelas').DataTable();
    });
</script>

@endsection