@extends('layout.app')

@section('content')
<div class="container">
    <h2>Tambah Jurusan</h2>

    <form action="{{ route('admin.jurusan.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>jurusan</label>
            <input type="text" name="jurusan" class="form-control border" >
            @error('jurusan')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.jurusan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection