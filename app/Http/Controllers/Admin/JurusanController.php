<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $jurusan = Jurusan::all();
        return view('admin.jurusan.index', compact('jurusan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.jurusan.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'jurusan' => 'required|unique:jurusans,jurusan'
        ]);

        Jurusan::create([
            'jurusan' => $request->jurusan,
        ]);
        return redirect()->route('admin.jurusan.index')->with('success', 'jurusan berhasil ditambah');           
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
    public function edit($id)
    {
        //
        $jurusan = Jurusan::find($id);
        return view('admin.jurusan.edit',compact('jurusan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jurusan $jurusan)
    {
      $request->validate([
            'jurusan' => 'required|unique:jurusans,jurusan,' .$jurusan->id
        ]);
        $jurusan->update([
            'jurusan' => $request->jurusan
        ]);

        return redirect()->route('admin.jurusan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jurusan $jurusan)
    {
        //
        $jurusan->delete();
        return redirect()->route('admin.jurusan.index')->with('success', 'jurusan birhasil dihapus');

    }
}