<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $kelas = Kelas::all();
        return view('admin.kelas.index', compact('kelas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.kelas.tambah');
    }               

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nama_kelas' => 'required|unique:kelas,nama_kelas|string|max:255',
        ]);

        Kelas::create([
            'nama_kelas' => $request->nama_kelas,
        ]);

        return redirect()->route('admin.kelas.index')->with('success', 'kelas berhasil ditambahkan');
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
    public function edit(Kelas $kelas)
    {
        //
        return view('admin.kelas.edit', compact('kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kelas $kelas)
    {
        //
        $request->validate([
            'nama_kelas' => 'required|unique:kelas,nama_kelas,' .$kelas->id
        ]);
        $kelas->update([
            'nama_kelas' => $request->nama_kelas
        ]);

        return redirect()->route('admin.kelas.index')->with('success', 'kelas berhasih diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelas $kelas)
    {
        //
        if($kelas->siswa()->count() > 0){
            return redirect()->route('admin.kelas.index')->with('error', 'kelas tidak bisa dihapus karena masih memiliki siswa');
        }
        $kelas->delete();
        return redirect()->route('admin.kelas.index')->with('success', 'kelas berhasih di hapus');
    }
}

