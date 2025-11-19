@extends('layout.app')

@section('content')
<div class="container">
    <h2>Tambah Siswa</h2>

    @if ($errors->any())
    <div class="alert alert-danger small">
        {{ $errors->first() }}
    </div>
    @endif

    <form action="{{ route('admin.siswa.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control border" >
        </div>
        @error('name')
        <div class="text-danger">{{ $message }}</div>
        @enderror
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control border" >
        </div>
        @error('email')
        <div class="text-danger">{{ $message }}</div>
        @enderror
        <div class="mb-3">
            <label>NIS</label>
            <input type="text" name="NIS" class="form-control border" >
        </div>
        @error('NIS')
        <div class="text-danger">{{ $message }}</div>
        @enderror
        <div class="mb-3">
            <label>Tempat Lahir</label>
            <input type="text" name="tempat_lahir" class="form-control border" >
        </div>
        @error('tempat_lahir')
        <div class="text-danger">{{ $message }}</div>
        @enderror
        <div class="mb-3">
            <label>Tanggal lahir</label>
            <input type="date" name="tanggal_lahir" class="form-control border" >
        </div>
        @error('tanggal_lahir')
        <div class="text-danger">{{ $message }}</div>
        @enderror
        <div class="mb-3">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control border">
                <option value="tidak diketahui">Tidak diketahui</option>
                <option value="laki-laki">Laki-laki</option>
                <option value="perempuan">Perempuan</option>
            </select>
        </div>
        @error('jenis_kelamin')
        <div class="text-danger">{{ $message }}</div>
        @enderror
        <div class="mb-3">
            <label>Kelas</label>
            <select name="kelas" class="form-control border">
                <option value="">Pilih Kelas</option>
                @foreach ($kelas as $kls)
                <option value="{{ $kls->id }}">{{ $kls->nama_kelas }}</option>
                @endforeach
            </select>
        </div>
        @error('nama_kelas')
        <div class="text-danger">{{ $message }}</div>
        @enderror
        <div class="mb-3">
            <label>Jurusan</label>
            <select name="jurusan" class="form-control border">
                <option value="">Pilih Jurusan</option>
                @foreach ($jurusan as $jrs)
                <option value="{{ $jrs->id }}">{{ $jrs->jurusan }}</option>
                @endforeach
            </select>
        </div> 
        @error('jurusan')
        <div class="text-danger">{{ $message }}</div>
        @enderror
        <div class="mb-3">
            <label>Dudi</label>
            <select name="nama_dudi" class="form-control border">
                <option value="">Pilih Dudi</option>
                @foreach ($dudi as $d)
                <option value="{{ $d->id }}">{{ $d->nama_dudi }}</option>
                @endforeach
            </select>
        </div> 
        @error('nama_dudi')
        <div class="text-danger">{{ $message }}</div>
        @enderror
        <div class="mb-3">
            <label>Pembimbing</label>
            <select name="pembimbing_id" class="form-control border">
                <option value="">Pilih Pembimbing</option>
                @foreach ($pembimbing as $pbb)
                <option value="{{ $pbb->id }}">{{ $pbb->name }}</option>
                @endforeach
            </select>
        </div> 
        @error('pembimbing_id')
        <div class="text-danger">{{ $message }}</div>
        @enderror
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control border" >
        </div>
        @error('password')
        <div class="text-danger">{{ $message }}</div>
        @enderror
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.kelas.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection