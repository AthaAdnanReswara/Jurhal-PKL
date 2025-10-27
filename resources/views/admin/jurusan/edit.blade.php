@extends('layout.app')

@section('content')
<div class="container">
    <h2>Edit Jurusan</h2>

    <form action="{{ route('admin.jurusan.update', $jurusan->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>jurusan</label>
            <input type="text" name="jurusan" value="{{ $jurusan->jurusan }}" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.jurusan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection