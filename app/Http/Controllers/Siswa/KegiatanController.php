<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KegiatanController extends Controller
{
    // untuk menampilkan di admin
    public function kegiatan()
    {
        $kegiatans = Kegiatan::with(['siswa'])->get();
        return view('admin.kegiatan.kegiatan', compact('kegiatans'));
    }

    /**
     * Display a listing of the resourc e.
     */
    public function index()
    {
        //
        $kegiatan = Kegiatan::where('id_siswa', Auth::user()->siswa->id)->get();
        return view('siswa.kegiatan.index', compact('kegiatan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('siswa.kegiatan.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Ambil user yang sedang login
        $user = Auth::user();

        // Validasi input
        $data = $request->validate([
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'kegiatan' => 'required',
            'dukumentasi' => 'required|image|mimes:jpg,jpeg,png',
        ]);

        $gambar = $request->file('dukumentasi')->store('kegiatan', 'public');

        // Upload dokumentasi jika ada
        kegiatan::create([
            'id_siswa' => $user->siswa->id, // diasumsikan siswa login (Fogenky)
            'tanggal' => $data['tanggal'],
            'jam_mulai' => $data['jam_mulai'],
            'jam_selesai' => $data['jam_selesai'],
            'kegiatan' => $data['kegiatan'],
            'dukumentasi' => $gambar
        ]);

        return redirect()->route('siswa.kegiatan.index')->with('success', 'sukses menambah data');
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
    public function edit(Kegiatan $kegiatan)
    {
        //
        return view('siswa.kegiatan.edit', compact('kegiatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kegiatan $kegiatan)
    {
        //
        $request->validate([
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'kegiatan' => 'required',
            'dukumentasi' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        $data = [
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'kegiatan' => $request->kegiatan,
        ];

        if ($request->hasFile('dukumentasi')) {
            if ($kegiatan->dukumentasi && Storage::disk('public')->exists($kegiatan->dukumentasi)) {
                Storage::disk('public')->delete($kegiatan->dukumentasi);
            }
            $data['dukumentasi'] = $request->file('dukumentasi')->store('kegiatan', 'public');
        }

        $kegiatan->update($data);

        return redirect()->route('siswa.kegiatan.index')->with('success', 'sukses mengedit data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kegiatan $kegiatan)
    {
        //
        if ($kegiatan->dukumentasi) {
            Storage::disk('public')->delete($kegiatan->dukumentasi);
        }

        $kegiatan->delete();

        return redirect()->route('siswa.kegiatan.index')->with('success', 'berhasil menghapus data kegiatan');
    }
}
