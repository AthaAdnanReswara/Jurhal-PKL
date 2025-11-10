@extends('layout.app')

@section('content')
<div class="container">
    <h2>Tambah Kegiatan</h2>

    @if ($errors->any())
    <div class="alert alert-danger small">
        {{ $errors->first() }}
    </div>
    @endif

    <form action="{{ route('siswa.kegiatan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control border px-2" required>
        </div>

        <div class="mb-3">
            <label>Jam Mulai</label>
            <input type="time" name="jam_mulai" class="form-control border px-2" required>
        </div>

        <div class="mb-3">
            <label>Jam Selesai</label>
            <input type="time" name="jam_selesai" class="form-control border px-2" required>
        </div>

        <div class="mb-3">
            <label>Kegiatan</label>
            <textarea name="kegiatan" id="kegiatan" class="form-control border " rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label>Dokumentasi</label>
            <input type="file" name="dukumentasi" class="form-control border px-2">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('siswa.kegiatan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>

</div>
@endsection