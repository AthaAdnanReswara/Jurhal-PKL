<?php

namespace App\Http\Controllers\Pembimbing;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Kegiatan;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembimbingSiswa extends Controller
{
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

    public function index()
    {
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
    public function update(Request $request, string $id)
    {
        //
        // Mengambil objek berdasarkan ID
        $kegiatan = Kegiatan::findOrFail($id);
        $request->validate([
            'catatan_pembimbing' => 'nullable|string|max:500',
        ]);

        $kegiatan->catatan_pembimbing = $request->catatan_pembimbing;
        $kegiatan->save();

        return redirect()->back()->with('success', 'Catatan pembimbing berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
