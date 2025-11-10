@extends('layout.app')

@section('content')
<div class="container">
    <h2>Tambah Abasensi</h2>

    @if ($errors->any())
    <div class="alert alert-danger small">
        {{ $errors->first() }}
    </div>
    @endif

    <form action="{{ route('siswa.absensi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control border" required>
        </div>

        <div class="mb-3">
            <label>Jam Masuk</label>
            <input type="time" name="jam_masuk" class="form-control border" required>
        </div>

        <div class="mb-3">
            <label>Jam Pulang</label>
            <input type="time" name="jam_pulang" class="form-control border" required>
        </div>

        <div class="mb-3">
            <label>status</label>
            <input type="name" name="status" class="form-control border" required>
        </div>

        <div class="mb-3">
            <label>Keterangan</label>
            <input type="file" name="keterangan" class="form-control border">
        </div>
        
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('siswa.absensi.index') }}" class="btn btn-secondary">Kembali</a>
    </form>

</div>
@endsection