<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfilSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = Auth::user();

        $siswa = $user->siswa;
        $pembimbing = $siswa ? $siswa->pembimbing : null;
        $kelas = Kelas::all();
        $jurusan = Jurusan::all();
        $dudi = $siswa ? $siswa->dudi : null;

        return view("siswa.profile.index", compact('siswa', 'user', 'pembimbing', 'kelas', 'jurusan', 'dudi'));
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

    public function update(Request $request, string $id)
    {
        // 1️⃣ Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'id_kelas' => 'required',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamain' => 'required|string',
            'golongan_darah' => 'nullable|string|max:3',
            'nama_dudi' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // 2️⃣ Update data user
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
        ]);

        // 3️⃣ Ambil data siswa terkait
        $dataSiswa = Siswa::where('id_siswa', $user->id)->first();

        if ($dataSiswa) {
            $data = [
                'id_kelas' => $request->id_kelas,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamain' => $request->jenis_kelamain,
                'golongan_darah' => $request->golongan_darah,
                'nama_dudi' => $request->nama_dudi,
            ];

            // 4️⃣ Jika ada file foto baru
            if ($request->hasFile('foto')) {
                // Hapus foto lama dari storage jika ada
                if ($dataSiswa->foto && Storage::disk('public')->exists($dataSiswa->foto)) {
                    Storage::disk('public')->delete($dataSiswa->foto);
                }
                // Upload foto baru ke folder storage/app/public/foto_siswa
                $data['foto'] = $request->file('foto')->store('foto_siswa', 'public');
            }

            // 5️⃣ Update ke database
            $dataSiswa->update($data);
        }

        // 6️⃣ Redirect balik dengan notifikasi sukses
        return redirect()->route('siswa.profile.index')->with('success', 'Data siswa berhasil diperbarui!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
