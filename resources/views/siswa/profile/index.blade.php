@extends('layout.app')

@section('title', 'Profil Siswa')
@section('page-title', 'Profil Siswa')

@section('content')
<div class="container-fluid px-3 px-md-5">

    <!-- Header -->
    <div class="page-header min-height-300 border-radius-xl mt-4"
        style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?auto=format&fit=crop&w=1920&q=80');">
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
                        @if($siswa->poto)
                        <img src="{{ asset('storage/' . $siswa->poto) }}" alt="dukumentasi" width="80%" class="rounded shadow-sm">
                        @else
                        <img src="{{ asset('assets/img/bruce-mars.jpg') }}" alt="profile_image"
                            class="w-100 border-radius-lg shadow-sm border border-3 border-white">
                        @endif

                    </div>
                </div>
                <div class="col">
                    <h5 class="fw-bold mb-1">{{ $siswa->user->name }}</h5>
                    <p class="text-muted mb-0">{{ $siswa->kelas->kelas ?? '-' }} | {{ $siswa->jurusan->jurusan ?? '-' }}</p>
                </div>
                <div class="col-auto text-end">
                    <!-- Tombol Buka Modal -->
                    <button type="button" class="btn btn-dark btn-sm w-100 p-2" data-bs-toggle="modal" data-bs-target="#editProfile{{ $siswa->id }}">
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
                            <p><strong>Nama Lengkap:</strong> {{ $siswa->user->name }}</p>
                            <p><strong>NIS:</strong> {{ $siswa->NIS ?? '-' }}</p>
                            <p><strong>Jenis Kelamin:</strong> {{ ucfirst($siswa->jenis_kelamin) ?? '-' }}</p>
                            <p><strong>TTL:</strong> {{ $siswa->tempat_lahir ?? '-' }},
                                {{ $siswa->tanggal_lahir ? \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d F Y') : '-' }}
                            </p>
                            <p><strong>Golongan Darah:</strong> {{ $siswa->golongan_darah ?? '-' }}</p>
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
                            <p><strong>Kelas:</strong> {{ $siswa->kelas->nama_kelas ?? '-' }}</p>
                            <p><strong>Jurusan:</strong> {{ $siswa->jurusan->jurusan ?? '-' }}</p>
                            <p><strong>Email:</strong> {{ $siswa->user->email }}</p>
                            <p><strong>Nomor Telepon:</strong> {{ $siswa->no_hp ?? '-' }}</p>
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
                            <h4 class="fw-bold text-decoration-underline">Dunia Kerja</h4>
                            @if ($dudi)
                            <p><strong>Nama DUDI:</strong> {{ $dudi->nama_dudi }}</p>
                            <p><strong>Direktur DUDI:</strong> {{ $dudi->direktur }}</p>
                            <p><strong>Pembimbing DUDI:</strong> {{ $dudi->pembimbing }}</p>
                            <p><strong>Kontak:</strong> {{ $dudi->no_hp }}</p>
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

<!-- ✅ Modal Edit Profil -->
<div class="modal fade" id="editProfile{{ $siswa->id }}" tabindex="-1" aria-labelledby="editProfileLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark ">
                <h5 class="modal-title text-white" id="editProfileLabel">Ubah Data Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('siswa.profile.update', $profile->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <div class="mb-3">
                        <label>Nama Lengkap</label>
                        <input type="text" name="name" class="form-control border" value="{{ $siswa->user->name }}">
                    </div>
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control border" value="{{ $siswa->user->email }}">
                    </div>
                    @error('email')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control border">
                    </div>
                    @error('password')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label>Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control border" value="{{ $siswa->tempat_lahir }}">
                    </div>
                    @error('tempat_lahir')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control border" value="{{ $siswa->tangga_lahir }}">
                    </div>
                    @error('tangga_lahir')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label>Golongan Darah</label>
                        <input type="text" name="golongan_darah" class="form-control border" value="{{ $siswa->golongan_darah }}">
                    </div>
                    @error('golongan_darah')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control border" required>
                            <option value="tidak diketahui" {{ $siswa->jenis_kelamin == 'tidak diketahui' ? 'selected' : '' }}>Tidak Diketahui</option>
                            <option value="Laki-laki" {{ $siswa->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ $siswa->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    @error('jenis_kelamin')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label>Foto (opsional)</label>
                        <input type="file" name="foto" class="form-control border">
                        @if($siswa->foto)
                        <img src="{{ asset('storage/' . $siswa->foto) }}" width="80" class="mt-2 rounded">
                        @endif
                    </div>
                    @error('foto')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection