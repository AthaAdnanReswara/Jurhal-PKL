<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dudi;
use Illuminate\Http\Request;

class DudiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $dudi = Dudi::all();
        return view('admin.dudi.index', compact('dudi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.dudi.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nama_dudi' => 'required|string|max:255',
            'jenis_usaha' => 'required|string|max:255',
            'alamat' => 'required|string|max:555',
            'no_hp' => 'required|string|max:255',
            'direktur' => 'required|string|max:255',
            'pembimbing' => 'required|string|max:255',
        ]);

        Dudi::create([
            'nama_dudi' => $request->nama_dudi,
            'jenis_usaha' => $request->jenis_usaha,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'direktur' => $request->direktur,
            'pembimbing' => $request->pembimbing,
        ]);
        return redirect()->route('admin.dudi.index');
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
    public function edit(Dudi $dudi)
    {
        //
        return view('admin.dudi.edit', compact('dudi'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dudi $dudi)
    {
        //
        $request->validate([
            'nama_dudi' => 'required|string|max:255',
            'jenis_usaha' => 'required|string|max:255',
            'alamat' => 'required|string|max:555',
            'no_hp' => 'required|string|max:255',
            'direktur' => 'required|string|max:255',
            'pembimbing' => 'required|string|max:255',
        ]);
        $dudi->update([ 
            'nama_dudi' => $request->nama_dudi,
            'jenis_usaha' => $request->jenis_usaha,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'direktu' => $request->direktu,
            'pembimbing' => $request->pembimbing,
        ]);
        return redirect()->route('admin.dudi.index')->with('success', 'berhasil mengupdate data dudi');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dudi $dudi)
    {
        //
        $dudi->delete();
        return redirect()->route('admin.dudi.index')->with('success', 'berhasil menghapus dudi');
    }
}
