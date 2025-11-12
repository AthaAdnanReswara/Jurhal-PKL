@extends('layout.app')


@section('content')
<div class="col-12">
    <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Table Absensi</h6>
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
            @if(session('error'))
            <div class="alert alert-danger small mx-3">{{ session('error') }}</div>
            @endif
            @if($errors->any())
            <div class="alert alert-danger small mx-3">{{ $errors->first() }}</div>
            @endif
        </div>
        <div class="card-body px-0 pb-2">
            <form action="{{ route('siswa.absensi.store') }}" method="POST" class="mb-4">
                @csrf

                <div class="row">
                    <div class="col-md-3">
                        <div class="input-group input-group-outline">
                            <select name="status" id="statusSelect" class="form-control">
                                <option value="hadir">Hadir</option>
                                <option value="izin">Izin</option>
                                <option value="sakit">Sakit</option>
                                <option value="libur">Libur</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="input-group input-group-outline">
                            <input type="text" name="keterangan" id="keteranganInput" class="form-control"
                                placeholder="Keterangan (izin/sakit)" disabled>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <button class="btn btn-primary btn-sm">Masuk</button>
                    </div>
                </div>
            </form>

            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0" id="absensi">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jam Mulai</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jam Pulang</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Keterangan</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($absensis as $d)
                        <tr>
                            <td class="align-middle text-sm">{{ $loop->iteration }}</td>
                            <td class="align-middle text-sm">{{ $d->siswa->user->name }}</td>
                            <td class="align-middle text-sm">{{ $d->tanggal }}</td>
                            <td class="align-middle text-sm">{{ $d->jam_masuk }}</td>
                            <td class="align-middle text-sm">{{ $d->jam_pulang }}</td>
                            <td class="align-middle text-sm">{{ $d->status }}</td>
                            <td class="align-middle text-sm">{{ $d->Keterangan }}</td>
                            <td class="align-middle text-sm">
                                @if ($d->status == 'hadir' && $d->jam_pulang == null)
                                <a href="{{ route('siswa.absensi.pulang', $d->id) }}" class="btn btn-success btn-sm">Pulang</a>
                                @else
                                <span class="badge bg-secondary">Selesai</span>
                                @endif
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
    document.getElementById('statusSelect').addEventListener('change', function() {
        document.getElementById('keteranganInput').disabled = (this.value === 'hadir');
    });
</script>

<script>
    $(document).ready(function() {
        $('#absensi').DataTable();
    });
</script>

@endsection