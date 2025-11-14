<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Kegiatan;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembimbingSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $siswas = Siswa::where('pembimbing_id', Auth::user()->id)->get();
        return view('pembimbing.siswa.index', compact('siswas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function siswaKegiatan($id)
    {
        $kegiatans = Kegiatan::where('id_siswa', $id)->get();
        return view('pembimbing.siswa.kegiatan', compact('kegiatans'));
    }

    public function siswaAbsensi($id)
    {
        $absensis = Absensi::where('id_siswa', $id)->get();
        return view('pembimbing.siswa.absensi', compact('absensis'));
    }
}
