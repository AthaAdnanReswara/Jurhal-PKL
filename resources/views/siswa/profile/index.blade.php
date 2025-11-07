@extends('layout.app')

@section('title', 'Profil Siswa')
@section('page-title', 'Profil Siswa')

@section('content')
<div class="container-fluid px-3 px-md-5">

    <!-- Header -->
    <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
        <span class="mask bg-gradient-dark opacity-5"></span>
        <div class="position-absolute bottom-0 left-0 p-4 text-white">
            <h4 class="fw-bold mb-1">{{ $siswa->user->name }}</h4>
            <p class="mb-0">{{ $siswa->kelas->kelas ?? '-' }} - {{ $siswa->jurusan->jurusan ?? '-' }}</p>
        </div>
    </div>

    <!-- Card Body -->
    <div class="card shadow-lg border-0 mt-n5 mx-2 mx-md-4">
        <div class="card-body py-4 px-4 px-md-5">

            <!-- Header Row -->
            <div class="row align-items-center mb-4">
                <div class="col-auto">
                    <div class="avatar avatar-xxl position-relative">
                        <img src="{{ asset('assets/img/bruce-mars.jpg') }}" alt="profile_image"
                            class="w-100 border-radius-lg shadow-sm border border-3 border-white">
                    </div>
                </div>
                <div class="col">
                    <h5 class="fw-bold mb-1">{{ $siswa->user->name }}</h5>
                    <p class="text-muted mb-0">{{ $siswa->kelas->kelas ?? '-' }} | {{ $siswa->jurusan->jurusan ?? '-' }}</p>
                </div>
                <div class="col-auto">
                    <button class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                        <i class="material-icons align-middle me-1">edit</i> Edit Profil
                    </button>
                </div>
            </div>

            <!-- Detail Section -->
            <div class="row g-4">
                <!-- Data Pribadi -->
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-gradient-primary text-white py-2 px-3 rounded-top">
                            <h6 class="mb-0">Data Pribadi</h6>
                        </div>
                        <div class="card-body small">
                            <p><strong>NIS:</strong> {{ $siswa->nis ?? '-' }}</p>
                            <p><strong>Nama Lengkap:</strong> {{ $siswa->user->name }}</p>
                            <p><strong>Jenis Kelamin:</strong> {{ ucfirst($siswa->gender) ?? '-' }}</p>
                            <p><strong>TTL:</strong> {{ ($siswa->tempat_lahir ?? '-') }},
                                {{ $siswa->tanggal_lahir ? \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d M Y') : '-' }}
                            </p>
                            <p><strong>Golongan Darah:</strong> {{ $siswa->gol_darah ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Akademik -->
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-gradient-info text-white py-2 px-3 rounded-top">
                            <h6 class="mb-0">Akademik & Kontak</h6>
                        </div>
                        <div class="card-body small">
                            <p><strong>Kelas:</strong> {{ $siswa->kelas->kelas ?? '-' }}</p>
                            <p><strong>Jurusan:</strong> {{ $siswa->jurusan->jurusan ?? '-' }}</p>
                            <p><strong>Email:</strong> {{ $siswa->user->email }}</p>
                            <p><strong>Nomor Telepon:</strong> {{ $siswa->nomor ?? '-' }}</p>
                            <p><strong>Alamat:</strong> {{ $siswa->alamat ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Pembimbing -->
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-gradient-success text-white py-2 px-3 rounded-top">
                            <h6 class="mb-0">Pembimbing</h6>
                        </div>
                        <div class="card-body small">
                            @if ($pembimbing)
                            <div class="d-flex align-items-center mb-3">
                                <img src="{{ asset('assets/img/team-3.jpg') }}" class="rounded-circle me-3" width="45" height="45">
                                <div>
                                    <strong>{{ $pembimbing->name }}</strong><br>
                                    <span class="text-muted small">{{ $pembimbing->email }}</span>
                                </div>
                            </div>
                            @else
                            <p class="text-muted">Belum ada pembimbing ditetapkan.</p>
                            @endif
                            <hr>
                            <h6 class="fw-bold">Dunia Kerja</h6>
                            @if ($dudi)
                            <p><strong>Nama DUDI:</strong> {{ $dudi->nama_dudi }}</p>
                            <p><strong>Pembimbing DUDI:</strong> {{ $dudi->pembimbing }}</p>
                            <p><strong>Kontak:</strong> {{ $dudi->kontak }}</p>
                            @else
                            <p class="text-muted">Belum ada DUDI ditetapkan.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Profil -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-3 overflow-hidden">
            <div class="modal-header bg-gradient-dark text-white">
                <h5 class="modal-title text-white">Edit Profil Siswa</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('siswa.profile.update', $siswa->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body px-4 py-3">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" value="{{ $siswa->user->name }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $siswa->user->email }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">NIS</label>
                            <input type="text" name="nis" class="form-control" value="{{ $siswa->nis }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Kelas</label>
                            <select name="id_kelas" class="form-select">
                                @foreach($kelas as $k)
                                <option value="{{ $k->id }}" {{ $siswa->id_kelas == $k->id ? 'selected' : '' }}>
                                    {{ $k->kelas }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Jurusan</label>
                            <select name="id_jurusan" class="form-select">
                                @foreach($jurusan as $j)
                                <option value="{{ $j->id }}" {{ $siswa->id_jurusan == $j->id ? 'selected' : '' }}>
                                    {{ $j->jurusan }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" class="form-control" value="{{ $siswa->tempat_lahir }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control"
                                value="{{ $siswa->tanggal_lahir ? \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('Y-m-d') : '' }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Jenis Kelamin</label>
                            <select name="gender" class="form-select">
                                <option value="laki-laki" {{ $siswa->gender == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="perempuan" {{ $siswa->gender == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nomor Telepon</label>
                            <input type="text" name="nomor" class="form-control" value="{{ $siswa->nomor }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Alamat</label>
                            <textarea name="alamat" class="form-control" rows="3">{{ $siswa->alamat }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection