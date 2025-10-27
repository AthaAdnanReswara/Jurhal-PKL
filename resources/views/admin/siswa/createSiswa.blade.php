@extends('layout.app')

@section('content')
<div class="container">
    <h2>Tambah Kelas</h2>

    @if ($errors->any())
    <div class="alert alert-danger small">
        {{ $errors->first() }}
    </div>

    <form action="{{ route('admin.siswa.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <select name="id_kelas">
                <option selected>Pilih Kelas</option>
                @foreach ($kelas as $kls)
                <option nama="id_jurusan" value="{{ $klas->id }}">{{ $kls->kelas }}</option>
                @endforeach
            </select>
        </div>
        
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