@extends('layout.app')

@section('content')
<div class="container">
    <h2>Tambah Kelas</h2>

    <form action="{{ route('admin.kelas.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Kelas</label>
            <input type="text" name="nama_kelas" class="form-control border" >
            @error('nama_kelas')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.kelas.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection