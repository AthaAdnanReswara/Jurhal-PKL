@extends('layout.app')


@section('content')
<div class="col-12">
    <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Table Kegiatan</h6>
            </div>
        </div>
        <div class="m-3 mb-2">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible text-white">{{ session('success') }}
                <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
        </div>
        <div class="card-body px-0 pb-2">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0" id="kegiatan">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name Siswa</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">pembimbing Siswa</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jam Mulai</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jam Selesai</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kegiatans as $kgt)
                        <tr>
                            <td class="align-middle text-sm">{{ $loop->iteration }}</td>
                            <td class="align-middle text-sm">{{ $kgt->siswa->user->name }}</td>
                            <td class="align-middle text-sm">{{ $kgt->siswa->pembimbing->name }}</td>
                            <td class="align-middle text-sm">{{ $kgt->tanggal }}</td>
                            <td class="align-middle text-sm">{{ $kgt->jam_mulai }}</td>
                            <td class="align-middle text-sm">{{ $kgt->jam_selesai }}</td>
                            <td class="align-middle text-sm">
                                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#detail{{ $kgt->id }}">
                                    detail
                                </button>
                            </td>
                        </tr>
                        <div class="modal fade" id="detail{{ $kgt->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                            aria-labelledby="staticBackdropLabel" aria-hidden="true"> -->
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editProfileLabel">Kegiatan Siswa</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="row g-3">
                                                <div class="form-group">
                                                    <label for="name">Nama Siswa</label>
                                                    <input type="text" class="form-control border" id="name" name="name"
                                                        value="{{ $kgt->siswa->user->name ?? '-' }}" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label for="keterangan_kegiatan">Keterangan Kegiatan:</label>

                                                    <textarea class="form-control border" name="keterangan_kegiatan" id=""
                                                        disabled>{{ $kgt->kegiatan }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tanggal_kegiatan">Tanggal:</label>
                                                    <input type="text" class="form-control border" id="tanggal_kegiatan"
                                                        name="tanggal_kegiatan" value="{{ $kgt->tanggal ?? '-' }}" disabled>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="mulai_kegiatan">Mulai Kegiatan:</label>
                                                        <input type="text" class="form-control border" id="mulai_kegiatan"
                                                            name="mulai_kegiatan" value="{{ $kgt->jam_mulai ?? '-' }}" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="akhir_kegiatan">Akhir Kegiatan:</label>
                                                        <input type="text" class="form-control border" id="akhir_kegiatan"
                                                            name="akhir_kegiatan" value="{{ $kgt->jam_selesai ?? '-' }}" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label>Dokumentasi</label><br>
                                                <img src="{{ asset('storage/' . $kgt->dukumentasi) }}" alt="dukumentasi" width="80%" class="rounded shadow-sm">
                                            </div>
                                            <div class="form-group">
                                                <label for="catatan_pembimbing_{{ $kgt->id }}">Catatan Pembimbing</label>
                                                <textarea class="form-control border" id="catatan_pembimbing_{{ $kgt->id }}"
                                                    name="catatan_pembimbing" rows="4" disabled>{{ $kgt->catatan_pembimbing }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="mulai_kegiatan">Created_at</label>
                                                <input type="text" class="form-control border" id="mulai_kegiatan"
                                                    name="mulai_kegiatan" value="{{ $kgt->created_at->format('d-m-Y H:i') }}" disabled>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#kegiatan').DataTable();
    });
</script>

@endsection