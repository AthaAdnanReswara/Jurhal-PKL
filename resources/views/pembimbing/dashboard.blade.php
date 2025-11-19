@extends('layout.app')

@section('title','Dasboard')

@section('content')

<div class="row">
    <div class="ms-3">
        <h3 class="mb-0 h4 font-weight-bolder">Dashboard</h3>
        <p class="mb-4">
            {{ $user->name}}
        </p>
    </div>

    <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-2 ps-3" >
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="text-sm mb-0 text-capitalize">Dudi</p>
                        <h4 class="mb-0">{{ $totalDudi }}</h4>
                    </div>
                    <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                        <i class="material-symbols-rounded opacity-10">group</i>
                    </div>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-2 ps-3">
                <p class="mb-0 text-sm"><span class="text-success font-weight-bolder"></span><a href="">Lihat Total Dudi</a></p>
            </div>
        </div> 
    </div>
    <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-2 ps-3" >
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="text-sm mb-0 text-capitalize">Siswa</p>
                        <h4 class="mb-0">{{ $totalSiswa }}</h4>
                    </div>
                    <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                        <i class="material-symbols-rounded opacity-10">group_person</i>
                    </div>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-2 ps-3">
                <p class="mb-0 text-sm"><span class="text-success font-weight-bolder"></span><a href="{{ route('pembimbing.siswa.index') }}">Lihat Siswa</a></p>
            </div>
        </div>
    </div>

</div>
@endsection