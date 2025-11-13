<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        $user = Auth::user();
        $siswa = $user->siswa;
        
        // 1️⃣ Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:user,email,' . $user->id,
            'password'=> 'nullable|min:3',

            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamain' => 'required|string',
            'golongan_darah' => 'nullable|string|max:3',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

         // 2️⃣ Update data user

        if($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $dataUser = [
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> $request->password,
        ];

        $dataSiswa = [
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenisa_kelamain' => $request->jenisa_kelamain,
            'golongan_darah' => $request->golongan_darah,
        ];

        if ($request->hasFile('foto')) {
            if ($siswa->foto && Storage::disk('public')->exists($siswa->foto)) {
                Storage::disk('public')->delete($siswa->foto);
            }
            $dataSiswa['foto'] = $request->file('foto')->store('profile', 'public');
        }

        $user->update($dataSiswa);
        $siswa->update($dataSiswa);


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
