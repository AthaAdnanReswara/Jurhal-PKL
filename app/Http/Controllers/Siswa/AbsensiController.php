<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    //menapilan di admin
    public function absensi()
    {
        $absensi = Absensi::with(['siswa'])->get();

        return view('admin.absensi.absensi', compact('absensi'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $absensis = Absensi::where('id_siswa', Auth::user()->siswa->id)->get();
        return view('siswa.absensi.index', compact('absensis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('siswa.absensi.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    // Ambil user yang sedang login
    $user = Auth::user();
    $siswa = $user->siswa; // relasi antara user dan siswa

    // Validasi input
    $request->validate([
        'tanggal' => 'required|date',
        'jam_masuk' => 'required',
        'jam_pulang' => 'required',
        'status' => 'required|in:hadir,izin,sakit', // disesuaikan dengan enum di tabel
        'keterangan' => 'nullable|string',
    ]);

    // Simpan data ke tabel absensis
    Absensi::create([
        'id_siswa' => $siswa->id, // siswa login (misal Fogenky)
        'tanggal' => $request->tanggal,
        'jam_masuk' => $request->jam_masuk,
        'jam_pulang' => $request->jam_pulang,
        'status' => $request->status,
        'keterangan' => $request->keterangan ?? null,
    ]);

    // Redirect dengan pesan sukses
    return redirect()->route('siswa.absensi.index')->with('success', 'Absensi berhasil ditambahkan.');
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
