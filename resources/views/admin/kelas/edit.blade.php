@extends('layout.app')

@section('content')
<div class="container">
    <h2>Edit Kelas</h2>

    <form action="{{ route('admin.kelas.update', $kelas->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Kelas</label>
            <input type="text" name="nama_kelas" value="{{ old('nama_kelas', $kelas->nama_kelas) }}" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.kelas.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection