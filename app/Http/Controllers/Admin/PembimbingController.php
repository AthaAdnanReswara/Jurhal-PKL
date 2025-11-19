<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PembimbingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::where('role', 'pembimbing')->get();
        return view('admin.pembimbing.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.pembimbing.tambah');  
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:3',
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pembimbing',
        ]);
        return redirect()->route('admin.pembimbing.index')->with('status', 'User Pembimbing berhasil ditambahkan.');
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
    public function edit(User $pembimbing)
    {
        //
        return view('admin.pembimbing.edit',compact('pembimbing'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $pembimbing)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email,' .$pembimbing->id,
            'password' => 'nullable|min:3,'
        ]);

        $pembimbing->name = $request->name;
        $pembimbing->email = $request->email; 
       
        if ($request->filled('password')) {
            $pembimbing->password = Hash::make($request->password);
        }

        $pembimbing->save();
   
        return redirect()->route('admin.pembimbing.index')->with('success','berhasil mengupdate pembimbing');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $pembimbing)
    {
        if($pembimbing->pembimbingSiswa()->count() > 0){
            return redirect()->route('admin.pembimbing.index')->with('error', 'pembimbing tidak bisa dihapus karena masih memiliki siswa');
        }
        $pembimbing->delete();
            return redirect()->route('admin.pembimbing.index')->with('success','berhasil menghapus pembimbing');
    }
}
