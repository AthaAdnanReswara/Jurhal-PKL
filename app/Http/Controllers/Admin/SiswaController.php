<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dudi;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $siswa = Siswa::with(['user', 'pembimbing', 'dudi', 'kelas', 'jurusan', 'kegiatan', 'absensi'])->get();
        return view('admin.siswa.index', compact('siswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $kelas = Kelas::all();
        $jurusan = Jurusan::all();
        $dudi = Dudi::all();
        $pembimbing = User::where('role', 'pembimbing')->get();

        return view('admin.siswa.createSiswa', compact('kelas', 'jurusan', 'dudi', 'pembimbing'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:3',

            'NIS' => 'required|unique:siswas,nis',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan,tidak diketahui',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
            'nama_dudi' => 'required',
            'pembimbing_id' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'siswa',
        ]);

        Siswa::create([
            'id_siswa' => $user->id,
            'NIS' => $request->NIS,
            'jurusan_id' => $request->jurusan,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'kelas_id' => $request->kelas,
            'jenis_kelamin' => $request->jenis_kelamin,
            'nama_dudi' => $request->nama_dudi,
            'pembimbing_id' => $request->pembimbing_id,
        ]);

        return redirect()->route('admin.siswa.index')->with('success', 'berhasil menambahkan data siswa');
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
    public function edit(Siswa $siswa)
    {
        //
        $kelas = Kelas::all();
        $jurusan = Jurusan::all();
        $dudi = Dudi::all();
        $pembimbing = User::where('role','pembimbing')->get();
        return view('admin.siswa.edit', compact('siswa','kelas','jurusan','dudi','pembimbing'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Siswa $siswa)
    {
        //
        $user = User::findOrFail($siswa->id_siswa);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'. $user->id,
            'password' => 'nullable|min:3',

            'NIS' => 'required|unique:siswas,nis,' . $siswa->id,
            'jenis_kelamin' => 'required|in:laki-laki,perempuan,tidak diketahui',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
            'nama_dudi' => 'required',
            'pembimbing_id' => 'required',
        ]);

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $user->password,
        ]);

        $siswa->update([
            'id_siswa' => $user->id,
            'NIS' => $request->NIS,
            'jurusan_id' => $request->jurusan,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'kelas_id' => $request->kelas,
            'jenis_kelamin' => $request->jenis_kelamin,
            'nama_dudi' => $request->nama_dudi,
            'pembimbing_id' => $request->pembimbing_id,
        ]);
        return redirect()->route('admin.siswa.index')->with('success', 'berhasil mengupdate data siswa');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Siswa $siswa)
    {
        //
        $user = User::find($siswa->id_siswa);
        $user->delete();
        $siswa->delete();

        return redirect()->route('admin.siswa.index')->with('success','Siswa berhsasil di hapus');
    }
}
