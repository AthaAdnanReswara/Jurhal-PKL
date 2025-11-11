@extends('layout.app')

@section('content')
<div class="container">
    <h2>Edit Kegiatan</h2>

    <form action="{{ route('siswa.kegiatan.update', $kegiatan->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" value="{{ $kegiatan->tanggal }}" class="form-control border px-2" required>
        </div>

        <div class="mb-3">
            <label>Jam Mulai</label>
            <input type="time" name="jam_mulai" value="{{ $kegiatan->jam_mulai }}" class="form-control border px-2" required>
        </div>

        <div class="mb-3">
            <label>Jam Selesai</label>
            <input type="time" name="jam_selesai" value="{{ $kegiatan->jam_selesai }}" class="form-control border px-2" required>
        </div>

        <div class="mb-3">
            <label>Kegiatan</label>
            <textarea name="kegiatan" id="kegiatan" class="form-control border ">{{ $kegiatan->kegiatan }}</textarea>
        </div>

        <div class="mb-3">
            <label>Dokumentasi</label><br>
            <img src="{{ asset('storage/' . $kegiatan->dukumentasi) }}" alt="dukumentasi" width="35%" class="rounded shadow-sm">
            <input type="file" name="dukumentasi" value="{{ $kegiatan->dukumentasi }}" class="form-control border px-2">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('siswa.kegiatan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>

</div>
@endsection