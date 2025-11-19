@extends('layout.app')

@section('content')
<div class="container">
    <h2>Edit Jurusan</h2>

    <form action="{{ route('admin.dudi.update', $dudi->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Dudi</label>
            <input type="text" name="nama_dudi" value="{{ $dudi->nama_dudi }}" class="form-control border" required>
        </div>
        @error('nama_dudi')
        <div class="text-danger">{{ $message }}</div>
        @enderror
        <div class="mb-3">
            <label>Jenis Usaha</label>
            <input type="text" name="jenis_usaha" value="{{ $dudi->jenis_usaha }}" class="form-control border" required>
        </div>
        @error('jenis_usaha')
        <div class="text-danger">{{ $message }}</div>
        @enderror
        <div class="mb-3">
            <label>Alamat</label>
            <input type="text" name="alamat" value="{{ $dudi->alamat }}" class="form-control border" required>
        </div>
        @error('alamat')
        <div class="text-danger">{{ $message }}</div>
        @enderror
        <div class="mb-3">
            <label>Telepon</label>
            <input type="text" name="no_hp" value="{{ $dudi->no_hp }}" class="form-control border" required>
        </div>
        @error('no_hp')
        <div class="text-danger">{{ $message }}</div>
        @enderror
        <div class="mb-3">
            <label>Direktur</label>
            <input type="text" name="direktur" value="{{ $dudi->direktur }}" class="form-control border" required>
        </div>
        @error('direktur')
        <div class="text-danger">{{ $message }}</div>
        @enderror
        <div class="mb-3">
            <label>Pembimbing</label>
            <input type="text" name="pembimbing" value="{{ $dudi->pembimbing }}" class="form-control border" required>
        </div>
        @error('pembimbing')
        <div class="text-danger">{{ $message }}</div>
        @enderror
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.dudi.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection