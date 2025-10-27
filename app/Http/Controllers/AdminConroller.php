<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminConroller extends Controller
{
    //ini  untuk function di siswa admin

    public function indexSiswa()
    {
        $users = User::where('role', 'siswa')->get();
        return view('admin.siswa.indexSiswa', compact('users'));
    }

    public function tambahSiswa()
    {
        return view('admin.siswa.createSiswa');
    }

    public function tambahSiswaStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:3',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'siswa',
        ]);

        return redirect()->route('admin.siswa.index')->with('status', 'User siswa berhasil ditambahkan.');
    }

}
