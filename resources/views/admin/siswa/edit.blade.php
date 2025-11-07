@extends('layout.app')

@section('content')
<div class="container">
    <h2>Edit Siswa</h2>

    @if ($errors->any())
    <div class="alert alert-danger small">
        {{ $errors->first() }}
    </div>
    @endif

    <form action="{{ route('admin.siswa.update', $siswa->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" value="{{ old('name', $siswa->user->name)}}" class="form-control border" >
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email', $siswa->user->email)}}" class="form-control border" >
        </div>
        <div class="mb-3">
            <label>NIS</label>
            <input type="text" name="NIS" value="{{ old('NIS', $siswa->NIS) }}" class="form-control border" >
        </div>
        <div class="mb-3">
            <label>Tempat Lahir</label>
            <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $siswa->tempat_lahir) }}" class="form-control border" >
        </div>
        <div class="mb-3">
            <label>Tanggal lahir</label>
            <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $siswa->tanggal_lahir) }}" class="form-control border" >
        </div>
        <div class="mb-3">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control border">
                <option value="tidak diketahui" {{old('jenis_kelamin',$siswa->jenis_kelamin) == 'tidak diketahui' ? 'selected' : ''}}>Tidak diketahui</option>
                <option value="laki-laki" {{old('jenis_kelamin',$siswa->jenis_kelamin) == 'laki-laki' ? 'selected' : ''}}>Laki-laki</option>
                <option value="perempuan" {{old('jenis_kelamin',$siswa->jenis_kelamin) == 'perempuan' ? 'selected' : ''}}>Perempuan</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Kelas</label>
            <select name="kelas" class="form-control border">
                <option value="">Pilih Kelas</option>
                @foreach ($kelas as $kls)
                <option value="{{ $kls->id }}" {{ old('kelas_id', $siswa->kelas_id) == $kls->id ? 'selected': '' }}>{{ $kls->nama_kelas }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Jurusan</label>
            <select name="jurusan" class="form-control border">
                <option value="">Pilih Jurusan</option>
                @foreach ($jurusan as $jrs)
                <option value="{{ $jrs->id }}" {{ old('jurusan_id', $siswa->jurusan_id) == $jrs->id ? 'selected': '' }}>{{ $jrs->jurusan }}</option>
                @endforeach
            </select>
        </div> 
        
        <div class="mb-3">
            <label>Dudi</label>
            <select name="nama_dudi" class="form-control border">
                <option value="">Pilih Dudi</option>
                @foreach ($dudi as $d)
                <option value="{{ $d->id }}" {{ old('nama_dudi', $siswa->nama_dudi) == $d->id ? 'selected': '' }}>{{ $d->nama_dudi }}</option>
                @endforeach
            </select>
        </div> 
        <div class="mb-3">
            <label>Pembimbing</label>
            <select name="pembimbing_id" class="form-control border">
                <option value="">Pilih Pembimbing</option>
                @foreach ($pembimbing as $pbb)
                <option value="{{ $pbb->id }}" {{ old('pembimbing_id', $siswa->pembimbing_id) == $pbb->id ? 'selected': '' }}>{{ $pbb->name }}</option>
                @endforeach
            </select>
        </div> 
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control border" >
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.siswa.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection