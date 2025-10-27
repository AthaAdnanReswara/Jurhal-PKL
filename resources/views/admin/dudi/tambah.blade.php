@extends('layout.app')

@section('content')
<div class="container">
    <h2>Tambah Dudi</h2>

    <form action="{{ route('admin.dudi.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>dudi</label>
            <input type="text" name="nama_dudi" class="form-control border" >
            @error('nama_dudi')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label>Jenis Usaha</label>
            <input type="text" name="jenis_usaha" class="form-control border" >
            @error('jenis_usaha')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <input type="text" name="alamat" class="form-control border" >
            @error('alamat')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label>Telepon</label>
            <input type="text" name="no_hp" class="form-control border" >
            @error('no_hp')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label>Direktur</label>
            <input type="text" name="direktur" class="form-control border" >
            @error('direktur')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label>Pembimbing</label>
            <input type="text" name="pembimbing" class="form-control border" >
            @error('pembimbing')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.dudi.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection